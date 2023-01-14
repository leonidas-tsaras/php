<?php
namespace market;

include_once("classes/person.php");

$person = new Person();
echo $person->get_age(2000);