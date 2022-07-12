<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class VerifyController extends Controller
{
    public function Verify_documents(Request $request)
    {
        $withdrawal_slip = WithdrawalSlip::find($request->key); 

        $request_key = $request->key;

        if(!empty($withdrawal_slip))
        {
            Session::flash('success', 'This document is a valid documents from Gensan Feedmill Inc.');
        }

        return view('slip.verification', compact('withdrawal_slip'));

    }
}
