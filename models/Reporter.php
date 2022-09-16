<?php
    /*
    * Stagaires TIDD 2022
    * Auteur : ABOTCHI Kodjo Mawugno
    * Douaneko
    * Model Reporter ( signaleur) 
    * date : 2022-08-24
    *
    */
    namespace  models;
    require_once("../core/autoloader.php");

    use \core\DB;
    use core\Password;

    class Reporter extends DB{

        public function __construct()
        {
            parent::__construct();
        }

        public function _insert(Array $_data){

            $insert =  $this-> _execute("INSERT INTO t_reporters(_uuid, _last_name, _first_name, _email, _pseudo, _password, _city, _telephone ) VALUES ( :_uuid, :_last_name, :_first_name, :_email, :_pseudo, :_password, :_city, :_telephone )", 
            [
                ':_uuid' => $_data['_uuid'],
                ':_last_name' => $_data['_last_name'],
                ':_first_name' => $_data['_first_name'],
                ':_email' => $_data['_email'],
                ':_pseudo' => $_data['_pseudo'],
                ':_password' => $_data['_password'],
                ':_city' => $_data['_city'],
                ':_telephone' => $_data['_telephone']

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

            $update =  $this-> _execute(" UPDATE t_reporters SET _uuid = :_uuid, _last_name = :_last_name, _first_name = :_first_name, _email = :_email, _pseudo = :_pseudo, _password = :_password, _city = :_city, _telephone = :_telephone , _updated_at = :_updated_at WHERE _id = :_id", 
            [
                ':_uuid' => $_data['_uuid'],
                ':_last_name' => $_data['_last_name'],
                ':_first_name' => $_data['_first_name'],
                ':_email' => $_data['_email'],
                ':_pseudo' => $_data['_pseudo'],
                ':_password' => $_data['_password'],
                ':_city' => $_data['_city'],
                ':_telephone' => $_data['_telephone'],
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
            $disable = $this->_query("UPDATE t_reporters SET _status = 'invalide' WHERE _id = $id");

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
            $disable = $this->_query("UPDATE t_reporters SET _status = 'valide' WHERE _id = $id");

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

            $data = $this -> _query(" SELECT * FROM t_reporters ");

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

            $data = $this -> _query(" SELECT _id FROM t_reporters WHERE _uuid = '$_uuid' ");

            if($data['status'] == !0){
                return [
                    'status' => !0,
                    'id' => $data['data'][0]["_id"]
                ];
            }
        }

        public function _getById(Array $_data){
            $id = $_data['_id'];
            $data = $this -> _query(" SELECT * FROM t_reporters WHERE _id = $id");

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

        //connexion à la plateforme mobile

        public function _connexion(Array $_data){
            $pass = $_data['_password'];
            $tel = $_data['_telephone'];

            $get_password = $this->_query("SELECT *  FROM t_reporters WHERE _telephone = $tel");

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
                        'status' => !1
                    ];
                }
            }else{
                return [
                    'status' => !1,
                ];
            }
        }

        
    }