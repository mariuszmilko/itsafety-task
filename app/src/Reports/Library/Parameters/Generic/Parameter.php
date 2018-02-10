<?php

namespace App\Reports\Library\Parameters\Generic;


abstract class Parameter
{
   protected $rowname;
   protected $name;


   public function setRowname($rowname)
   {
      $this->rowname = $rowname;
   }

   public function getRowname()
   {
      return $this->rowname;
   }

   public function setName($name)
   {
      $this->name = $name;
   }

   public function getName()
   {
       return $this->name;
   }

}