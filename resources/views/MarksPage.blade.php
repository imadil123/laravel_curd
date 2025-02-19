<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Marks Page</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css" integrity="sha512-Evv84Mr4kqVGRNSgIGL/F/aIDqQb7xQ2vcrdIwxfjThSH8CSR7PBEakCr51Ck+w+/U6swU2Im1vVX0SVk9ABhg==" crossorigin="anonymous" referrerpolicy="no-referrer" />  
</head>
<body>
    <x-navbar/>
    <div class="container">
        <div class="row my-3">
            <div class="col-12">
                <div class="row">
                    <div class="col">
                        <h1>Student details</h1>
                    </div>
                    <div class="col-8">
                        <form action="#" method="GET" class="mb-3">
                            <div class="input-group col-6">
                                <input type="text" name="query" class="form-control search" placeholder="Search Your Record..." value="{{ request('query') }}">
                                <button type="submit" class="btn btn-success">Search</button>
                            </div>
                        </form>
                    </div>
                </div>
                <a href="#" class="btn btn-success my-3">New User</a>
                <div class="d-flex">
                    <div id="students-container">
                        @include('partials.marks-list')
                    </div>                    
                </div>
            </div>
        </div>
    </div>


</body>
</html>