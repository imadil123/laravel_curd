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
        .modal-dialog {
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
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h2 class="modal-title" id="updateStudentModalLabel">Update Student</h2>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="updateStudentForm" method="POST">
                        @csrf
                        @method('PUT')
                        <input type="hidden" id="updateStudentId" name="id">
                        <div class="row mb-3">
                            <div class="col-6">
                                <label for="updateName" class="form-label">Name</label>
                                <input type="text" class="form-control" id="updateName" name="name" required>
                            </div>
                            <div class="col-md-6 position-relative">
                                <label for="EmailControl" class="form-label">Email Address</label>
                                <div class="input-group has-validation">
                                    <span class="input-group-text" id="validationTooltipUsernamePrepend">@</span>
                                    <input type="email" name="email" class="form-control" id="EmailControl" placeholder="Enter your Email">
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
                        <div class="col-md-6 mb-3">
                            <label for="updateGender" class="form-label">Gender</label>
                            <select class="form-control" id="updateGender" name="gender" required>
                                <option value="Male">Male</option>
                                <option value="Female">Female</option>
                                <option value="Other">Other</option>
                            </select>
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

    <script>
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

            $('#updateStudentId').val(studentId);
            $('#updateName').val(studentName);
            $('#updateEmail').val(studentEmail);
            $('#updateAge').val(studentAge);
            $('#CityControl').val(studentCity);
            $('#updateGender').val(studentGender);

            $('#updateStudentForm').attr('action', `/students/update/${studentId}`);

            $('#updateStudentModal').modal('show');
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
