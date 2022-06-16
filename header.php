<header>
 <marquee><h1>SCHOOL MANAGEMENT SYSTHEM</h1></marquee> 
</header>
<nav class="navbar navbar-expand-sm bg-dark justify-content-center">
  <div class="container-fluid">
    <ul class="navbar-nav">
      <li class="nav-item">
        <a href="administrator.php" class="nav-link">Manage teachers</a>
      </li>
      <li class="nav-item">
        <a href="../bookstore/index.php" class="nav-link">Manage Ebooks</a>
      </li>
      <li class="nav-item">
        <a href="users.php" class="nav-link">Views Users</a>
      </li>
    </ul>
    <form class="d-flex">
        <input class="form-control me-2" id="search" onkeyup="tableFilter()" type="text" placeholder="Search">
        <button class="btn btn-primary" type="button">Search</button>
      </form>
    <a href="../deconnexion.php" class="btn btn-primary pr-0" >Log out</a>
  </div>
</nav>