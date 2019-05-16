<?php

class Comment {

    public function __construct($name, $text) {
        $this->name = $name; 
        $this->text = $text; 
    }

    public function __toString(){
        return $this->name . $this->text;
    }
}
?>