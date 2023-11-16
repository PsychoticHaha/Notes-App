<?php
require_once('CRUD/pdo.php');
?>
<!DOCTYPE html>
<html lang="en">

  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="stylesheets/login.css">
    <link rel="stylesheet" href="stylesheets/common.css">
  </head>

  <body>
    <?php
    // Check if it threw an error during login
    if ($_SESSION['logged'] == 'error') {
      echo '<div class="error tips">Please, try to connect again ...</div>';
      $_SESSION['logged'] = 'null';
    } 
    if ($_SESSION['register'] == 'success') {
      echo '<div class="success tips">Register successful ! Login now</div>';
      $_SESSION['register'] = "null";
    } else {
      $_SESSION['register'] = "null";
    }
    // Login authentification
    try {
      if (!empty($_POST['email']) && !empty($_POST['password']) && isset($_POST['connect'])) {
        $email = $_POST['email'];
        $userPassword = $_POST['password'];
        $query = ('SELECT * FROM users WHERE email=:email');
        $stmt = $pdo->prepare($query);
        $stmt->bindParam(':email', $email);
        $stmt->execute();
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        foreach ($result as $values) {
          $hash = $values['password'];
          $_SESSION['user_id'] = $values['id'];
        }
        if (password_verify($userPassword, $hash)) {
          $_SESSION['logged'] = 'true';
          header('Location:home.php');
        } else {
          $_SESSION['logged'] = 'error';
        }
      } else {
        $_SESSION['logged'] = 'false';
      }
    } catch (PDOException $e) {
      echo 'Error: ' . $e->getMessage();
      echo 'Misy erreur any am connexion database (pdo.php)';
    }
    ?>
    <div class="box-page">
      <div class="container">
        <div class="login">
          <h2>Login</h2>
          <form action="" method="POST">
            <label for="email">Email</label>
            <input type="email" name="email" id="email" placeholder="Your email...">
            <label for="password">Password</label>
            <div class="show-password">
              <input type="password" name="password" id="password" placeholder="Password...">
              <span class="show-password">
                <svg class="svg" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 576 512">
                  <path
                    d="M572.52 241.4C518.29 135.59 410.93 64 288 64S57.68 135.64 3.48 241.41a32.35 32.35 0 0 0 0 29.19C57.71 376.41 165.07 448 288 448s230.32-71.64 284.52-177.41a32.35 32.35 0 0 0 0-29.19zM288 400a144 144 0 1 1 144-144 143.93 143.93 0 0 1-144 144zm0-240a95.31 95.31 0 0 0-25.31 3.79 47.85 47.85 0 0 1-66.9 66.9A95.78 95.78 0 1 0 288 160z" />
                </svg>
              </span>
            </div>
            <input type="submit" name="connect" id="submit" value="Login">
          </form>
        </div>
        <div class="new-user">
          <a href="register">Don't have account yet ?
            <span class="underline">Register here.</span>
          </a>
        </div>
      </div>
    </div>
    <script src="script.js" defer></script>
  </body>

</html>