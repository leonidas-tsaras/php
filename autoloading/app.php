<?php
use classes\Person;

spl_autoload_register(function($classname){
  include_once str_replace("\\", "/", $classname) . ".php";
});

$person = new Person();
echo $person->get_age(2000);