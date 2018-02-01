Preconditions:

<?php
class db{
    public static function init();
    public function __construct($config);
    public function query($sql, $args );
}

//ControllerAction  zamiana
//wyspecyfikowanie interfejsu dla kontorleru
class DeviceController {
    public function getParam($name);
}

?>


Code to CR:

<?php



//warstwy abstrkacji
//-repozytoria
//-encje+logika
class DeviceController extends ControllerAction
{
    //akcja ajaksowa
    public function updateDeviceNameAction()
    {
        jawny dostęp do tablicy GET
        $deviceId = $_GET['device_id'];  //request  class
        $deviceName = $_GET['device_name']; //request  class
        //validacja wartości parametrów


        $db = db::init();
        $db->query("UPDATE `device` set `name` = " . $deviceName . " WHERE device_id  = ".$deviceId);
        //bindowanie parametrów

    }

    public function viewDeviceAction()
    {
        $view = new View(); //jawne wywołanie obikety View, zamiana na parametr, właściwośc klasy
        ...  //stdclass
        $device = DeviceModel::get($_GET['device_id']); //jawny dostęp do tablicy GET, zamian na request, validacja
                                                        //statyczny dos†ep do metody z Modelu zamienić 
                                                        //DTO - kwestia optymalizacji struktury danych, zamiana na lejszą (json, array)
        $view->assign("device", $device);
        ...
        echo $view->render(“device.php”);
    }

...
}
?>
//brak szablonów,  
views/device.php
...
<div>   
<img class=”device” scr=”<?php echo $view->$device->device_photo_url; ?>” /> //$device->device_photo_url  //dostęp do obiektu po nazwie   //problem z dostepem do własciwości w momencie błędu literówki, 
<span class=”device_name”><?php echo $view->device->name ?></span>  //$device->device_photo_url  //dostęp do obiektu po nazwie 
</div>
...

<?php

class DeviceModel
{
    public static $devices = [];

    //sttyczna metoda, 
    //łączenie odpowiedzialności(dostęp do db, wywołanie zapytania, logika(to tylko powinno być)) w metodzie 
    // 
    public static function update($device_photo_id, $device_name, $devId)
    {
        //zaszyta jawna konfiguracja dostepu do db, powinna być złącona instancja db z  kontenraDI  w tym obiekcie
        //definicja konfiguracj bazy danych na poziomie Namespace w konfiguracji
        $db = new db([
            'host' => 'localhost',
            'user' => 'root'
            'password' => 'ania7',
            ...
        ]);  //do usunięcia
        //brak konsekwencji jeśli chodzi bindowanie stringó∑
        //j.w. query
        $db->query("UPDATE `device` set `name` = {$device_name} WHERE device_id  = $devId");
        //myląca nazwa dla zmiennej tablicowej zwracanej z tej metody np. $devices
        //problem 
        $device = $this->searchDevcieByName($device_name);
        $device_id = 0;
         
        foreach($device as $d){
            $device_id = $d->device_id;  //iterujemy po tablicy przypisujemy do jednej
            //  self::$devices[$device_id] 
        }

        self::$devices[$device_id] = $device;

        return true;

    }
    //zaszyta jawna konfiguracja dostepu do db, powinna być złącona instancja db z  kontenraDI  w tym obiekcie
        //definicja konfiguracj bazy danych na poziomie Namespace w konfiguracji
    public static function searchDevcieByName($name)
    {
        $db = new db([
        'host' => 'localhost',
        'user' => 'root'
        'password' => 'ania7',
        ...
        ]);
        $s = $db->query("SELECT device_id, device_name,  FROM devcie
            WHERE device_name LIKE '%{$name}%'");

        return $s->fetchAll();
    }
...
}