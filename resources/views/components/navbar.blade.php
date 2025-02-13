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
</style>

<nav class="navbar navbar-expand-lg" style="background-color: #7952b3">
    <div class="container-fluid">
      <a class="navbar-brand text-white font-weight-bold" href="#">Navbar</a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav me-auto mb-2 mb-lg-0">
          <li class="nav-item">
            <a class="nav-link active text-white capsule" aria-current="page" href="#">Home</a>
          </li>
          <li class="nav-item">
            <a class="nav-link active text-white capsule" aria-current="page" href="#">Table</a>
          </li>
        </ul>
        <form class="d-flex">
          <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
          <button class="btn btn-outline-light" type="submit">Search</button>
        </form>
      </div>
    </div>
</nav>
