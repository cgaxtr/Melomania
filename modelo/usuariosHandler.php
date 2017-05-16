<?php
  require_once("db.php");

  $db = DB::getInstance()->getConnection();

  $val = "%{$_REQUEST['term']}%";

  $stmt = $db->prepare('SELECT email FROM usuarios WHERE email like ?');
  $stmt->bind_param('s', $val);

  $stmt->execute();

  $result = $stmt->get_result();
    $return_array = array();
    while ($row = $result->fetch_assoc()) {
      array_push($return_array, $row["email"]);
    }

    echo json_encode($return_array);
 ?>
