<?php include_once $_SERVER['DOCUMENT_ROOT'] .
    '/radiorain/includes/helpers.inc.php'; ?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <title>PHP/MySQL File Repository</title>
  </head>
  <body>
    <h1>PHP/MySQL File Repository</h1>

    <form action="" method="post" enctype="multipart/form-data">
      <div>
        <label for="upload">Upload File:
        <input type="file" id="upload" name="upload"></label>
      </div>
      <div>
        <label for="desc">File Description:
        <input type="text" id="desc" name="desc"
            maxlength="255"></label>
      </div>
      <div>
        <input type="hidden" name="action" value="upload">
        <input type="submit" value="Upload">
      </div>
    </form>

  </body>
</html>
