<?php
namespace app;


class Session
{
    private static $_instance;
    public static function getinstance(){
        if(self::$_instance===null){
            self::$_instance=new Session();
        }
        return self::$_instance;
    }
    public function __construct()
    {
        session_start();
    }
    public function setFlush($key,$message){
        $_SESSION['flush'][$key]=$message;
    }
    public function hasFlush(){
        return !empty($_SESSION['flush']);
    }
    public function getFlush(){
        if(isset($_SESSION['flush'])) {
            $flush=$_SESSION['flush'];
            unset($_SESSION['flush']);
            return $flush;
        }else{
            return null;
        }

    }

}