<?php
// EDIT NOTES
require_once('../pdo.php');
if (isset($_POST['title']) && !empty($_POST['note']) && isset($_POST['saveChange']) && $_POST['saveChange']=='Save Changes') {
  if (!empty($_SESSION['user_id'])) {
    try {
      $title = $_POST['title'];
      $note = $_POST['note'];
      $_note_id = $_POST['noteID'];
      $query = 'UPDATE notes SET note_title=:title, note_content=:content WHERE id=:note_id AND user_id=:user_id';
      $stmt = $pdo->prepare($query);
      $stmt->bindParam(':title', $title, PDO::PARAM_STR);
      $stmt->bindParam(':content', $note, PDO::PARAM_STR);
      $stmt->bindParam(':note_id', $_note_id, PDO::PARAM_INT);
      $stmt->bindParam(':user_id', $user_id, PDO::PARAM_INT);
      $stmt->execute();
      header('Content-Type: application/json');
      echo json_encode('NOTE EDITED');
    } catch (PDOException $e) {
      echo 'Error: ' . $e->getMessage();
    }
  } else {
    header('Location:../index');
  }
} else {
  header('Content-Type: application/json');
  echo json_encode('NOTE erroooooooooor');
}
?>