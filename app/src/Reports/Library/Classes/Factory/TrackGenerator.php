<?php



class TrackGenerator 
{
   private $currentPoint;
   private $previousPoint;
   private $track;
   private $tracks = [];

   public function __construct()
   {

   }
     
 //  To Track generator
   public function isEndTrack()
   {
      if (!empty($this->previous) && $this->current != $this->previous) {
          $this->tracks[] = $this->track;
          $this->track = $this->trackBuilder->newInstance();
      }
      
   }

   public function isFirstTrack()
   {
      return (empty($this->previous) && !empty($this->current));
   }

   private function setCurrent($point) 
   {
      $this->current = $point;
   }

   private function setPrevious() 
   {
      $this->previous = $this->current; 
   }

   public function process($point)
   {
      $this->setCurrent($point);
      $this->isFirstTrack() == false ? $this->isEndTrack() : true;  
      $this->track->generate($point);
      $this->setPrevious();
   }

   public function setNewTrack()
   {
         return $trackBuilder->newInstance();
   }
//TO Service
//    public function getDataByDate($device_id, $dateFrom, $dateTo)
//    {
//         $generator = $repository->findTracksByDate($device_id, $dateFrom, $dateTo);
//       //  $config->generate($generator, $this->parameters);  
//         foreach ($generator as $row ) {
//              $config->generate($row, $this->parameters);
//         }

//        return $this->parameters;
//    }

//    public function getDataByDay($dateDay)
//    {
//         $generator = $repository->findTracksByDay($device_id, $dateDay);  
//         foreach ($generator as $row ) {
//              $config->generate($row, $this->parameters);
//         }
        
//        return $this->parameters;
//    }
  

//    private function map(callable $cb, $collection) {
//     foreach ($collection as $key => $item) {
//         yield $item => $cb($item);
//     }

}
}