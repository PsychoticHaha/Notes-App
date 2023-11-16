<?php
session_start();
if(isset($_POST['note_id']) && !empty($_POST['note_id'])){
  $_SESSION['note_id'] = $_POST['note_id'];
  echo json_encode('ok id');
} else {
  $_SESSION['note_id'] = 'null';
  echo json_encode('No id');
}
?>