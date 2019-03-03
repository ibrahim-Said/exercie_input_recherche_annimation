<?php

namespace app;


class Form
{
public $data;
public function __construct($data){
    $this->data=$data;
}
public function input($type,$name){
    if($type==='textarea'){
        return '<p><div class="form-group"><textarea name="'.$name.'" class="form-control" placeholder="'.$name.'...">'.$this->getValue($name).'</textarea></div></p>';
    }
    else{
        return '<p><div class="form-group"><input type="'.$type.'" value="'.$this->getValue($name).'" name="'.$name.'" placeholder="'.$name.'..." class="form-control"></div></p>';
    }
}
public function submit($name){
    return '<button type="submit" class="btn btn-primary" name="'.$name.'">'.$name.'</button>';
}
public function getValue($key){
    if(isset($this->data[$key])){
        return $this->data[$key];
    }
    else{
        return null;
    }
}
}