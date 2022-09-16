<?php
require_once("Auth.php");

use core\Auth;

$api = (new Env())->_get_api();
if($_SERVER['REQUEST_METHOD'] != "POST" &&  $_SERVER['REQUEST_METHOD'] !='GET'){

    $api = (new Env())->_get_api();
    $response = [
        "meta" =>$api,
        "status"=> "BAD_REQUEST",
    ];

    echo json_encode($response);

    exit;
}



if(isset($_SERVER['Autorization'])){
        
    $token = trim($_SERVER['Authorization']);
}elseif($_SERVER['HTTP_AUTHORIZATION']){
    echo "HTTP_AUTHORIZATION";
    $token = trim($_SERVER['HTTP_AUTHORIZATION']);
}elseif(function_exists('apache_request_headers')){

    
    $headers = apache_request_headers();

    if($headers['Authorization']){
        $token = trim($headers['Authorization']);
    }

}



if(!isset($token))
{
    $response = [
        "meta" =>$api,
        "status"=> "TOKEN_NOT_FOUND",

    ];

    echo json_encode($response);

    exit;
}

if(!preg_match('/Bearer\s(\S+)/',$token, $matches))
{
    $response = [
        "meta" =>$api,
        "status"=> "TOKEN_NOT_FOUND",

    ];

    echo json_encode($response);

    exit;
}

$token = str_replace('Bearer ', '', $token);

if((new Auth($token))->_checkToken() == !1) {
   $response = [
        "meta" => $api,
        "status"=> "TOKEN_EXPIRE"
    ];

    print_r(json_encode($response
    ) ) ;

    exit;

}

$user = (new Auth($token))->_user();


if( $user !="public" && $user !="tidd" && $user !="city_hall"){
    $response = [
        "meta" => $api,
        "satus" => "403_FORBIDDEN"
    ];
    print_r(json_encode($response)) ;

    exit;

}

  


?>