<?php

namespace App\Http\Controllers;
use Digikraaft\Paystack\Paystack;
use Digikraaft\PaystackSubscription\Payment as PaystackPayment;
use Digikraaft\PaystackSubscription\Exceptions\PaymentFailure;
use App\Models\Deposit;

use Illuminate\Http\Request;

class DepositController extends Controller
{
    
    public function verifyPaystack($txnref)
    {
        $transaction = PaystackPayment::hasValidTransaction($txnref);
        if ($transaction) {

            return $transaction;
        }
        return false;
       
    }


    public function createDeposit(Request $request)
    {
        $txnid = $request->reference;

        //dd($txnid);

        if($transaction = $this->verifyPaystack($txnid)){
            if(Deposit::whereTxnref($transaction->data->reference)->first() ){
                throw PaymentFailure::paymentAlreadyExist();
            }

           
            $deposit = Deposit::create([
                "amount" => $transaction->data->amount,
                "txnref" => $transaction->data->reference,
                "wallet_id" => auth()->user()->wallet->id,
                "user_id" => auth()->user()->id,
            ]);
    
            if($request->wantsJson()){
                return response()->json([
                    'status' => 'success',
                    'message' => 'Successfull',
                    'data' => $deposit
                ], 201);
            }
            return redirect()->back();
        }

    
        return response()->json([
            'status' => 'error',
            'message' => 'error occured'
        ], 400);
       

       
    }


}
