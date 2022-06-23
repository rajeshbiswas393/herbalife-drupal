<?php
ini_set('display_errors', 1); ini_set('display_startup_errors', 1); error_reporting(E_ALL);
if(!session_id()){
    session_start();
}
echo 'HI';
// Include the autoloader provided in the SDK
require_once ('./php-graph/src/Facebook/autoload.php');

// Include required libraries
use Facebook\Facebook;
use Facebook\Exceptions\FacebookResponseException;
use Facebook\Exceptions\FacebookSDKException;
echo '-->HI1';
/*
 * Configuration and setup Facebook SDK
 */
$appId         = '537262567877239'; //Facebook App ID
$appSecret     = '5b08d621975b66932f1c36e56a409563'; //Facebook App Secret
$redirectURL   = 'http://localhost/post_to_facebook_from_website/'; //Callback URL
$fbPermissions = array('publish_actions'); //Facebook permission

$fb = new Facebook(array(
    'app_id' => $appId,
    'app_secret' => $appSecret,
    'default_graph_version' => 'v2.6',
));

// Get redirect login helper
$helper = $fb->getRedirectLoginHelper();

// Try to get access token
try {
    if(isset($_SESSION['facebook_access_token'])){
        $accessToken = $_SESSION['facebook_access_token'];
    }else{
        $accessToken = $helper->getAccessToken();
    }
  
} catch(FacebookResponseException $e) {
     echo 'Graph returned an error: ' . $e->getMessage();
      exit;
} catch(FacebookSDKException $e) {
    echo 'Facebook SDK returned an error: ' . $e->getMessage();
      exit;
}
echo '-->HI12';
echo $accessToken;
?>