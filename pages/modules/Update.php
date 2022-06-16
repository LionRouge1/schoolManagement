<?php
class Update {
  private $bdd;

  public function __construct($bdd)
  {
    $this->bdd = $bdd;
  }

  public function update($column, $table, $idn, $id)
  {
    $email=htmlspecialchars($_POST[$column]);
    $sql = 'UPDATE `' . $table .'` SET `'.$column.'`=? WHERE `'. $idn .'` =`' . $id . '`';
    $adminup= $this->bdd->prepare($sql);
    $adminup->execute(array($email));
  }
}
?>