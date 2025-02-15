<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>New User</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <style>
        /* Form ko screen ke center me lane ke liye */
        .full-screen {
            height: 100vh; 
            display: flex;
            justify-content: center;
            align-items: center;
            background-color: #f8f9fa; 
        }

        /* Form ki styling */
        .form-container {
            width: 650px; 
            padding: 20px;
            background: white;
            border-radius: 10px;
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
        }

        /* Input fields responsive height */
        .form-control {
            height: 5vh; 
            font-size: 1.9vh;
        }
        .form-check-label {
            font-size: 1.9vh;
        }

        .form-select {
            height: 5vh; 
            font-size: 1.8vh;
        }
        
        .form-label {
            font-size: 2vh;
            font-weight: 500;
        }
        #formFile {
            height: 5vh;
            font-size: 1.9vh;
        }
        .input-group-text {
            font-size: 1.9vh;
        }
        #togglePassword.is-invalid {
            display: none;
        }
        .is-invalid-border {
            border: 1px solid red; 
            padding: 5px; 
            border-radius: 5px;
        }
         
    </style>
<body>
    <div class="full-screen">
        <div class="container card">
            <div class="card-body ">
            <h2 class="hadding card-title my-2 font-weight-bold">Update User Date</h2><hr>
            <form class="row needs-validation" novalidate action="{{ route('update.user',$data->id)}}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="col-md-6">
                    <label for="NameControl" class="form-label">Name</label>
                    <input type="text" value="{{ $data->name }}" name="name" class="form-control" id="NameControl" placeholder="Enter your name">
                </div>
                <div class="col-md-6 position-relative">
                    <label for="EmailControl" class="form-label">Email Address</label>
                    <div class="input-group has-validation">
                        <span class="input-group-text" id="validationTooltipUsernamePrepend">@</span>
                        <input type="email" name="email" value="{{ $data->email }}"
                            class="form-control" id="EmailControl" placeholder="Enter your Email">
                    </div>
                </div>
                <div class="mb-2 position-relative">
                    <label for="PasswordControl" class="form-label">Password</label>
                    <input type="password" name="password" class="form-control @error('password') is-invalid @enderror" id="PasswordControl"
                        placeholder="Enter new password (leave empty to keep old password)">
                    
                    <!-- Eye Icon for Show/Hide Password -->
                    <i class="fa-solid fa-eye-slash @error('password') is-invalid @enderror" id="togglePassword" 
                       style="position: absolute; right: 22px; top: 75%; transform: translateY(-50%); cursor: pointer;">
                    </i>
                </div>
                <div class="col-md-6">
                    <label for="AgeControl" class="form-label">Age</label>
                    <input type="number" name="age" value="{{ $data->age }}"
                        class="form-control" id="AgeControl"
                        placeholder="Enter your Age">
                </div>
                     
                <div class="col-md-6">
                    <label for="CityControl" class="form-label">City</label>
                    <select name="city" id="CityControl" class="form-select">
                        <option value="">Select City</option>
                        <option value="Delhi" {{ old('city', $data->city) == 'Delhi' ? 'selected' : '' }}>Delhi</option>
                        <option value="Mumbai" {{ old('city', $data->city) == 'Mumbai' ? 'selected' : '' }}>Mumbai</option>
                        <option value="Goa" {{ old('city', $data->city) == 'Goa' ? 'selected' : '' }}>Goa</option>
                        <option value="Pune" {{ old('city', $data->city) == 'Pune' ? 'selected' : '' }}>Pune</option>
                    </select>
                </div>
                
                {{-- <div class="mb-3">
                    <label for="CityControl" class="form-label">City</label>
                    <input type="text" value="{{ $data->city }}" name="city" class="form-control" id="CityControl" placeholder="Enter your City">
                </div> --}}

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
</div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>