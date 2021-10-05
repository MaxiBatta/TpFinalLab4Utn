<?php

namespace Models;

Class Carrer
{
    private $name;
    private $description;
    private $active;


    public function getName()
    {
        return $this->name;
    }
    public function setName($name)
    {
        $this->name= $name;
    }

    public function getDescription()
    {
        return $this->description;
    }
    public function setDescription($description)
    {
        $this->description= $description;
    }
    public function getActive()
    {
        return $this->active;
    }
    public function setActive($active)
    {
        $this->active= $active;
    }









}



?>