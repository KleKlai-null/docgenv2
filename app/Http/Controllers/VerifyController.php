<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\WithdrawalSlip;
use App\Models\ReturnSlip;
use Session;

class VerifyController extends Controller
{
    public function Verify_documents(Request $request)
    {
        $withdrawal_slip = WithdrawalSlip::find($request->key); 

        if(!$withdrawal_slip)
        {
            $withdrawal_slip = ReturnSlip::find($request->key); 
        }

        $request_key = $request->key;

        if(!empty($withdrawal_slip))
        {
            Session::flash('success', 'This document is a valid documents from Gensan Feedmill Inc.');
        }

        return view('slip.verification', compact('withdrawal_slip'));

    }
}
