<?php
    /*
    * Stagaires TIDD 2022
    * Auteur : ABOTCHI Kodjo Mawugno
    * Douaneko
    * De gestion des mairie 
    * date : 2022-08-24
    *
    */
    namespace  models;
    require_once("../core/autoloader.php");

    use \core\DB;


    class CityHall extends DB{
        
        public function __construct()
        {
            parent::__construct();
        }

        public function _insert(Array $_data){

            $insert = $this->_execute("INSERT INTO t_cityHalls(_uuid, _name, _city, _postal_code, _telephone, _prefecture, _author) VALUES(:_uuid, :_name, :_city, :_postal_code, :_telephone, :_prefecture, :_author)",[
                ":_uuid" => $_data['_uuid'],
                ":_name" =>  $_data['_name'], 
                ":_city" =>  $_data['_city'], 
                ":_postal_code" =>  $_data['_postal_code'], 
                ":_telephone" =>  $_data['_telephone'], 
                ":_prefecture" =>  $_data['_prefecture'], 
                ":_author" =>  $_data['_author']
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
                    'error' => $insert['error']                 
                ];
            }

        }

        public function _update(Array $_data){

            $update = $this->_execute("UPDATE  t_cityHalls SET _uuid = :_uuid, _name = :_name, _city = :_city, _postal_code = :_postal_code, _telephone = :_telephone, _prefecture = :_prefecture, _author = :_author WHERE _id = :_id",[
                ":_uuid" => $_data['_uuid'],
                ":_name" =>  $_data['_name'], 
                ":_city" =>  $_data['_city'], 
                ":_postal_code" =>  $_data['_postal_code'], 
                ":_telephone" =>  $_data['_telephone'], 
                ":_prefecture" =>  $_data['_prefecture'], 
                ":_author" =>  $_data['_author'],
                ":_id" => $_data['_id']
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
            $disable = $this->_query("UPDATE t_cityHalls SET _status = 'invalide' WHERE _id = $id");

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
            $disable = $this->_query("UPDATE t_cityHalls SET _status = 'valide' WHERE _id = $id");

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

            $data = $this -> _query(" SELECT * FROM t_cityHalls ");

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

            $data = $this -> _query(" SELECT _id FROM t_cityHalls WHERE _uuid = '$_uuid' ");

            if($data['status'] == !0){
                return [
                    'status' => !0,
                    'id' => $data['data'][0]["_id"]
                ];
            }
        }

        public function _getById(Array $_data){
            $id = $_data['_id'];
            $data = $this -> _query(" SELECT * FROM t_cityHalls WHERE _id = $id");

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