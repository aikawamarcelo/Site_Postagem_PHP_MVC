<?php

abstract class Connection{
    
    // Quando uma classe é abstrata deve-se usar o self.
    
    private static $conn;

    public static function getConn(){
    
        if(self:: $conn == null){
           self:: $conn = new PDO('mysql: host=localhost; dbname=site_postagens;', 'root', '');
        }
    
        return self:: $conn;
    
}

}

?>