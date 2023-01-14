<?php
namespace classes;

class Person {
    private $current_year;

    function __construct() {
        $this->current_year=date('Y'); 
    }

    function get_age($birth_year) {
        return $this->current_year - $birth_year;
    }
}