<?php

class Quiz
{
    //foods配列のインデックス
    public $q_index = 0;

    //○か×か格納する配列
    public $result = [];

    public $foods = [];

    //ポイント
    public $point =0;

    public $type;

    public function hello(){
        echo "this is Quiz class";
    }

    public function divideType(){
            if($_POST['fund']){
                $this->type = 'fund';
                $_SESSION['type'] = 'fund';
            }else if($_POST['adv']){
                $this->type = 'adv';
                $_SESSION['type'] = 'adv';
            }
            header('Location: ate_playing.php');
            exit();
    }

    public function  getFood($db){
        $records = $db->query("SELECT name, carbo, image FROM foods ORDER BY RAND() LIMIT 5");
        if($records){
            while($record = $records->fetch_assoc()){
                $this->foods[]= $record;
            }
            $this->foods;
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

    public function playingFund($q_carbo){
        $dummy_ans1 = $this->getDummyAns1($q_carbo);
        $dummy_ans2 = $this->getDummyAns2($q_carbo, $dummy_ans1);
        $choices = [$q_carbo,  $dummy_ans1,  $dummy_ans2];
        shuffle($choices);
        return $choices;
    }


    public function checkAnsOfFund($ans_carbo){
        $selectedChoice = filter_input(INPUT_POST, 'choice');
            if($selectedChoice == $ans_carbo){
                $this->result[] = "correct";
                
                $this->point += 20;
            }else{
                $this->result[] = "miss";
            }
    }

}