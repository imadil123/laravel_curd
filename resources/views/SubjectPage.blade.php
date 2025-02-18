<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Subjects</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">

</head>
<body>
    <x-navbar/>
    <div class="container">
        <div class="row my-3">
            <div class="col-12">
                <div class="row">
                    <div class="col">
                        <h1>Add Subjects</h1>
                    </div>
                </div>
                <a href="#" class="btn btn-success my-3" data-bs-toggle="modal" data-bs-target="#updateStudentModal">Add New Subject</a>
                <div class="d-flex">
                    <div id="students-container">

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
                <form id="updateStudentForm" action="{{ route('subjects.store') }}" method="POST" enctype="multipart/form-data">
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






 <!-- Bootstrap and jQuery Scripts -->
 <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
 integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
 crossorigin="anonymous">
 </script>
 <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script> 
 <script src="https://cdn.jsdelivr.net/npm/jquery-validation@1.19.3/dist/jquery.validate.min.js"></script>
</body>
</html>