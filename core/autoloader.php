<?php   
    /*
    * 
    * Auteur : ABOTCHI Kodjo Mawugno
    * 
    * 
    * date : 2022-08-15
    *
    */
    spl_autoload_register(function($_class){

        $class = str_replace("\\", "/", $_class);

        require_once("../".$class.".php");
    });


?>    