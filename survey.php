<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="author" content="Survey">
    <meta name="description" content="Survey">
    <title>Survey</title>
  </head>
<body>
  <?php
  print htmlspecialchars(print_r($_POST,true));
   ?>
   <form>
     <input type="radio" name="multi" value="<?php
      echo $_POST['question1b'];
      ?>"><?php
       echo $_POST['question1b'];
       ?>
     <br>
     <input type="radio" name="multi" value="<?php
      echo $_POST['question1c'];
      ?>"><?php
       echo $_POST['question1c'];
       ?>
     <br>
     <input type="radio" name="multi" value="<?php
      echo $_POST['question1d'];
      ?>"><?php
       echo $_POST['question1d'];
       ?>
     <br>
     <br>
     <input type="submit" name="submit2" value="Submit" class="button">
   </form>


</body>
</html>
