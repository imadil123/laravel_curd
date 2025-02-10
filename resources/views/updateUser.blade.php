<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>New User</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <style>
        .form-label{
            font-size: 18px;
            font-weight: bold;
        }
        .hadding{
            font-weight: 600;
            /* text-align: center; */
        }
    </style>
<body>
    <div class="container card my-4 col-6 shadow-lg">
        <div class="card-body ">
            <h1 class="hadding card-title my-2">Update User Date</h1><hr>
            <form action="{{ route('update.user',$data->id)}}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="mb-3">
                    <label for="NameControl" class="form-label">Name</label>
                    <input type="text" value="{{ $data->name }}" name="name" class="form-control" id="NameControl" placeholder="Enter your name">
                  </div>
                <div class="mb-3">
                    <label for="EmailControl" class="form-label">Email</label>
                    <input type="email" value="{{ $data->email }}" name="email" class="form-control" id="EmailControl" placeholder="Enter your Email">
                  </div>
                <div class="mb-3">
                    <label for="PasswordControl" class="form-label">Password</label>
                    <input type="password" name="password" class="form-control @error('password') is-invalid @enderror" id="PasswordControl" placeholder="Enter new password (leave empty to keep old password)">
                    </div>
                <div class="mb-3">
                    <label for="AgeControl" class="form-label">Age</label>
                    <input type="text" value="{{ $data->age }}" name="age"class="form-control" id="AgeControl" placeholder="Enter your Age">
                  </div>
                <div class="mb-3">
                    <label for="CityControl" class="form-label">City</label>
                    <input type="text" value="{{ $data->city }}" name="city" class="form-control" id="CityControl" placeholder="Enter your City">
                  </div>
                  <div class="mb-3">
                    <label for="formFile" class="form-label">File</label>
                    <input class="form-control" type="file" name="image" onchange="document.querySelector('#output').src=window.URL.createObjectURL(this.files[0])" id="formFile">
                    @if($data->fileName)
                      <img id="output" src="{{ asset('storage/' . $data->fileName) }}" alt="User Image" class="img-thumbnail mt-2" width="100">
                    @endif
                </div>
                <div class="mb-3">
                    <button class="btn btn-primary my-3" type="submit">Update</button>
                </div>                   
            </form>    
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>