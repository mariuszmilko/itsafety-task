<?php

namespace App\Reports\Sheets\Tracks\Model;


class Track 
{
   protected $parameters = [];
   protected $config;

   public function __construct($config)
   {
       $this->config = $config;
   }
   
   public function getParameter($name) 
   {
        if (!isset($this->parameters[$name])) 
            throw new Exception('Błędna nazwa parametru');
        
        return $this->parameters[$name];
   }

   public function getParameters() 
   {
        return $this->parameters;
   }

   public function processPoint($point)
   {
      return $config->generate($point, $this->parameters);
   }

}
