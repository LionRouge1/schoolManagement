<?php
class Books
{
  private $bdd;
  private $ebooks;
  private $files;

  public function __construct($bdd)
  {
    $this->bdd = $bdd;
  }

  private function connexion($sql)
  {
    return $this->bdd->prepare($sql);
  }

  public function addBook()
  {
    if (isset($_POST['title']) && !empty($_POST['title'])) {
      $ebooks = $_POST['title'];
      $imageFileType = strtolower(pathinfo($_FILES['file']['name'], PATHINFO_EXTENSION));
      $photo = $ebooks . '.' . $imageFileType;
      $chemin = 'books' . $photo;
      $charge = move_uploaded_file($_FILES['file']['tmp_name'], $chemin);

      $sql = 'INSERT INTO ebooks (ebooks, files) VALUES (:ebooks, :files)';
      $connexion = $this->connexion($sql);
      $connexion->execute(array(
        'ebooks' => $ebooks,
        'files' => $chemin
      ));
    }
  }

  public function display($who)
  {
    $sql = 'SELECT * FROM ebooks';
    $connexion = $this->bdd->query($sql);
    $books = $connexion->fetch();
    do {
?>
      <tr>
        <td><?= $books['ebooks'] ?></td>
        <td><a href="<?= $books['files'] ?>" download><?= $books['files'] ?></a></td>
        
          <?php if ($who == 'admin') : ?><td> <a href="delete.php?id=<?= $books['book_id'] ?>" id="<?= $books['book_id'] ?>" class="btn">Remove</a></td><?php endif ?>
      </tr>
<?php

    } while ($books = $connexion->fetch());
  }

  public function remove()
  {
    $id = $_GET['id'];
    $delete = $this->bdd->prepare('DELETE FROM ebooks WHERE book_id = ?');
    $delete->execute(array($id));
  }
}