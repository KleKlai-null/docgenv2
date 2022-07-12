<?php

namespace App\Http\Controllers;

use App\Http\Requests\ReturnSlipRequest;
use App\Models\ReturnItem;
use App\Models\ReturnSlip;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use SimpleSoftwareIO\QrCode\Facades\QrCode;
use Illuminate\Support\Facades\Storage;

class ReturnSlipController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $search = $request->search;
        
        if(!empty($search)){

            $data = ReturnSlip::where(function ($query) use ($search){
                $query->where('document_series_no', 'like', '%'.$search.'%')
                    ->orWhere('department', 'like', '%'.$search.'%');
            })->paginate(5);

            $data->appends(['search' => $search]);
        }
        else{
            $data = ReturnSlip::paginate(5);
        }

        return view('slip.return-slip.index', compact('data'));  
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $returnSlip_count = ReturnSlip::count();

        $count = sprintf("%05d", $returnSlip_count + 1);

        //Generate Document Series Number
        $document_series_number = 'GFI-RS-'.date('Y').'-'.$count;

        return view('slip.return-slip.return-slip', compact('document_series_number'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ReturnSlipRequest $request)
    {

        $returnSlip = ReturnSlip::create([
            'department'            => $request->department,
            'mr_no'                 => $request->mr_no,
            'document_series_no'    => $request->document_series_no,
            'withdrawal_slip_no'    => $request->withdrawal_slip_no,
            'prepared_by'           => $request->prepared_by,
            'approved_by'           => $request->approved_by,
            'received_by'           => $request->received_by,
        ]);

        // Generate QR_Code
        $image = QrCode::format('png')
            ->size(200)->errorCorrection('H')
            ->generate(config('app.url').'/verify/'.$returnSlip->id);

        $output_file = '/img/qr/return-slip/qr-' . $returnSlip->document_series_no . '.png';

        Storage::disk('public')->put($output_file, $image);

        foreach($request->items as $key => $item) {
            ReturnItem::create([
                'return_slip_id'        => $returnSlip->id,
                'item_code'             => $item['item_code'],
                'item_description'      => $item['item_description'],
                'qty'                   => $item['qty'],
                'uom'                   => $item['uom'],
                'reason'                => $item['reason']
            ]);
        }

        // Generate PDF File
        $customPaper = array(0,0,567.00,283.80);
        $pdf = PDF::loadView('slip.return-slip.pdf', compact('returnSlip'))->setPaper($customPaper, 'portrait');
        $content = $pdf->download()->getOriginalContent();
        Storage::disk('local')->put('return-slip/bak/'.$returnSlip->document_series_no.'.pdf',$content) ;

        return redirect()->route('return-slip.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\ReturnSlip  $returnSlip
     * @return \Illuminate\Http\Response
     */
    public function show(ReturnSlip $returnSlip)
    {
        // dd($returnSlip->returnitems);
        $customPaper = array(0,0,567.00,283.80);

        $pdf = PDF::loadView('slip.return-slip.pdf', compact('returnSlip'))->setPaper($customPaper, 'portrait');
        return $pdf->stream();
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\ReturnSlip  $returnSlip
     * @return \Illuminate\Http\Response
     */
    public function edit(ReturnSlip $returnSlip)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\ReturnSlip  $returnSlip
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ReturnSlip $returnSlip)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\ReturnSlip  $returnSlip
     * @return \Illuminate\Http\Response
     */
    public function destroy(ReturnSlip $returnSlip)
    {
        //
    }
}
