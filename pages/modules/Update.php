<?php
class Update {
  private $bdd;

  public function __construct($bdd)
  {
    $this->bdd = $bdd;
  }

  public function update($sql, $val, $id)
  {
    $adminup= $this->bdd->prepare($sql);
    $adminup->execute(array($val, $id));
  }
}
?>