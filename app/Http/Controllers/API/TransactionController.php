<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Response\ResponseMessage;
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
            return $this->transactionService->makeTransaction($request);
        } catch (\Exception $e) {
            return ResponseMessage::create(500, $e->getMessage());
        }
    }
}
