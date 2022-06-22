<?php
session_start();
if (!isset($_SESSION['who'])) {
  header('Location: ../index.php');
  die();
}
$who = $_SESSION['who'];
$id = $_SESSION['id'];
$pagebook = true;


require_once '../config.php';
require '../pages/modules/Books.php';

if ($who == 'teachers') {
  $sql1 = 'SELECT * FROM teachers where teacher_id = ?';
  $connexion = $bdd->prepare($sql1);

  $connexion->execute(array($id));
  $teacher = $connexion->fetch();
  $avatar = $teacher['avatar'];
}


$about = new Books($bdd);
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <link rel="stylesheet" href="../pages/css/admin1.css">
  <link rel="stylesheet" href="../pages/css/adminstylew.css">
  <link rel="stylesheet" href="style.css">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
  <link rel="stylesheet" href="../pages/css/app.css">
  <title>Bookstore</title>
</head>

<body>
  <?php
  if ($who == 'admin') {
    include '../header.php';
  } else {
    include '../pages/header.php';
  }
  ?>
  <main>
    <?php if ($who == 'admin') : ?> <button class="btn btn-primary btnadd" data-bs-toggle="modal" data-bs-target="#addBook">Add</button><?php endif ?>
    <div class="table-striped">
      <table class="table">
        <tr class="entete">
          <th>Ebook</th>
          <th>Size</th>
          <th>Downloads</th>
          <?php if ($who == 'admin') : ?> <th>action</th><?php endif ?>
        </tr>
        <!--- List of all the books -->
        <?php
        $books = $about->display($who);
        ?>
      </table>
    </div>

    <div id="addBook" class="modal">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h3>Your file should be in one of the following formats: <strong>.doc</strong>, <strong>.pdf</strong>, <strong>.docx</strong></h3>
          </div>
          <form action="delete.php" method="post" class="m-4" enctype="multipart/form-data">
            <div class="m-2">
              <input type="file" accept=".pdf, .doc, .docx" name="book" class="text-inpute" required />
            </div>
            <button type="submit" class="btn btn-primary" id="button">Add</button>
          </form>
          <span id="error"></span>
        </div>
      </div>
    </div>
    <?php
    if (isset($_POST['title']) && !empty($_POST['title']) && isset($_POST['author']) && !empty($_POST['author'])) {
      $books = $about->addBook($_POST['title'], $_POST['author']);
    }
    ?>

  </main>
  <script>
    function tableFilter() {
      var input, filter, table, tr, td, i, txtValue;
      input = document.getElementById("search");
      filter = input.value.toUpperCase();
      table = document.querySelector(".table");
      tr = table.getElementsByTagName("tr");

      for (i = 0; i < tr.length; i++) {

        td = tr[i].getElementsByTagName("td")[0];
        console.log('admin')

        if (td) {
          txtValue = td.textContent || td.innerText;
          if (txtValue.toUpperCase().indexOf(filter) > -1) {
            tr[i].style.display = "";
          } else {
            tr[i].style.display = "none";
          }
        }
      }
    }
  </script>
</body>

</html>