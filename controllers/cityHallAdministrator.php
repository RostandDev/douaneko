<?php
    /*
    * Stagaires TIDD 2022
    * Auteur : ABOTCHI Kodjo Mawugno
    * Douanek_api de TIDD  
    * Fichier : Controlleur de toutes les actions sur un administrateur de tidd
    * date : 2022-07-30
    *
    */
    header("Access-Control-Allow-Origin: *");
    header("content-type: application/json");
    require_once("../core/autoloader.php");
    require_once("../core/request.php");
   
   
    use core\Password;
    use core\Uuid;
    use core\Auth;
    use models\CityHallAdministrator;

    $api = (new Env())->_get_api();

    $access = (new Auth($token))->_access();

    if($user !="city_hall" || $user !="tidd"){
        $response = [
            "meta" => $api,
            "satus" => "403_FORBIDDEN"
        ];
        print_r(json_encode($response)) ;

        exit;

    }
    if($_SERVER['REQUEST_METHOD'] == 'POST'){


        if(isset($_POST['insert'])){

            if($access != "editor"){
                $response = [
                    "meta" => $api,
                    "satus" => "403_FORBIDDEN"
                ];
                print_r(json_encode($response)) ;

                exit;

            }
            $uuid = (new Uuid())->_uuid();
            $password = (new Password())->_hash(htmlspecialchars($_POST['_password']));


                $admin = (new CityHallAdministrator())->_insert([
                    '_uuid'=> $uuid,
                    '_last_name'=>htmlspecialchars($_POST['_last_name']),
                    '_first_name'=>htmlspecialchars($_POST['_first_name']),
                    '_city_hall'=>intval(htmlspecialchars($_POST['_city_hall'])), 
                    '_identifier' => htmlspecialchars($_POST['_identifier']),
                    '_password'=> $password

                ]);
                
                if( $admin['status'] == !0){
                   
                    $data = [
                        "meta"=> $api,
                        "status" => "OK"
                    ];
            
                   
                } 
                else{
                    
                    $data = [
                        "meta"=> $api,
                        "status" => "DATA_ERROR"                        
                    ];
            
                }

            print_r(json_encode($data) ) ;
        }

        if(isset($_POST['update'])){

            $password = (new Password())->_hash(htmlspecialchars($_POST['_password']));

            $email = htmlspecialchars($_POST['_city_hall']);
            if (preg_match("#^[a-z0-9._-]+@[a-z0-9._-]{2,}\.[a-z]{2,4}$#",  $email)){

                $admin = (new CityHallAdministrator())->_update([
    
                    '_last_name'=>htmlspecialchars($_POST['_last_name']),
                    '_first_name'=>htmlspecialchars($_POST['_first_name']),
                    '_city_hall'=>$email, 
                    '_access_level' => $_POST['_access_level'],
                    '_identifier' => htmlspecialchars($_POST['_identifier']),
                    '_password'=> $password,
                    '_id' => $_POST['_id']

                ]);
                
                if( $admin['status'] == !0){
                   
                    $data = [
                        "meta"=> $api,
                        "status" => "OK"
                    ];
            
                   
                } 
                else{
                    
                    $data = [
                        "meta"=> $api,
                        "status" => "DATA_ERROR",
                        'error' => $admin['error']                      
                    ];
            
                }

            }else{

                $data = [
                    "meta"=> $api,
                    "status" => "EMAIL_ERROR"                        
                ];
        
                
            }

            print_r(json_encode($data) ) ;


        }

    }



    if($_SERVER['REQUEST_METHOD'] == 'GET'){

        if(isset($_GET['admins'])   ){
            
            if(isset($_GET['id'])){
                $data = (new CityHallAdministrator())->_getById(['_id' => intval(htmlspecialchars($_GET['id']))])['data'];
            }
            else{
                $data = (new CityHallAdministrator())->_get()['data'];
            }
            
            $response = [
                "meta" => $api,
                "status"=> "OK",
                "content" => $data
            ];

            echo json_encode($response);
        }




        if(isset($_GET['delete'])){
        

                $delete = (new CityHallAdministrator())->_delete([ 
                    "_id" => intval($_GET['id']),
                ]);

                if($delete['status'] == !0){
                    $response = [
                        "meta" => $api,
                        "status"=> "OK"
                    ];
                }
                else{
                    $response = [
                        "meta" => $api,
                        "status"=> $delete['error']
                    ];
                }
    
                echo json_encode($response);
                        

        }


        if(isset($_GET['disconnecte'])  ){


            
        }

        if(isset($_GET['desable'])  ){
            $reporter = (new CityHallAdministrator() )->_disable(['_id' =>intval(htmlspecialchars($_GET['_id']))]);

            if($reporter['status'] == !0){
                $response = [
                    "meta" => $api,
                    "status"=> "OK"
                ];
            }
            else{
                $response = [
                    "meta" => $api,
                    "status"=> $reporter['error']
                ];
            }

            echo json_encode($response);
        }


        if(isset($_GET['enable'])  ){
            $reporter = (new CityHallAdministrator() )->_enable(['_id' =>intval(htmlspecialchars($_GET['_id']))]);

            if($reporter['status'] == !0){
                $response = [
                    "meta" => $api,
                    "status"=> "OK"
                ];
            }
            else{
                $response = [
                    "meta" => $api,
                    "status"=> $reporter['error']
                ];
            }

            echo json_encode($response);
        }


//generer des fakers


    if(isset($_GET['fakers'])){
      
        for($i=0; $i<500; $i++){

        

        
            $uuid = (new Uuid())->_uuid();
            $password = (new Password())->_hash("faker-name".$i*2);
    

                $admin = (new CityHallAdministrator())->_insert([
                    '_uuid'=> $uuid,
                    '_last_name'=> "faker-lname".($i*2),
                    '_first_name'=>"faker-fname".($i*2),
                    '_city_hall'=>"faker-mail".($i*2)."10@gmail.com", 
                    '_identifier' => "faker-identifer10".($i*2), 
                    '_password'=> $password

                ]);
                
                if( $admin['status'] == !0){
                    
                    echo 'créé';
                } 
                else{
                    
        

                    $data =  (new CityHallAdministrator())->_get()['data'];

            
                    print_r(json_encode($data) ) ;
                }
       
        }
    }
}

 