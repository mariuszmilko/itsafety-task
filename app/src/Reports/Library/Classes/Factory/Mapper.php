<?php

namespace App\Reports\Library\Classes\Factory;

use App\Reports\Library\Classes\Domain\Model\Generic\Mapper\IMapper;
use stdClass;
use App\Reports\Library\Classes\Domain\Model\Mapper as MapperModel;
use App\Reports\Library\Classes\Factory\Generic\
{
    IDictionary, IFactoryData
};


/**
 * Class Mapper
 * @package App\Reports\Library\Classes\Factory
 */
final class Mapper implements IFactoryData
{
    /**
     * @var stdClass
     */
    private $oMap;
    /**
     * @var IDictionary
     */
    private $filterDictionary;
    /**
     * @var IDictionary
     */
    private $aggDictionary;

    /**
     * Mapper constructor.
     * @param stdClass $oMap
     * @param IDictionary $filterDictionary
     * @param IDictionary $aggDictionary
     */
    public function __construct(stdClass $oMap, IDictionary $filterDictionary, IDictionary $aggDictionary)
    {
        $this->oMap             = $oMap;
        $this->filterDictionary = $filterDictionary;
        $this->aggDictionary    = $aggDictionary;
    }

    /**
     * @param array $data
     * @return IMapper
     */
    public function factory(array $data): IMapper
    {
        return new MapperModel($data, $this->oMap, $this->filterDictionary, $this->aggDictionary);
    }
}