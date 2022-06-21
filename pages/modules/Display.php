<?php
class Display
{

  private $bdd;
  private $permission;

  public function __construct($bdd)
  {
    $this->bdd = $bdd;
  }

  public function displayelement($sql, $heads, $type, $permission = true, $id = '')
  {
    switch ($type) {
      case 'query':
        $utilisateur = $this->bdd->query($sql);
        $user = $utilisateur->fetch();
        break;
      case 'prepare':
        $utilisateur = $this->bdd->prepare($sql);
        $utilisateur->execute(array($id));
        $user = $utilisateur->fetch();
        break;
    }

?>
    <div class="table-striped">
      <table class="table">
        <tr class="entete">
          <?php
          foreach ($heads as $head) {
          ?>
            <th><?= $head; ?></th>
          <?php
          }
          ?>
        </tr>
        <?php
        do {
          $check = $user['ID'];

        ?>
          <tr class="user">
            <?php
            if ($permission) :
            ?>
              <td> <img src="../images/avatars/<?= $user['avatar'] ?>" alt="" style="width: 80px; height: 50px"> </td>
              <td><?= $user['Name']; ?></td>
              <td><?= $user['Surname']; ?></td>
              <td><?= $user['schoolName']; ?></td>
              <td><?= $user['Email']; ?></td>
              <td><?= $user['contact']; ?></td>
              <td><?= $user['qualification']; ?></td>
              <td><?= $user['address']; ?></td>
              <td><?= $user['gender']; ?></td>
              <td><?= $user['region']; ?></td>
              <td><?= $user['ctyName']; ?></td>
              <?php
            else :
              for ($i = 1; $i < count($user) / 2; $i++) {

              ?>
                <td><?= $user[$i]; ?></td>
            <?php
              }
            endif;
            ?>
            <?php if ($permission) : ?>
              <td>
                <p class="delete" onclick="deleteft(<?= $check ?>, '<?= $user['Name'] . ' ' . $user['Surname']; ?>')" data-bs-toggle="modal" data-bs-target="#id01"><strong class="strong" title="Supprimer">&times</strong> <span class="dltxt">Delete</span></p>
              </td>
          </tr>
        <?php endif; ?>
      <?php
        } while ($user = $utilisateur->fetch());
      ?>
      </table>
    </div>
  <?php
  }

  public function deleteElement()
  {
  ?>
    <div id="id01" class="modal modal1" style="display: none;">
      <span onclick="document.getElementById('id01').style.display='none'" class="closespr" title="Close Modal">×</span>
      <form class="modal1-content" method="post" action="supprime.php">
        <div class="container">
          <h4>DELETE TEACHER ACCOUNT</h4>
          <p>Do you really want DELETE <span id="nom"></span> ?</p>
          <div class="clearfix">
            <button type="button" onclick="document.getElementById('id01').style.display='none'" class="cancelbtn" data-bs-dismiss="modal">Cancel</button>
            <button type="submit" name="delete" class="deletebtn">Delete</button>
          </div>
        </div>
      </form>
    </div>
  <?php
  }

  public function message()
  {
  ?>
    <?php
    if (isset($_GET['fid'])) {
      switch ($_GET['fid']) {
        case 'true':
    ?>
          <div class="alerted">
            <span class="closebtn">&times;</span>
            <strong>Success!</strong> Account Delete sucessfully.
          </div>
          <script type="text/javascript">
            var alerted = document.querySelector(".alerted");
            var closebtn = document.querySelector(".closebtn");
            closebtn.addEventListener('click', function() {
              alerted.style.display = "none";
            });
            alerted.classList.add("success");
            setTimeout(function() {
              alerted.classList.remove("success");
            }, 10000);
          </script>
        <?php
          break;

        case 'false':
        ?>
          <div class="alert alert-danger">
            <span class="closebtn">&times;</span>
            <strong>Erreur</strong> Sorry!! Something went wrong
          </div>
          <script type="text/javascript">
            var alerted = document.querySelector(".alert");
            var closebtn = document.querySelector(".closebtn");
            closebtn.addEventListener('click', function() {
              alerted.style.display = "none";
            });
            alerted.classList.add("success");
            setTimeout(function() {
              alerted.style.display = "none";
            }, 10000);
          </script>
    <?php
          break;
      }
    }
    ?>
<?php
  }
}
