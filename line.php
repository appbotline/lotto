<?

$message = $_POST['data'];
//$newMessage = explode(",", $message);
$sendMessage = $message[0] . "\r\n";
$sendMessage .= "สามตัว : " . $message[1] . "\r\n";
$sendMessage .= "สองตัว : " . $message[2];

echo $sendMessage;

$chOne = curl_init();
curl_setopt( $chOne, CURLOPT_URL, "https://notify-api.line.me/api/notify");
// SSL USE
curl_setopt( $chOne, CURLOPT_SSL_VERIFYHOST, 0);
curl_setopt( $chOne, CURLOPT_SSL_VERIFYPEER, 0);
//POST
curl_setopt( $chOne, CURLOPT_POST, 1);
// Message
//curl_setopt( $chOne, CURLOPT_POSTFIELDS, $sendMessage);
//ถ้าต้องการใส่รุป ให้ใส่ 2 parameter imageThumbnail และimageFullsize
curl_setopt( $chOne, CURLOPT_POSTFIELDS, "message=$sendMessage");
// follow redirects
curl_setopt( $chOne, CURLOPT_FOLLOWLOCATION, 1);
//ADD header array
$headers = array( 'Content-type: application/x-www-form-urlencoded', 'Authorization: Bearer VbNK3L1FYgMkEdg5gOczA0qUAWGr1N9KcHbLiiauNLw', );  // หลังคำว่า Bearer ใส่ line authen code ไป
curl_setopt($chOne, CURLOPT_HTTPHEADER, $headers);
//RETURN
curl_setopt( $chOne, CURLOPT_RETURNTRANSFER, 1);
$result = curl_exec( $chOne );
//Check error
if(curl_error($chOne)) { echo 'error:' . curl_error($chOne); }
else { $result_ = json_decode($result, true);
echo "status : ".$result_['status']; echo " message : ". $result_['message']; }
//Close connect
curl_close( $chOne );
header("Location: index.php?round=".$newMessage[0]."&res=".$result_['message']);
die();
?>
