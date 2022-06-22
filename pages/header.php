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
      <form action="<?php if (!isset($pagebook)) : ?>subject.php<?php else : ?> ../pages/subject.php<?php endif ?>" method="post" class="m-4">
        <div class="m-2">
          <input type="text" placeholder="Subject..." name="subject" id="subjectb" oninput="this.className = ''" required>
        </div>
        <button type="submit" class="btn btn-primary" id="button">Add</button>
      </form>
      <span id="error"></span>
    </div>
  </div>
</div>
<script>
  function autocompleten(inp, arr) {
  var currentFocus;
  inp.addEventListener("input", function (e) {
    var a, b, i, val = this.value;
    closeAllLists();
    if (!val) { return false; }
    currentFocus = -1;
    a = document.createElement("DIV");
    a.setAttribute("id", this.id + "autocomplete-list");
    a.setAttribute("class", "autocomplete-items");
    a.style.backgroundColor = 'rgba(255, 255, 255, 0.85)';
    a.style.position = 'absolute';
    a.style.zIndex = 1;
    this.parentNode.appendChild(a);
    for (i = 0; i < arr.length; i++) {
      if (arr[i].substr(0, val.length).toUpperCase() == val.toUpperCase()) {
        b = document.createElement("DIV");
        b.style.padding = '8px';
        b.style.borderBottom = '1px solid #ccc';
        b.style.pointer = 'cursor';
        b.innerHTML = "<strong>" + arr[i].substr(0, val.length) + "</strong>";
        b.innerHTML += arr[i].substr(val.length);
        b.innerHTML += "<input type='hidden' value='" + arr[i] + "'>";
        b.addEventListener("click", function (e) {
          inp.value = this.getElementsByTagName("input")[0].value;
          closeAllLists();
        });
        a.appendChild(b);
      }
    }
  });
  inp.addEventListener("keydown", function (e) {
    var x = document.getElementById(this.id + "autocomplete-list");
    if (x) x = x.getElementsByTagName("div");
    if (e.keyCode == 40) {
      currentFocus++;
      addActive(x);
    } else if (e.keyCode == 38) {
      currentFocus--;
      addActive(x);
    } else if (e.keyCode == 13) {
      e.preventDefault();
      if (currentFocus > -1) {
        if (x) x[currentFocus].click();
      }
    }
  });
  function addActive(x) {
    if (!x) return false;
    removeActive(x);
    if (currentFocus >= x.length) currentFocus = 0;
    if (currentFocus < 0) currentFocus = (x.length - 1);
    x[currentFocus].classList.add("autocomplete-active");
  }
  function removeActive(x) {
    for (var i = 0; i < x.length; i++) {
      x[i].classList.remove("autocomplete-active");
    }
  }
  function closeAllLists(elmnt) {
    var x = document.getElementsByClassName("autocomplete-items");
    for (var i = 0; i < x.length; i++) {
      if (elmnt != x[i] && elmnt != inp) {
        x[i].parentNode.removeChild(x[i]);
      }
    }
  }
  document.addEventListener("click", function (e) {
    closeAllLists(e.target);
  });
}

let subjectn = new Set(['BIOLOGY', 'GENERAL ARTS', 'LITERATURE IN ENGLISH', 'FRENCH', 'ECONOMICS', 'GEOGRAPHY', 'HISTORY', 'GOVERNMENT', 'RELIGIOUS STUDIES', 'BUSINESS', 'ACCOUNTING',
  'BUSINESS MANAGEMENT', 'PRINCIPLE OF COSTING', 'VISUAL ARTS', 'GENERAL KNOWLEDGE IN ARTS', 'TEXTILE', 'GRAPHIC DESIGN',
  'BASKETRY', 'LEATHER WORK', 'PICTURE MAKING', 'CERAMICS AND SCULPTURE', 'HOME ECONOMICS', 'MANAGEMENT IN LIVING', 'FOOD AND NUTRITION',
  'Technical', 'Building Construction Technology', 'Carpentry And Joinery', 'Catering', 'Electrical Installation Work', 'Electronics', 'Fashion And Design', 'General Textiles',
  'Industrial Mechanics', 'Mechanical Engineering Craft Practice', 'Metal Work', 'Photography', 'Plumbing Craft', 'Printing Craft', 'Welding And Fabrication',
  'Wood Work', 'GENERAL SCIENCE', 'PHYSICS', 'CHEMISTRY', 'ELECTIVE MATHS']);

const subjectb = document.getElementById('subjectb');
subjectb.addEventListener('keydown', ()=> {
  autocompleten(subjectb, Array.from(subjectn));
})
</script>
<script src="../js/registeJs.js"></script>