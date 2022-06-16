<nav class="navbar navbar-expand-sm bg-dark navbar-dark justify-content-center">
  <div class="container-fluid">
    <ul class="navbar-nav">
    <li class="navbar-brand">
        <img src="images/avatars/<?=$avatar?>" alt="Avatar" class="rounded-pill">
      </li>
      <li class="navbar-brand">
        <a href="administrator.php" class="nav-link">View ratings</a>
      </li>
      <li class="navbar-brand">
        <a href="adminprofil.php?id=<?=$id?>" class="nav-link">Update profile</a>
      </li>
      <li class="navbar-brand">
        <a href="administrator.php" class="nav-link">Add subject</a>
      </li>
    </ul>
    <a href="../deconnexion.php" class="btn btn-primary pr-0" >Log out</a>
  </div>
</nav>