<?php
require_once('../vendor/autoload.php');
require_once('../Env.php');
use Firebase\JWT\JWT;
use Firebase\JWT\Key;
require_once("../core/autoloader.php");
use core\Auth;
/*echo  (new Env())->_getTokenKey();
$jwt =  JWT::decode( 'eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpc3MiOiJsb2NhbGhvc3QiLCJhdWQiOiJsb2NhbGhvc3QiLCJpYXQiOjE2NjMyNjE1MDEsImV4cCI6MTY2NDcwMTUwMSwiZGF0YSI6eyJ1c2VyIjoicHVibGljIiwiZGF0YSI6eyJfaWQiOiIzIiwiX3V1aWQiOiI4ZjVhOTViYy1jODk1LTQxMDgtYTU2YS0xNjA1N2MyNzI0OTQiLCJfbGFzdF9uYW1lIjoiUkVQT1JURVIiLCJfZmlyc3RfbmFtZSI6IlJlcG9ydGVyIiwiX2NpdHkiOiJBREtQX0wiLCJfZW1haWwiOiJyZXBvcnRlckBnbWFpbC5jb20iLCJfcHNldWRvIjoicmVwb3J0QCIsIl9wYXNzd29yZCI6IiQyeSQxMiRvdk1WZ3hELmRHUzFIcE9lZElmNnQuRGpzb2dXZDBud0NDbVpwdm9OTGJYeFdsekdFRlk3SyIsIl9pbnNlcnRlZF9hdCI6IjIwMjItMDktMTIgMTg6NTk6MzciLCJfdXBkYXRlZF9hdCI6IjIwMjItMDktMTIgMTg6NTk6MzciLCJfdGVsZXBob25lIjoiMTExMTAwMDAiLCJfc3RhdHVzIjoidmFsaWRlIn19fQ.rZtTWGXeWi1W6_9aNPrmTayRjQ-89KIOcFuAidq_f_w', new Key((new Env())->_getTokenKey(),'HS256'));

print_r($jwt);*/

$token = 'eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpc3MiOiJsb2NhbGhvc3QiLCJhdWQiOiJsb2NhbGhvc3QiLCJpYXQiOjE2NjMzMjAzNTIsImV4cCI6MTY2NDc2MDM1MiwiZGF0YSI6eyJ1c2VyIjoidGlkZCIsImRhdGEiOnsiX2lkIjoiMSIsIl91dWlkIjoidXJ0b2xrbDxza2wiLCJfbGFzdF9uYW1lIjoic3VwZXIiLCJfZmlyc3RfbmFtZSI6InN1cGVyIiwiX2VtYWlsIjoic3VwZXJAZ21haWwuY29tIiwiX2lkZW50aWZpZXIiOiJzdXBlciIsIl90ZWxlcGhvbmUiOiI5ODc1NDEyNSIsIl9wYXNzd29yZCI6IiQyeSQxMiRFZ1ZXbURCY2VBbHFiN2owU2FIalR1LzBFSnZrRzM4RzdEa0JleDN3dDRFNnFLbFdDNk1uTyIsIl9hY2Nlc3NfbGV2ZWwiOiJlZGl0b3IiLCJfc3RhdHVzIjoidmFsaWRlIiwiX2NyZWF0ZWRfYXQiOiIyMDIyLTA5LTE2IDAxOjA4OjEyIiwiX3VwZGF0ZWRfYXQiOiIyMDIyLTA5LTE2IDAxOjA4OjEyIn19fQ.n7iLWhlBEZZX2SD835R-xXfRYwGmxzzI35fG4VB74b8';


if((new Auth($token))->_checkToken() == !0) echo "valide";
else echo "invalide";

echo ((new Auth($token))->_user());
//print_r ((new Auth($token))->_access());

echo ((new Auth($token))->_cityHall());

echo ((new Auth($token))->_id());

$tknArray = explode('.', $token);
$head = json_decode(base64_decode($tknArray[0]),true );
$payload = json_decode(base64_decode($tknArray[1]),true );

$expir = json_decode(base64_decode($tknArray[1]),true )['exp'];
$user = json_decode(base64_decode($tknArray[1]),true )['data'];


//print_r($user);
 
 
