<link rel="stylesheet" href="css/app.css">
<header>
 <marquee><h1>Marketplace for SHS Teachers in Ghana</h1></marquee>
</header>
<nav class="navbar navbar-expand-sm bg-dark navbar-dark justify-content-center">
  <div class="container-fluid">

    <?php
    switch ($who) {
      case 'teachers':
    ?>
        <ul class="navbar-nav">
          <li class="navbar-brand">
            <img src="../images/avatars/<?= $avatar ?>" alt="Avatar" class="rounded-pill" style="height: 70px; width:120px;">
          </li>
          <li class="navbar-brand <?php if(isset($pagehome)) : ?> active <?php endif ?>" style="color: white;">
            <a href="<?php if (!isset($pagebook)) : ?> teachers.php <?php else : ?> ../pages/teachers.php<?php endif ?>" class="nav-link text-white">View ratings</a>
          </li>
          <li class="navbar-brand <?php if(isset($pagebook)) : ?> active <?php endif ?>">
            <a href="../bookstore/index.php" class="nav-link text-white">View ebooks</a>
          </li>
          <li class="navbar-brand <?php if(isset($pageUpdate)) : ?> active <?php endif ?>">
            <a href="<?php if (!isset($pagebook)) : ?> adminprofil.php?id=<?= $id ?> <?php else : ?> ../pages/adminprofil.php?id=<?= $id ?><?php endif ?>" class="nav-link text-white">Update profile</a>
          </li>
          <li class="navbar-brand">
            <button href="#" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addSubject">Add subject</button>
          </li>
          <form class="d-flex" style="height: 47px;">
            <input class="form-control me-2" id="search" onkeyup="tableFilter()" type="text" placeholder="Search">
            <button class="btn btn-primary" type="button">Search</button>
          </form>
        </ul>
        <a href="../deconnexion.php" class="btn btn-primary pr-0">Log out</a>
      <?php
        break;
      case 'users':
      ?>
        <ul class="navbar-nav">
          <li class="navbar-brand<?php if(!isset($pagebook)) : ?> active <?php endif ?>">
            <a href="<?php if (!isset($pagebook)) : ?>users.php<?php else : ?> ../pages/users.php<?php endif ?>" class="nav-link text-white">View Teachers</a>
          </li>
          <li class="navbar-brand<?php if(isset($pagebook)) : ?> active <?php endif ?>">
            <a href="../bookstore/index.php" class="nav-link text-white">View Ebook</a>
          </li>
        </ul>
        <?php if(!isset($pagebook)) : ?>
          <form class="d-flex" action="users.php?filer=true" method="POST">
            <select name="filer" id="filter" style="height: 38px">
              <option value="">Select__</option>
              <option value="region">Region</option>
              <option value="city">City</option>
              <option value="subject">Subject</option>
            </select>
            <p class="autocomplete"><input class="form-control me-2" name="by" id="search" type="text" placeholder="Search by..."></p>
            <button type="submit" class="btn btn-primary" type="button" style="height: 38px">Search</button>
          </form>
        <?php else : ?>
          <form class="d-flex">
            <input class="form-control me-2" id="search" onkeyup="tableFilter()" type="text" placeholder="Search">
            <button class="btn btn-primary" type="button">Search</button>
          </form>
        <?php endif ?>


        <div class="toast" style="margin-left: 40%">
          <div class="toast-header">
            <strong class="me-auto">Personl information</strong>
            <button type="button" class="btn-close" data-bs-dismiss="toast"></button>
          </div>
          <div class="toast-body">
            <a href="userprofil.php"> <i class="fa-solid fa-gear"></i>Go to the setting</a>
          </div>
        </div>
        <div>

          <a href="../deconnexion.php" class="btn btn-primary pr-0">Log out</a>

          <img src="../images/avatars/avatar.png" onclick="document.querySelector('.toast').classList.add('show')" alt="Avatar" title="Profile" class="btn btn-primary" style="height: 50px; width:50px;">
        </div>
    <?php
        break;
      default:
        header('Location: ../deconnexion.php');
        die();
        break;
    }
    ?>
  </div>
</nav>

<div id="addSubject" class="modal">
  <div class="modal-dialog">
    <div class="modal-content">
      <form action="subject.php" method="post" class="m-4">
        <div class="m-2">
          <input type="text" placeholder="Subject..." name="subject" id="subject" oninput="this.className = ''" required>
        </div>
        <button type="submit" class="btn btn-primary" id="button">Add</button>
      </form>
      <span id="error"></span>
    </div>
  </div>
</div>

<script src="../js/registeJs.js"></script>