<?php

class Comment {

    public function __construct($ip, $username, $email, $date, $time, $text) {
        $this->ip = $ip;
        $this->username = $username; 
        $this->email = $email;
        $this->date = $date;
        $this->time = $time;
        $this->text = $text; 
    }

    public function __toString(){
        $string = $this->ip . $this->username . $this->email . $this->date . $this->time . $this->text;
        return $string;
    }
}
?>