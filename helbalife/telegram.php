<?php
function suspendido($chat_id, $url, $foo) 
{
  $TOKEN = "5400859388:AAEslKxlcmOyijoHojfOv7ZLdImg_dfat_I";
  $TELEGRAM = "https://api.telegram.org:443/bot$TOKEN"; 
  $url = "https://zrabogados-pruebas.xyz/bot/404.png";
  $query = http_build_query(array(
    'chat_id'=> $chat_id,
    'photo'=> $url,
    'text'=> $foo,
    'parse_mode'=> 'HTML' // Optional: Markdown | HTML
  ));
  
  # Use sendPhoto here, Not sendMessage
  $response = file_get_contents("$TELEGRAM/sendPhoto?$query");
  return $response;
}
?>


<?php
    $imageURL = "https://zrabogados-pruebas.xyz/bot/404.png";
	$textMsg = "This is a text message";
	$chatId = 5514641323;
	echo suspendido($chatId,$imageURL,$textMsg);
?>
<a target="_blank" class="telegram-btn"
    href='http://t.me/herbalife_tcs_botshare/url?url=<?php echo $imageURL; ?>'>
 Share
</a>
