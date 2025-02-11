<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Student data</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>

<body>
    
    
    @if(session('status'))
        <x-alert type="danger" :message="session('status')" />
    @endif
    @if(session('update'))
        <x-alert type="success" :message="session('update')" />
    @endif
    @if(session('add'))
        <x-alert type="success" :message="session('add')" />
    @endif

    <div class="container">
        <div class="row my-3">
            <div class="col-6">
                <h1>Student data</h1>
                <a href="/newUser" class="btn btn-success my-3">New User</a>
                       <span class="mx-3" style="font-size: 18px; font-weight: 500;"> Total data : {{ $data->total() }} </span>
                <table class="table table-bordered table-striped">
                    <thead class="table-dark">
                        <tr>
                            <th scope="col">S.no</th>
                            <th scope="col">Name</th>
                            <th scope="col">Gender</th>
                            <th scope="col">Email</th>
                            <th scope="col">Password</th>
                            <th scope="col">Age</th>
                            <th scope="col">City</th>
                            <th scope="col">Images</th>
                            <th scope="col">View</th>
                            <th scope="col">Update</th>
                            <th scope="col">Delete</th>

                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($data as $id => $stu)
                            <tr>
                                <td>{{ $id + 1}}</td>
                                <td>{{ $stu->name }}</td>
                                <td>{{ $stu->gender }}</td>
                                <td>{{ $stu->email }}</td>
                                {{-- <td>{{ Str::limit($stu->password, 10, '...') }}</td> --}}
                                <td>{{ str_repeat('*', 10) }}</td>
                                <td>{{ $stu->age }}</td>
                                <td>{{ $stu->city }}</td>
                                <td><img src="{{ asset('/storage/' . $stu->fileName) }}" alt="{{ $stu->name }}" width="100"></td>
                                <td><a href="{{ route('view.user', $stu->id) }}" class="btn btn-primary btn-sm">View</a></td>
                                <td><a href="{{ route('update.page', $stu->id) }}" class="btn btn-warning btn-sm">Update</a></td>
                            <td><a href="{{ route('delete.user', $stu->id) }}" class="btn btn-danger btn-sm">delete</a></td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                <div class="d-flex">
                    <div>
                        {{ $data->links('pagination::bootstrap-4') }}
                    </div>
                    <!-- <div class="mx-3" style="font-size: 18px; font-weight: 500;">
                        Total data : {{ $data->total() }}
                    </div> -->
                </div>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
        crossorigin="anonymous"></script>
</body>

</html>