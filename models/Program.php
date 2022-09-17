<?php 
namespace models;

use core\DB;

require_once('../core/autoloader.php');


class Program extends DB{
    public function __construct()
    {
        parent::__construct();
    }

    public function _insert($_data){
        
        $insert = $this-> _execute("INSERT INTO t_programs(_uuid, _execution_date, _place,_name) VALUES ( :_uuid, :_execution_date,  :_place ,:_name)", 
        [
            ':_uuid' => $_data['_uuid'],
            ':_execution_date' => $_data['_execution_date'],
            ':_name' => $_data['_name'],
            ':_place' => $_data['_place']
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
        
        $insert = $this-> _execute("INSERT INTO t_programsCityHalls(_city_hall, _program) VALUES ( :_city_hall, :_program)", 
        [
            ':_city_hall' => $_data['_city_hall'],
            ':_program' => $_data['_program']
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
                                 
        $update = $this-> _execute("UPDATE   t_programs SET _uuid = :_uuid, _execution_date = :_execution_date, _executed_by = :_executed_by, _place = :_place, _name = :_name, _status = :_status WHERE _id = :_id", 
        [
            ':_uuid' => $_data['_uuid'],
            ':_execution_date' => $_data['_execution_date'],
            ':_executed_by' => $_data['_executed_by'],
            ':_name' => $_data['_name'],
            ':_status' => $_data['_status'],
            ':_place' => $_data['_place'],
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
        


        $delete = $this -> _query(" DELETE FROM t_programs WHERE _id = $_id ");

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
        
        $data = $this -> _query(" SELECT * FROM t_programs ");

        if($data['status'] == !0){
            return [
                'status' => !0,
                'data' => $data['data']
            ];
        }
    }
    

    public function _getId( $_uuid ){
        
        $data = $this -> _query(" SELECT _id FROM t_programs WHERE _uuid = '$_uuid' ");

        if($data['status'] == !0){
            return [
                'status' => !0,
                'id' => $data['data'][0]["_id"]
            ];
        }
    }

    public function _getByCityHall( $_city ){
        
        $data = $this -> _query(" SELECT t_programs.*, t_cityHalls._name as _cityHall FROM t_programs INNER JOIN t_programsCityHalls ON t_programs._id =  t_programsCityHalls._program INNER JOIN t_cityHalls ON t_cityHalls._id = t_programsCityHalls._city_hall WHERE  t_programsCityHalls._city_hall= '$_city' ");

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
        
        $data = $this -> _query(" SELECT * FROM t_programs WHERE _id = $_id ");

        if($data['status'] == !0){
            return [
                'status' => !0,
                'data' => $data['data']
            ];
        }
    }

}




?>