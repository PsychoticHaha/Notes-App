<?php
require_once('pdo.php');
try {
  // Errors prevent and recording
  if (isset($_POST['pdo'])) {
    $query = 'SELECT * FROM notes';
    $stmt = $pdo->prepare($query);
    $stmt->execute();
    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
    $response = json_encode($result);
    header('Content-Type: application/json');
    echo $response;
  } else {
    $query = 'SELECT * FROM notes WHERE user_id=:id ORDER BY created_at';
    $stmt = $pdo->prepare($query);
    $stmt->bindParam(':id', $user_id, PDO::PARAM_INT);
    $stmt->execute();
    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
    //Sort sensitive data
    $sorted = array();
    foreach ($result as $row) {
      $filteredRow = array(
        "id" => $row["id"],
        "title" => $row["note_title"],
        "content" => $row["note_content"],
        "creation_date"=>$row['created_at'],
      );
      // Render final response
      $sorted[] = $filteredRow;
    }
    $response = json_encode($sorted);
    header('Content-Type: application/json');
    echo $response;
  }
  // Capture errors
} catch (PDOException $e) {
  echo 'Error: ' . $e->getMessage();
}
?>