<?php
    abstract class AdventurerClass
    {
        public $name;
        public $hp;
        public $mp;

        function __construct($name)
        {
            $this->name = $name;         
        }

        protected function receiveDamage($dmg)
        {
            if(isset($this->hp) && gettype($this->hp) == "integer") {
                $this->hp = $this->hp - $dmg;
                return $this->hp;
            }
        }

        protected function setMp($mp)
        {
            return $this->mp = $mp;
        }

        public function isDead()
        {
            if($this->hp < 1) {
                return true;
            } else {
                return false;
            }
        }
    }