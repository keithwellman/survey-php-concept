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

        width: 60%;
        float:left;
      }

       a:link {
        color: #C1DAD6;
      }


       a:visited {
         color: #C1DAD6;
      }


       a:hover {
         color: #C1DAD6;
       }

       a:active {
          color: #C1DAD6;
        }

      .top{width:100%;
        height:40;}

      .dialog {
        width: 50%;
        float:both;
      }


      body, html {
        height:100%;
        background: cover;
        background-image:url("backgroundd.jpg");
        background-attachment: fixed;
        background-repeat: no-repeat;
        background-color: #b1d2d2;

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
        width: 40%;
        background-color: #000066;
        color: #C1DAD6;
        padding: 15px 10px 15px 10px;
        -webkit-border-radius: 12px;
        -moz-border-radius: 20px;
        border-radius: 20px;
        opacity: 1;
      }

      #preview {
         padding: 15px 10px 15px 10px;
        width: 26%;
        float:both;
        -webkit-border-radius: 12px;
        -moz-border-radius: 20px;
        border-radius: 20px;
        color:#C1DAD6;
        background-color: #000066;
      }

        #head{

          background-color: #000066;
           color:#C1DAD6;
        }

        .head {
          background-color:#000066;
          color:#C1DAD6;
          size: 50px;
          opacity: .7;
        }

    </style>
  </head>
<body>


  <br>
  <div class="head" align="center" ;>
<h1>Survey King</h1>
</div>
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
            echo '
            <label for="question">Question: </label>
            <input type="text" name="question" value=""><br>
            ';
            break;

          case 'dropDown':
            echo '
            <label for="question">Question: </label>
            <input type="text" name="question" value=""><br>
            <input type="text" name="responseA" value="Option 1"><br>
            <input type="text" name="responseB" value="Option 2"><br>
            <input type="text" name="responseC" value="Option 3"><br>
            <input type="text" name="responseD" value="Option 4"><br>
            ';
            break;

          default:

            break;
        }
      }
    ?>
 <br>
    <br>
      <input type="submit" name="submit" value="Add to Survey" class="button">
    </form>

 </div>
  <?php
    // testing
    // print htmlspecialchars(print_r($_POST,true));
    // echo "<br><br><p>Session:</p><br>";
    // print htmlspecialchars(print_r($_SESSION,true));
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
            $question_type = $_SESSION['questionType'];
            $question = $_POST['questiona'];
            $questionNum = $_SESSION['questionNum'];

            $_SESSION["question$questionNum"] = Array("questionType" => "$question_type", "question" => "$question");
            $questionNum++;
            $_SESSION['questionNum'] = $questionNum;
            break;

          case 'text':
            $question_type = $_SESSION['questionType'];
            $question = $_POST['question'];
            $questionNum = $_SESSION['questionNum'];

            $_SESSION["question$questionNum"] = Array("questionType" => "$question_type", "question" => "$question");
            $questionNum++;
            $_SESSION['questionNum'] = $questionNum;
            break;

          case 'dropDown':
            $question_type = $_SESSION['questionType'];
            $question = $_POST['question'];
            $responseA = $_POST['responseA'];
            $responseB = $_POST['responseB'];
            $responseC = $_POST['responseC'];
            $responseD = $_POST['responseD'];
            $questionNum = $_SESSION['questionNum'];

            $_SESSION["question$questionNum"] = Array("questionType" => "$question_type", "question" => "$question",
            "responseA" => "$responseA",
            "responseB" => "$responseB",
            "responseC" => "$responseC",
            "responseD" => "$responseD");
            $questionNum++;
            $_SESSION['questionNum'] = $questionNum;
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

    <br>
    <center>
      <form class="" action="survey.php" method="post">
        <button type="submit" class="button" style="vertical-align:middle"><span>Create </span></button>
      </form>
        <br>
        <p>
          <?php
            if (isset($_GET['logout'])) {
            if($_GET['logout']==1) session_destroy();
            }
           ?>
           <a href="?logout=1">Start Over</a>

        </p>
    </center>


</div>

</body>
</html>
