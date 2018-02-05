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

   public function getDateAggData(&$trackParameters)
   {
        foreach ($this->aggregates as $agg)
        {
            if ($agg->type && $agg->lastaware) {
                $p = &$trackParameters['end'][$agg->class];
                $p->calculate(['value' => $this->data['end_date']]); //const in map
                return true;
            }
        }
        return false;
   }

   public function extractDate($track)
   {
//        //  ["end"]=>
//   array(1) {
//     ["App\Reports\Sheets\Tracks\Config\Parameters\EndDate"]=>
//     object(App\Reports\Sheets\Tracks\Config\Parameters\EndDate)#31 (2) {
//       ["endDate":protected]=>
//       string(19) "2018-01-19 05:48:59"
//       ["last":protected]=>
//       bool(false)
//     }
 // }
     //  $track->updateOnEnd()
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