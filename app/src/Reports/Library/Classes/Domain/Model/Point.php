<?php

namespace App\Reports\Library\Classes\Domain\Model;

use stdClass;
use App\Reports\Library\Parameters\Generic\{IParameterAgg, IParameterFilter};
use App\Reports\Library\Classes\Domain\Model\Generic\Point\{IPointProcess, IPointUpate};

/**
*  Elementary part of track
*/
class Point implements IPointProcess, IPointUpdate
{ 
    /** @var FilterDictionary Should contain a description if available */
    protected $delimiter;

    /** @var AggregateDictionary Should contain a description if available */
    protected $parameters

    /** @var array Should contain a description if available */
    protected $data;
    
    /**
     * This method sets a description.
    *
    * @param array $description A text with a maximum of 80 characters.
    * @param stdClass $description A text with a maximum of 80 characters.
    * @param FilterDictionary  $description A text with a maximum of 80 characters.
    * @param AggregateDictionary $description A text with a maximum of 80 characters.
    *
    * @constructor
    */
    public function __construct(array $data)
    {
        $this->data = $data;
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
       return $this->delimiter;
    }
    /**
     * This method sets a description.
    *
    * @param array $description A text with a maximum of 80 characters.
    *
    * @return Point
    */
    public function processing(&$parameters) //$context  ->get callable
    {    //to Ireator
       foreach ($parameters as $key => $parameter)
       {
          $parameter->calculate(['value' => $data[$parameter->rowname] ]);
       }

      // return $this->parameters;
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
            $p = &$parameters['end'][$agg->class];
            $p->calculate(['value' => $this->data['end_date']]); //const in map
            return true;
    }

    public function getData()
    {
        return $this->data;
    }


    public function injectDelimiter($this->delimiter)
    {
       $this->delimiter = $delimiter;
    }
}