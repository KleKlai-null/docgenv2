<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Merchandise Withdrawal Slip') }}
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
                    <form method="POST" action="{{ route('user.store') }}">
                        @csrf

                        <div class="card-body">
                            {{-- <h5 class="card-title mb-5">Nutrihogs Corporation</h5> --}}

                            <div class="col">
                                <div class="form-floating mb-3">
                                    <input name="name" type="text" class="form-control" value="{{ old('customer_name') }}" placeholder="Customer Name" autocomplete="off">
                                    <label for="floatingInput">Name</label>
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-floating mb-3">
                                    <input name="email" type="email" class="form-control" value="{{ old('customer_name') }}" placeholder="Customer Name" autocomplete="off">
                                    <label for="floatingInput">Email</label>
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-floating mb-3">
                                    <input name="password" type="password" class="form-control" value="{{ old('customer_name') }}" placeholder="Customer Name" autocomplete="off">
                                    <label for="floatingInput">Password</label>
                                </div>
                            </div>

                            <div class="col">
                                <div class="form-floating mb-3">
                                    <input name="password_confirmation" type="password" class="form-control" value="{{ old('customer_name') }}" placeholder="Customer Name" autocomplete="off">
                                    <label for="floatingInput">Password</label>
                                </div>
                            </div>

                            <button type="submit" class="btn btn-primary">Save</button>
                        </div>
                    </form>
                </div>
            </div> 
        </div>
    </div>

     {{-- jquery --}}
     <script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anonymous"></script>
</x-app-layout>
