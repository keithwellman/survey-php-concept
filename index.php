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
        color: #ffff7f;
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

  <img class="logo" src="oo.png" alt="logo" style="width:300px;height:228px;">
  <br>
  <br>
<div class="container">
<!-- Left side survey question creator -->

  <div class="selectQuestion">
    <h3>Choose a question type:</h3>
    <form action="index.php" method="post">
      <input type="radio" name="questionType" value="multipleChoice">Multiple Choice
      <br>
      <input type="radio" name="questionType" value="bool">True/False
      <br>
      <input type="radio" name="questionType" value="text">Text
      <br>
      <input type="radio" name="questionType" value="dropDown">Drop Down
      <br>
      <br>
      <input type="submit" name="submit" value="Add Question" class="button">
    </form>
  </div>


  <div class="questionform">
   <form class="" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post">
    <?php
      $questionNum = 1;
      if ($_POST && ($_POST['submit'] == 'Add Question')) {
        //print htmlspecialchars(print_r($_POST,true));
        $questionType = $_POST["questionType"];
        $_SESSION['questionType'] = $questionType;
        $_SESSION["question$questionNum"] = array();
        switch ($questionType) {
          case 'multipleChoice':
            echo '
            <label for="question'.$questionNum.'">Question: </label>
            <input type="text" name="question'.$questionNum.'a" value=""><br>
            <input type="text" name="question'.$questionNum.'b" value=""><br>
            <input type="text" name="question'.$questionNum.'c" value=""><br>
            <input type="text" name="question'.$questionNum.'d" value=""><br>
            ';
            $questionNum++;

            break;

          case 'bool':
            echo '
            <label for="question'.$questionNum.'">Question: </label>
            <input type="text" name="question'.$questionNum.'a" value=""><br>
            ';
            $questionNum++;
            break;

          case 'text':
            echo "You chose text.";
            $questionNum++;
            break;

          case 'dropDown':
            echo "You chose dropDown.";
            $questionNum++;
            break;

          default:
            # code...
            break;
        }
      }
      elseif ($_POST && ($_POST['submit'] == 'Add to Survey') && (isset($_SESSION['question1'])) && ($_SESSION['questionType'] == 'multipleChoice')) {
        $keya = "question1a";
        $valuea = $_POST["question1a"];
        $keyb = "question1b";
        $valueb = $_POST["question1b"];
        $keyc = "question1c";
        $valuec = $_POST["question1c"];
        $keyd = "question1d";
        $valued = $_POST["question1d"];
        $_SESSION['question1'] = array("$keya" => "$valuea",
      "$keyb" => "$valueb", "$keyc" => "$valuec", "$keyd" => "$valued");
      }
      elseif ($_POST && ($_POST['submit'] == 'Add to Survey') && (isset($_SESSION['question2'])) && ($_SESSION['questionType'] == 'bool')) {
        $keya = "question2a";
        $valuea = $_POST["question2a"];
        $_SESSION['question2'] = array("$keya" => "$valuea");
      }
    ?>

      <input type="submit" name="submit" value="Add to Survey" class="button">
    </form>

  <?php
    // testing
    print htmlspecialchars(print_r($_POST,true));
    echo "<br><br><p>Session:</p><br>";
    print htmlspecialchars(print_r($_SESSION,true));
  ?>


  </div> <!-- end questionform -->
</div> <!-- end container -->



<!-- Right side survey preview -->
  <div class="container" id="preview">
    <br>

    <?php
      // if question is multiple choice display radio input with session data
      if ($_POST && ($_POST['submit'] == 'Add to Survey')) {
      if (isset($_SESSION['question1'])) {
        echo "<p>Question 1</p>";
        if ($_SESSION['questionType'] == 'multipleChoice') {
          echo $_SESSION['question1']['question1a'];
          echo "<br>";
          echo '
            <input type="radio" name="question1" value="'.$_SESSION['question1']['question1a'].'">'.$_SESSION['question1']['question1b'].'<br>
            <input type="radio" name="question1" value="'.$_SESSION['question1']['question1a'].'">'.$_SESSION['question1']['question1c'].'<br>
            <input type="radio" name="question1" value="'.$_SESSION['question1']['question1a'].'">'.$_SESSION['question1']['question1d'].
          '';
        }
        elseif ($_SESSION['questionType'] == 'bool') {
          echo $_SESSION['question1']['question2a'];
          echo "<br>";
          echo '
            <input type="radio" name="question2" value="true">True<br>
            <input type="radio" name="question2" value="false">False<br>
            ';
        }
      }
      elseif (isset($_SESSION['question2'])) {
        echo "<p>Question 2</p>";
        if ($_SESSION['questionType'] == 'multipleChoice') {
          echo $_SESSION['question2']['question2a'];
          echo "<br>";
          echo '
            <input type="radio" name="question2" value="'.$_SESSION['question2']['question2a'].'">'.$_SESSION['question2']['question2b'].'<br>
            <input type="radio" name="question2" value="'.$_SESSION['question2']['question2a'].'">'.$_SESSION['question2']['question2c'].'<br>
            <input type="radio" name="question2" value="'.$_SESSION['question2']['question2a'].'">'.$_SESSION['question2']['question2d'].'';
        }
        elseif ($_SESSION['questionType'] == 'bool') {
          echo $_SESSION['question2']['question2a'];
          echo "<br>";
          echo '
            <input type="radio" name="question2" value="true">True<br>
            <input type="radio" name="question2" value="false">False<br>
            ';
        }
      }
    }

     ?>

    <br>
    <center>
        <button class="button" style="vertical-align:middle"><span>Create </span></button>
        <br>
        <p>
          <!--<a href="#" onclick="<?php //session_destroy();?>">Destroy Session</a> -->
        </p>
    </center>
  </div>



</body>
</html>
