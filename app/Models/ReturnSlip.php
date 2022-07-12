<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Traits\UUID;

class ReturnSlip extends Model
{
    use UUID, HasFactory;

    protected $guarded = [
        'id',
        'created_at',
        'updated_at'
    ];

    public function returnitems()
    {
        return $this->hasMany(ReturnItem::class);
    }

    public function withdrawalslip()
    {
        return $this->belongsTo(WithdrawalSlip::class);
    }
}
