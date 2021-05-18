<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Services\Interfaces\TransactionServiceInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

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
            $transaction = $this->transactionService->makeTransaction($request);
            return $transaction;
        } catch (\Exception $e) {
            Log::info($e->getMessage());
        }
    }
}
