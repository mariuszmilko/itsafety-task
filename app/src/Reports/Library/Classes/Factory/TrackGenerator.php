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
   public function isEndTrack($point)
   {
      if (!empty($this->previous) && $this->current != $this->previous) {
          $this->tracks[] = $this->track;
          $this->track->processPoint($point);
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
      $this->isFirstTrack() == false ? $this->isEndTrack($point) : true;  //LastPoint 
      $result = $this->track->processPoint($point);
      $this->setPrevious();
   }
}