<?php

class SessionFlash{

    private string $message ;

    public static function set(string $message){

        $_SESSION['message'] = $message ;

    }

    public static function get():string{

        $message = $_SESSION['message'] ;
        self::delete();
        return $message ;

    }

    public static function delete():void{

        unset( $_SESSION['message'] );
    
    }

    public static function exist():bool{

        return (isset($_SESSION['message']));

    }

}