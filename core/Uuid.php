<?php

    /*
    * 
    * Auteur : ABOTCHI Kodjo Mawugno
    *
    * Uuid 
    * date : 2022-08-15
    *
    */
    namespace core;
    
    class Uuid{
        protected $_data;

        public function __construct($_data = null){
            
            $this ->_data = $_data;
            
        }

        public function _uuid(){
            // Generate 16 bytes (128 bits) of random data or use the data passed into the function.
            $data = $this ->_data ?? random_bytes(16);
            assert(strlen($data) == 16);
        
            // Set version to 0100
            $data[6] = chr(ord($data[6]) & 0x0f | 0x40);
            // Set bits 6-7 to 10
            $data[8] = chr(ord($data[8]) & 0x3f | 0x80);
        
            // Output the 36 character UUID.
            return vsprintf('%s%s-%s-%s-%s-%s%s%s', str_split(bin2hex($data), 4));
        }

       
    }
