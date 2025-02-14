<style>
  /* Common styles for both buttons */
  .nav-item .nav-link.capsule {
    border: 2px solid white;
    border-radius: 50px;
    padding: 5px 15px;
    transition: all 0.3s ease-in-out;
  }

  /* Hover effect for both buttons */
  .nav-item .nav-link.capsule:hover {
    background-color: white;
    color: #7952b3 !important;
  }

  .navbar-brand {
    font-size: 25px;
  }
</style>

<nav class="navbar navbar-expand-lg" style="background-color: #7952b3">
    <div class="container-fluid">
      <a class="navbar-brand text-white font-weight-bold me-auto ms-3" href="#">iCode</a>

        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" 
            aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse justify-content-end" id="navbarSupportedContent">
            <ul class="navbar-nav ms-auto mb-2 mx-5 mb-lg-0">
                <li class="nav-item mx-2">
                    <a class="nav-link active text-white capsule" aria-current="page" href="{{ route('view.students') }}">Table</a>
                </li>
                <li class="nav-item mx-2">
                    <a class="nav-link active text-white capsule" aria-current="page" href="{{ route('login') }}">Login</a>
                </li>
                <li class="nav-item mx-2">
                    <a class="nav-link active capsule bg-light" aria-current="page" href="{{ route('logout.user') }}">Logout</a>
                </li>
            </ul>
        </div>
    </div>
</nav>
