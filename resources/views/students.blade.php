<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Student data</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <style>
        .modal-size {
            max-width: 800px; /* Default 500px hota hai */
        }

        .form-control {
            height: 5vh; 
            font-size: 1.9vh;
        }
        .form-label {
            font-size: 2vh;
            font-weight: 500;
        }
        #students-container {
            min-width: auto;
            width: 100%;
            overflow: auto;
        }
        .search {
            height: 2.4rem;
            font-size: medium;
        }

       
    </style>
</head>

<body>
    <x-navbar/> 
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
            <div class="col-12">
                <div class="row">
                    <div class="col">
                        <h1>Student data</h1>
                    </div>
                    <div class="col-8">

                        <form action="{{ route('search.students') }}" method="GET" class="mb-3">
                            <div class="input-group col-6">
                                <input type="text" name="query" class="form-control search" placeholder="Search Your Record..." value="{{ request('query') }}">
                                <button type="submit" class="btn btn-success">Search</button>
                            </div>
                        </form>
                    </div>
                </div>
                <a href="/newUser" class="btn btn-success my-3">New User</a>
                <span class="mx-3" style="font-size: 18px; font-weight: 500;"> Total data : {{ $students->total() }} </span>
                <div class="d-flex">
                    <div id="students-container">
                        @include('partials.students-list')
                    </div>                    
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap Modal for Update -->
    <div class="modal fade" id="updateStudentModal" tabindex="-1" aria-labelledby="updateStudentModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-size">
            <div class="modal-content">
                <div class="modal-header">
                    <h2 class="modal-title" id="updateStudentModalLabel">Update Student</h2>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="updateStudentForm" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <input type="hidden" id="updateStudentId" name="id">
                        <div class="row mb-3">
                            <div class="col-6">
                                <label for="updateName" class="form-label">Name</label>
                                <input type="text" class="form-control  @error('name') is-invalid @enderror" id="updateName" name="name" autocomplete="off" required>
                            </div>
                            <div class="col-md-6 position-relative">
                                <label for="EmailControl" class="form-label">Email Address</label>
                                <div class="input-group has-validation">
                                    <span class="input-group-text" id="validationTooltipUsernamePrepend">@</span>
                                    <input type="email" name="email" class="form-control  @error('email') is-invalid @enderror" id="EmailControl" placeholder="Enter your Email" autocomplete="off" required>
                                </div>
                            </div>
                        </div>
                        <div class="mb-2 position-relative">
                            <label for="PasswordControl" class="form-label">Password</label>
                            <input type="password" name="password" class="form-control @error('password') is-invalid @enderror" id="PasswordControl"
                                placeholder="Enter new password (leave empty to keep old password)">
                        </div>
                        <div class="row mb-3">
                            <div class="col-md-6 mb-3">
                                <label for="updateAge" class="form-label">Age</label>
                                <input type="number" class="form-control" id="updateAge" name="age" required>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="CityControl" class="form-label">City</label>
                                <select name="city" id="CityControl" class="form-select" required>
                                    <option value="" disabled>Select City</option>
                                    <option value="Jodhpur">Jodhpur</option>
                                    <option value="Delhi">Delhi</option>
                                    <option value="Mumbai">Mumbai</option>
                                    <option value="Goa">Goa</option>
                                    <option value="Pune">Pune</option>
                                    <option value="Bangalore">Bangalore</option>
                                    <option value="Hyderabad">Hyderabad</option>
                                    <option value="Chennai">Chennai</option>
                                </select>
                            </div>
                        </div>       
                        <div class="row mb-3">
                            <div class="col-md-6 mb-3">
                                <label for="updateGender" class="form-label">Gender</label>
                                <select class="form-control" id="updateGender" name="gender" required>
                                    <option value="Male">Male</option>
                                    <option value="Female">Female</option>
                                    <option value="Other">Other</option>
                                </select>
                            </div>
                            <fieldset class="row mb-3 mt-3">
                                <legend class="col-form-label form-label col-sm-2 pt-0">Subjects</legend>
                                <div class="col-sm-10">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" name="subjects[]" value="JavaScript" id="gridCheck1" >
                                        <label class="form-check-label" for="gridCheck1">JavaScript</label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" name="subjects[]" value="Cpp" id="gridCheck2">
                                        <label class="form-check-label" for="gridCheck2">Cpp</label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" name="subjects[]" value="React" id="gridCheck3">
                                        <label class="form-check-label" for="gridCheck3">React</label>
                                    </div>
                                </div>
                            </fieldset>
                        </div>
                        <div class="mb-3">
                            <label for="formFile" class="form-label">File</label>
                            <input class="form-control" type="file" name="image" id="formFile">
                        
                            <!-- Image preview -->
                            <img id="output" src="" alt="User Image" class="img-thumbnail mt-2" width="100">
                        </div>
                        <button type="submit" class="btn btn-success">Save Update</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap Delete Confirmation Modal for Delete -->
    <div class="modal fade" id="deleteStudentModal" tabindex="-1" aria-labelledby="deleteStudentModalLabel" aria-hidden="true">
        <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
            <h5 class="modal-title" id="deleteStudentModalLabel">Confirm Deletion</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                Are you sure you want to delete this student?
            </div>
            <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">No</button>
            <form id="deleteStudentForm" method="POST" action="">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-danger">Delete</button>
            </form>
            </div>
        </div>
        </div>
    </div>
    


    <!-- Bootstrap and jQuery Scripts -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
        crossorigin="anonymous">
    </script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script> 
    <script src="https://cdn.jsdelivr.net/npm/jquery-validation@1.19.3/dist/jquery.validate.min.js"></script>

    <script>
    // validation Roles
    $(document).ready(function () {

    // Add custom regex method
    $.validator.addMethod("regex", function(value, element, regexpr) {
        return this.optional(element) || regexpr.test(value);
    });
    // jQuery Validation for Update Form
    $("#updateStudentForm").validate({
        rules: {
            name: {
                required: true,
                minlength: 5
            },
            email: {
                required: true,
                email: true
            },
            password: {
                minlength: 6,
                regex: /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{6,}$/
            },
            age: {
                required: true,
                number: true,
                min: 18,
                max: 100
            },
            city: {
                required: true
            },
            gender: {
                required: true
            },
            "subjects[]": {
                required: true
            }
        },
        messages: {
            name: {
                required: "Please enter the student's name",
                minlength: "Name must be at least 3 characters long"
            },
            email: {
                required: "Please enter an email address",
                email: "Enter a valid email address"
            },
            password: {
                minlength: "Password must be at least 6 characters long",
                 regex: "Password must contain at least one uppercase letter, one lowercase letter, one number, and one special character."
                
            },
            age: {
                required: "Please enter the student's age",
                number: "Enter a valid number",
                min: "Age must be at least 18",
                max: "Age must not exceed 100"
            },
            city: {
                required: "Please select a city"
            },
            gender: {
                required: "Please select a gender"
            },
            "subjects[]": {
                required: "Please select at least one subject"
            }
        },
        errorElement: "div",
        errorPlacement: function (error, element) {
            error.addClass("text-danger mt-1");
            error.insertAfter(element);
        }
    });

     // Prevent form submission if validation fails
        $("#updateStudentForm").on("submit", function (e) {
        if (!$(this).valid()) {
            e.preventDefault();
        }
            });
        });



        // Pagination
        $(document).on('click', '#pagination-links a', function (event) {
            event.preventDefault();
            let page = $(this).attr('href').split('page=')[1];
            fetchStudents(page);
        });

        function fetchStudents(page) {
            $.ajax({
                url: "{{ route('students.fetch') }}?page=" + page,
                type: "GET",
                success: function (response) {
                    $('#students-container').html(response);
                },
                error: function (error) {
                    console.log("Error fetching students:", error);
                }
            });
        }

        // Open Update Modal and Fill Data
        $(document).on('click', '.updateStudentBtn', function () {
            let studentId = $(this).data('id');
            let studentName = $(this).data('name');
            let studentEmail = $(this).data('email');
            let studentAge = $(this).data('age');
            let studentCity = $(this).data('city');
            let studentGender = $(this).data('gender');
            let studentSubjects = $(this).data('subjects');
            let studentImage = $(this).data('image'); 


            $('#updateStudentId').val(studentId);
            $('#updateName').val(studentName);
            $('#EmailControl').val(studentEmail);
            $('#updateAge').val(studentAge);
            $('#CityControl').val(studentCity);
            $('#updateGender').val(studentGender);
            

            $('input[name="subjects[]"]').prop('checked', false);

            if (studentSubjects) {
               try {
                    let subjectsArray = JSON.parse(studentSubjects); // Parse JSON string to array

                        // Iterate over all checkboxes and check the ones that match the student's subjects
                        $('input[name="subjects[]"]').each(function () {
                            if (subjectsArray.includes($(this).val())) {
                                $(this).prop('checked', true);
                            }
                        });
                    } catch (e) {
                        console.error("Error parsing subjects JSON:", e);
                    }
                }


            $('#updateStudentForm').attr('action', `/students/update/${studentId}`);

           // Check if student has an existing image
           if (studentImage) {
              let imagePath = `/storage/${studentImage}`;
              $('#output').attr('src', imagePath).show();
            } else {
                $('#output').attr('src', 'default-image.png').show();
            }
        });


            $('#formFile').on('change', function (event) {
                let file = event.target.files[0];
                let validExtensions = ['image/jpeg', 'image/png', 'image/jpg'];

                if (file && validExtensions.includes(file.type)) {
                    let reader = new FileReader();
                    reader.onload = function (e) {
                        $('#output').attr('src', e.target.result).show();
                    };
                    reader.readAsDataURL(file);
                } else {
                    alert("Please select a valid image file (JPG, PNG, JPEG).");
                    $('#formFile').val(''); // Reset file input
                }
            });

        // Open Delete Modal
        $(document).on('click', '.deleteStudentBtn', function () {
            let studentId = $(this).data('id');

            // Set action in form dynamically
            $('#deleteStudentForm').attr('action', `/students/delete/${studentId}`);

            // Show the modal
            $('#deleteStudentModal').modal('show');
        });

    </script>
</body>
</html>
