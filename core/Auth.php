<?php
    /*
    * Stagaires TIDD 2022
    * Auteur : ABOTCHI Kodjo Mawugno
    * Douaneko
    * Model Reporter ( signaleur) 
    * date : 2022-08-24
    *
    */
    namespace  core;
    require_once("../vendor/autoload.php");
    use Firebase\JWT\JWT;
    use Firebase\JWT\Key;
    require_once("../core/autoloader.php");
    use core\DB;
    use Env;

    class Auth  {
      private $_data;
      private $_token;
      

      public function __construct($_token = "", $_data = [])
      {
        $this->_token = $_token;
        $this->_data = $_data;
      }


        public function _gen( $validity = 0){

            $payload = [
                'iss' => 'localhost',
                'aud' => 'localhost',
                'iat' => time(),
                'exp' => time() + $validity, //1000*1440
                'data' => $this->_data
    
            ];
    
           
           return JWT::encode($payload,(new Env())->_getTokenKey(), 'HS256');
           
        }
        
        public function _extract(){
          $tknArray = explode('.', $this->_token);
          $head = json_decode(base64_decode($tknArray[0]),true );
          $payload = json_decode(base64_decode($tknArray[1]),true );

          $expir = json_decode(base64_decode($tknArray[1]),true )['exp'];
          $payload = json_decode(base64_decode($tknArray[1]),true )['data'];
          $user = $payload['user'];
          $data = $payload['data'];

          return [
              "exp" => $expir,
              "user" => $user,
              "data" => $data

          ];

        }

        public function _checkToken() {

            $expir = $this->_extract()['exp'];

            $time = time();
            
            if($expir > $time){
              return  !0;
            }
            else{
               return !1;
            }
        }

        public function _user(){
          $user = $this->_extract()['user'];

          return $user;
        }

        public function _access(){
          $user = $this->_extract()['data']['_access_level'];

          return $user;
        }

        public function _cityHall(){
          $user = $this->_extract()['data']['_city_hall'];

          return $user;
        }

        public function _id(){
          $user = $this->_extract()['data']['_id'];

          return $user;
        }


        /*



                public function _isValide($token){
          $tknArray = explode('.', $token);
            $head = json_decode(base64_decode($tknArray[0]),true );
            $payload = json_decode(base64_decode($tknArray[1]),true );

            $expir = json_decode(base64_decode($tknArray[1]),true )['exp'];
            $user = json_decode(base64_decode($tknArray[1]),true )['data']['user'];
            $data =  json_decode(base64_decode($tknArray[1]),true )['data'];

            $verifyToken = $this->_gen($data,0);

            if($verifyToken == $token){
              return [
                'status'=> !0,
                'exp' => $expir
              ];
            }
            else{
              return [
                'stauts'=> !1
              ];
            }
        }

        public function _checkToken(string $token) {
            
          if($this->_isValide($token)['status'] == !1)return !1;
          $expir = $this->_isValide($token)['exp'];

            $time = time();
            
            if($expir > $time){
              return  !0;
            }
            else{
               return !1;
            }
        }*/
    }

