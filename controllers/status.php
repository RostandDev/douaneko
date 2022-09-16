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
    require_once('../core/autoloader.php');
    use models\Trashstatus;
    use Env;
use models\Trash;

    $api = (new Env())->_get_api();

    if($_SERVER['REQUEST_METHOD'] != "POST" &&  $_SERVER['REQUEST_METHOD'] !='GET'){


        $response = [
            "meta" =>$api,
            "status"=> "BAD_REQUEST",
        ];

        echo json_encode($response);

        exit;
    }

    if(isset($_POST['status'])){

        $insert = (new Trashstatus())->_insert(        [
            '_full_level' => htmlspecialchars($_POST['_full_level']),
            '_trash' => htmlspecialchars($_POST['_trash'])
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

        print_r(json_encode($data) ) ;

    }

    if($_SERVER['REQUEST_METHOD'] == "GET"){

        $data = (new Trashstatus())->_get();
        if(isset($_GET['id'])) $data = (new Trashstatus())->_getById(intval(htmlspecialchars($_GET['id'])))['data'];
        if(isset($_GET['trash'])) $data = (new Trashstatus())->_getByTrash(intval(htmlspecialchars($_GET['trash'])))['data'];

        print_r(json_encode($data) ) ;
    }

?>