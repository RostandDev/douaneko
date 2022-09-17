<?php
    /*
    * Stagaires TIDD 2022
    * Auteur : ABOTCHI Kodjo Mawugno
    * Douaneko
    * Controlleur des mairies | City hall 
    * date : 2022-08-24
    *
    */
    header("Access-Control-Allow-Origin: *");
    header("content-type: application/json");
    require_once("../core/autoloader.php");


    use core\Auth;
    use core\Uuid;
    use models\CityHall;

    $api = (new Env())->_get_api();
    $access = (new Auth($token))->_access();

    if($access != "editor"){
        $response = [
            "meta" => $api,
            "satus" => "403_FORBIDDEN"
        ];
        print_r(json_encode($response)) ;

        exit;

    }

    if($access != "editor"){
        $response = [
            "meta" => $api,
            "satus" => "403_FORBIDDEN"
        ];
        print_r(json_encode($response)) ;

        exit;

    }
    if($_SERVER['REQUEST_METHOD']== 'POST'){
        if(isset($_POST['insert'])){


                $insert = (new  CityHall())->_insert([
                    "_uuid" => (new Uuid())->_uuid(),
                    "_name" =>  htmlspecialchars($_POST['_name']), 
                    "_city" =>  htmlspecialchars($_POST['_city']), 
                    "_postal_code" =>  htmlspecialchars($_POST['_postal_code']), 
                    "_telephone" => htmlspecialchars( $_POST['_telephone']), 
                    "_prefecture" => htmlspecialchars( $_POST['_prefecture']), 
                    "_author" => (new Auth($token))->_id()
                ]);



                if($insert['status'] == !0){
                    $data = [
                        "meta" => $api,
                        "status"=> "OK"
                    ];
                }
                else{

                    $data = [
                        "meta" => $api,
                        "status"=> "BAD_REQUEST",
                        "code" => $insert['error']
                    ];
                }

            
            echo json_encode($data);
        }


        if(isset($_POST['update'])){


            $insert = (new CityHall())->_update([
                "_uuid" => (new Uuid())->_uuid(),
                "_name" =>  htmlspecialchars($_POST['_name']), 
                "_city" =>  htmlspecialchars($_POST['_city']), 
                "_postal_code" =>  htmlspecialchars($_POST['_postal_code']), 
                "_telephone" => htmlspecialchars( $_POST['_telephone']), 
                "_prefecture" => htmlspecialchars( $_POST['_prefecture']), 
                "_author" => (new Auth($token))->_id(),
                '_id' => intval(htmlspecialchars($_POST['_id']))   
                
            ]);



                if($insert['status'] == !0){
                    $data = [
                        "meta" => $api,
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

        

    }


    if($_SERVER['REQUEST_METHOD']== 'GET'){

        if(isset($_GET['cityhalls'])){
            if(isset($_GET['id'])){
                $data = (new CityHall())->_getById(['_id' => intval(htmlspecialchars($_GET['id']))])['data'];
            }
            else{
                $data = (new CityHall())->_get()['data'];
            }
            
            $response = [
                "meta" => $api,
                "status"=> "OK",
                "content" => $data
            ];

            echo json_encode($response);
        }



        if(isset($_GET['delete']) || isset($_GET['disable'])  ){
            $reporter = (new CityHall() )->_disable(['_id' =>intval(htmlspecialchars($_GET['_id']))]);

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
            $reporter = (new  CityHall() )->_enable(['_id' =>intval(htmlspecialchars($_GET['_id']))]);

            if($reporter['status'] == !0){
                $response = [
                    "meta" =>$api,
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



    }