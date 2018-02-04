<?php

namespace App\Reports\Sheets\Tracks\Model;


class Track 
{
   protected $parameters = [];
   //TrackContext

   public function __construct()
   {
       $this->parameters = [];
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
       return $point->filtering($this->parameters)->getData();
   }

}
