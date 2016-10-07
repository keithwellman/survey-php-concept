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
      .container {
        min-height: 100%;
        width: 70%;
        background-color: #666666;
        float:left;
      }

      .dialog {
        width: 50%;
        background-color: white;
        float:both;
      }

      body {
        color: black;
      }

      .button {
        display: inline-block;
        border-radius: 20px;
        background-color: #f4511e;
        border: none;
        color: #FFFFFF;
        text-align: center;
        font-size: 20px;
        padding: 7px;
        width: 150px;
        transition: all 0.5s;
        cursor: pointer;
        margin: 5px;
      }

      .button span {
        cursor: pointer;
        display: inline-block;
        position: relative;
        transition: 0.5s;
      }

      .button span:after {
        content: ":)";
        position: absolute;
        opacity: 0;
        top: 0;
        right: -20px;
        transition: 0.5s;
      }

      .button:hover span {
        padding-right: 25px;
      }

      .button:hover span:after {
        opacity: 1;
        right: 0;
      }

      .questionform {
        width: 400px;
        margin: auto;
      }

      .selectQuestion {
        margin: auto;
        width: 28%;
        background-color: #ffff7f;
        color: black;
        padding: 0 10px 0 10px;
      }

      .logo {
        width: 300px;
        height: 228px;
      }

      #preview {
        padding: 10px;
        color: black;
        width: 28%;
        background-color: #ffff7f;
        float:right;
      }
    </style>
  </head>
<body>

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

</body>
</html>
