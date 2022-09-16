<?php
    header("Access-Control-Allow-Origin: *");
    header("content-type: application/json");
    require_once('../core/autoloader.php');

    use core\Auth;
    use Env;
    use models\CityHallAdministrator;
    use models\Reporter;
    use models\TiddAdministrator;

    $api = (new Env())->_get_api();
    if($_SERVER['REQUEST_METHOD'] != 'POST' ){
        
        
        $response = [
            "meta" =>$api,
            "status"=> "BAD_REQUEST_METHO",
            "code" => 403
        ];
    

    }


    if(!isset($_POST['login'])){
        $response =  [
             "meta" =>$api,
             "status"=> "NOT_FOUND"
         ];
         
         echo json_encode($response);
    
         exit;
    }



    if(isset($_POST['login'])){

        if(isset($_POST['_identifier'])){

            $identifier = htmlspecialchars($_POST['_identifier']);
            if (preg_match("#^[a-z0-9._-]+@[a-z0-9._-]{2,}\.[a-z]{2,4}$#",  $identifier)){

                $connexion = (new TiddAdministrator())->_connexion([ 
                    '_email' =>$identifier, 
                    '_password'=> htmlspecialchars($_POST['_password'])
                ]);

                $user = "tidd";

            }
            else{
                
                $connexion = (new CityHallAdministrator())->_connexion([
                    "_identifier" =>$identifier,
                    "_password" => htmlspecialchars( $_POST['_password'])
                ]);
                $user = "city_hall";
            }
        }

        if(isset($_POST['_telephone'])){
            $connexion = (new Reporter())->_connexion([
                "_telephone" => intval(htmlspecialchars( $_POST['_telephone'])),
                "_password" => htmlspecialchars( $_POST['_password'])
            ]);
            $user = "public";
        }


        if($connexion['status'] == !0){

            $jwt = (new Auth(' ', [
                "user" => $user,
                "data" => $connexion['user']
            ]))->_gen( 1000*1440);
            
            $response = [
                "meta" => $api,
                "token" => $jwt,
                "status"=> "CONNECTED"
                
            ];
        }
        else{
           $response =  [
                "meta" =>$api,
                "status"=> "REJECTED",
                "error" => $connexion['error']
            ];
        }

        echo json_encode($response);
       
    }

    