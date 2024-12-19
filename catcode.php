<?php
  session_start();
  $con = mysqli_connect("localhost","root","","questania");
  if(!$con){
      die('Connection Failed'. mysqli_connect_error());
  }

  
  if(isset($_POST['delete_student'])) {
      $student_id = mysqli_real_escape_string($con, $_POST['delete_student']);
  
      // Delete the category and its related questions
      $query = "DELETE categories, questions FROM questions_cat LEFT JOIN user_questions ON categories.cat_id = questions.cat_id WHERE categories.cat_id='$student_id'";
      $query_run = mysqli_query($con, $query);
  
      if($query_run) {
          $_SESSION['message'] = "Category and related questions deleted successfully";
          header("Location: cat.php");
          exit(0);
      } else {
          $_SESSION['message'] = "Category and related questions not deleted";
          header("Location: cat.php");
          exit(0);
      }
  }

  




if(isset($_POST['save_student']))
{
    $name = mysqli_real_escape_string($con, $_POST['name']);
    

    $query = "INSERT INTO questions_cat (cat) VALUES ('$name')";

    $query_run = mysqli_query($con, $query);
    if($query_run)
    {
        $_SESSION['message'] = "Category Created Successfully";
        header("Location: cat.php");
        exit(0);
    }
    else
    {
        $_SESSION['message'] = "Category Not Created";
        header("Location: cat.php");
        exit(0);
    }
}

?>