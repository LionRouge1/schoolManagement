<?php
session_start();
if (!isset($_SESSION['who'])) {
  header('Location: ../index.php');
  die();
}
$who = $_SESSION['who'];
require_once '../config.php';
require '../pages/modules/Books.php';

$about = new Books($bdd);
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <link rel="stylesheet" href="./style.css">
  <title>Bookstore</title>
</head>

<body>
  <header>
    <div class="logo">
      <p>Bookstore</p>
    </div>
    <ul class="navbar">
      <li><a href="#" id="list-link" class="links active">List</a></li>
      <?php if ($who == 'admin') ?> <li><a href="#" id="add-link" class="links">Add book</a></li>
      <li><a href="javascript:history.go(-1)" class="link">
          <-Go back</a>
      </li>
    </ul>
  </header>
  <main>
    <!-- Header Section -->



    <!-- List Section -->
    <section class="books_container" id="list">
      <h1>Awesome books</h1>
      <div>
        <table class="books_table">
          <thead>
            <tr class="line_hd">
              <th>Title</th>
              <th>Author</th>
              <th>action</th>
            </tr>
          </thead>
          <!--- List of all the books -->
          <?php
          $books = $about->display();
          ?>
        </table>
      </div>
    </section>

    <section id="add_book">
      <h2>Add a new book</h2>
      <div class="add-new section hidden">
        <form action="" method="post" id="book-form">
          <input type="text" id="title" name="title" class="text-inpute" placeholder="Book title..." />
          <input type="text" id="author" name="author" class="text-inpute" placeholder="Book's author..." />
          <button type="submit" id="button">Add</button>
        </form>
        <span id="error"></span>
      </div>
    </section>
    <?php
      if(isset($_POST['title']) && !empty($_POST['title']) && isset($_POST['author']) && !empty($_POST['author']))
      {
        $books = $about->addBook($_POST['title'], $_POST['author']);
      }
    ?>

    <!-- Footer Section -->
    <footer>
      <p>Copyright: All rights reserved</p>
    </footer>
  </main>
  <script src="js/main.js"></script>
</body>

</html>