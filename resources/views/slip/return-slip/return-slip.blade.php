<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Merchandise Return Slip') }}
        </h2>
        
    </x-slot>
    {{-- bootstrap --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="card">
                    <form method="POST" action="{{ route('return-slip.store') }}">
                        @csrf

                        <div class="card-body">
                            {{-- <h5 class="card-title mb-5">Nutrihogs Corporation</h5> --}}

                            <div class="row">
                                <div class="col">
                                    <div class="form-floating mb-3">
                                        <input name="department" type="text" class="form-control" value="{{ old('customer_name') }}" placeholder="Customer Name" autocomplete="off">
                                        <label for="floatingInput">Department</label>
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="form-floating mb-3">
                                        <input name="document_series_no" type="text" class="form-control" placeholder="Customer Name" readonly value="{{ $document_series_number }}">
                                        <label for="floatingInput">Document Series Number</label>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col">
                                    <div class="form-floating mb-3">
                                        <input name="mr_no" type="text" value="{{ old('pallet_no') }}" class="form-control" placeholder="Pallet Number" autocomplete="off">
                                        <label for="floatingInput">MR Number</label>
                                    </div> 
                                </div>
                                <div class="col">
                                    <div class="form-floating mb-3">
                                        <input name="withdrawal_slip_no" type="text" value="{{ old('wh_location') }}" class="form-control" id="floatingInput" placeholder="Customer Name">
                                        <label for="floatingInput">Withdrawal Slip Number</label>
                                    </div>
                                </div>
                            </div>

                            <!--
                                Dynamic Fields Begin
                            -->

                            <table class="table mt-4 mb-4" id="dynamicAddRemove">  
                                <tr>
                                    <th>Item Code</th>
                                    <th>Item Description</th>
                                    <th>Qty</th>
                                    <th>UOM</th>
                                    <th>Reason</th>
                                    <th>Action</th>
                                </tr>
                                <tr>  
                                    <td><input type="text" name="items[0][item_code]" class="form-control" /></td>  
                                    <td><textarea type="text" name="items[0][item_description]" class="form-control" ></textarea></td>  
                                    <td><input type="number" name="items[0][qty]" class="form-control" /></td>  
                                    <td><input type="text" name="items[0][uom]" class="form-control" /></td>  
                                    <td><input type="text" name="items[0][reason]"  class="form-control" /></td>  
                                    <td><button type="button" name="add" id="add-btn" class="btn btn-success">Add</button></td>  
                                </tr>  
                            </table> 

                            <!--
                                Dynamic Fields End
                            -->

                            <div class="row">
                                <div class="col">
                                    <div class="form-floating mb-3">
                                        <input name="prepared_by" type="text" value="{{ old('prepared_by') }}" class="form-control" autocomplete="off">
                                        <label for="floatingInput">Prepared by:</label>
                                    </div> 
                                </div>
                                <div class="col">
                                    <div class="form-floating mb-3">
                                        <input name="approved_by" type="text" value="{{ old('approved_by') }}" class="form-control" autocomplete="off">
                                        <label for="floatingInput">Approved by:</label>
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="form-floating mb-3">
                                        <input name="received_by" type="text" value="{{ old('released_by') }}" class="form-control" autocomplete="off">
                                        <label for="floatingInput">Received by:</label>
                                    </div>
                                </div>
                            </div>

                            <button type="submit" class="btn btn-primary">Save and Print</button>
                        </div>
                    </form>
                </div>
            </div> 
        </div>
    </div>

     {{-- jquery --}}
     <script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anonymous"></script>
     {{-- javascript for dynamic add/remove --}}
    <script type="text/javascript">
        var i = 0;
    
        // add fields
            $(document).on('click','#add-btn', function (e) {
                ++i;
                $("#dynamicAddRemove")
                .append('<tr><td><input type="text" name="items['+i+'][item_code]"class="form-control" /></td><td><textarea type="text" name="items['+i+'][item_description]"class="form-control" ></textarea></td><td><input type="text" name="items['+i+'][qty]"class="form-control" /></td><td><input type="text" name="items['+i+'][uom]"class="form-control" /></td><td><input type="text" name="items['+i+'][reason]"class="form-control" /></td><td><button type="button" class="btn btn-danger remove-tr">Remove</button></td></tr>'
                );
            });
    
            // to remove fields
            $(document).on('click','.remove-tr', function (e) {
                $(this).parents('tr').remove();
            });
        </script>
</x-app-layout>
