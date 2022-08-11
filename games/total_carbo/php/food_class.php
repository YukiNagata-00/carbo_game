<?php

class Food {
    private $food_name;
    private $food_carb;
    private $food_img;

    public function setName(string $data){
        $this->food_name = $data;
    }
    public function getName(){
        return $this->food_name;
    }
    public function setCarb(string $data){
        $this->food_carb = $data;
    }
    public function getCarb(){
        return $this->food_carb;
    }
    public function setImg(string $data){
        $this->food_img = $data;
    }
    public function getImg(){
        return $this->food_img;
    }
    
    
    

}


?>