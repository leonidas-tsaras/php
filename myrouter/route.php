<?php

class Route {

   private $_uri = [];

   public function add($uri) {
      $this->_uri[] = '/'.trim($uri, '/');
   }

   public function submit() {
      //$param = isset($_GET["uri"]) ? $_GET["uri"] : "/";

      return $_SERVER['REQUEST_URI'];
   }
}