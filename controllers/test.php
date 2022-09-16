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

$token = 'eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpc3MiOiJsb2NhbGhvc3QiLCJhdWQiOiJsb2NhbGhvc3QiLCJpYXQiOjE2NjMyOTExMDMsImV4cCI6MTY2NDczMTEwMywiZGF0YSI6eyJ1c2VyIjoiY2l0eV9oYWxsIiwiZGF0YSI6eyJfaWQiOiIxIiwiX3V1aWQiOiJ1cnRvbGtsPHNrbCIsIl9hY2Nlc3NfbGV2ZWwiOiJyZWFkZXIiLCJfbGFzdF9uYW1lIjoic3VwZXIiLCJfZmlyc3RfbmFtZSI6InN1cGVyIiwiX2lkZW50aWZpZXIiOiJzdXBlciIsIl9wYXNzd29yZCI6IiQyeSQxMiRFZ1ZXbURCY2VBbHFiN2owU2FIalR1LzBFSnZrRzM4RzdEa0JleDN3dDRFNnFLbFdDNk1uTyIsIl9jaXR5X2hhbGwiOiIxIiwiX3N0YXR1cyI6InZhbGlkZSIsIl9pbnNlcnRlZF9hdCI6IjIwMjItMDktMTYgMDE6MTY6MDIiLCJfdXBkYXRlZF9hdCI6IjIwMjItMDktMTYgMDE6MTY6MDIifX19.u_zlOL9UPBVGRZTVRpqmKNpR-LH29JEAOD35eclBIEI';


if((new Auth($token))->_checkToken() == !0) echo "valide";
else echo "invalide";

echo ((new Auth($token))->_user());
print_r ((new Auth($token))->_access());

echo ((new Auth($token))->_cityHall());

$tknArray = explode('.', $token);
$head = json_decode(base64_decode($tknArray[0]),true );
$payload = json_decode(base64_decode($tknArray[1]),true );

$expir = json_decode(base64_decode($tknArray[1]),true )['exp'];
$user = json_decode(base64_decode($tknArray[1]),true )['data'];


//print_r($user);
 
 
