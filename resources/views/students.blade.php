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
            <div class="col-6">
                <h1>Student data</h1>
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
                    <h5 class="modal-title" id="updateStudentModalLabel">Update Student</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="updateStudentForm" method="POST">
                        @csrf
                        @method('PUT')
                        <input type="hidden" id="updateStudentId" name="id">
                        <div class="mb-3">
                            <label for="updateName" class="form-label">Name</label>
                            <input type="text" class="form-control" id="updateName" name="name" required>
                        </div>
                        <div class="mb-3">
                            <label for="updateEmail" class="form-label">Email</label>
                            <input type="email" class="form-control" id="updateEmail" name="email" required>
                        </div>
                        <div class="mb-3">
                            <label for="updateAge" class="form-label">Age</label>
                            <input type="number" class="form-control" id="updateAge" name="age" required>
                        </div>
                        <div class="mb-3">
                            <label for="updateCity" class="form-label">City</label>
                            <input type="text" class="form-control" id="updateCity" name="city" required>
                        </div>
                        <div class="mb-3">
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
            $('#updateCity').val(studentCity);
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
