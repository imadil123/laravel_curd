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
    font-size: 1.2rem
  }
  #students-container {
        min-width: auto;
        width: 100%;
        overflow: auto;
    }
</style>

<nav class="navbar navbar-expand-lg" style="background-color: #7952b3">
    <div class="container-fluid">
      <a class="navbar-brand text-white font-weight-bold me-auto ms-3" href="#">iCode</a>

        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" 
            aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="hello capsule">
          <div class="dropdown">
            <a class="btn btn-light dropdown-toggle capsule mx-5" href="#" role="button" id="dropdownMenuLink" data-bs-toggle="dropdown" aria-expanded="false">
              Menu
            </a>
            <ul class="dropdown-menu" aria-labelledby="dropdownMenuLink">
              <li><a class="dropdown-item" href="#">Students</a></li>
              <li><a class="dropdown-item" href="#">Subject</a></li>
            </ul>
          </div>
        </div>

        <div class="hello capsule">
          <div class="dropdown">
            <a class="btn btn-light dropdown-toggle capsule" href="#" role="button" id="dropdownMenuLink" data-bs-toggle="dropdown" aria-expanded="false">
              Menu
            </a>
            <ul class="dropdown-menu" aria-labelledby="dropdownMenuLink">
              <li><a class="dropdown-item" href="#">Students</a></li>
              <li><a class="dropdown-item" href="#">Subject</a></li>
            </ul>
          </div>
        </div>




        <div class="collapse navbar-collapse justify-content-end" id="navbarSupportedContent">
            <ul class="navbar-nav ms-auto mb-2 mx-5 mb-lg-0">
              @auth
              <li class="nav-item mx-2 mb-2 text-center">
                    <a class="nav-link active text-white capsule" aria-current="page" href="{{ route('view.students') }}">Table</a>
                </li>
                <li class="nav-item mx-2 mb-2 text-center">
                  <a class="nav-link active capsule bg-light" aria-current="page" href="{{ route('logout.user') }}">Logout</a>
              </li>
              @endauth

              @guest
              <li class="nav-item mx-2 mb-2 text-center">
                <a class="nav-link active text-white capsule" aria-current="page" href="{{ route('registration.user') }}">Register</a>
              </li>
              <li class="nav-item mx-2 mb-2 text-center">
                <a class="nav-link active text-white capsule" aria-current="page" href="{{ route('login') }}">Login</a>
              </li>
              @endguest  
            </ul>
        </div>
    </div>
</nav>
