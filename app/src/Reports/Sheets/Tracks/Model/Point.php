<?php

namespace App\Reports\Sheets\Tracks\Model;

class Point //interface IPoint
{ 
    protected $oMap;
    protected $filterDictionary;
    protected $aggDictionary;
    protected $filters;
    protected $aggregates;
    protected $data;
    
    public function __construct($data, $oMap, $filterDictionary, $aggDictionary)
    {
        $this->oMap = $oMap;
        $this->filterDictionary = $filterDictionary;
        $this->aggDictionary = $aggDictionary;
        $this->filters = $this->oMap->filters;
        $this->aggregates = $this->oMap->aggregates;
        $this->data = $data;
    }

   public function delimiter()
   {   //to Ireator
       foreach ($this->filters as $fMap){
            $filter = $this->filterDictionary->get($fMap->class);
     
            if (isset($this->data[$fMap->rowname]) && 
            isset($filter) && 
            $filter->filter(['value' => $this->data[$fMap->rowname]]) &&
            isset($fMap->delimiter)) {
                return $fMap->delimiter; //$this->data[$fMap->rowname];
            }
        }
        throw new \Exception('Brak delimitera w mapie');
   }
   
   public function filtering(&$parameters) //$context  ->get callable
   {    //to Ireator
        foreach ($this->filters as $fMap){
            $filter = $this->filterDictionary->get($fMap->class);
    
        //TODO:extract aggrgeates on type filter conditional
            if (isset($this->data[$fMap->rowname]) && 
                isset($filter) && 
                $filter->filter(['value' => $this->data[$fMap->rowname]])) {

                foreach ($this->aggregates  as $gMap) {  
                    if ($gMap->type == $fMap->type) {
                        $type = $fMap->type;
                    } else {
                        continue;
                    }
            //TODO://method aggPrametersValues(&$parameters, $aggDictionary, $type, $clazz)
                    if (isset($parameters[$type][$gMap->class])) {
                        $agg = $parameters[$type][$gMap->class];// = $this->data[$gMap->rowname];
                    //    $agg->calculate(['value' => $this->data[$gMap->rowname], 'index' => 1]); 
                    } else {
                        $agg = $this->aggDictionary->get($gMap->class);  

                        $parameters[$type][$gMap->class] = $agg;
                      //  $agg->calculate(['value' => $this->data[$gMap->rowname], 'index' => 1]); 
                        //$parameters[$type][$gMap->class]->calculate(['value' => $this->data[$gMap->rowname], 'index' => 1]);
                    }
            
                    $agg->calculate(['value' => $this->data[$gMap->rowname], 'index' => 1]); // $point->value 
                }
            }
        }

       return $this;
   }

   public function extractDate()
   {
       return $this->data['start_date'];
   }
   
   public function getData()
   {
       return $this->data;
   }

   public function resetOnDelimiter()
   {

   }
}