<?php

require_once $_SERVER['DOCUMENT_ROOT'] . "/vendor/autoload.php";

use App\DB\DB;
use App\Repositories\ListRepository;
use App\TaskList;
use App\Repositories\UsersRepository;
use App\User;
use App\App;

session_start();

$config_path = $_SERVER['DOCUMENT_ROOT'] . "/config.php";
App::bind('config', require $config_path);
$db = new DB(App::get('config')['database']);
$UsersRep = new UsersRepository($db->getInstance(App::get('config')['database']));

$loginButton = ' ' ;

$googleClient = new Google_Client();
$googleClient->setClientId('54513481697-e144b30aqavgpfgsu9lfborscdr5jq6b.apps.googleusercontent.com');
$googleClient->setClientSecret('Ke-B1QRrEmIe1-26KlMFN1jH');
$googleClient->setRedirectUri('http://php-docker.com:9070/App/Actions/google-login.php');
$googleClient->addScope('email');
$googleClient->addScope('profile');

session_start();
if(isset($_GET["code"])) {
    $token = $googleClient->fetchAccessTokenWithAuthCode($_GET["code"]);
    $googleClient->setAccessToken($token['access_token']);
    $_SESSION['access_token'] = $token['access_token'];
    $googleService = new Google_Service_Oauth2($googleClient);
    $data = $googleService->userinfo->get();
    if (!empty($data['name'])) {
        $_SESSION['user_login'] = $data['name'];
    }
    if($UsersRep->find($_SESSION['user_login'], '')) {
        $UserInfo = [
            'login' => $_SESSION['user_login'],
            'password' => ''
        ];
        $CurrentUser = new User($UserInfo);
        header("Location: http://php-docker.com:9070/?action=enter-user");
    }else{
        $UserInfo = [
            'login' => $_SESSION['user_login'],
            'password' => ''
        ];
        $UsersRep->create($UserInfo);
        $CurrentUser = new User($UserInfo);
        header("Location: http://php-docker.com:9070/?action=enter-user");

    }
    exit();
}

if (!isset($_SESSION['access_token'])) {
    $loginButton = '<a href = "' . $googleClient->createAuthUrl() .
        ' "><img src="../../partials/imgs/sign-in-with-google.png"></a>';
}

