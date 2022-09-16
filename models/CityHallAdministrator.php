<?php
    /*
    * Stagaires TIDD 2022
    * Auteur : ABOTCHI Kodjo Mawugno
    * Douaneko
    * Fichier 
    * date : 2022-08-24
    *
    */
    namespace  models;
    require_once("../core/autoloader.php");

    use \core\DB;
    use core\Password;

    class CityHallAdministrator extends DB {

        public function __construct(){

            parent::__construct();
            
        }

        public function _insert($_data){
                                 
            $insert = $this-> _execute("INSERT INTO t_cityHallAdministrators(_uuid, _last_name, _first_name, _city_hall, _identifier, _password ) VALUES ( :_uuid, :_last_name, :_first_name, :_city_hall, :_identifier, :_password )", 
            [
                ':_uuid' => $_data['_uuid'],
                ':_last_name' => $_data['_last_name'],
                ':_first_name' => $_data['_first_name'],
                ':_city_hall' => $_data['_city_hall'],
                ':_identifier' => $_data['_identifier'],
                ':_password' => $_data['_password'],

            ]);
            
            if($insert['status'] == !0){
                return [
                    'status' => !0,
                ];
            }
            else{
                return [
                    'status' => !1, 
                    'error' => $insert['error']                 
                ];
            }
        }

        public function _get(){
        
            $data = $this -> _query(" SELECT * FROM t_cityHallAdministrators ");

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

        public function _update( array $_data){

            $updated = $this-> _execute("UPDATE  t_cityHallAdministrators SET  _last_name = :_last_name, _first_name = :_first_name , _city_hall = :_city_hall, _identifier  = :_identifier, _password = :_password, _access_level = :_access_level, _status = :_status WHERE _id = :_id", 
            [
                ":_id" => $_data['_id'],
                ':_last_name' => $_data['_last_name'],
                ':_first_name' => $_data['_first_name'],
                ':_access_level' => $_data['_access_level'],
                ':_city_hall' => $_data['_city_hall'],
                ':_identifier' => $_data['_identifier'],
                ':_password' => $_data['_password'],
                ':_status' => $_data['_status']

            ]);
            
            if($updated['status'] == !0){
                return [
                    'status' => !0,
                    'id' =>$_data['_id']
                ];
            }
            else{
                return [
                    'status' => !1, 
                    'error' => $updated ['error']                
                ];
            }
        }

        public function _delete(array $_data){
            $updated = $this-> _execute("DELETE FROM t_cityHallAdministrators WHERE _id = :_id", 
            [
                ":_id" => $_data['_id'],
                
            ]);
            
            if($updated){
                return [
                    'status' => !0,
                    'id' => $_data['_id']
                ];
            }
            else{
                return [
                    'status' => !1,                  
                ];
            }
        }


        public function _disable(Array $_data){
            $id = $_data['_id'];
            $disable = $this->_query("UPDATE t_cityHallAdministrators SET _status = 'invalide' WHERE _id = $id");

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
            $disable = $this->_query("UPDATE t_cityHallAdministrators SET _status = 'valide' WHERE _id = $id");

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

        public function _getById($_id){

            $data = $this->_query("SELECT * FROM t_cityHallAdministrators WHERE _id = $_id");

            if($data['status'] == !0){

                return [
                    'status' => !0,
                    'data' => $data['data']
                ];
            }
            else{
                return [
                    'status' => !1
                ]; 
            }
        }

        public function _getByMail($_city_hall){

            $data = $this->_query("SELECT * FROM t_cityHallAdministrators WHERE _city_hall = '$_city_hall'");

            return $data['data'];
        }
        
        public function _chekEmail($_city_hall){

            $data = $this -> _query(" SELECT _id, _password  FROM t_cityHallAdministrators WHERE _city_hall = '$_city_hall' ");

            if($data['status'] == !0){

                return [
                    'status' => !0,
                    'id' => $data['data'][0]["_id"],
                    'password' => $data['data'][0]["_password"]
                ];
            }
            else{
                return !1;
            }

            
        }

                
        public function _chek_identifier($_identifier){

            $data = $this -> _query(" SELECT _id ,_password FROM t_cityHallAdministrators WHERE _identifier = '$_identifier' ");

            if($data['status'] == !0){

                return [
                    'status' => !0,
                    'id' => $data['data'][0]["id"],
                    'password' => $data['data'][0]["_password"]
                ];
            }
            else{
                return !1;
            }

            
        }

        public function _get_pass_by_identifier($_identitifier){
            $data = $this -> _query(" SELECT password FROM t_cityHallAdministrators WHERE _identifier = '$_identitifier' ");

            if(count($data['data']) == 1){

                return [
                    'status' => !0,
                    'password' => $data['data'][0]["_password"]
                ];
            }
            else{
                return ['status'=> !1];
            }
        }

        public function _connexion($_data){

            $pass = $_data['_password'];
            $pseudo = $_data['_identifier'];

            $get_password = $this->_query("SELECT * FROM t_cityHallAdministrators WHERE _identifier = '$pseudo'");

            if($get_password['status'] == !0 && count($get_password['data']) == 1){
                $hash = $get_password['data'][0]['_password'];

                $chek = (new Password())->_verify($pass, $hash);

                if($chek == !0){
                    return [
                        'status' => !0,
                        'user' => $get_password['data'][0]
                    ];
                }
                else{
                    return [
                        'status' => !1,
                        'error' => 'INVALIDE_PASS'
                    ];
                }
            }else{
                return [
                    'status' => !1,
                    'error' => 'INVALIDE_USER'
                ];
            }
        }


        public function _get_id( $_uuid ){
        
            $data = $this -> _query(" SELECT _id FROM t_cityHallAdministrators WHERE _uuid = '$_uuid' ");

            if($data['status'] == !0){
                return [
                    'status' => !0,
                    'id' => $data['data'][0]["_id"]
                ];
            }
        }

        public function _enable_admin( $_data ){
        
            $data = $this -> _execute("UPDATE  t_cityHallAdministrators SET _access_level = 'editor' WHERE _id = :_id ", [
                ":_id" => $_data['_id'],
                
            ]);

            if($data['status'] == !0){
                return [
                    'status' => !0,
                    'id' =>  $_data['_id']
                ];
            }
            else{
                return [
                    'status' => !1
                ];
            }
        }

        public function _disable_admin( $_data ){
        
            $data = $this -> _execute("UPDATE  t_cityHallAdministrators SET _access_level = 'reader' WHERE _id = :_id ", [
                ":_id" => $_data['_id'],
                
            ]);

            if($data['status'] == !0){
                return [
                    'status' => !0,
                    'id' => $_data['_id']
                ];
            }
        }
    }
