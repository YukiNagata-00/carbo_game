<?php

class EasyQuiz{

    public $foods=[];
    public $choices = [];

    function __construct($db)
    {
        $this->_setup($db);
        $this->_setChoices();

        if (!isset($_SESSION['current_num'])) {
            $_SESSION['current_num'] = 0;
        }
        if (!isset($_SESSION['foods'])) {
            $_SESSION['foods'] =  $this->foods;
        }
        if (!isset($_SESSION['choices'])) {
            $_SESSION['choices'] =  $this->choices;
        }
    }

    public function _setup($db){
        $records = $db->query("SELECT name, carbo, image FROM foods ORDER BY RAND() LIMIT 5");
        if($records){
            while($record = $records->fetch_assoc()){
                $this->foods[]= $record;
            }
            $this->foods;
        }
    }

    public function _setChoices(){
        for($i =0; $i <count($this->foods); $i++){
            $this->choices[$i] = [$this->foods[$i]['carbo'], $this->getDummyAns1($this->foods[$i]['carbo']), $this->getDummyAns2($this->foods[$i]['carbo'], $this->getDummyAns1($this->foods[$i]['carbo'])) ];
            shuffle($this->choices[$i]);
        }
        
    }

    public function getDummyAns1($q_carbo){
        $dummy1 = round(round(mt_rand() / mt_getrandmax(), 2) * $q_carbo, 1);
        if($dummy1 <= 0 ||  abs($dummy1 - $q_carbo) <= 1){
            return  $this->getDummyAns1($q_carbo);
        }else{
            return $dummy1;
        }
    }
    public function getDummyAns2($q_carbo, $dummy_ans1){
        $dummy2 = round(round(mt_rand() / mt_getrandmax(), 2) * $q_carbo *rand(1,9) + $q_carbo / rand(1, 1.5), 1);
        if($dummy2 <= 0 ||  abs($dummy2 - $q_carbo) <= 1){
            return $this->getDummyAns2($q_carbo, $dummy_ans1);
        }else{
            return $dummy2;
        }
    }
}

    ?>
