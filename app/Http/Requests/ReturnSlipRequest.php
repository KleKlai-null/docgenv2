<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ReturnSlipRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'department'            => 'required',
            'mr_no'                 => 'required',
            'withdrawal_slip_no'    => 'required',
            'prepared_by'           => 'required',
            'approved_by'           => 'required',
            'received_by'           => 'required',
        ];
    }
}
