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

    class Reporting extends DB{

        public function __construct()
        {
            parent::__construct();
        }

        public function _insert(Array $_data){

            $insert = $this-> _execute("INSERT INTO t_reporting(_uuid, _longitude, _latitude, _type, _level, _comment, _reporter ) VALUES ( :_uuid, :_longitude, :_latitude, :_type, :_level, :_comment, :_reporter )", 
            [
                ':_uuid' => $_data['_uuid'],
                ':_longitude' => $_data['_longitude'],
                ':_latitude' => $_data['_latitude'],
                ':_type' => $_data['_type'],
                ':_level' => $_data['_level'],
                ':_comment' => $_data['_comment'],
                ':_reporter' => $_data['_reporter']

            ]);

            if($insert['status']){
                return [
                    'status' => !0,
                    'id' => $this-> _getId($_data['_uuid'])['id']
                ];
            }
            else{
                return [
                    'status' => !1, 
                    'error' =>             [
                        ':_uuid' => $_data['_uuid'],
                        ':_longitude' => $_data['_longitude'],
                        ':_latitude' => $_data['_latitude'],
                        ':_type' => $_data['_type'],
                        ':_level' => $_data['_level'],
                        ':_comment' => $_data['_comment'],
                        ':_reporter' =>1
        
                    ]                 
                ];
            }


        }

        public function _update(Array $_data){

            $update =  $this-> _execute(" UPDATE t_reporting SET _uuid = :_uuid, _longitude = :_longitude, _latitude = :_latitude, _type = :_type, _level = :_level, _comment = :_comment, _reporter = :_reporter,  _updated_at = :_updated_at WHERE _id = :_id", 
            [
                ':_uuid' => $_data['_uuid'],
                ':_longitude' => $_data['_longitude'],
                ':_latitude' => $_data['_latitude'],
                ':_type' => $_data['_type'],
                ':_level' => $_data['_level'],
                ':_comment' => $_data['_comment'],
                ':_reporter' => $_data['_reporter'],
                ':_id' => $_data['_id'],
                ':_updated_at' => date("Y-m-d H:i:s")

            ]);

            if($update['status']){
                return [
                    'status' => !0,
                    'id' => $this-> _getId($_data['_uuid'])['id']
                ];
            }
            else{
                return [
                    'status' => !1, 
                    'error' => $update['error']                 
                ];
            }

        }

        public function _disable(Array $_data){
            $id = $_data['_id'];
            $disable = $this->_query("UPDATE t_reporting SET _status = 'invalide' WHERE _id = $id");

            if($disable['status']){
                return [
                    'status' => !0,
                ];
            }
            else{
                return [
                    'status' => !1, 
                    'error' => $disable['error']                 
                ];
            }
        }


        public function _enable(Array $_data){
            $id = $_data['_id'];
            $disable = $this->_query("UPDATE t_reporting SET _status = 'valide' WHERE _id = $id");

            if($disable['status']){
                return [
                    'status' => !0,
                ];
            }
            else{
                return [
                    'status' => !1, 
                    'error' => $disable['error']                 
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