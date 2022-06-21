<?php
class Rating
{
  private $bdd;
  function __construct($bdd)
  {
    $this->bdd = $bdd;
  }

  public function addRate()
  {
    if (isset($_POST['rate']) && !empty($_POST['rate']) || isset($_POST['comments']) && !empty($_POST['comments'])) {
      $sql = 'INSERT INTO rating (teacher_id, rate, RDate, comments, user_id)
      VALUES (:teacher_id, :rate, :RDate, :comments, :user_id)';
      print_r($_SESSION);
      $id = $_SESSION['id'];
      $tid = $_GET['tid'];

      $comment = $this->bdd->prepare($sql);
      $rate = $comment->execute(array(
        'teacher_id' => $tid,
        'rate' => $_POST['rate'],
        'RDate' => date("Y-m-d"),
        'comments' => $_POST['comments'],
        'user_id' => $id
      ));

      header('Location: users.php');
      die();
    }
  }

  public function displayRate()
  {
    $sql = 'SELECT r.rate_id AS ID, u.userName AS Name, u.userSurname AS Surname, r.RDate, r.rate, r.comments FROM teachers t JOIN rating r on  t.teacher_id = r.teacher_id 
    join users u on r.user_id = u.user_id where r.teacher_id = ? ORDER BY r.RDate DESC';

    $id = $_SESSION['id'];

    $comments = $this->bdd->prepare($sql);
    $comments->execute(array($id));
    $rates = $comments->fetch();
    
    if(is_null($rates) && !empty($rate)) {
      echo 'No comment yet';
    }
    else{
      ?>
    <div id="id01" class="modal modal1" style="display: none;">
      <span onclick="document.getElementById('id01').style.display='none'" class="closespr" title="Close Modal">×</span>
      <form class="modal1-content" method="post" action="../rating.php">
        <div class="container">
          <h4>DELETE TEACHER ACCOUNT</h4>
          <p>Do you really want DELETE this comments ?</p>
          <div class="clearfix">
            <button type="button" onclick="document.getElementById('id01').style.display='none'" class="cancelbtn" data-bs-dismiss="modal">Cancel</button>
            <button type="submit" name="delete" class="deletebtn">Delete</button>
          </div>
        </div>
      </form>
    </div>
    <div class="table-striped">
      <table class="table">
            <tr class="entete">
            <th>Name</th>
              <th>Surname</th>
              <th>Date</th>
              <th>Rates</th>
              <th>Comments</th>
        <?php
        do {

        ?>
          <tr class="list">
            <?php
            for ($i = 1; $i < count($rates)/2; $i++) {
            ?>
              <td><?= $rates[$i]; ?></td>
            <?php
            }
            ?>
          </tr>
        <?php
        } while ($rates = $comments->fetch());
        ?>
      </table>
    </div>
<?php
    }

  }

  public function deleteRate()
  {
    if (isset($_POST['delete'])) {
      $idd=$_POST['delete'];
      $delete=$this->bdd->prepare('DELETE FROM teachers WHERE teacher_id = ?');
      $delete->execute(array($idd));
    
      
      header('Location: teachers.php?fid=true');die();
    }else {
      print_r($_POST);
    }
  }
}
