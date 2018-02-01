<?php



public class AvgSpeed implements IAvg
{
   protected $sum = 0;
   protected $maxCount = 0;

    public function calculateAgg($parameters)
    {
        $this->sum += $parameters['value'];
        $this->index += $parameters['index'];
    }

    public function getCalculatedValue()
    {  
        return  $this->sum/$this->index;
    }

}