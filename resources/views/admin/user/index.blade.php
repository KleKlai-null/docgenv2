<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('User Management') }}
        </h2>
        
    </x-slot>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <div class="container"> 
                        <a href="{{ route('user.create') }}" class="btn btn-primary btn-rounded btn-sm fw-bold">Add User</a>

                        <table class="table align-middle mb-0 bg-white">
                            <thead class="">
                              <tr>
                                <th>Name</th>
                                <th>Status</th>
                                <th>Action</th>
                              </tr>
                            </thead>
                            <tbody>
                                @foreach ($users as $user)
                                    <tr>
                                        <td>{{ $user->name }}</td>
                                        <td>{{ ($user->status == true) ? 'Active' : 'Deactivated'; }}</td>
                                        <td>
                                            <a href="{{ route('user.status-change', $user) }}" class="btn btn-{{ ($user->status == false) ? 'success' : 'danger' }} link btn-rounded btn-sm fw-bold">{{ ($user->status == false) ? 'Activate' : 'Deactivate' }}</a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                          </table>
                          <br>
                          <div class="d-flex">

                        </div>
                    </div>
                </div> 
            </div>
        </div>
    </div>

     {{-- jquery --}}
     <script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anonymous"></script>
</x-app-layout>
