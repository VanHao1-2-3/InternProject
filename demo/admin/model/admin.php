<?php

class admin
{
  public function getAdminAcc()
  {
    $conn = new connect();
    $sql = "SELECT * FROM admintable";
    $result = $conn->getList($sql);
    return $result;
  }
  public function getRole()
  {
    $conn = new connect();
    $sql = "SELECT * FROM role";
    $result = $conn->getList($sql);
    return $result;
  }
  public function insertAdmin($admin)
  {
    $conn = new connect();
    $sql = $conn->prepare("INSERT INTO admintable(id, admin_name,avatar,`password`,`role`)
    VALUES(null, :admin_name, :avatar, :password,:role)
    ");
    $sql->bindParam(':admin_name', $admin['admin_name'], PDO::PARAM_STR);
    $sql->bindParam(':avatar', $admin['avatar'], PDO::PARAM_STR);
    $sql->bindParam(':password', $admin['password'], PDO::PARAM_STR);
    $sql->bindParam(':role', $admin['role'], PDO::PARAM_INT);
    $result = $sql->execute();
    if ($result) {
      return true;
    } else {
      return false;
    }
  }
  public function getAdmin($value, $type = 'admin_name')
  {
    $conn = new connect();
    if ($type === 'admin_name') {
      $sql = "SELECT * from admintable where admin_name='$value'";
    } else {
      $sql = "SELECT * from admintable where id=$value";
    }
    $result = $conn->getInstance($sql);
    return $result;
  }
  public function hideAdmin($id)
  {
    $conn = new connect();
    $sql = "UPDATE admintable SET deleted = 1 WHERE id = $id";
    $result = $conn->exec($sql);
    if ($result > 0) {
      return true;
    } else {
      return false;
    }
  }
}
?>
