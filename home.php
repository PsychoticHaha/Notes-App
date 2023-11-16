<?php
session_start();
if ($_SESSION['logged'] == 'true') {
  echo '<div class="success tips">You are now connected</div>';
} else {
  $_SESSION['logged'] = 'error';
  header('Location:./index');
}
?>
<!DOCTYPE html>
<html lang="en">

  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="stylesheets/login.css">
    <link rel="stylesheet" href="stylesheets/notes.css">
    <title>Home</title>
  </head>

  <body>
    <?php
    if (isset($_POST['logout'])) {
      $_SESSION['logged'] = 'false';
      header('Location:./index');
    }
    ?>
    <div class="confirm-modal">
      <div class="modal">
        <div class="title">
          Do you really want to delete this note ?
        </div>
        <div class="buttons">
          <div class="yes success">YES</div>
          <div class="no error">NO</div>
        </div>
      </div>
    </div>
    <div class="mobile-header">
      <div class="your-notes">
        <svg class="header-svg" xmlns="http://www.w3.org/2000/svg" fill="#fff" viewBox="0 0 384 512">
          <path
            d="M336 64H282.121C268.896 26.799 233.738 0 192 0S115.104 26.799 101.879 64H48C21.5 64 0 85.484 0 112V464C0 490.516 21.5 512 48 512H336C362.5 512 384 490.516 384 464V112C384 85.484 362.5 64 336 64ZM96 392C82.75 392 72 381.25 72 368S82.75 344 96 344S120 354.75 120 368S109.25 392 96 392ZM96 296C82.75 296 72 285.25 72 272S82.75 248 96 248S120 258.75 120 272S109.25 296 96 296ZM192 64C209.674 64 224 78.326 224 96C224 113.672 209.674 128 192 128S160 113.672 160 96C160 78.326 174.326 64 192 64ZM304 384H176C167.199 384 160 376.799 160 368C160 359.199 167.199 352 176 352H304C312.801 352 320 359.199 320 368C320 376.799 312.801 384 304 384ZM304 288H176C167.199 288 160 280.799 160 272C160 263.199 167.199 256 176 256H304C312.801 256 320 263.199 320 272C320 280.799 312.801 288 304 288Z" />
        </svg>
        <span class="text"> Your notes</span>
      </div>
    </div>
    <div class="box-homepage">
      <form action="" method="post">
        <input type="submit" name="logout" id='logout' value="Logout">
      </form>
      <div class="container note">
        <form action="" method="">
          <label for="note-title">Title</label>
          <input type="text" name="title" id="note-title" placeholder="Your note title">
          <label for="note-body">Note</label>
          <textarea id="note-body" name="note" placeholder="Your note body"></textarea>
          <div class="buttons">
            <input type="submit" id="save" name="save" value="Save">
            <input type="submit" id="saveChange" name="saveChange" value="Save Changes" style="display:none">
            <input type="button" id="cancel" value="Cancel">
          </div>
        </form>
      </div>
      <div class="content">
        <div class="heading">
          <h3>Your NOTELIST</h3>
        </div>
        <div class="" id="any-note">
          <h3>You have any note yet !</h3>
        </div>
        <div class="body">
          <div class="singlenote">
            <div class="title">
              <p>Note 1</p>
              <p>Creation date : 2023-23-23</p>
            </div>
            <div class="note-content">
              <p>This is an example of note</p>
            </div>
            <div class="btns">
              <a class="edit" href="">
                <svg width="24" height="24" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" fill="none"
                  stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                  <path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7" />
                  <path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z" />
                </svg>
                Edit
              </a>
              <a class="delete" href="">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24">
                  <path d="M6 19c0 1.1.9 2 2 2h8c1.1 0 2-.9 2-2V7H6v12zM19 4h-3.5l-1-1h-5l-1 1H5v2h14V4z" />
                </svg>
                Delete
              </a>
            </div>
          </div>
          <div class="singlenote">
            <div class="title">
              <p>Note 2</p>
            </div>
            <div class="note-content">
              <p>This is an example of note</p>
            </div>
            <div class="btns">
              <a class="edit" href="">
                <svg width="24" height="24" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" fill="none"
                  stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                  <path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7" />
                  <path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z" />
                </svg>
                Edit
              </a>
              <a class="delete" href="">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24">
                  <path d="M6 19c0 1.1.9 2 2 2h8c1.1 0 2-.9 2-2V7H6v12zM19 4h-3.5l-1-1h-5l-1 1H5v2h14V4z" />
                </svg>
                Delete
              </a>
            </div>
          </div>

          <div class="singlenote">
            <div class="title">
              <p>Note 3</p>
            </div>
            <div class="note-content">
              <p>This is an example of note</p>
            </div>
            <div class="btns">
              <a class="edit" href="">
                <svg width="24" height="24" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" fill="none"
                  stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                  <path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7" />
                  <path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z" />
                </svg>
                Edit
              </a>
              <a class="delete" href="">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24">
                  <path d="M6 19c0 1.1.9 2 2 2h8c1.1 0 2-.9 2-2V7H6v12zM19 4h-3.5l-1-1h-5l-1 1H5v2h14V4z" />
                </svg>
                Delete
              </a>
            </div>
          </div>
          <div class="singlenote" style="height:400vh">

          </div>
        </div>
      </div>
    </div>
    <script src="script.js" defer></script>
    <script src="note.js" defer></script>
  </body>

</html>