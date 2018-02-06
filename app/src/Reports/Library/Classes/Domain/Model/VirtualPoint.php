<?php

namespace App\Reports\Library\Classes\Domain\Model;




//to consider
class VirtualPoint
{ 
    private $point;
   
    
  public function __construct($point)
  {
        $this->point = $point;
  }



   public function delimiter()
   {   //to Ireator
      $this->point->delimiter();
   }
   


   public function filtering(&$parameters) //$context  ->get callable
   {    //to Ireator

       return $this;
   }



   public function extractDate()
   {
       return $this->date['start_date'];
   }
   


   public function getData()
   {
       return $this->data;
   }



   public function resetOnDelimiter()
   {

   }
}