<?php

include_once  '../service/authService.php';
include_once  '../classi/pwd.php';
include_once  '../generali/standard.php';


header('Content-type: application/json');
$request_body = file_get_contents('php://input');

$data = json_decode($request_body);

$pwd = new Pwd();
$pwd = Standard::encodeToMyClass($data, $pwd);
$authService = new AuthService();

$result = $authService ->doLogin($pwd);
echo $result;
?>