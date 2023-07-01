<?php

class User
{
    public $id;
    public $first_name;
    public $last_name;
    public $email;

    public function __construct($id, $first_name, $last_name, $email)
    {
        $this->id = $id;
        $this->first_name = $first_name;
        $this->last_name = $last_name;
        $this->email = $email;
    }
}