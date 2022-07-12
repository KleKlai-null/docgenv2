<?php

namespace App\Http\Controllers;

use App\Models\WithdrawalSlip;
use App\Models\Item;
use Illuminate\Http\Request;
use Exception;
use Barryvdh\DomPDF\Facade\Pdf;
use SimpleSoftwareIO\QrCode\Facades\QrCode;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\WithdrawalSlipRequest;
use Illuminate\Support\Facades\DB;

class WithdrawalSlipController extends Controller
{
    private $storeData;

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $search = $request->search;
        
        if(!empty($search)){

            $data = WithdrawalSlip::where(function ($query) use ($search){
                $query->where('document_series_no', 'like', '%'.$search.'%')
                    ->orWhere('customer_name', 'like', '%'.$search.'%');
            })->paginate(5);

            $data->appends(['search' => $search]);
        }
        else{
            $data = WithdrawalSlip::paginate(5);
        }

        return view('slip.index', compact('data'));   
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        $withdrawalSlip_count = WithdrawalSlip::count();

        $count = sprintf("%05d", $withdrawalSlip_count + 1);

        //Generate Document Series Number
        $document_series_number = 'GFI-MI-'.date('Y').'-'.$count;

        return view('slip.create', compact('document_series_number'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(WithdrawalSlipRequest $request)
    {

        DB::transaction(function () use ($request){

            $this->storeData = WithdrawalSlip::create([
                'user_id'                   => auth()->user()->id,
                'customer_name'             => $request->customer_name,
                'document_series_no'        => $request->document_series_no,
                'customer_date'             => $request->customer_date,
                'pallet_no'                 => $request->pallet_no,
                'wh_location'               => $request->wh_location,
                'warehouse'                 => $request->warehouse,
                'profit_center'             => $request->profit_center,
                'sub_profit_center'         => $request->sub_profit_center,
                'prepared_by'               => $request->prepared_by,
                'approved_by'               => $request->approved_by,
                'released_by'               => $request->released_by,
            ]);

            foreach($request->items as $key => $item) {
                Item::create([
                    'withdrawal_slip_id'    => $this->storeData->id,
                    'item_code'             => $item['item_code'],
                    'item_description'      => $item['item_description'],
                    'qty'                   => $item['qty'],
                    'uom'                   => $item['uom'],
                    'remarks'               => $item['remarks']
                ]);
            }

        }, 1);

        $image = QrCode::format('png')
            ->size(200)->errorCorrection('H')
            ->generate(config('app.url').'/verify/'.$this->storeData->id);

        $output_file = '/img/qr/qr-' . $this->storeData->document_series_no . '.png';

        Storage::disk('public')->put($output_file, $image); //storage/app/public/img/qr-code/qr-1557309130.png

        $withdrawalSlip = $this->storeData;

        // Generate PDF File
        $customPaper = array(0,0,567.00,283.80);
        $pdf = PDF::loadView('slip.pdf', compact('withdrawalSlip'))->setPaper($customPaper, 'portrait');
        $content = $pdf->download()->getOriginalContent();
        Storage::disk('local')->put('returnslip/bak/'.$this->storeData->document_series_no.'.pdf',$content) ;

        return redirect('history-log');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\WithdrawalSlip  $withdrawalSlip
     * @return \Illuminate\Http\Response
     */
    public function show(WithdrawalSlip $withdrawalSlip)
    {
        $customPaper = array(0,0,567.00,283.80);

        $pdf = PDF::loadView('slip.pdf', compact('withdrawalSlip'))->setPaper($customPaper, 'portrait');
        return $pdf->stream();
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\WithdrawalSlip  $withdrawalSlip
     * @return \Illuminate\Http\Response
     */
    public function edit(WithdrawalSlip $withdrawalSlip)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\WithdrawalSlip  $withdrawalSlip
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, WithdrawalSlip $withdrawalSlip)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\WithdrawalSlip  $withdrawalSlip
     * @return \Illuminate\Http\Response
     */
    public function destroy(WithdrawalSlip $withdrawalSlip)
    {
        //
    }   

    public function generatePDF($id)
    {
        $withdrawalSlip = WithdrawalSlip::where('id', $id)->first();

        $customPaper = array(0,0,567.00,283.80);

        //Change save area to storage to prevent access public
        // $pdf = PDF::loadView('slip.view', compact('withdrawalSlip'));
        $pdf = PDF::loadView('slip.pdf', compact('withdrawalSlip'))->setPaper($customPaper, 'portrait');
        return $pdf->download($withdrawalSlip->document_series_no.'.pdf');
    }
}
