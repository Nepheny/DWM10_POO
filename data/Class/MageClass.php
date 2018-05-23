<?php
    class MageClass extends AdventurerClass
    {
        function __construct($name, $hp, $mp)
        {
            parent::__construct($name);
            $this->hp = $hp;
            $this->mp = $mp;
        }

        public function fireBall($enemy)
        {
            if(isset($enemy) && is_subclass_of($enemy, 'AdventurerClass')) {
                $costMp = 5;
                if($this->mp - $costMp >= 0) {
                    $this->setMp($this->mp - $costMp);
                    $dmg = rand(5, 15);
                    $enemy->receiveDamage($dmg);
                } else {
                    $dmg = 1;
                    $enemy->receiveDamage($dmg);
                    RenderHelperClass::simpleTag("p", "%0% n'a plus de mana, %0% frappe avec son sceptre.", [$this->name]);
                }
            }
        }
    }