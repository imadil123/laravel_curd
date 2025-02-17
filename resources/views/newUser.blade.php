<!DOCTYPE html>
<html lang="en">
<head>
    {{-- new branch--}}        
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>New User</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css" integrity="sha512-Evv84Mr4kqVGRNSgIGL/F/aIDqQb7xQ2vcrdIwxfjThSH8CSR7PBEakCr51Ck+w+/U6swU2Im1vVX0SVk9ABhg==" crossorigin="anonymous" referrerpolicy="no-referrer" />    

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
                width: 700px; 
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
</head>

<body>
   
    <div class="full-screen">

        <div class="form-container card">

            <div class="card-body ">
                <h2 class="mb-3">Add New User</h2>
                <hr>
                <form class="row needs-validation" novalidate action="{{ route('add.user') }}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="col-md-6">
                        <label for="NameControl" class="form-label">Name</label>
                        <input type="text" name="name" value="{{ old('name') }}"
                            class="form-control @error('name') is-invalid @enderror " id="NameControl"
                            placeholder="Enter your name" autocomplete="off">
                        <span class="text-danger">
                            @error('name')
                                {{ $message }}
                            @enderror
                        </span>
                    </div>
                    <div class="col-md-6 position-relative">
                        <label for="EmailControl" class="form-label">Email Address</label>
                        <div class="input-group has-validation">
                            <span class="input-group-text" id="validationTooltipUsernamePrepend">@</span>
                            <input type="email" name="email" value="{{ old('email') }}"
                                class="form-control @error('email') is-invalid @enderror " id="EmailControl"
                                placeholder="Enter your Email" autocomplete="off">
                        </div>
                            <span class="text-danger">
                                @error('email')
                                    {{ $message }}
                                @enderror
                            </span>
                    </div>
                    <div class="mb-2 position-relative">
                        <label for="PasswordControl" class="form-label">Password</label>
                        <input type="password" name="password" value="{{ old('password') }}"
                            class="form-control @error('password') is-invalid @enderror" id="PasswordControl"
                            placeholder="Enter your Password">
                        
                        <!-- Eye Icon for Show/Hide Password -->
                        <i class="fa-solid fa-eye-slash @error('password') is-invalid @enderror" id="togglePassword" 
                           style="position: absolute; right: 22px; top: 75%; transform: translateY(-50%); cursor: pointer;">
                        </i>
                    
                        <span class="text-danger">
                            @error('password'){{ $message }}@enderror
                        </span>
                    </div>
                    <div class="col-md-6">
                        <label for="AgeControl" class="form-label">Age</label>
                        <input type="number" name="age" value="{{ old('age') }}"
                            class="form-control @error('age') is-invalid @enderror " id="AgeControl"
                            placeholder="Enter your Age">
                        <span class="text-danger">@error('age'){{ $message }}@enderror</span>
                    </div>

                    <div class="col-md-6">
                        <label for="CityControl" class="form-label">City</label>
                        <select name="city" id="CityControl" 
                            class="form-select @error('city') is-invalid @enderror" 
                            aria-label="Default select example" required>
                            <option value="" selected>Select City</option>
                            <option value="Jodhpur" {{ old('city') == 'Jodhpur' ? 'selected' : '' }}>Jodhpur</option>
                            <option value="Delhi" {{ old('city') == 'Delhi' ? 'selected' : '' }}>Delhi</option>
                            <option value="Mumbai" {{ old('city') == 'Mumbai' ? 'selected' : '' }}>Mumbai</option>
                            <option value="Goa" {{ old('city') == 'Goa' ? 'selected' : '' }}>Goa</option>
                            <option value="Pune" {{ old('city') == 'Pune' ? 'selected' : '' }}>Pune</option>
                            <option value="Bangalore" {{ old('city') == 'Bangalore' ? 'selected' : '' }}>Bangalore</option>
                            <option value="Hyderabad"{{ old('city') == 'Hyderabad' ? 'selected' : '' }}>Hyderabad</option>
                            <option value="Chennai"{{ old('city') == 'Chennai' ? 'selected' : '' }}>Chennai</option>
                        </select>
                        <!-- Validation Message -->
                        <span class="invalid-feedback">
                            @error('city'){{ $message }}@enderror
                        </span>
                    </div>  

                    <fieldset class="row mb-3 mt-3">
                        <legend class="col-form-label form-label col-sm-2 pt-0">Gender</legend>
                        <div class="col-sm-10">
                    
                            <div class="form-check">
                                <input class="form-check-input @error('gender') is-invalid @enderror" type="radio" name="gender" id="gridRadios1" value="Male"
                                {{ old('gender') == 'Male' ? 'checked' : '' }}  required>
                                <label class="form-check-label" for="gridRadios1">Male</label>
                            </div>
                    
                            <div class="form-check">
                                <input class="form-check-input @error('gender') is-invalid @enderror" type="radio" name="gender" id="gridRadios2" value="Female" 
                                {{ old('gender') == 'Female' ? 'checked' : '' }}  required>
                                <label class="form-check-label" for="gridRadios2">Female</label>
                            </div>
                    
                            <div class="form-check">
                                <input class="form-check-input @error('gender') is-invalid @enderror" type="radio" name="gender" id="gridRadios3" value="Other"
                                {{ old('gender') == 'Other' ? 'checked' : '' }}>
                                <label class="form-check-label" for="gridRadios3">Other</label>
                            </div>                  
                            <!-- Display Laravel Validation Error -->
                            @error('gender')
                                <div class="text-danger mt-1">{{ $message }}</div>
                            @enderror
                    
                        </div>
                    </fieldset>

                        {{-- checkbox --}}
                        @php
                        // Agar edit ke time subjects database se aa rahe hain toh unko array me convert karein
                        $selectedSubjects = old('subjects', isset($user->subjects) ? explode(',', $user->subjects) : []);
                        @endphp
                        
                        <fieldset class="row mb-3 mt-3">
                            <legend class="col-form-label form-label col-sm-2 pt-0">Subjects</legend>
                            <div class="col-sm-10">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="subjects[]" value="JavaScript" id="gridCheck1" 
                                        {{ in_array('JavaScript', $selectedSubjects) ? 'checked' : '' }}>
                                    <label class="form-check-label" for="gridCheck1">JavaScript</label>
                                </div>
                        
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="subjects[]" value="Cpp" id="gridCheck2" 
                                        {{ in_array('Cpp', $selectedSubjects) ? 'checked' : '' }}>
                                    <label class="form-check-label" for="gridCheck2">Cpp</label>
                                </div>
                        
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="subjects[]" value="React" id="gridCheck3" 
                                        {{ in_array('React', $selectedSubjects) ? 'checked' : '' }}>
                                    <label class="form-check-label" for="gridCheck3">React</label>
                                </div>
                            </div>
                        </fieldset>

                    <div class="mb-2">
                        <label for="formFile" class="form-label">File</label>
                        <input class="form-control @error('image') is-invalid @enderror" type="file" name="image" id="formFile">
                        <!-- Validation Error Message -->
                        <span class="invalid-feedback">
                            @error('image') {{ $message }} @enderror
                        </span>
                    </div>  

                    <div>
                        <button class="btn btn-primary btn-sm mt-3" type="submit">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
        crossorigin="anonymous"></script>

    <!-- JavaScript to Toggle Password Visibility -->
    <script>
        document.getElementById('togglePassword').addEventListener('click', function () {
            let passwordField = document.getElementById('PasswordControl');
            let icon = this;
    
            if (passwordField.type === "password") {
                passwordField.type = "text";
                icon.classList.remove('fa-eye-slash');
                icon.classList.add('fa-eye');
            } else {
                passwordField.type = "password";
                icon.classList.remove('fa-eye');
                icon.classList.add('fa-eye-slash');
            }
        });
    </script>
</body>

</html>