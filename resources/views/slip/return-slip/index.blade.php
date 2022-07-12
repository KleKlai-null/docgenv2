<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
        
    </x-slot>
    {{-- bootstrap --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <div class="container"> 

                        <form class="col-md-3 input-group" action="{{ route('return-slip.index') }}">
                          {{-- @csrf --}}
                          <div class="input-group">
                            <div class="col-lg-2 float-right">
                              <input type="search" class="form-control" name="search" placeholder="Search" aria-label="Search" aria-describedby="search-addon"/>                          
                            </div>
                            <button type="submit" class="btn btn-primary">search</button> 
                          </div>
                        </form>
  
                        <table class="table align-middle mb-0 bg-white">
                            <thead class="">
                              <tr>
                                <th>Document Series </th>
                                <th>Department</th>
                                <th>Prepared By</th>
                                <th>Approved By</th>
                                <th>Release By</th>
                                <th>Action</th>
                              </tr>
                            </thead>
                            <tbody>
                              @forelse ($data as $key => $value)
                                <tr>
                                  <td>
                                    <div class="d-flex align-items-center">
                                      <div class="ms-3">
                                        <p class="fw-bold mb-1">{{ $value->document_series_no }}</p>
                                      </div>
                                    </div>
                                  </td>
                                  <td>
                                    <p class="text-muted mb-0">{{ $value->department }}</p>
                                  </td>
                                  <td>
                                      <p class="text-muted mb-0">{{ $value->prepared_by }}</p>
                                  </td>
                                  <td>
                                      <p class="text-muted mb-0">{{ $value->approved_by }}</p>
                                  </td>
                                  <td>
                                      <p class="text-muted mb-0">{{ $value->received_by }}</p>
                                  </td>
                                  <td>
                                    <a href="{{ route('return-slip.show', $value->id) }}" target="_blank" class="btn btn-link btn-rounded btn-sm fw-bold">Details</a>
                                    <a href="{{ route('generate.pdf', $value->id) }}" class="btn btn-link btn-rounded btn-sm fw-bold">Download PDF</a>
                                  </td>
                                </tr>
                              @empty
                                <tr>
                                  <td colspan="7"></td>
                                </tr>
                              @endforelse
                            </tbody>
                          </table>
                          <br>
                          <div class="d-flex">
                            {!! $data->links('pagination::bootstrap-4') !!}
                        </div>
                </div>
            </div> 
        </div>
    </div>

    
     {{-- jquery --}}
     <script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anonymous"></script>
</x-app-layout>
