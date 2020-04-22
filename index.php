<?php

class Phone
{
    protected $phoneNumber;
    protected $typeCard;

    public function __construct($phoneNumber, $typeCard)
    {
        $this->phoneNumber = $phoneNumber;


        $this->typeCard = $typeCard;

    }

    /**
     * @param int $phoneNumber
     */
    public function setPhoneNumber($phoneNumber)
    {
        $this->phoneNumber = $phoneNumber;
    }

    /**
     * @param string $typeCard
     */
    public function setTypeCard($typeCard)
    {
        $this->typeCard = $typeCard;
    }

    /**
     * @return int
     */
    public function getPhoneNumber()
    {
        return $this->phoneNumber;
    }

    /**
     * @return string
     */
    public function getTypeCard()
    {
        return $this->typeCard;
    }
}

class Queue
{
    private $array;
    private $limit;
    private $count;
    private $value;
    public $Vinaphone;
    public $Viettel;
    public $Mobifore;

    public function __construct($array, $limit)
    {
        if (is_array($array)) {
            $this->array = $array;
        } else {
            $this->array = [];
        }
        if (is_integer($limit)) {
            $this->limit = $limit;
        } else {
            $this->limit = 20;
        }
        $this->count = -1;
        $this->value = 0;
        $this->Vinaphone = [];
        $this->Viettel = [];
        $this->Mobifore = [];
    }

    public function isEmpty()
    {
        return empty($this->array);
    }

    public function pop()
    {
        array_shift($this->array);
        $this->count++;
    }

    public function pushIntoVinaPhone($phone)
    {
        array_push($this->Vinaphone, $phone);
    }

    public function pushIntoVietTel($phone)
    {
        array_push($this->Viettel, $phone);
    }

    public function pushIntoMobiFore($phone)
    {

        array_push($this->Mobifore, $phone);
    }

    public function push($phone)
    {
        $value = [
            'phoneNumber' => $phone->getPhoneNumber(),
            'typeCard' => $phone->getTypeCard()
        ];
        if ($this->isEmpty() || count($this->array) <= $this->limit) {
            array_push($this->array, $value);
            $this->count++;
            $this->search();
            $this->pop();
        } else {
            $this->pop();
            array_push($this->array, $value);
            $this->count++;
        }
    }

    public function search()
    {
        foreach ($this->array as $key => $phone) {
            if ($phone['typeCard'] == 'vinaphone') {
                $this->pushIntoVinaPhone($this->array[$key]);
            } elseif ($phone['typeCard'] == 'viettel') {
                $this->pushIntoVietTel($this->array[$key]);
            } elseif ($phone['typeCard'] == 'mobifore') {
                $this->pushIntoMobiFore($this->array[$key]);
            } else {
                $key++;
            }
        }
    }

    public function returnVina()
    {
        return implode(",", $this->Vinaphone);
    }

    public function returnViettel()
    {
        return implode(",", $this->Viettel);
    }

    public function returnMobifore()
    {
        return implode(",", $this->Mobifore);
    }
    public function showListVina(){
        echo "<table border='1'>";
        foreach ($this->Vinaphone as $key =>$phone){
            echo "<tr><td>".$phone['phoneNumber']."</td><td>".$phone['typeCard']."</td></tr>";
        }
        echo "</table>";
    }
    public function showListViettel(){
        echo "<table border='1'>";
        foreach ($this->Viettel as $key =>$phone){
            echo "<tr><td>".$phone['phoneNumber']."</td><td>".$phone['typeCard']."</td></tr>";
        }
        echo "</table>";
    }
    public function showListMobifore(){
        echo "<table border='1'>";
        foreach ($this->Mobifore as $key =>$phone){
            echo "<tr><td>".$phone['phoneNumber']."</td><td>".$phone['typeCard']."</td></tr>";
        }
        echo "</table>";
    }
}

$phoneType = new Queue($arr = [], 10);
$phone1 = new Phone('12461724', 'vinaphone');
$phone2 = new Phone('12059272', 'viettel');
$phone3 = new Phone('12746506', 'mobifore');
$phone4 = new Phone('12465062', 'viettel');
$phone5 = new Phone('12665432', 'viettel');
$phone6 = new Phone('04771245', 'vinaphone');
$phone7 = new Phone('47516504', 'vinaphone');

$phoneType->push($phone1);
$phoneType->push($phone2);
$phoneType->push($phone3);
$phoneType->push($phone4);
$phoneType->push($phone5);
$phoneType->push($phone6);
$phoneType->push($phone7);

$phoneType->showListVina();
$phoneType->showListViettel();
$phoneType->showListMobifore();
