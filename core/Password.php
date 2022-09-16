<?php
    /*
    * 
    * Auteur : ABOTCHI Kodjo Mawugno
    * 
    * Mot de passe, verification , hashage , algo utilise : PASSWORD_BCRYPT
    * date : 2022-08-15
    *
    */
    namespace core;
    class Password {

        public function _hash(string $_password){
            $opt = [
                'cost' => 12,
            ];
            $hash = password_hash($_password, PASSWORD_BCRYPT, $opt);
        
            return $hash;
        }

        public function _verify( string $_password, string $_hash){
            
            if(!password_verify($_password, $_hash)) return !1;

            return !0;
        }
    }
    