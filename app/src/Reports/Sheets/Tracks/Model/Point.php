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
                    $this->aggPrametersValues($parameters, $type, $gMap->rowname, $gMap->class);
                }
            }
        }

       return $this;
    }




    private function aggPrametersValues(&$parameters, $type, $rowname, $clazz)
    {
        if (isset($parameters[$type][$clazz])) {
            $agg = $parameters[$type][$clazz];
        } else {
            $agg = $this->aggDictionary->get($clazz);  
            $parameters[$type][$clazz] = $agg;
        }

        $agg->calculate(['value' => $this->data[$rowname], 'index' => 1]);   
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
}