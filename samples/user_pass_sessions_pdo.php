<?php

$db = new PDO('sqlite:phplogin.sqlite');
session_start();

require '../library/PHPLogin.php';
$phplogin = new PHPLogin();

if ($_POST['username']) {
	require 'UserPassPDOChecker.php';
	$phplogin->addChecker(new UserPassPDOChecker($db, $_POST, $fields = array('username', 'password'), $filters = array('password' => 'md5')));
} elseif (isset($_SESSION['phplogin_token'])) {
	require 'TokenSessionChecker.php';
	$phplogin->addChecker(new TokenSessionChecker($_SESSION, $fields = array('phplogin_token')));
}

$user = $phplogin->getUser();

print_r($user);
$_SESSION['phplogin_token'] = $phplogin->getToken();
print_r($_SESSION);

if (empty($user['type']) || $user['type'] === 'anonymous') {
	require 'loginform.html';
}
