<?php
class Books {
  private $bdd;
  private $title;
  private $author;

  public function __construct($bdd)
  {
    $this->bdd = $bdd;
  }

  private function connexion($sql) 
  {
    return $this->bdd->prepare($sql);
  }
  
  public function addBook($title, $author)
  {
    $sql = 'INSERT INTO ebooks (title, author) VALUES (:title, :author)';
    $connexion = $this->connexion($sql);
    $connexion->execute(array(
      'title' => $title,
      'author' => $author
    ));
  }

  public function display()
  {
    $sql = 'SELECT * FROM ebooks';
    $connexion = $this->bdd->query($sql);
    $books = $connexion->fetch();
    do {
      ?>
      <tr>
      <td><?=$books['title']?></td> 
      <td><?=$books['author']?></td> <td>
      <a href="delete.php?id=<?=$books['book_id']?>" id="<?=$books['book_id']?>" class="btn">Remove</a></td>
      </tr>
      <?php
  
    } while($books = $connexion->fetch());
  }

  public function remove()
  {
    $id=$_GET['id'];
    $delete=$this->bdd->prepare('DELETE FROM ebooks WHERE book_id = ?');
    $delete->execute(array($id));
  }
}