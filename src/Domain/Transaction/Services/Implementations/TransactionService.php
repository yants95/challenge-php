<?php

namespace Domain\Transaction\Services\Implementations;

use Domain\Transaction\Repositories\TransactionRepositoryInterface;
use Domain\Transaction\Services\Interfaces\TransactionServiceInterface;
use Domain\Wallet\Repositories\WalletRepositoryInterface;
use Domain\User\Repositories\UserRepositoryInterface;

use App\Core\External\Interfaces\AuthorizationServiceInterface;
use App\Core\Http\Response\ResponseMessage;

use Illuminate\Support\Facades\DB;

class TransactionService implements TransactionServiceInterface
{
    protected $transactionRepository;
    protected $walletRepository;
    protected $userRepository;
    protected $authorizationService;

    public function __construct(
        TransactionRepositoryInterface $transactionRepository,
        WalletRepositoryInterface $walletRepository,
        UserRepositoryInterface $userRepository,
        AuthorizationServiceInterface $authorizationService
    ) {
        $this->transactionRepository = $transactionRepository;
        $this->walletRepository = $walletRepository;
        $this->userRepository = $userRepository;
        $this->authorizationService = $authorizationService;
    }

    public function makeTransaction($data)
    {
        try {
            $transaction = [
                'value' => $data->value,
                'payer' => $data->payer,
                'payee' => $data->payee
            ];

            $payerWallet = $this->walletRepository->getWalletByUser($data->payer);
            $payeeWallet = $this->walletRepository->getWalletByUser($data->payee);

            if (!$this->userRepository->checkPayerType($payerWallet->user_id)) {
                return ResponseMessage::create(400, "Ops! Shopkeepers cannot do transfers.");
            }

            if (!$this->walletRepository->getSufficientWalletAmount($payerWallet, $data->value)) {
                return ResponseMessage::create(400, "Insufficient funds");
            }

            if (!$this->authorizationService->authorize()) {
                return ResponseMessage::create(400, "Ops! Transfer not authorized.");
            }

            DB::beginTransaction();

            $this->transactionRepository->create($transaction);

            $this->walletRepository->increaseAmount($payeeWallet, $data->value);
            $this->walletRepository->decreaseAmount($payerWallet, $data->value);

            DB::commit();

            return ResponseMessage::create(200, "Transfer completed successfully");
        } catch (\Exception $e) {
            DB::rollback();

            return ResponseMessage::create(500, $e->getMessage());
        }
    }
}
