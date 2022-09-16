<?php
   /*
    * Auteur : ABOTCHI Kodjo Mawugno
    * 
    * Fichier .
    * date : 2022-07-30
    *
    */

    class Env{

        private array $_api;
        
        protected $_db_name;
        protected $_db_user;
        protected $_db_password;


        public function __construct(

            //demarage de le session 
            
            
            // Le nom de la base de donnée
            $_db_name = "Douaneko",

            // L'utilisateur de la base de donnée
            $_db_user = "root",
            
            // Le mot de passe de la base de donnée
            $_db_password =  "root"
            
            
            ){
                

            $this->_db_name = $_db_name;
            $this->_db_user = $_db_user;
            $this->_db_password = $_db_password;

            $this->_set_api();
        }

        public function _db(){

            
            return [
                "db_name" => $this->_db_name,
                "db_user" => $this->_db_user,
                "db_password" => $this->_db_password
            ];


        }





       

        /**
         * Get the value of _api
         */ 
        public function _get_api()
        {
                return $this->_api;
        }

        /**
         * Set the value of _api
         *
         * @return  self
         */ 
        public function _set_api($_api = [
            "name" => 'douaneko_api',
            "version" => '1.0.'
        ])
        {
                $this->_api = $_api;

                return $this;
        }


        public function _getTokenKey(){
            return "auchechefdedecide";
        }
    }




   


    

    
   
?>    
