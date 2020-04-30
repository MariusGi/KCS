<?php

class Man 
{
    public $firstName;
    public $lastName;

    public function greet()
    {
        echo 'Hello ' . $this->firstName . ' ' . $this->lastName;
    }
}

$man = new Man();
$man->firstName = "Marius";
$man->lastName = "Girnis";
$man->greet();