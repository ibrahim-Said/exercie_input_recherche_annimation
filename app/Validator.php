<?php

namespace app;


class Validator
{
    public $data;
    public $errors;
    public function __construct($data){
        $this->data=$data;
    }
    private function getFile($key){
        if(isset($this->data[$key])){
            return $this->data[$key];
        }
        else{
            return null;
        }
    }
    public function isAlpha($key,$message){
      if(empty($this->getFile($key)) || !preg_match('/^[a-zA-Z0-9- ]+$/',$this->getFile($key)) ){
          $this->errors[$key]=$message;
      }
    }
    public function isNum($key,$message){
        if(empty($this->getFile($key)) || !preg_match('/^[0-9]+$/',$this->getFile($key)) || $this->getFile($key)>100 || $this->getFile($key)<0){
            $this->errors[$key]=$message;
        }
    }
    public function isTel($key,$message){
        if(empty($this->getFile($key)) || !preg_match('/^[0-9+]+$/',$this->getFile($key)) ){
            $this->errors[$key]=$message;
        }
    }
    public function isEmail($key,$message){
        if(empty($this->getFile($key)) || !filter_var($this->getFile($key),FILTER_VALIDATE_EMAIL)){
            $this->errors[$key]=$message;
        }
    }
    public function isValide(){
        return empty($this->errors);
    }
    public function getErrors(){
        return $this->errors;
    }
}