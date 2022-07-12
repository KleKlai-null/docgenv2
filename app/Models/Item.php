<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    use HasFactory;

    protected $fillable = [
        'withdrawal_slip_id',
        'item_code', 
        'item_description', 
        'qty',
        'uom',
        'remarks'
    ];

    public function withdrawalslip()
    {
        return $this->belongsTo(WithdrawalSlip::class);
    }
}
