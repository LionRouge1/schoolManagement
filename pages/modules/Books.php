<?php
class Books
{
  private $bdd;
  private $ebooks;
  private $files;

  public function __construct()
  {
    $this->bdd = mysqli_connect('localhost', 'root', '', 'databaseSchool');;
  }

  public function addBook()
  {
    if (isset($_FILES['book']) && !empty($_FILES['book'])) {
      $bookname = $_FILES['book']['name'];
      $destination = 'books/' . $bookname;
      $extension = pathinfo($bookname, PATHINFO_EXTENSION);
      $book = $_FILES['book']['tmp_name'];
      $size = $_FILES['book']['size'];

      if (in_array($extension, ['pdf', 'doc', 'docx'])) {
        if ($size < 990000000) {
          if (move_uploaded_file($book, $destination)) {
            $sql = "INSERT INTO ebooks (ebooks, size, downloads) VALUES ('$bookname', $size, 0)";
            if(mysqli_query($this->bdd, $sql)){
              header('Location: index.php');
              die();
            };
            echo "Sorry we couldn't upload the file";
            return;
          }
          echo "File size too large";
          return;
        }
      }
    }
  }

  public function display($who)
  {

    $sql = "SELECT * FROM ebooks";
    $result = mysqli_query($this->bdd, $sql);

    $files = mysqli_fetch_all($result, MYSQLI_ASSOC);

    foreach ($files as $file) :
?>
      <tr>
        <td><?php echo $file['ebooks']; ?></td>
        <td><?php echo floor($file['size'] / 1000) . ' KB'; ?></td>
        <td><?php echo $file['downloads']; ?></td>
        <td><a href="delete.php?file_id=<?php echo $file['book_id'] ?>">Download</a></td>
        <?php if ($who == 'admin') : ?><td> <a href="delete.php?id=<?= $file['book_id'] ?>" id="<?= $file['book_id'] ?>" class="btn">Remove</a></td><?php endif ?>
      </tr>
<?php
    endforeach;
  }

  public function remove()
  {
    $id = $_GET['id'];
    $sql = "DELETE FROM ebooks WHERE book_id=$id";
    if(mysqli_query($this->bdd, $sql)){
      header('Location: index.php');
      die();
    };
  }

  public function download()
  {
    if (isset($_GET['file_id'])) {
      $id = $_GET['file_id'];
    
      $sql = "SELECT * FROM ebooks WHERE book_id=$id";
      $result = mysqli_query($this->bdd, $sql);
    
      $file = mysqli_fetch_assoc($result);
      $filepath = 'books/' . $file['ebooks'];
    
      if (file_exists($filepath)) {
          header('Content-Description: File Transfer');
          header('Content-Type: application/octet-stream');
          header('Content-Disposition: attachment; filename=' . basename($filepath));
          header('Expires: 0');
          header('Cache-Control: must-revalidate');
          header('Pragma: public');
          header('Content-Length: ' . filesize('books/' . $file['ebooks']));
          readfile('books/' . $file['ebooks']);
    
          $newCount = $file['downloads'] + 1;
          $updateQuery = "UPDATE ebooks SET downloads=$newCount WHERE book_id=$id";
          mysqli_query($this->bdd, $updateQuery);
          exit;
      }
      echo "File not exist";
    }
  }
}
