<?php
    /*
    * 
    * Auteur : ABOTCHI Kodjo Mawugno
    *  
    * 
    * date : 2022-08-15
    *
    */
    namespace core;

    class File{

        public function _uploade($_name, $_file, $_path){
            
            if($_file['error'] == !1  ){
                               
                $info = pathinfo($_file['name']) ;
                    
                $_file['name'] = $_name;

                if(move_uploaded_file($_file['tmp_name'], $_path."/" .$_name.'.'.$info['extension'])){

                    $file = [
                            "status" => !0,
                            "extension"  => $info['extension'],
                            "size" => $_file['size'],
                            "type" => explode("/", $_file['type'])[0]
                    ];

                }
                else{
                    echo "uploaded..path error Check path  " ;
                    $file["status"] = !1;
                                                                              
                }
                                       

            } 
            else{
                echo "error in file";
                $file["status"] = !1;
            }

            return  $file;
            
            
            
        }

        // Pour uploader plusieur fichier
        public function _multi_upload( $_file, $_path){
            
            $file = []; // array to return 

            for( $i = 0; $i < count($_file['name']); $i++){ //count the number of file sent

                if($_file['error'][$i]== !1  ){ //if we don't get error
                    
                    $_name = (new Uuid())-> _uuid(); // we generate an uuid as name of our current file to upload

                    $info = pathinfo($_file['name'][$i]) ;
                        
                    $_file['name'][$i] = $_name;

                   
    
                    if(move_uploaded_file($_file['tmp_name'][$i], $_path."/" .$_name.'.'.$info['extension'])){ // we just upload after all 
                        
                        $file[$i] = [
                                "status" => !0,
                                'uuid' => $_name,
                                "name" => $_name,
                                "extension"  => $info['extension'],
                                "size" => $_file['size'][$i],
                                "type" => explode("/", $_file['type'][$i])[0]
                        ];
                       

    
                    }
                    else{
                        
                        $file[$i] = [
                            "status" => !1,
                            "name" => $_name,
                            "extension"  => $info['extension'],
                            "size" => $_file['size'],
                            "type" => explode("/", $_file['type'][$i])[0]
                        ];
                                                                                  
                    }
                                           
    
                } 
                else{
                   
                    
                    $file[$i]["status"] = !1;
                }
            }

            return  $file;
              
        }
    }
?>    