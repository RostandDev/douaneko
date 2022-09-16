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
    use core\DB;
    use core\Password;
    use core\Uuid;
    use core\Auth;
    use models\Reporter;


    $api = (new Env())->_get_api();
    if($_SERVER['REQUEST_METHOD']== 'POST'){
        if(isset($_POST['insert'])){
            $password = (new Password())->_hash(htmlspecialchars($_POST['_password']));
    
            $email = htmlspecialchars($_POST['_email']);

            if (preg_match("#^[a-z0-9._-]+@[a-z0-9._-]{2,}\.[a-z]{2,4}$#",  $email))
            {

                $insert = (new Reporter())->_insert([
                    '_uuid' => (new Uuid())->_uuid(),
                    '_last_name' => $_POST['_last_name'],
                    '_first_name' => $_POST['_first_name'],
                    '_email' => $email,
                    '_pseudo' => $_POST['_pseudo'],
                    '_password' => $password,
                    '_city' => $_POST['_city'],
                    '_telephone' => $_POST['_telephone']
    
                ]);



                if($insert['status'] == !0){
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

            }
            else{

                $data = [
                    "meta" => $api,
                    "status"=> "DATA_ERROR"
                ];
            }

            echo json_encode($data);
        }

        if(isset($_POST['update'])){
            $password = (new Password())->_hash(htmlspecialchars($_POST['_password']));
    
            $email = htmlspecialchars($_POST['_email']);

            if (preg_match("#^[a-z0-9._-]+@[a-z0-9._-]{2,}\.[a-z]{2,4}$#",  $email))
            {

                $update = (new Reporter())->_update([
                    '_uuid' => (new Uuid())->_uuid(),
                    '_last_name' => $_POST['_last_name'],
                    '_first_name' => $_POST['_first_name'],
                    '_email' => $email,
                    '_pseudo' => $_POST['_pseudo'],
                    '_password' => $password,
                    '_city' => $_POST['_city'],
                    '_telephone' => $_POST['_telephone'],
                    '_id' => $_POST['_id']
    
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

            }
            else{

                $data = [
                    "meta" => $api,
                    "status"=> "DATA_ERROR"
                ];
            }

            echo json_encode($data);
        }

    }


    if($_SERVER['REQUEST_METHOD']== 'GET'){

        if(isset($_GET['reporters'])){
            if(isset($_GET['id'])){
                $data = (new Reporter())->_getById(['_id' => intval(htmlspecialchars($_GET['id']))])['data'];
            }
            else{
                $data = (new Reporter())->_get()['data'];
            }
            
            $response = [
                "meta" => $api,
                "status"=> "OK",
                "content" => $data
            ];

            echo json_encode($response);
        }



        if(isset($_GET['delete']) || isset($_GET['desable'])  ){
            $reporter = (new Reporter() )->_disable(['_id' =>intval(htmlspecialchars($_GET['_id']))]);

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
            $reporter = (new Reporter() )->_enable(['_id' =>intval(htmlspecialchars($_GET['_id']))]);

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



    }