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

  <img class="logo" src="oo.png" alt="logo">
  <br>
  <br>
<div class="container">
<!-- Left side survey question creator -->

  <div class="selectQuestion">
    <h3>Choose a question type:</h3>
    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post">
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

      // If the form has been submitted and the first question doesn't exist
      // then set the questionNum variable to 1

      if (isset($_SESSION['question1']) == false) {
        $questionNum = 1;
        $_SESSION['questionNum'] = 1;
      }
      // if ($_POST && ($_POST['submit'] == 'Add Question') && (isset($_SESSION['question1']) == false)) {
      //   $questionNum = 1;
      //   $_SESSION['questionNum'] = 1;
      // }

      // if the form has been submitted set the questionType variable to multipleChoice
      // bool, text, or dropDown. Copy the $_POST variables to $_SESSION to save the
      // data for the preview and final survey page.
      if ($_POST && ($_POST['submit'] == 'Add Question')) {
        // print htmlspecialchars(print_r($_POST,true));
        $questionType = $_POST["questionType"];
        $_SESSION['questionType'] = $questionType;
        //$_SESSION["question$questionNum"] = array();

        // Display a different form dependent on questionType chosen.
        switch ($questionType) {
          case 'multipleChoice':
            echo '
            <label for="question">Question: </label>
            <input type="text" name="question" value=""><br>
            <input type="text" name="responseA" value=""><br>
            <input type="text" name="responseB" value=""><br>
            <input type="text" name="responseC" value=""><br>
            ';

            break;

          case 'bool':
            echo '
            <label for="question">Question: </label>
            <input type="text" name="questiona" value=""><br>
            ';
            break;

          case 'text':
            echo "You chose text.";
            break;

          case 'dropDown':
            echo "You chose dropDown.";
            break;

          default:
            # code...
            break;
        }
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

      // First set $_SESSION keys to store the data from the submitted form.
      // Each question stored in an associative array
      // $_SESSION['question1'] = Array(questionType => multipleChoice,
      // question => this is the question, response1 => answer1,
      // response2 => answer2, response3 => answer3)
      // To display the form: loop through question array and display the form data

      if ($_POST && ($_POST['submit'] == 'Add to Survey')) {

        switch ($_SESSION['questionType']) {
          case 'multipleChoice':
            $question_type = $_SESSION['questionType'];
            $question = $_POST['question'];
            $responseA = $_POST['responseA'];
            $responseB = $_POST['responseB'];
            $responseC = $_POST['responseC'];
            $questionNum = $_SESSION['questionNum'];

            $_SESSION["question$questionNum"] = Array("questionType" => "$question_type", "question" => "$question",
            "responseA" => "$responseA",
            "responseB" => "$responseB",
            "responseC" => "$responseC");
            $questionNum++;
            $_SESSION['questionNum'] = $questionNum;
            break;

          case 'bool':
            $question = $_POST['question'];
            $_SESSION["question$questionNum"] = Array("questionType" => "$question_type", "question" => "$question");
            $questionNum++;
            break;

          case 'text':
            $question = $_POST['question'];
            $_SESSION["question$questionNum"] = Array("questionType" => "$question_type", "question" => "$question",
            "responseA" => "$responseA");
            $questionNum++;
            break;

          case 'dropDown':
            $question = $_POST['question'];
            $responseA = $_POST['responseA'];
            $responseB = $_POST['responseB'];
            $responseC = $_POST['responseC'];

            $_SESSION["question$questionNum"] = Array("questionType" => "$question_type", "question" => "$question",
            "responseA" => "$responseA",
            "responseB" => "$responseB",
            "responseC" => "$responseC");
            $questionNum++;
            break;

          default:
            # code...
            break;
        }

      }


      // if there's a first question...
      if (isset($_SESSION["question1"])) {
        // display each question that exists
        $questionNum = $_SESSION['questionNum'];
        for ($i=1; $i < $questionNum; $i++) {
          $q_type = $_SESSION["question$i"]['questionType'];
          switch ($q_type) {
            case 'multipleChoice':
              echo "<p>Question $i</p>";
              echo "<br>";
              echo $_SESSION["question$i"]['question'];
              echo '
                <input type="radio" name="question'.$i.'" value="'.$_SESSION["question$i"]['responseA'].'">'.$_SESSION["question$i"]['responseA'].'<br>
                <input type="radio" name="question'.$i.'" value="'.$_SESSION["question$i"]['responseB'].'">'.$_SESSION["question$i"]['responseB'].'<br>
                <input type="radio" name="question'.$i.'" value="'.$_SESSION["question$i"]['responseC'].'">'.$_SESSION["question$i"]['responseC'].
              '';
              break;
            case 'bool':
              # code...
              break;
            case 'text':
              # code...
              break;
            case 'dropDown':
              # code...
              break;

            default:
              # code...
              break;
          }

        }

      }
      // if question is multiple choice display radio input with session data
    //   if ($_POST && ($_POST['submit'] == 'Add to Survey')) {
    //   if (isset($_SESSION['question1'])) {
    //     echo "<p>Question 1</p>";
    //     if ($_SESSION['questionType'] == 'multipleChoice') {
    //       echo $_SESSION['question1']['question1a'];
    //       echo "<br>";
    //       echo '
    //         <input type="radio" name="question1" value="'.$_SESSION['question1']['question1a'].'">'.$_SESSION['question1']['question1b'].'<br>
    //         <input type="radio" name="question1" value="'.$_SESSION['question1']['question1a'].'">'.$_SESSION['question1']['question1c'].'<br>
    //         <input type="radio" name="question1" value="'.$_SESSION['question1']['question1a'].'">'.$_SESSION['question1']['question1d'].
    //       '';
    //     }
    //     elseif ($_SESSION['questionType'] == 'bool') {
    //       echo $_SESSION['question1']['question2a'];
    //       echo "<br>";
    //       echo '
    //         <input type="radio" name="question2" value="true">True<br>
    //         <input type="radio" name="question2" value="false">False<br>
    //         ';
    //     }
    //   }
    //   elseif (isset($_SESSION['question2'])) {
    //     echo "<p>Question 2</p>";
    //     if ($_SESSION['questionType'] == 'multipleChoice') {
    //       echo $_SESSION['question2']['question2a'];
    //       echo "<br>";
    //       echo '
    //         <input type="radio" name="question2" value="'.$_SESSION['question2']['question2a'].'">'.$_SESSION['question2']['question2b'].'<br>
    //         <input type="radio" name="question2" value="'.$_SESSION['question2']['question2a'].'">'.$_SESSION['question2']['question2c'].'<br>
    //         <input type="radio" name="question2" value="'.$_SESSION['question2']['question2a'].'">'.$_SESSION['question2']['question2d'].'';
    //     }
    //     elseif ($_SESSION['questionType'] == 'bool') {
    //       echo $_SESSION['question2']['question2a'];
    //       echo "<br>";
    //       echo '
    //         <input type="radio" name="question2" value="true">True<br>
    //         <input type="radio" name="question2" value="false">False<br>
    //         ';
    //     }
    //   }
    // }

     ?>

    <br>
    <center>
        <button class="button" style="vertical-align:middle"><span>Create </span></button>
        <br>
        <p>
          <?php
            if (isset($_GET['logout'])) {
            if($_GET['logout']==1) session_destroy();
            }
           ?>
           <a href="?logout=1">Destroy Session</a>
        </p>
    </center>
  </div>



</body>
</html>
