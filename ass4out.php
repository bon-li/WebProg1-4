<?php
  /*
      Name: Bonita
      File name: ass4out.php
      Course code: SYST10199
      Date file was created: April 9, 2022
  */

  require("connect.php");
  $output="";
  $errors="";

  try{
    $dbConn = new
    PDO("mysql:host=$hostname;dbname=$dbname", $username, $password);
    $sql = "SELECT * FROM contacts ORDER BY last_name";
    $statement = $dbConn -> prepare($sql);
    $execOk = $statement -> execute();
    if($execOk){
      while($row = $statement -> fetch()){
        $email = $row['email_address'];
        $fname = $row['first_name'];
        $lname = $row['last_name'];
        $phone = $row['phone_number'];
        $created_on = $row['created_on'];
        $output.="<tr><td>$email</td><td>$fname</td><td>$lname</td><td>$phone</td><td>$created_on</td></tr>";
      }
    }
  } catch (PDOException $e){
    $errors.= 'Connection error: ' . $e->geMessage();
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
        <h1>View Contacts Table: </h1>
        <h2><?=$errors;?></h2>
        <table border="1px">
          <tr>
            <th>Email Address</th>
            <th>First Name</th>
            <th>Last Name</th>
            <th>Phone Number</th>
            <th>Created On</th>
          </tr>
          <?=$output;?>
        </table>
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