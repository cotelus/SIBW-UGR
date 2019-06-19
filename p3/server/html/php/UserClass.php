<?php

class User {

    public function __construct($email, $userId, $name, $type) {
        $this->email = $email;	
        $this->userId = $userId;
        $this->name = $name;
        $this->type = $type;
    }

    public function __toString(){
        $string = $this->email . $this->userId . $this->name . $this->type;
        return $string;
    }
}
?>