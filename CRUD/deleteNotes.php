<?php
require_once('pdo.php');
//DELETE
if (isset($_POST['delete']) && isset($_POST['noteID'])) {
  if (!empty($_SESSION['user_id'])) {
    try {
      $_note_id = $_POST['noteID'];
      $query = 'DELETE FROM notes WHERE id=:note_id AND user_id=:user_id';
      $stmt = $pdo->prepare($query);
      $stmt->bindParam(':note_id', $_note_id, PDO::PARAM_INT);
      $stmt->bindParam(':user_id', $user_id, PDO::PARAM_INT);
      $stmt->execute();
      header('Content-Type: application/json');
      echo json_encode('NOTE DELETED');
    } catch (PDOException $e) {
      echo 'Error: ' . $e->getMessage();
      echo json_encode('ACCESS DENIED');
    }
  } else {
    header('Location:../index');
  }
} else {
  header('Content-Type: application/json');
  echo json_encode('NOTE erroooooooooor');
}
?>