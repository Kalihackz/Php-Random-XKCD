<?php

function emailMessage($to,$sub,$text,$html) {
    $mailjetApiKey = getenv('APIKEY', true) ?: getenv('APIKEY');
    $mailjetApiSecret = getenv('APISECRET', true) ?: getenv('APISECRET');
    $adminEmail = getenv('ADMINEMAIL', true) ?: getenv('ADMINEMAIL');
  
    $messageData = [
        'Messages' => [
            [
                'From' => [
                    'Email' => $adminEmail,
                    'Name' => 'Admin'
                ],
                'To' => [
                    [
                        'Email' => $to,
                        'Name' => 'User'
                    ]
                ],
                'Subject' => $sub,
                'TextPart' => $text,
                'HTMLPart' => $html
            ]
        ]
    ]; 
    
    $jsonData = json_encode($messageData);
    $ch = curl_init('https://api.mailjet.com/v3.1/send');
    
    curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'POST');
    curl_setopt($ch, CURLOPT_POSTFIELDS, $jsonData);
    curl_setopt($ch, CURLOPT_USERPWD, "{$mailjetApiKey}:{$mailjetApiSecret}");
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_HTTPHEADER, [
        'Content-Type: application/json',
        'Content-Length: ' . strlen($jsonData)
    ]);
    
    $result = curl_exec($ch);
    if (curl_errno($ch)) {
        echo 'Error:' . curl_error($ch);
    }
    $response = json_decode($result);
}

if(empty(strip_tags($_POST['email']))){
    header('Location: https://php-xkcd.herokuapp.com/');
    exit;
}

if(empty(strip_tags($_POST['reqType']))){
    header('Location: https://php-xkcd.herokuapp.com/');
    exit;
}


$secCode = rand(10000,100000).'';

$cookie_name = "code";
$cookie_value = hash('sha256', $secCode);
setcookie($cookie_name, $cookie_value, time() + (86400 * 30), "/"); // 86400 = 1 day



emailMessage(strip_tags($_POST['email']),'Verification Email','Your Verification code is '.$secCode,'Your Verification code is <b>'.$secCode.'</b>')


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/verify.css">
    <title>Verification Code Page</title>
    <link rel="icon" href="https://imgs.xkcd.com/comics/api.png" type="image/icon type" />
</head>
<body>
<?php
if (strip_tags($_POST['reqType']) == 'sub')
{
?>

    <form action="result.php" method="POST">
    <div class="parent">
        <div class="emailDiv">
        <p name="codeInp" style="width:300px;text-align:center;margin-bottom:10px">Enter the code that has been mailed to <span style="color:blue"><?php echo  strip_tags($_POST['email']); ?></span></p>
        <input type="text" name="codeInp" id="codeInp" placeholder="Enter code here" style="width:300px;text-align:center" required>
        <input type="hidden" name="email" value="<?php echo strip_tags($_POST['email']); ?>">
        <button type="submit" style="width:50%;margin:20px auto">SUBMIT</button>
        </div>
    </div>
    </form>
<?php
}
else if (strip_tags($_POST['reqType']) == 'unsub')
{
?>
   <form action="unsubs.php" method="POST">
   <div class="parent">
        <div class="emailDiv">
        <p name="codeInp" style="width:300px;text-align:center;margin-bottom:10px">Enter the code that has been mailed to <span style="color:blue"><?php echo  strip_tags($_POST['email']); ?></span></p>
        <input type="text" name="codeInp" placeholder="Enter code here" style="width:300px;text-align:center" required>
        <input type="hidden" name="email" value="<?php echo strip_tags($_POST['email']); ?>">
        <button type="submit" style="width:50%;margin:20px auto">SUBMIT</button>
        </div>
    </div>
    </form>
<?php
}
else
{
    header('Location: https://php-xkcd.herokuapp.com/');
    exit;
}
?>
</body>
</html>
