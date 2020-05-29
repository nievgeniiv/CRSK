<?php


class ModelApplicationEvents
{
  private $db;

  public function __construct()
  {
    $this->db = DB::getInstance();
  }

  public function getList() : array
  {
    $sql = 'SELECT id, title, activate FROM events';
    return $this->db->getRows($sql, '');
  }

  public function saveData(int $id, string $fioChildren, string $schoolChildren, string $classChildren,
                            string $phoneChildren, string $emailChildren, string $programm,
                            string $school, string $fioParent, string $position, string $phoneParent,
                           string $emailParent, string $programmParent) : bool
  {
    //echo 'ok3';
    $sql = 'SELECT MAX(Id) as id FROM events' . $id;
    //echo 'ok';
    $row= $this->db->getColumn($sql, '');
    $idMax = $row['0'] + 1;
    //var_dump($idMax);
    $sql = 'INSERT INTO events' . $id . '() VALUE(?$, ?$, ?$, ?$, ?$, ?$, ?$, ?$, ?$, ?$, ?$, ?$, ?$)';
    return $this->db->setData($sql, 'issssssssssss', $idMax, $fioChildren, $schoolChildren, $classChildren, $phoneChildren,
                              $emailChildren, $programm, $school, $fioParent, $position, $phoneParent, $emailParent,
                              $programmParent);
  }
}
