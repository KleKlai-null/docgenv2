<?php

namespace App\Observers;

use App\Models\WithdrawalSlip;

class WithdrawalSlipObserver
{
    public $afterCommit = true;

    /**
     * Handle the WithdrawalSlip "created" event.
     *
     * @param  \App\Models\WithdrawalSlip  $withdrawalSlip
     * @return void
     */
    public function created(WithdrawalSlip $withdrawalSlip)
    {
        activity()
        ->causedBy(auth()->user()->id)
        ->performedOn($withdrawalSlip)
        ->log(auth()->user()->name . ' created withdrawal slip');
    }

    /**
     * Handle the WithdrawalSlip "updated" event.
     *
     * @param  \App\Models\WithdrawalSlip  $withdrawalSlip
     * @return void
     */
    public function updated(WithdrawalSlip $withdrawalSlip)
    {
        //
    }

    /**
     * Handle the WithdrawalSlip "deleted" event.
     *
     * @param  \App\Models\WithdrawalSlip  $withdrawalSlip
     * @return void
     */
    public function deleted(WithdrawalSlip $withdrawalSlip)
    {
        //
    }

    /**
     * Handle the WithdrawalSlip "restored" event.
     *
     * @param  \App\Models\WithdrawalSlip  $withdrawalSlip
     * @return void
     */
    public function restored(WithdrawalSlip $withdrawalSlip)
    {
        //
    }

    /**
     * Handle the WithdrawalSlip "force deleted" event.
     *
     * @param  \App\Models\WithdrawalSlip  $withdrawalSlip
     * @return void
     */
    public function forceDeleted(WithdrawalSlip $withdrawalSlip)
    {
        //
    }
}
