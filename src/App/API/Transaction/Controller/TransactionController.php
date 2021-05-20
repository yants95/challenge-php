<?php

namespace App\API\Transaction\Controller;

use Domain\Transaction\Services\Interfaces\TransactionServiceInterface;

use App\Core\Http\Controllers\Controller;
use App\Core\Http\Response\ResponseMessage;
use Illuminate\Http\Request;

class TransactionController extends Controller
{
    protected $transactionService;

    public function __construct(TransactionServiceInterface $transactionService)
    {
        $this->transactionService = $transactionService;
    }

    public function handle(Request $request)
    {
        try {
            return $this->transactionService->makeTransaction($request);
        } catch (\Exception $e) {
            return ResponseMessage::create(500, $e->getMessage());
        }
    }
}
