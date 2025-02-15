<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View User Details</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css" integrity="sha512-Evv84Mr4kqVGRNSgIGL/F/aIDqQb7xQ2vcrdIwxfjThSH8CSR7PBEakCr51Ck+w+/U6swU2Im1vVX0SVk9ABhg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <style>
        body {
            background-color: #f8f9fa;
        }
        .card {
            border-radius: 10px;
            transition: 0.3s ease-in-out;
        }
        .card img {
            border-radius: 50%;
            object-fit: cover;
        }
        .user-info h3 {
            font-size: 1.2rem;
            margin-bottom: 8px;
        }
        i {
            font-size: 1.5rem;
            color:#fff;
        }
    </style>
</head>
<body>
    <nav class="navbar navbar-dark bg-dark">
    <div class="container-fluid">
        <div class="d-flex align-items-center">
            <a href="{{ route('view.students') }}" class="text-white text-decoration-none">
                <i class="fa-sharp fa-solid fa-arrow-left mx-4 my-2"></i>
            </a>
            <span id="hadding" class="navbar-brand mb-0 h1">User Details</span>
        </div>
    </div>
</nav>


    <div class="container mt-5">
        <div class="row d-flex justify-content-center">
            @foreach ($data as $stu)
                <div class="col-md-6 col-lg-4">
                    <div class="card p-3 mb-4 shadow-sm bg-white">
                        <div class="text-center">
                            @if ($stu->fileName)
                                <img src="{{ asset('storage/' . $stu->fileName) }}" alt="User Image" class="img-thumbnail mt-2" width="120" height="120">
                            @else
                                <img src="https://via.placeholder.com/120" alt="No Image" class="img-thumbnail mt-2">
                            @endif
                        </div>
                        <div class="card-body text-center">
                            <div class="user-info text-start">
                                
                                <h3><strong>Name:</strong> {{ $stu->name }}</h3>
                                <h3><strong>Gender:</strong> {{ $stu->gender }}</h3>
                                <h3><strong>Email:</strong> {{ $stu->email }}</h3>
                                <h3><strong>Age:</strong> {{ $stu->age }}</h3>
                                <h3><strong>City:</strong> {{ $stu->city }}</h3>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>

</body>
</html>
