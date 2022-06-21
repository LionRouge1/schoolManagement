<?php
class Filter
{
  private $bdd;

  function __construct($bdd)
  {
    $this->bdd = $bdd;
  }

  public function showUser($data)
  {
    $user = $data->fetch();
    if (!is_null($user) && !empty($user)) :
?>
      <div class="row text-center m-4">
        <?php
        do {
        ?>
          <div class="modal" id="id<?= $user['teacher_id'] ?>">
            <div class="modal-dialog">
              <span class="close" onclick="document.getElementById('<?= $user['teacher_id'] ?>').style.display='none'; 
          location.reload();" title="Fermer">&times</span>
              <div class="modal-content">
                <p class="line">
                  <span><?= $user['tchName'] ?></span><span><?= $user['tchSurname'] ?></span>
                </p>
                <p><strong>Email :</strong> <?= $user['tchEmail'] ?></p>
                <p><strong>Region :</strong> <?= $user['region'] ?></p>
                <p><strong>City :</strong> <?= $user['ctyName'] ?></p>
                <p class="line">
                <p><strong>Gender :</strong> <?= $user['gender'] ?></p>
                <p><strong>Qualification :</strong> <?= $user['qualification'] ?></p>
                <p><strong>Contact :</strong> <?= $user['contact'] ?></p>
                <div class="modal-footer justify-content-center">
                  <span><i class="fas fa-star"></i></span>
                  <span><i class="fas fa-star"></i></span>
                  <span><i class="far fa-star"></i></span>
                  <span><i class="far fa-star"></i></span>
                  <span><i class="far fa-star"></i></span>
                </div>
              </div>

            </div>
          </div>

          <div id="id0<?= $user['teacher_id'] ?>" class="modal">
            <div class="modal-dialog">
              <div class="modal-content p-4 justify-content-center">
                <div class="modal-header" style="height: 100px;">
                  <p><strong>Rate teacher </strong><?= $user['tchName'] . ' ' . $user['tchSurname'] ?></p>
                </div>
                <form action="rating.php?tid=<?= $user['teacher_id'] ?>" method="post">
                  <div class="ratebox">
                    <input type="range" name="rate" min='1' max='10' id="Rid<?= $user['teacher_id'] ?>" onchange="rates('Rid<?= $user['teacher_id'] ?>')" required>
                    <span class="rateValue"></span>
                  </div>
                  <div>
                    <textarea name="comments" cols="30" rows="5" placeholder="Enter your comments here..." required></textarea>
                  </div>
                  <button type="submit" class="btn btn-primary">Submit</button>
                </form>
              </div>
            </div>
          </div>

          <div class="card m-3 shadow" style="width:400px">
            <img class="card-img-top" src="../images/avatars/<?= $user['avatar'] ?>" alt="Teacher picture" style="width:100%; height: 250px">
            <div class="card-body">
              <h4 class="card-title"><?= $user['tchName'] . ' ' . $user['tchSurname'] ?></h4>
              <p class="card-text"><?= $user['sbtName'] ?> teacher at <?= $user['schoolName'] ?> in the <?= $user['region'] ?> </p>
              <a href="#" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#id<?= $user['teacher_id'] ?>">Book</a>
              <a href="#" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#id0<?= $user['teacher_id'] ?>">Rate</a>
            </div>
          </div>
        <?php
        } while ($user = $data->fetch());
        ?>

      </div>
<?php
    endif;
  }

  public function mainfilter()
  {
    if (isset($_POST['filer']) && isset($_POST['by'])) {
      switch ($_POST['filer']) {
        case 'region':
          $sql = 'SELECT * FROM teachers t JOIN locations l ON t.teacher_id = l.location_id
            JOIN subjects_teachers st ON t.teacher_id = st.teacher_id
            JOIN subjects s ON st.subject_id = s.subject_id WHERE l.region = ?';
          $utilisateur = $this->bdd->prepare($sql);
          $utilisateur->execute(array($_POST['by']));
          $this->showUser($utilisateur);
          break;
        case 'city':
          $sql = 'SELECT * FROM teachers t JOIN locations l ON t.teacher_id = l.location_id
            JOIN subjects_teachers st ON t.teacher_id = st.teacher_id
            JOIN subjects s ON st.subject_id = s.subject_id WHERE l.ctyName = ?';
          $utilisateur = $this->bdd->prepare($sql);
          $utilisateur->execute(array($_POST['by']));
          $this->showUser($utilisateur);
          break;
        case 'subject':
          $sql = 'SELECT * FROM teachers t JOIN locations l ON t.teacher_id = l.location_id
            JOIN subjects_teachers st ON t.teacher_id = st.teacher_id
            JOIN subjects s ON st.subject_id = s.subject_id WHERE s.sbtName = ?';
          $utilisateur = $this->bdd->prepare($sql);
          $utilisateur->execute(array($_POST['by']));
          $this->showUser($utilisateur);
          break;

        default:
          $sql = 'SELECT * FROM teachers t JOIN locations l ON t.teacher_id = l.location_id
          JOIN subjects_teachers st ON t.teacher_id = st.teacher_id
          JOIN subjects s ON st.subject_id = s.subject_id';
          $utilisateur = $this->bdd->query($sql);
          $this->showUser($utilisateur);
      }
    } else {
      $sql = 'SELECT * FROM teachers t JOIN locations l ON t.teacher_id = l.location_id
      JOIN subjects_teachers st ON t.teacher_id = st.teacher_id
      JOIN subjects s ON st.subject_id = s.subject_id';

      $utilisateur = $this->bdd->query($sql);
      $this->showUser($utilisateur);
    }
  }
}
