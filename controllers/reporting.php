<?php


    /*
    * Stagaires TIDD 2022
    * Auteur : ABOTCHI Kodjo Mawugno
    * Douaneko
    * Controlleur des requetes | Reporter ( signaleur) 
    * date : 2022-08-24
    *
    */

    use core\File;
    use core\Uuid;
    use models\Media;
    use models\Reporting;
    use models\ReportingMedia;

    header("Access-Control-Allow-Origin: *");
    header("content-type: application/json");
    require_once("../core/autoloader.php");

    $api = (new Env())->_get_api();
    if($_SERVER['REQUEST_METHOD']== 'POST'){
        if(isset($_POST['insert'])){


                $file = (new File())->_multi_upload($_FILES['_reporting'], '../disk/uploads/reporting/images');

                
                $media = [];
                for($i = 0; $i < count($file); $i++){
                    $_media = (new Media())->_insert([
                        '_uuid' => $file[$i]['uuid'], 
                        '_type' => $file[$i]['type'], 
                        '_extension' => $file[$i]['extension'], 
                        '_size' => $file[$i]['size'],
                        '_name' => $file[$i]['name']
                    ]);  

                    if($_media['status'] == !0){
                        $media[$i] = $_media['id'];
                    }
                   
                }

                if(count($media) > 0){
                    $insert = (new Reporting())->_insert([
                        '_uuid' => (new Uuid())->_uuid(),
                        '_longitude' => $_POST['_longitude'],
                        '_latitude' => $_POST['_latitude'],
                        '_type' => $_POST['_type'],
                        '_level' => $_POST['_level'],
                        '_comment' => $_POST['_comment'],
                        '_reporter' => intval(htmlspecialchars($_POST['_reporter']))
        
                    ]);
    
    
    
                    if($insert['status'] == !0){
                        
                        for($i = 0; $i <count($media); $i++ ){
                            $assoc = (new ReportingMedia())->_insert([
                                '_reporting' => $insert['id'],
                                '_media' => $media[$i]
                            ]);
                        }

                        
    
                        $data = [
                            "meta" =>$api,
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

                }

                

            

            echo json_encode($data);
        }


        if(isset($_POST['update'])){


            $insert = (new Reporting())->_update([
                '_uuid' => (new Uuid())->_uuid(),
                '_longitude' => $_POST['_longitude'],
                '_latitude' => $_POST['_latitude'],
                '_type' => $_POST['_type'],
                '_level' => $_POST['_level'],
                '_comment' => $_POST['_comment'],                    
                '_reporter' => intval(htmlspecialchars($_POST['_reporter'])),
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

        if(isset($_GET['reporting'])){
            if(isset($_GET['id'])){
                $data = (new Reporting())->_getById(['_id' => intval(htmlspecialchars($_GET['id']))])['data'];
            }
            else{
                $data = (new Reporting())->_get()['data'];
            }
            
            $response = [
                "meta" => $api,
                "status"=> "OK",
                "content" => $data
            ];

            echo json_encode($response);
        }



        if(isset($_GET['delete']) || isset($_GET['disable'])  ){
            $reporter = (new Reporting() )->_disable(['_id' =>intval(htmlspecialchars($_GET['_id']))]);

            if($reporter['status'] == !0){
                $response = [
                    "meta" => [
                        "name" => "douaneko_api",
                        "version" =>"1.0.0"
                    ],
                    "status"=> "OK"
                ];
            }
            else{
                $response = [
                    "meta" => [
                        "name" => "douaneko_api",
                        "version" =>"1.0.0"
                    ],
                    "status"=> $reporter['error']
                ];
            }

            echo json_encode($response);
        }


        if(isset($_GET['enable'])  ){
            $reporter = (new Reporting() )->_enable(['_id' =>intval(htmlspecialchars($_GET['_id']))]);

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