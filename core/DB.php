<?php

    /*
    * 
    * Auteur : ABOTCHI Kodjo Mawugno
    * 
    *Connexion a la base de données 
    * date : 2022-08-15
    *
    */
    namespace core;

    require_once("../Env.php"); 
    
   use Env;
    use Exception;

    class DB extends \PDO
    {
        private $_error;
       
        public function __construct()
        {  
            $env = (new Env())->_db();
           
            $db_name =$env['db_name'];
            $db_user =  $env['db_user'];
            $db_password =  $env['db_password'];
            
           

            
            try{
                

                $pdo_options[\PDO::ATTR_ERRMODE] = \PDO::ERRMODE_EXCEPTION;

                parent::__construct("mysql:host=localhost;dbname=$db_name", $db_user , $db_password , $pdo_options );
                
                
            }
            catch(\Exception $e)
            {
                die("Error : ".$e->getMessage()) ;

            }
        }


        public function _query( String $_request, String $_fetch_option = \PDO::FETCH_ASSOC ){
                        
            $req = $this -> prepare($_request);

            try{
               $req -> execute();

               return [
                    'status' => !0,
                    'data' => $req->fetchAll($_fetch_option)
                ];
            }
            catch(Exception $e){
                $this->_error = $e->getCode();

                return [ 
                    'status' => !1,
                    'error' => $e->getCode()
                ];

            }

           
        }

        public function _execute($_request, $_values ){

            $req = $this->prepare( $_request );

            try{
               $req->execute($_values);

               return [
                'status' => 1,
                
                ];


            }
            catch(Exception $e) {
                $this->_error = $e->getCode();

                return [
                    'status' => 0,
                    'error' => $e->getMessage()
                ];
            }
            

        
        }


    }

?>