<?php
    /*
    * Stagaires TIDD 2022
    * Auteur : ABOTCHI Kodjo Mawugno
    * Douaneko  
    * Fichier 
    * date : 2022-07-30
    *
    */
    namespace models;
    
    require_once("../core/DB.php");
    use \core\DB;

    class Media extends DB{
        public function __construct(){

            parent::__construct();
            
        }

        public function _insert($_data)
        {
            
            
            $insert = $this ->_execute(
                "INSERT INTO t_media(_uuid, _type, _extension, _size, _name ) VALUES (:_uuid, :_type, :_extension, :_size, :_name)",
                [
                    ':_uuid' => $_data['_uuid'], 
                    ':_type' => $_data['_type'], 
                    ':_extension' => $_data['_extension'], 
                    ':_size' => $_data['_size'],
                    ':_name' => $_data['_name']
                ]
            );

            if($insert['status'] == !0){
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
            
        public function _get()
        {
            $req = $this->_query(" SELECT * FROM t_media");
            

            if($req)
            {
                $response = ['status' => !0,
                            'media' => $req['data']
                ];   
            }
            else{
                $response = ['status' => !1 ];
                    
            }

            return $response;
        }

        public function _delete($_id)
        {
            $req = $this->_execute("DELETE FROM  Media WHERE id = :id", [':id ' => $_id]);
        

            if($req)
            {
                return  !0 ;
            }
            else{
                return ;        
            }

        
        }


        public function _getId( $_uuid ){
        
            $data = $this -> _query(" SELECT _id FROM t_media WHERE _uuid = '$_uuid' ");
    
            if($data['status'] == !0){
                return [
                    'status' => !0,
                    'id' => $data['data'][0]["_id"]
                ];
            }
        }

        public function _getById($_id){

            $data = $this -> _query(" SELECT CONCAT(_name, '.', _extension) AS _image FROM t_media WHERE _id = $_id ");

            return $data['data'][0]['_image'];
        }
    }