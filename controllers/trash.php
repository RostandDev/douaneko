<?php
    /*
    * Stagaires TIDD 2022
    * Auteur : ABOTCHI Kodjo Mawugno
    * Douaneko
    * Controlleur des requetes | Reporter ( signaleur) 
    * date : 2022-08-24
    *
    */
    header("Access-Control-Allow-Origin: *");
    header("content-type: application/json");
    require_once("../core/autoloader.php");
    require_once("../core/request.php");
    use core\Uuid;
    use core\Auth;
    use models\Trash;


    $api = (new Env())->_get_api();




        
        if($_SERVER['REQUEST_METHOD']== 'POST'){


            if($user !="city_hall" && $user !="tidd"){
                $response = [
                    "meta" => $api,
                    "satus" => "403_FORBIDDEN"
                ];
                print_r(json_encode($response)) ;

                exit;

            }

            if(isset($_POST['insert']) ){
        
               
                $insert =  (new Trash())->_insert([
                    '_uuid' => (new Uuid())->_uuid(),
                    '_longitude' => htmlspecialchars($_POST['_longitude']),
                    '_latitude' => htmlspecialchars($_POST['_latitude']),
                    '_name' => htmlspecialchars($_POST['_name']),
                    '_address' => htmlspecialchars($_POST['_address']),
                ]);
        
                if($insert['status'] == !0){
                   
                    if($user == "city_hall")
                    {
                        echo (new Auth($token))->_cityHall(). ' et '. $insert['id'];
                        $association = (new Trash())->_associate([
                            "_city_hall" => (new Auth($token))->_cityHall(),
                            "_trash" => $insert['id']
                        ]);

                    }


                    $data = [
                        "meta" =>$api,
                        "status"=> "OK"
                    ];


                }
                else{

                    $data = [
                        "meta" =>$api,
                        "status"=> "BAD_REQUEST",
                        "code" => $insert['error']
                    ];
                }

                echo json_encode($data);
        
        
            }

            if(isset($_POST['update'])){
    
                $update =  (new Trash())->_update([
                    '_uuid' => (new Uuid())->_uuid(),
                    '_longitude' => htmlspecialchars($_POST['_longitude']),
                    '_latitude' => htmlspecialchars($_POST['_latitude']),
                    '_name' => htmlspecialchars($_POST['_name']),
                    '_address' => htmlspecialchars($_POST['_address']),
                    '_id' => htmlspecialchars($_POST['_id'])
                ]);


                if($update['status'] == !0){
                    $data = [
                        "meta" =>$api,
                        "status"=> "OK"
                    ];
                }
                else{

                    $data = [
                        "meta" => $api,
                        "status"=> "BAD_REQUEST",
                        "code" => $update['error']
                    ];
                }

                echo json_encode($data);

            }
        }

        if($_SERVER['REQUEST_METHOD']== 'GET'){



            if(isset($_GET['trashs'])){
                if(isset($_GET['city_hall'])){
                    $data = (new Trash())->_getByCityHall(['_id' => intval(htmlspecialchars($_GET['cityHall']))])['data'];
                }
                if(isset($_GET['id'])){
                    $data = (new Trash())->_getById(['_id' => intval(htmlspecialchars($_GET['id']))])['data'];
                }
                else{
                    $data = (new Trash())->_get()['data'];
                }
                
                $response = [
                    "meta" => $api,
                    "status"=> "OK",
                    "content" => $data
                ];
    
                echo json_encode($response);
            }
    
    
            if(isset($_GET['delete']) ){

                if($user !="city_hall" && $user !="tidd"){
                    $response = [
                        "meta" => $api,
                        "satus" => "403_FORBIDDEN"
                    ];
                    print_r(json_encode($response)) ;

                    exit;

                }
                $delete = (new Trash() )->_delete(['_id' =>intval(htmlspecialchars($_GET['_id']))]);

    
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
    
        }
        
        

   
 





   /* if(isset($_GET['fakers'])){
      
        for($i=0; $i<100; $i++){

        

            $insert =  (new Trash())->_insert([
                '_uuid' => (new Uuid())->_uuid(),
                '_longitude' => rand(1000,9000),
                '_latitude' => rand(1000,9000),
                '_name' => 'faker-tname',
                '_address' => 'faker-taddress',
                '_author' => intval(htmlspecialchars($_SESSION['USER_ID']))
            ]);
    
            if($insert['status']== !0) {
                $data = [
                    "status" => !0,
                    "data" => (new Trash())->_get()['data']
                ];
        
               
            }
            elseif($insert['status']== !1) {
                $data = [
                    "status" => !1,
                    "error" => "DATA_ERROR",
                    "data" => (new Trash())->_get()['data']
                ];
            } 
            else{
                
                    $data = [
                        "status" => !1,
                        "error" => "INTERNAL_ERROR",
                    ];
                 
            }

    
            print_r(json_encode($data) ) ;
    
       
        }*/

