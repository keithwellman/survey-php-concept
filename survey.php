<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="author" content="Survey King">
    <meta name="description" content="Survey King">
    <title>Survey King</title>
    <style>
      body {
        align-content: center;
        color: black;
        background-color: #f4511e;
      }
      
      .preview {
        padding: 15px 10px 15px 10px;
        width: 26%;
        margin: auto;
        -webkit-border-radius: 12px;
        -moz-border-radius: 20px; 
        border-radius: 20px;
        color:#C1DAD6;
        background-color: #000066;
      }
    </style>
  </head>
<body>
<div class="preview">
<?php
// if there's a first question...
if (isset($_SESSION["question1"])) {
  // display each question that exists
  $questionNum = $_SESSION['questionNum'];
  for ($i=1; $i < $questionNum; $i++) {
    $q_type = $_SESSION["question$i"]['questionType'];
    switch ($q_type) {
      case 'multipleChoice':
        echo "<p><b>Question $i</b></p>";
        echo "<br>";
        echo $_SESSION["question$i"]['question'];
        echo "<br>";
        echo '
          <input type="radio" name="question'.$i.'" value="'.$_SESSION["question$i"]['responseA'].'">'.$_SESSION["question$i"]['responseA'].'<br>
          <input type="radio" name="question'.$i.'" value="'.$_SESSION["question$i"]['responseB'].'">'.$_SESSION["question$i"]['responseB'].'<br>
          <input type="radio" name="question'.$i.'" value="'.$_SESSION["question$i"]['responseC'].'">'.$_SESSION["question$i"]['responseC'].
        '';
        break;
      case 'bool':
        echo "<p><b>Question $i</b></p>";
        echo "<br>";
        echo $_SESSION["question$i"]['question'];
        echo "<br>";
        echo '
          <input type="radio" name="bool" value="true">True
          <input type="radio" name="bool" value="false">False
          ';
        break;
      case 'text':
        echo "<p><b>Question $i</b></p>";
        echo "<br>";
        echo $_SESSION["question$i"]['question'];
        echo "<br>";
        echo '
          <textarea name="text" rows="8" cols="40"></textarea>
          ';
        break;
      case 'dropDown':
        echo "<p><b>Question $i</b></p>";
        echo "<br>";
        echo $_SESSION["question$i"]['question'];
        echo "<br>";
        echo '
          <select>
            <option value="'.$_SESSION["question$i"]['responseA'].'">'.$_SESSION["question$i"]['responseA'].'</option>
            <option value="'.$_SESSION["question$i"]['responseB'].'">'.$_SESSION["question$i"]['responseB'].'</option>
            <option value="'.$_SESSION["question$i"]['responseC'].'">'.$_SESSION["question$i"]['responseC'].'</option>
            <option value="'.$_SESSION["question$i"]['responseD'].'">'.$_SESSION["question$i"]['responseD'].'</option>
          </select>
          ';
        break;
      default:
        # code...
        break;
    }
  }
}
?>
</div>

</body>
</html>