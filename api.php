<?php 
function findEmails($image){
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
$arr = [];
$active = 'Active';
$stmt = $mysqli->prepare("SELECT * FROM emailList WHERE stat = ?");
$stmt->bind_param("s", $active);
$stmt->execute();
$result = $stmt->get_result();
while($row = $result->fetch_assoc()) {
    $arr[] = $row['emailID'];
}
$stmt->close();
if(!$arr) {
    exit('<br>NO Emails to send.');
}
else{
    foreach ($arr as $value) {
        emailMessage($value,'Random XKCD comics every five minutes.','Random XKCD comics every five minutes.','<h1>Random XKCD comics every five minutes.</h1>You can unsubscribe by clicking this <a href="https://php-xkcd.herokuapp.com/">LINK</a><br><br><img src="'.$image.'">',$image);
    }
}
}

// MAIL 
function emailMessage($to,$sub,$text,$html,$image) {
    $mailjetApiKey = getenv('APIKEY', true) ?: getenv('APIKEY');
    $mailjetApiSecret = getenv('APISECRET', true) ?: getenv('APISECRET');
    $base64ValImage = base64_encode(file_get_contents($image));
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
                'HTMLPart' => $html,
                'Attachments' => [
                    [
                        'ContentType' => "image/png",
                        'Filename' => "comic_image.png",
                        'Base64Content' => $base64ValImage
                    ]
                ]
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
 
// Web page URL 
$url = "https://c.xkcd.com/random/comic/";
 
// Extract HTML using curl 
$ch = curl_init(); 
curl_setopt($ch, CURLOPT_HEADER, 0); 
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1); 
curl_setopt($ch, CURLOPT_URL, $url); 
curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1); 
 
$data = curl_exec($ch); 
curl_close($ch); 
 
// Load HTML to DOM object 
$dom = new DOMDocument(); 
@$dom->loadHTML($data); 
 
 
// Parse DOM to get meta data 
$metas = $dom->getElementsByTagName('meta'); 
 
for($i=0; $i<$metas->length; $i++){ 
    $meta = $metas->item($i); 

    if($meta->getAttribute('property') == 'og:url'){ 
        $url = $meta->getAttribute('content'); 
    } 
} 

$newurl = $url.'info.0.json';
$ch = curl_init(); 
curl_setopt($ch, CURLOPT_HEADER, 0); 
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1); 
curl_setopt($ch, CURLOPT_URL, $newurl); 
curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1); 
 
$data = curl_exec($ch); 
$json = json_decode($data);
curl_close($ch); 
echo $json->img;

findEmails($json->img);
?>
