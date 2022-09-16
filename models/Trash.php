<?php 
namespace models;

use core\DB;

require_once('../core/autoloader.php');


class Trash extends DB{
    public function __construct()
    {
        parent::__construct();
    }

    public function _insert($_data){
        
        $insert = $this-> _execute("INSERT INTO t_trashs(_uuid, _longitude, _latitude,_address,_name) VALUES ( :_uuid, :_longitude, :_latitude, :_address ,:_name)", 
        [
            ':_uuid' => $_data['_uuid'],
            ':_longitude' => $_data['_longitude'],
            ':_name' => $_data['_name'],
            ':_latitude' => $_data['_latitude'],
            ':_address' => $_data['_address']
        ]);
       
        if($insert['status'] == !0){
            return [
                'status' => !0,
                'id' => $this->_getId($_data['_uuid'])['id']
            ];
        }
        else{
            return [
                'status' => !1, 
                'error' => $insert['error']                 
            ];
        }
    }


    public function _associate($_data){
        
        $insert = $this-> _execute("INSERT INTO t_trashsCityHalls(_city_hall, _trash) VALUES ( :_city_hall, :_trash)", 
        [
            ':_city_hall' => $_data['_city_hall'],
            ':_trash' => $_data['_trash']
        ]);

        if($insert['status'] == !0){
            return [
                'status' => !0,
                'id' => $this->_getId($_data['_uuid'])['id']
            ];
        }
        else{
            return [
                'status' => !1, 
                'error' => $insert['error']                 
            ];
        }

    }



    public function _update($_data){
                                 
        $update = $this-> _execute("UPDATE   t_trashs SET _uuid = :_uuid, _longitude = :_longitude, _latitude = :_latitude, _address = :_address, _name = :_name WHERE _id = :_id", 
        [
            ':_uuid' => $_data['_uuid'],
            ':_longitude' => $_data['_longitude'],
            ':_latitude' => $_data['_latitude'],
            ':_name' => $_data['_name'],
            ':_address' => $_data['_address'],
            ':_id' => $_data['_id']
        ]);
        
        if($update['status'] == !0){
            return [
                'status' => !0,
            ];
        }
        else{
            return [
                'status' => !1, 
                'error' => $update['error']                 
            ];
        }
    }


    
    public function _delete($_id){
        
        $status = $this -> _query(" SELECT COUNT(_id) AS _count FROM t_trashStatus WHERE _trash = $_id ");

        if(count($status['data'][0]['_count']) > 0) $this -> _query(" DELETE FROM t_trashStatus WHERE _trash = $_id ");
        
        $delete = $this -> _query(" DELETE FROM t_trashs WHERE _id = $_id ");

        if($delete){
            return [
                'status' => !0,
                
            ];
            
        }
        else return [
            'status' => !1,
            'error' => $delete['error']  
        
        ];
    }


    public function _get(){
        
        $data = $this -> _query(" SELECT * FROM t_trashs ");

        if($data['status'] == !0){
            return [
                'status' => !0,
                'data' => $data['data']
            ];
        }
    }
    

    public function _getId( $_uuid ){
        
        $data = $this -> _query(" SELECT _id FROM t_trashs WHERE _uuid = '$_uuid' ");

        if($data['status'] == !0){
            return [
                'status' => !0,
                'id' => $data['data'][0]["_id"]
            ];
        }
    }

    public function _getByCityHall( $_city ){
        
        $data = $this -> _query(" SELECT _id FROM t_programs WHERE  = '$_city' ");

        if($data['status'] == !0){
            return [
                'status' => !0,
                'id' => $data['data'][0]["_id"]
            ];
        }
    }

    public function _getByTidd(  ){
        
        $data = $this -> _query(" SELECT _id FROM t_programs WHERE   ");

        if($data['status'] == !0){
            return [
                'status' => !0,
                'id' => $data['data'][0]["_id"]
            ];
        }
    }

    public function _getByName($_name){
        
        $data = $this -> _query(" SELECT * FROM t_programs WHERE _name LIKE '$_name' ");

        if($data['status'] == !0){
            return [
                'status' => !0,
                'data' => $data['data']
            ];
        }
    }

    public function _getById($_id){
        
        $data = $this -> _query(" SELECT * FROM t_trashs WHERE _id = $_id ");

        if($data['status'] == !0){
            return [
                'status' => !0,
                'data' => $data['data']
            ];
        }
    }

}




?>