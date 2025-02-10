<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>New User</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <style>
        .form-label {
            font-size: 18px;
            font-weight: 500;
        }

        .hadding {
            font-weight: 600;
            /* text-align: center; */
        }
    </style>

<body>
    {{-- @if ($errors->any())
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
        @foreach ( $errors->all() as $error)
        {{-- <li>{{ $error }}</li> --}}
        {{-- <strong>Whoops!</strong>
        <p>{{ $error }}</p>
        @endforeach
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    @endif --}}
    {{-- <ul>
        @foreach ($errors->all() as $error)
        <li>{{ $error }}</li>
        @endforeach
    </ul> --}}

    <div class="container card my-1 col-6 shadow-lg ">
        <div class="card-body ">
            <h1 class="hadding card-title my-2">Add New User</h1>
            <hr>
            <form action="{{ route('add.user') }}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="mb-3">
                    <label for="NameControl" class="form-label">Name</label>
                    <input type="text" name="name" value="{{ old('name') }}"
                        class="form-control @error('name') is-invalid @enderror " id="NameControl"
                        placeholder="Enter your name">
                    <span class="text-danger">
                        @error('name')
                            {{ $message }}
                        @enderror
                    </span>
                </div>
                <div class="mb-3">
                    <label for="EmailControl" class="form-label">Email</label>
                    <input type="email" name="email" value="{{ old('email') }}"
                        class="form-control @error('email') is-invalid @enderror " id="EmailControl"
                        placeholder="Enter your Email">
                    <span class="text-danger">@error('email'){{ $message }}@enderror</span>
                </div>
                <div class="mb-3">
                    <label for="PasswordControl" class="form-label">Password</label>
                    <input type="password" name="password" value="{{ old('password') }}"
                        class="form-control @error('password') is-invalid @enderror " id="PasswordControl"
                        placeholder="Enter your Psasword">
                    <span class="text-danger">@error('password'){{ $message }}@enderror</span>
                </div>
                <div class="mb-3">
                    <label for="AgeControl" class="form-label">Age</label>
                    <input type="number" name="age" value="{{ old('age') }}"
                        class="form-control @error('age') is-invalid @enderror " id="AgeControl"
                        placeholder="Enter your Age">
                    <span class="text-danger">@error('age'){{ $message }}@enderror</span>

                </div>
                <div class="mb-3">
                    <label for="CityControl" class="form-label">City</label>
                    <select class="form-select" aria-label="Default select example" value="{{ old('city') }}"
                        name="city">
                        <option selected>Select City</option>
                        <option value="Delhi">Delhi</option>
                        <option value="mumbai">Munbai</option>
                        <option value="goa">Goa</option>
                        <option value="pune">Pune</option>
                    </select>
                    <span class="text-danger">@error('city'){{ $message }}@enderror</span>
                </div>
                <div class="mb-3">
                    <label for="formFile" class="form-label">File</label>
                    <input class="form-control" type="file" name="image" id="formFile">
                </div>
                <div class="mb-3">
                    <button class="btn btn-primary mt-2 mb-2" type="submit">Submit</button>
                </div>
            </form>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
        crossorigin="anonymous"></script>
</body>

</html>