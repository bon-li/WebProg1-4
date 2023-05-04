<?php
  /*
      Name: Bonita
      File name: ass4in.php
      Course code: SYST10199
      Date file was created: April 9, 2022
  */

  require("connect.php");
  $errors="";
  $email="";
  $fname="";
  $lname="";
  $phone="";

  define("PHONE_LENGTH", 13);
  define("MAX_FIRST_NAME_LENGTH", 20);
  define("MAX_LAST_NAME_LENGTH", 30);
  define("MAXIMUM_EMAIL_LENGTH", 255);


  if($_SERVER['REQUEST_METHOD']=="POST"){
    $email = $_POST['input_email'];
    $fname = $_POST['input_fname'];
    $lname = $_POST['input_lname'];
    $phone = $_POST['input_phone'];
    
    try { 
      $dbConn = new PDO("mysql:host=$hostname;dbname=$dbname", $username, $password); 

      if(!isset($email) || trim($email) == ""){
        $errors.="Email field is empty.<br>";
      }elseif(!(filter_var($email, FILTER_VALIDATE_EMAIL))){
        $errors.="Email is invalid.<br>";
        $email="";
      }elseif(strlen($email) > MAXIMUM_EMAIL_LENGTH){
        $errors.="Email is too long.<br>";
        $email="";
      }
      $emailCheck = "SELECT email_address FROM contacts";
      $result = $dbConn->query($emailCheck);
      $result->execute(array(':email_address'=> $email));
      while($row = $result->fetch()){
        if($email == $row['email_address']){
          $errors.= "Email already exists.<br>";
          $email="";
        }
      }
  
      if(!isset($fname) ||trim($fname) == ""){
        $errors.="First name field is empty.<br>";
      }elseif(strlen($fname) > MAX_FIRST_NAME_LENGTH){
        $errors.="First name is too long.<br>";
        $fname="";
      }
  
      if(!isset($lname) || trim($lname) == ""){
        $errors.="Last name field is empty.<br>";
      }elseif(strlen($lname) > MAX_LAST_NAME_LENGTH){
        $errors.="last name is too long.<br>";
        $lname="";
      }
  
      if(!isset($phone) || trim($phone) == ""){
        $errors.="Phone number field is empty.<br>";
      }else if(strlen($phone) != PHONE_LENGTH){
        $errors.="Phone number has to be 13 characters.<br>";
        $phone="";
      }

      //$dbConn = new PDO("mysql:host=$hostname;dbname=$dbname", $username, $password); 

      if($errors==""){
        $sql = "INSERT INTO contacts (email_address, first_name, last_name, phone_number) VALUES(?,?,?,?)"; 
        $statement = $dbConn -> prepare($sql);
        $paramArray = array($email,$fname,$lname,$phone);
        $execOk = $statement -> execute($paramArray);
        if($execOk){
            header('Location: ass4out.php');
        }
      } else {
            $errors.="There is an issue in the insert statement.";
        }
  
    }catch (PDOException $e) { 
      $errors.= 'Connection error: ' . $e->getMessage(); 
    }
  }
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <title>Menu</title>
  <link rel="stylesheet" href="./css/vertical-menue.css">
</head>
<body>
  <header>
    <h1>Sys10199: Assignment 4 - Contacts</h1>
  </header>
  <div class="container">
    <nav>
      <ul>
        <li><a href="ass4out.php">View Contacts</a></li>
        <li><a href="ass4in.php">Add Contacts</a></li>
      </ul>
    </nav>
    <section class="main">
      <article>
        <h1>Add Contacts - Enter the following data: </h1>
        <h2><?=$errors?></h2>
        <form action="<?=$_SERVER['PHP_SELF']?>" method="POST">
          <div>
            <label for="">Email Address: </label>
            <input type="text" name="input_email" value="<?=$email?>">
          </div>
          <div>
            <label for="">First Name: </label>
            <input type="text" name="input_fname" value="<?=$fname?>">
          </div>
          <div>
            <label for="">Last Name: </label>
            <input type="text" name="input_lname" value="<?=$lname?>">
          </div>
          <div>
            <label for="">Phone Number: </label>
            <input type="text" name="input_phone" value="<?=$phone?>">
          </div>
          <div>
            <input type="submit" value="Add">
            <input type="reset" value="Clear">
          </div>
        </form>
      </article>
      <article>
      </article>
    </section><!-- main  -->
  </div><!--  container -->
  <footer>
    <section>
      <!-- for download -->
      <br>
      <p>&copy; Alzghool 2022</p>
    </section>
  </footer>
</body>
</html>