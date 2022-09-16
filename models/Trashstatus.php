<?php 
namespace models;

use core\DB;

require_once('../core/autoloader.php');


class Trashstatus extends DB{
    public function __construct()
    {
        parent::__construct();
    }

    public function _insert($_data){
                                 
        $insert = $this-> _execute("INSERT INTO t_trashStatus ( _full_level, _trash) VALUES ( :_full_level, :_trash )", 
        [
            ':_full_level' => $_data['_full_level'],
            ':_trash' => $_data['_trash']
        ]);
        
        if($insert){
            return [
                'status' => !0,
            ];
        }
        else{
            return [
                'status' => !1,                  
            ];
        }
    }





    public function _get(){
        
        $data = $this -> _query("  SELECT t_trashStatus._sent_at, t_trashStatus._full_level, t_trashs.* FROM t_trashStatus INNER JOIN t_trashs ON t_trashStatus._trash = t_trashs._id  ORDER BY t_trashStatus._sent_at ");

        if($data['status'] == !0){
            return [
                'status' => !0,
                'data' => $data['data']
            ];
        }
    }


    public function _get_id( $_uuid ){
        
        $data = $this -> _query(" SELECT _id FROM t_trashStatus WHERE _uuid = '$_uuid' ");

        if($data['status'] == !0){
            return [
                'status' => !0,
                'data' => $data['data'][0]["_id"]
            ];
        }
    }


    public function _getById($_id){
        
        $data = $this -> _query(" SELECT t_trashStatus._sent_at, t_trashStatus._full_level, t_trashs.* FROM t_trashStatus INNER JOIN t_trashs ON t_trashStatus._trash = t_trashs._id   WHERE t_trashs._id = $_id ORDER BY t_trashStatus._sent_at ");

        if($data['status'] == !0){
            return [
                'status' => !0,
                'data' => $data['data']
            ];
        }
    }

    public function _getByTrash($_id){
        
        $data = $this -> _query(" SELECT t_trashStatus._sent_at, t_trashStatus._full_level, t_trashs.* FROM t_trashStatus INNER JOIN t_trashs ON t_trashStatus._trash = t_trashs._id   WHERE t_trashs._trrash = $_id ORDER BY t_trashStatus._sent_at ");

        if($data['status'] == !0){
            return [
                'status' => !0,
                'data' => $data['data']
            ];
        }
    }


    public function _get_last_five($_id){
        
        $data = $this -> _query(" SELECT * FROM t_trashStatus  ORDER BY _sent_at DESC limit 5  ");

        if($data['status'] == !0){
            return [
                'status' => !0,
                'data' => $data['data']
            ];
        }
    }

}




?>