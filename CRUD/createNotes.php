<?php
// CREATE NOTES
require_once('../pdo.php');
if (isset($_POST['title']) && !empty($_POST['note']) && isset($_POST['save'])) {
  if (!empty($_SESSION['user_id'])) {
    try {
      $title = $_POST['title'];
      $note = $_POST['note'];
      $query = 'INSERT INTO notes(note_title,note_content,user_id, created_at) VALUES(:title, :content, :user_id, CURRENT_TIMESTAMP)';
      $stmt = $pdo->prepare($query);
      $stmt->bindParam(':title', $title, PDO::PARAM_STR);
      $stmt->bindParam(':content', $note, PDO::PARAM_STR);
      $stmt->bindParam(':user_id', $user_id, PDO::PARAM_INT);
      $stmt->execute();
      header('Content-Type: application/json');
      echo json_encode('NOTE SAVED');
    } catch (PDOException $e) {
      echo 'Error: ' . $e->getMessage();
    }
  } else {
    header('Location:../index');
  }
}
?>