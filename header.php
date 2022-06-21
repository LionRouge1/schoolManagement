<header>
 <marquee><h1>Marketplace for SHS Teachers in Ghana</h1></marquee>
</header>
<style>
  .nav-link {
    color: white;
  }
</style>
<nav class="navbar navbar-expand-sm bg-dark justify-content-center">
  <div class="container-fluid">
    <ul class="navbar-nav">
      <li class="nav-item link 
      <?php if(isset($pageadmin)): ?> active <?php endif?>" id="teachers-link" id="active ">
        <a href="<?php if(isset($pageadmin)): ?> administrator.php
          <?php else:?> ../pages/administrator.php<?php endif?>" class="nav-link">Manage teachers</a>
      </li>
      <li class="nav-item <?php if(isset($pagebook)): ?> active <?php endif?>" style="margin: 0 5px;">
        <a href="../bookstore/index.php" class="nav-link <?php if(isset($pagebook)): ?> text-black <?php else:?> text-white<?php endif?>">Manage Ebooks</a>
      </li>
      <li class="nav-item link <?php if(isset($pageuser)): ?> active <?php endif?>" id="users-link">
        <a href="<?php if(isset($pageuser)): ?>adminUsers.php
          <?php else:?> ../pages/adminUsers.php<?php endif?>" class="nav-link">Views Users</a>
      </li>
    </ul>
    <form class="d-flex">
        <input class="form-control me-2" id="search" onkeyup="tableFilter()" type="text" placeholder="Search">
        <button class="btn btn-primary" type="button">Search</button>
      </form>
    <a href="../deconnexion.php" class="btn btn-primary pr-0" >Log out</a>
  </div>
</nav>