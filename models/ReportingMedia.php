<?php
    /*
    * Stagaires TIDD 2022
    * Auteur : ABOTCHI Kodjo Mawugno
    * Douaneko
    * Model reporting ( signalement) 
    * date : 2022-08-24
    *
    */
    namespace  models;
    require_once("../core/autoloader.php");

    use \core\DB;
    use core\Password;

    class ReportingMedia extends DB{

        public function __construct()
        {
            parent::__construct();
        }

        public function _insert(Array $_data){

            $insert = $this-> _execute("INSERT INTO t_reportingMedia(_media, _reporting ) VALUES (:_media, :_reporting )", 
            [
                '_reporting' => $_data['_reporting'],
                '_media' => $_data['_media']
            ]);

            if($insert['status']){
                return [
                    'status' => !0,
                ];
            }
            else{
                return [
                    'status' => !1, 
                    'error' =>   $insert['error']
               ];
            }


        }


        public function _get(){

            $data = $this -> _query(" SELECT * FROM t_reporting ");

            if($data['status'] == !0){
                return [
                    'status' => !0,
                    'data' => $data['data']
                ];
            }
            else{
                return [
                    'status' => !1, 
                    'error' => $data['error']                 
                ];
            }
        }

        public function _getId(string $_uuid){

            $data = $this -> _query(" SELECT _id FROM t_reporting WHERE _uuid = '$_uuid' ");

            if($data['status'] == !0){
                return [
                    'status' => !0,
                    'id' => $data['data'][0]["_id"]
                ];
            }
        }

        public function _getById(Array $_data){

            $id = $_data['_id'];
            $data = $this -> _query(" SELECT * FROM t_reporting WHERE _id = $id");

            if($data['status'] == !0){
                return [
                    'status' => !0,
                    'data' => $data['data']
                ];
            }
            else{
                return [
                    'status' => !1, 
                    'error' => $data['error']                 
                ];
            }
        }

        
    }