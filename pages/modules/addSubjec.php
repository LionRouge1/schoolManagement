<?php
class Subject
{
  private $bdd;
  function __construct($bdd)
  {
    $this->bdd = $bdd;
  }

  public function addSubject()
  {
    $sqlsu = 'SELECT subject_id FROM subjects WHERE sbtName = ?';
    $subject = $this->bdd->prepare($sqlsu);
    $subject->execute(array($_POST['subject']));
    $subId = $subject->fetch();

    $sql = 'INSERT INTO subjects_teachers (subject_id, teacher_id) VALUES (:subject_id, :teacher_id)';
    $insert = $this->bdd->prepare($sql);
    $insert->execute(array(
      'subject_id' => $subId['subject_id'],
      'teacher_id' => $_SESSION['id']
    ));
  }

  public function deleteSubject()
  {
    $sql = 'DELETE FROM subjects_teachers WHERE id = ?';
    $subject = $this->bdd->prepare($sql);
    $subject->execute(array($_GET['subject']));
  }

  public function displaySubject()
  {
    $sql = 'SELECT st.id, s.sbtName FROM subjects_teachers st JOIN subjects s ON st.subject_id = s.subject_id WHERE st.teacher_id = ?';
    $subject = $this->bdd->prepare($sql);
    $subject->execute(array($_SESSION['id']));
    $subId = $subject->fetch();

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
          <th>Subjects</th>
          <th>Action</th>
      <?php
      do {

      ?>
        <tr class="list">
          <?php
          for ($i = 1; $i < count($subId) / 2; $i++) {
          ?>
            <td><?= $subId[$i]; ?></td>
          <?php
          }
          ?>
          <td>
            <a href="subject.php?subject=<?=$subId['id']?>" class="delete d-inline" ><strong class="strong" title="Delete">&times</strong> <span class="dltxt">Delete</span></a>
        </td>
          </tr>
    <?php
      } while ($subId = $subject->fetch());
      ?>
      </table>
    </div>
    <?php
    }
  }
