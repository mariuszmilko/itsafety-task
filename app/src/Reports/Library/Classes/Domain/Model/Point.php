<?php

namespace App\Reports\Library\Classes\Domain\Model;

use stdClass;
use App\Reports\Library\Parameters\Generic\{IParameterAgg, IParameterFilter};
use App\Reports\Library\Classes\Domain\Model\Generic\Point\{IPointProcess, IPointUpdate};

/**
*  Elementary part of track
*/
class Point implements IPointProcess, IPointUpdate
{ 
    /** @var int Should contain a description if available */
    protected $delimiter;

    /** @var array Should contain a description if available */
    protected $data;
    
    /**
     * This method sets a description.
    *
    * @param array $description A text with a maximum of 80 characters.
    * @param int $description A text with a maximum of 80 characters.
    *
    * @constructor
    */
    public function __construct(array $data, $delimiter)
    {
        $this->data = $data;
        $this->delimiter = $delimiter;
    }
    /**
     * This method sets a description.
    *
    * @param string $description A text with a maximum of 80 characters.
    *
    * @throws Exception
    * @return string
    */
    public function delimiter()
    {
        if (!isset($this->delimiter)) {
            throw new Exception('Brak delimitera Point'); //dla ułatwienia później słownik
        }
        
        return $this->delimiter;
    }
    /**
     * This method sets a description.
    *
    * @param array $description A text with a maximum of 80 characters.
    *
    * @return Point
    */
    public function processing(array &$parameters) //$context  ->get callable
    {   
       foreach ($parameters as &$parameter)
       {
          foreach ($parameter as $p)
          {
            $p->calculate([ 'value' => $this->data[$p->getRowname()] ]);
          }
       }
    }
    /**
     * This method sets a description.
    *
    * @param array $description A text with a maximum of 80 characters.
    *
    * @return bool
    */
    public function getDateAggData(array &$parameters) //TO TrackGenerator ?? unikniecie polaczenie z track ?
    { 
        $p = current($parameters);
        $p->calculate(['value' => $this->data[$p->getRowname()]]); //dla ułatwienia później słownik
        return true;
    }

    public function getData()
    {
        return $this->data;
    }
}