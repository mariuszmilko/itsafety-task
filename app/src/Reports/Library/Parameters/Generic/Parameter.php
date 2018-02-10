<?php

namespace App\Reports\Library\Parameters\Generic;


abstract class Parameter
{
   protected $rowname;


   public function setRowname($rowname)
   {
      $this->rowname = $rowname;
   }

   public function getRowname()
   {
      return $this->rowname;
   }

}