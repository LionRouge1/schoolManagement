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
            <img src="../images/avatars/<?= $avatar ?>" alt="Avatar" class="rounded-pill" style="height: 100px; width:120px;">
          </li>
          <li class="navbar-brand" style="color: white;">
            <a href="<?php if (!isset($pagebook)) : ?> teachers.php <?php else : ?> ../pages/teachers.php<?php endif ?>" class="nav-link text-white">View ratings</a>
          </li>
          <li class="navbar-brand">
            <a href="../bookstore/index.php" class="nav-link text-white">View ebooks</a>
          </li>
          <li class="navbar-brand">
            <a href="<?php if (!isset($pagebook)) : ?> adminprofil.php?id=<?= $id ?> <?php else : ?> ../pages/adminprofil.php?id=<?= $id ?><?php endif ?>" class="nav-link text-white">Update profile</a>
          </li>
          <li class="navbar-brand">
            <button href="#" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addSubject">Add subject</button>
          </li>
        </ul>
        <a href="../deconnexion.php" class="btn btn-primary pr-0">Log out</a>
      <?php
        break;
      case 'users':
      ?>
        <ul class="navbar-nav">
          <li class="navbar-brand">
            <a href="../pages/users.php" class="nav-link text-white">View Teachers</a>
          </li>
          <li class="navbar-brand">
            <a href="../bookstore/index.php" class="nav-link text-white">View Ebook</a>
          </li>
        </ul>
        <?php if (!isset($pagebook)) : ?>
          <form class="d-flex" action="filteraction.php" method="POST">
            <select name="filer" id="filter" required>
              <option value="">Select__</option>
              <option value="region">Region</option>
              <option value="city">City</option>
              <option value="subject">Subject</option>
            </select>
            <input class="form-control me-2" name="by" id="search" onclick="showFilter()" type="text" placeholder="Search by..." required>
            <button type="submit" class="btn btn-primary" type="button">Search</button>
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