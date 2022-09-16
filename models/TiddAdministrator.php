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

    class TiddAdministrator extends DB {

        public function __construct(){

            parent::__construct();
            
        }

        public function _insert($_data){
                                 
            $insert = $this-> _execute("INSERT INTO t_tiddAdministrators(_uuid, _last_name, _first_name, _email, _identifier, _password, _telephone ) VALUES ( :_uuid, :_last_name, :_first_name, :_email, :_identifier, :_password, :_telephone )", 
            [
                ':_uuid' => $_data['_uuid'],
                ':_last_name' => $_data['_last_name'],
                ':_first_name' => $_data['_first_name'],
                ':_email' => $_data['_email'],
                ':_identifier' => $_data['_identifier'],
                ':_password' => $_data['_password'],
                ':_telephone' => $_data['_telephone']

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
        
            $data = $this -> _query(" SELECT * FROM t_tiddAdministrators ");

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

            $updated = $this-> _execute("UPDATE  t_tiddAdministrators SET  _last_name = :_last_name, _first_name = :_first_name , _email = :_email, _identifier  = :_identifier, _password = :_password, _access_level = :_access_level, _telephone = :_telephone WHERE _id = :_id", 
            [
                ":_id" => $_data['_id'],
                ':_last_name' => $_data['_last_name'],
                ':_first_name' => $_data['_first_name'],
                ':_access_level' => $_data['_access_level'],
                ':_email' => $_data['_email'],
                ':_identifier' => $_data['_identifier'],
                ':_password' => $_data['_password'],
                ':_telephone' => $_data['_telephone']

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
            $updated = $this-> _execute("DELETE FROM t_tiddAdministrators WHERE _id = :_id", 
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
            $disable = $this->_query("UPDATE t_tiddAdministrators SET _status = 'invalide' WHERE _id = $id");

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
            $disable = $this->_query("UPDATE t_tiddAdministrators SET _status = 'valide' WHERE _id = $id");

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

            $data = $this->_query("SELECT * FROM t_tiddAdministrators WHERE _id = $_id");

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

        public function _getByMail($_email){

            $data = $this->_query("SELECT * FROM t_tiddAdministrators WHERE _email = '$_email'");

            return $data['data'];
        }
        
        public function _chekEmail($_email){

            $data = $this -> _query(" SELECT _id, _password  FROM t_tiddAdministrators WHERE _email = '$_email' ");

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

            $data = $this -> _query(" SELECT _id ,_password FROM t_tiddAdministrators WHERE _identifier = '$_identifier' ");

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
            $data = $this -> _query(" SELECT password FROM t_tiddAdministrators WHERE _identifier = '$_identitifier' ");

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
            $email = $_data['_email'];

            $get_password = $this->_query("SELECT * FROM t_tiddAdministrators WHERE _email = '$email'");

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
                        
                    ];
                }
            }else{
                return [
                    'status' => !1,
                   
                ];
            }
        }


        public function _get_id( $_uuid ){
        
            $data = $this -> _query(" SELECT _id FROM t_tiddAdministrators WHERE _uuid = '$_uuid' ");

            if($data['status'] == !0){
                return [
                    'status' => !0,
                    'id' => $data['data'][0]["_id"]
                ];
            }
        }

        public function _enable_admin( $_data ){
        
            $data = $this -> _execute("UPDATE  t_tiddAdministrators SET _access_level = 'editor' WHERE _id = :_id ", [
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
        
            $data = $this -> _execute("UPDATE  t_tiddAdministrators SET _access_level = 'reader' WHERE _id = :_id ", [
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
