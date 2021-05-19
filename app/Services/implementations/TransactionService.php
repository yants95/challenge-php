<?php

namespace App\Services\Implementations;

use App\External\Interfaces\AuthorizationServiceInterface;
use App\Http\Response\ResponseMessage;
use App\Repositories\Interfaces\TransactionRepositoryInterface;
use App\Repositories\Interfaces\WalletRepositoryInterface;
use App\Repositories\Interfaces\UserRepositoryInterface;
use App\Services\Interfaces\TransactionServiceInterface;
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
                'payee' => $data->payee,
            ];

            DB::beginTransaction();

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
