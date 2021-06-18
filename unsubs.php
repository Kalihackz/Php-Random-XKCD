<?php

$servername=getenv('SQLSERVER', true) ?: getenv('SQLSERVER');
$username=getenv('USERNAME', true) ?: getenv('USERNAME');
$password=getenv('PASSWORD', true) ?: getenv('PASSWORD');
$database=getenv('DATABASE', true) ?: getenv('DATABASE');

mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
try {
  $mysqli = new mysqli($servername,$username,$password,$database);
  $mysqli->set_charset("utf8mb4");
} catch(Exception $e) {
  exit('Error connecting to database'); 
}

if(empty(strip_tags($_POST['codeInp']))){
  $cookie_name = "FailedReason";
  $cookie_value = "Empty Code Parameter";
  setcookie($cookie_name, $cookie_value, time() + (5), "/"); // 86400 = 1 day
  header('Location: https://bolder-exclusive-stargazer.glitch.me/verify.php');
  exit;
}
if(empty(strip_tags($_POST['email']))){
  $cookie_name = "FailedReason";
  $cookie_value = "Empty Email Parameter";
  setcookie($cookie_name, $cookie_value, time() + (5), "/"); // 86400 = 1 day
  header('Location: https://bolder-exclusive-stargazer.glitch.me/verify.php');
  exit;
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/verify.css">
    <title>Unsubscription Page</title>
    <link rel="icon" href="https://imgs.xkcd.com/comics/api.png" type="image/icon type" />
</head>
<body>
<?php
if (empty($_COOKIE['code']))
{
  $cookie_name = "FailedReason";
  $cookie_value = "Empty Cookie Parameter";
  setcookie($cookie_name, $cookie_value, time() + (5), "/"); // 86400 = 1 day
  header('Location: https://bolder-exclusive-stargazer.glitch.me/verify.php');
  exit;
}
if ($_COOKIE['code'] === hash('sha256', strip_tags($_POST['codeInp'])))
{
    $arr = [];
    $stmt = $mysqli->prepare("SELECT * FROM emailList WHERE emailID = ?");
    $stmt->bind_param("s", strip_tags($_POST['email']));
    $stmt->execute();
    $result = $stmt->get_result();
    while($row = $result->fetch_assoc()) {
      $arr[] = $row;
    }
    if(!$arr)
    {
      ?>
      <div class="parent">
      <div class="emailDiv">
      <p name="codeInp" style="width:300px;text-align:center;margin-bottom:10px">You are not SUBSCRIBED.</p>
      </div>
      </div>
      <?php
      exit();
    } 
    
    $stmt = $mysqli->prepare("DELETE FROM emailList WHERE emailID = ?");
    $stmt->bind_param("s", strip_tags($_POST['email']));
    $stmt->execute();
    $stmt->close();
    ?>
    <div class="parent">
    <div class="emailDiv">
    <p name="codeInp" style="width:300px;text-align:center;margin-bottom:10px">You are UNSUBSCRIBED now.</p>
    </div>
    </div>
   <?php
    
}
else
{
  ?>
  <div class="parent">
  <div class="emailDiv">
  <p name="codeInp" style="width:300px;text-align:center;margin-bottom:10px">Your Code is Wrong.</p>
  </div>
  </div>
 <?php
}
?>
</body>
</html>
