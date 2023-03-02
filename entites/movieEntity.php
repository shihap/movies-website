<?php

class movieEntity 
{
    public  $name;
    public  $actors;
    public  $disc;    
    public  $img;
    public  $rate;
    public  $dir;
    public  $catagory;
   
    
    function __construct($name,$catagory,$actors,$disc,$img, $rate ,$dir) {
        $this->name = $name;
        $this->catagory=$catagory;
        $this->actors = $actors;
        $this->disc = $disc;
        $this->img = $img;
        $this->rate = $rate;
        $this->dir = $dir;
    }

}
