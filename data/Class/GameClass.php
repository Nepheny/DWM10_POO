<?php
    class GameClass
    {
        public $fighters = [];

        // Create the Object
        function __construct()
        {
            if(isset($_GET['state']) && $_GET['state'] == 'save') {
                $this->createFighters($_POST, 2);
            } elseif(isset($_GET['state']) && $_GET['state'] == 'reset') {
                session_destroy();
                header('Location: http://'.$_SERVER['HTTP_HOST'].$_SERVER['PHP_SELF']);
            }

            if(isset($_SESSION['fighters'])) {
                RenderHelperClass::displayTemplate('fight', SaveHelperClass::getData('fighters'));
            } else {
                RenderHelperClass::displayTemplate('form');
            }
        }

        // Instanciate two fighters and add to the fighters property
        protected function createFighters($fighters, $numbers)
        {
            foreach($fighters as $key => $value) {
                if(gettype($value) == "array") {
                    $class = ucfirst($value[3]) . "Class";
                    $this->fighters[] = new $class($value[0], $value[1], $value[2]);
                }
            }

            SaveHelperClass::saveData('fighters', $this->fighters);
        }

        // Each fighter hits the other fighter
        public function fight()
        {
            RenderHelperClass::simpleTag("h3", "Le duel commence !");

            while(true) {
                $this->fighters[0]->hit($this->fighters[1]);
                RenderHelperClass::simpleTag("p", "%0% a frappé %1%", [$this->fighters[0]->name, $this->fighters[1]->name]);
                RenderHelperClass::simpleTag("p", "%0% : %1% HP et %2% MP.", [$this->fighters[0]->name, $this->fighters[0]->hp, $this->fighters[0]->mp]);
                RenderHelperClass::simpleTag("p", "%0% : %1% HP et %2% MP.", [$this->fighters[1]->name, $this->fighters[1]->hp, $this->fighters[1]->mp]);
            
                if($this->fighters[1]->isDead()) {
                    break;
                }

                $this->fighters[1]->fireBall($this->fighters[0]);
                RenderHelperClass::simpleTag("p", "%0% a frappé %1%", [$this->fighters[1]->name, $this->fighters[0]->name]);
                RenderHelperClass::simpleTag("p", "%0% : %1% HP et %2% MP.", [$this->fighters[0]->name, $this->fighters[0]->hp, $this->fighters[0]->mp]);
                RenderHelperClass::simpleTag("p", "%0% : %1% HP et %2% MP.", [$this->fighters[1]->name, $this->fighters[1]->hp, $this->fighters[1]->mp]);

                if($this->fighters[0]->isDead()) {
                    break;
                }

                RenderHelperClass::noClosedTag("br");
            }

            $this->endGame();
        }

        // Define a winner
        public function endGame()
        {
            if($this->fighters[0]->isDead()) {
                RenderHelperClass::simpleTag("strong", "%0% a gagné !", [$this->fighters[1]->name]);
            } elseif($this->fighters[1]->isDead()) {
                RenderHelperClass::simpleTag("strong", "%0% a gagné !", [$this->fighters[0]->name]);
            }
        }
    }