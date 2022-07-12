<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class WithdrawalSlipRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
        // return auth()->user()->hasRole('Clerk') ? true : false ;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'customer_name'             => 'required|string',
            'document_series_no'        => 'required|string',
            'pallet_no'                 => 'required',
            'wh_location'               => 'required',
            'warehouse'                 => 'required',
            'profit_center'             => 'required',
            'sub_profit_center'         => 'required',
            'prepared_by'               => 'required',
            'approved_by'               => 'required',
            'released_by'               => 'required',
        ];
    }
}
