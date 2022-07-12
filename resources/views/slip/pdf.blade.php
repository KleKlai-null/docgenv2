<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
	
    {{-- <link rel="stylesheet" type="text/css" href="{{ asset('css/style.css') }}" > --}}

</head>

<style>
   
* { margin: 0; padding: 0; }
body { font: 14px/1.4 Georgia, serif; }
#page-wrap { width: 680px; margin: 0 auto; }

textarea { border: 0; font: 14px Georgia, Serif; overflow: hidden; resize: none; }
table { border-collapse: collapse; }
table td, table th { border: 1px solid black; padding: 1px; }
table td.borderless, table th.borderless { border: 0px solid black; padding: 1px; }

table.borderless{ border: 0px solid black; padding: 1px;}

#header { height: 15px; width: 100%; margin: 20px 0; background: #222; text-align: center; color: white; font: bold 15px Arial, Sans-Serif; text-decoration: uppercase; letter-spacing: 15px; padding: 8px 0px; }

#address { width: 250px; height: 150px; float: left; }
#customer { overflow: hidden; }

#logo { text-align: right; float: right; position: relative; margin-top: -15px; max-width: 570px; max-height: 130px; overflow: hidden; }

#items { clear: both; width: 100%; margin: 5px 0 0 0; border: 1px solid black; }
#items th { background: #eee; }
#items textarea { width: 80px; height: 50px; }
#items tr.item-row td { border: 0; vertical-align: top; }
#items td.description { width: 300px; }
#items td.item-name { width: 175px; }
#items td.description textarea, #items td.item-name textarea { width: 100%; }
#items td.total-line { border-right: 0; text-align: right; }
#items td.total-value { border-left: 0; padding: 10px; }
#items td.total-value textarea { height: 20px; background: none; }
#items td.balance { background: #eee; }
#items td.blank { border: 0; }

#terms { text-align: left; margin: 15px 0 0 0; }

p.sub {
  font-size:10px;
}

#meta { margin-top: 0px; width: 300px; float: left; }
#footer { margin-top: 0px; width: 230px; float: right; }
/* #meta td { text-align: left;  } */
/* #meta td.meta-head { text-align: left; background: #eee; font-size: 15px } */

#line { text-transform: uppercase; font: 13px Helvetica, Sans-Serif; letter-spacing: 10px; border-bottom: 1px solid black; padding: 1 0 8px 0; margin: 1  8px 0; }
</style>
<body>

	<div id="page-wrap">

		<h1 id="header" class="text-white">{{ env('APP_NAME') }}</h1>

        <table id="meta">
            <tr>
                <td class="borderless"><H4>Document Series No</H4></td>
                <td class="borderless"><div ><p>{{ $withdrawalSlip->document_series_no }} </p></div></td>
            </tr>
            <tr>

                <td class="borderless"><h6>Customer name</h6></td>
                <td class="borderless"><div><p class="sub">{{ $withdrawalSlip->customer_name }}</p></div></td>
            </tr>
            <tr>
                <td class="borderless"><h6>Date</h6></td>
                <td class="borderless"><div><p class="sub">{{ $withdrawalSlip->created_at->format('d M Y') }}</p></div></td>
            </tr>
            <tr>
                <td class="borderless"><h6>Pallet Number</h6></td>
                <td class="borderless"><div><p class="sub">{{ $withdrawalSlip->pallet_no }}</p></div></td>
            </tr>
            <tr>
                <td class="borderless"><h6>Warehouse Location</h6></td>
                <td class="borderless"><div><p class="sub">{{ $withdrawalSlip->wh_location }}</p></div></td>
            </tr>
            <tr>
                <td class="borderless"><h6>Warehouse</h6></td>
                <td class="borderless"><div><p class="sub">{{ $withdrawalSlip->warehouse }}</p></div></td>
            </tr>
        </table>

		<div id="identity">
            <div id="logo">
                <img src="data:image/png;base64,{{ base64_encode(file_get_contents(public_path('storage/img/qr/qr-'.$withdrawalSlip->document_series_no.'.png'))) }}" width="110px">
            </div>
		</div>
		
		<div style="clear:both"></div>
		
		
		<table id="items">
		
		  <tr>
            <th>Item Code</th>
            <th>Item Description</th>
            <th>Qty</th>
            <th>OUM</th>
            <th>Remarks</th>
		  </tr>
		  
		  <tr class="item-row">
            @forelse ($withdrawalSlip->items as $item)
                <tr>
                    <td>{{ $item->item_code }}</td>
                    <td>{{ $item->item_description }}</td>
                    <td>{{ $item->qty }}</td>
                    <td>{{ $item->uom }}</td>
                    <td>{{ $item->remarks }}</td>
                 </tr>
            @empty
                 <tr>
                    <td colspan="4">Insufficient Data</td>
                 </tr>
            @endforelse
		  </tr>
		
		</table>

        <div id="terms">
            <div style="float: right;">
                <table id="footer">
                    <tr>
                        <td class="borderless"><h6>Prepared by</h6></td>
                        <td class="borderless"><div><p class="sub">{{ $withdrawalSlip->prepared_by }}</p></div></td>
                    </tr>
                    <tr>
                        <td class="borderless"><h6>Aproved by</h6></td>
                        <td class="borderless"><div><p class="sub">{{ $withdrawalSlip->approved_by }}</p></div></td>
                    </tr>
                    <tr>
                        <td class="borderless"><h6>Released by</h6></td>
                        <td class="borderless"><div><p class="sub">{{ $withdrawalSlip->released_by }}</p></div></td>
                    </tr>
                    <tr>
                        <td class="borderless"><h6>Profit Center</h6></td>
                        <td class="borderless"><div><p class="sub">{{ $withdrawalSlip->profit_center }}</p></div></td>
                    </tr>
                    <tr>
                        <td class="borderless"><h6>Sub-Profit Center</h6></td>
                        <td class="borderless"><div><p class="sub">{{ $withdrawalSlip->sub_profit_center }}</p></div></td>
                    </tr>
                </table>
            </div>
        </div>
	</div>
</body>

</html>