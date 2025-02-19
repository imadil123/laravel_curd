<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Subjects</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <style>
          #subjects-container {
            min-width: auto;
            width: 100%;
            overflow: auto;
        }
    </style>
</head>
<body>
    <x-navbar/>
    <div class="container">
        <div class="row my-3">
            <div class="col-12">
                <div class="row">
                    <div class="col">
                        <h1>Subjects Table</h1>
                    </div>
                </div>
                <a href="#" class="btn btn-success my-3" data-bs-toggle="modal" data-bs-target="#updateStudentModal">Add New Subject</a>
                <div class="d-flex">
                    <div id="subjects-container">
                        @include('partials.subject-list')
                    </div>                    
                </div>
            </div>
        </div>
    </div>
    
 <!-- Bootstrap Modal for add subject -->
 <div class="modal fade" id="updateStudentModal" tabindex="-1" aria-labelledby="updateStudentModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-size">
        <div class="modal-content">
            <div class="modal-header">
                <h2 class="modal-title" id="updateStudentModalLabel">Add New Subjects</h2>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="AddStudentForm" action="{{ route('subjects.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                        <div class="col">
                            <label for="addsubject" class="form-label">Subject</label>
                            <input type="text" class="form-control  @error('subject') is-invalid @enderror" id="addsubject" name="subject" autocomplete="off" required>
                        </div>
                        <div class="col mt-3 mb-3">
                            <label for="status" class="form-label">Status</label>
                            <select class="form-control @error('status') is-invalid @enderror" id="status" name="status" required>
                                <option value="active">Active</option>
                                <option value="inactive">Inactive</option>
                            </select>
                        </div>              
                    <button type="submit" class="btn btn-success">Add</button>
                </form>
            </div>
        </div>
    </div>
</div>
  <!-- Bootstrap Modal for Update Subject -->
<div class="modal fade" id="updateSubjectModal" tabindex="-1" aria-labelledby="updateSubjectModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-size">
        <div class="modal-content">
            <div class="modal-header">
                <h2 class="modal-title" id="updateSubjectModalLabel">Update Subject</h2>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="updateSubjectForm" method="POST">
                    @csrf
                    @method('PUT')
                    <input type="hidden" id="updateSubjectId" name="id">
                    <div class="mb-3">
                        <label for="SubjectName" class="form-label">Subject Name</label>
                        <input type="text" class="form-control @error('subject') is-invalid @enderror" 
                            id="SubjectName" name="subject" autocomplete="off" required>
                    </div>
                    <div class="col mt-3 mb-3">
                        <label for="updateStatus" class="form-label">Status</label>
                        <select class="form-control @error('status') is-invalid @enderror" id="updateStatus" name="status" required>
                            <option value="active">Active</option>
                            <option value="inactive">Inactive</option>
                        </select>
                    </div>                        
                    <button type="submit" class="btn btn-success">Save Update</button>
                </form>
            </div>
        </div>
    </div>
</div>
  <!-- Bootstrap Delete Confirmation Modal for Delete -->
  <div class="modal fade" id="deleteSubjectModal" tabindex="-1" aria-labelledby="deleteSubjectModalLabel" aria-hidden="true">
    <div class="modal-dialog">
    <div class="modal-content">
        <div class="modal-header">
        <h5 class="modal-title" id="deleteSubjectModalLabel">Confirm Deletion</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            Are you sure you want to delete this subject?
        </div>
        <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">No</button>
        <form id="deleteSubjectForm" method="POST" action="">
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
    crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script> 
    <script src="https://cdn.jsdelivr.net/npm/jquery-validation@1.19.3/dist/jquery.validate.min.js"></script>

   <script>
    // Pagination
    $(document).on('click', '#pagination-wrapper a', function (event) {
    event.preventDefault(); // Prevent default link behavior
    let page = $(this).attr('href').split('page=')[1];

    fetchSubjects(page);
});

    function fetchSubjects(page) {
        $.ajax({
            url: "{{ route('subject.fetch') }}?page=" + page,
            type: "GET",
            success: function (response) {
                $('#subjects-container').html(response); // Ensure this ID exists in Blade
            },
            error: function (error) {
                console.log("Error fetching subjects:", error);
            }
        });
    }



    // update madal jQuery code 
    $(document).ready(function () {
        $(document).on('click', '.updateSubjectBtn', function () {
            let subjectId = $(this).data('id');
            let subjectName = $(this).data('name');
            let subjectStatus = $(this).data('status'); // Fetch correct status
            let updateRoute = $(this).data('route');

            $('#updateSubjectId').val(subjectId);
            $('#SubjectName').val(subjectName);
            $('#updateStatus').val(subjectStatus); // Set correct status field
            $('#updateSubjectForm').attr('action', updateRoute);
        });
    });


     // Open Delete Modal
     $(document).on('click', '.deleteStudentBtn', function () {
            let subjectId = $(this).data('id');

            // Set action in form dynamically
            $('#deleteSubjectForm').attr('action', `/subjects/${subjectId}`);
            // Show the modal
            $('#deleteSubjectModal').modal('show');
        });
</script>
</body>
</html>