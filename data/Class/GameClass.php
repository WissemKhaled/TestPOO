<?php 

	class GameClass 
	{
		
		public $fighters = [];
		function __construct()
		{
			if (isset($_GET['state']) && $_GET['state'] == 'save') {
				$this->createFighters($_POST, 2);
			}else if (isset($_GET['state']) && $_GET['state'] == 'reset'){
				session_destroy();
				header('Location: http://'.$_SERVER['HTTP_HOST'].$_SERVER['PHP_SELF']);
			}
			if (isset($_SESSION['fighters'])) {
				RenderHelperClass::displayTemplate('fight', SaveHelperClass::getData('fighters'));;
			} else {
				RenderHelperClass::displayTemplate('form');
			}
		}
       		// Instanciate two fighters and add them to the fight
		protected function createFighters($fighters, $numbers)
		{
			foreach ($fighters as $key => $value) {
				if (gettype($value) == "array") {
					// On prend la quartière laveur de l'heure, on prend sa valeur en Majuscule et on lui rajoute Class à la fin
					$class = $value[3] . "Class";
					$this->fighters[] = new $class($value[0], $value[1], $value[2]);
				}
			}
			SaveHelperClass::saveData('fighters', $this->fighters);
		}

		public function fight()
		{
			RenderHelperClass::simpleTag('h3', 'Aaaaand now, FIGHT !');
			$flag = false;
			while ($flag == false) {

				// Lance la phase d'attaque pour le Guerrier, classique vue qu'il n'utilise pas de magie
				$this->fighters[0]->hit($this->fighters[1]);
				RenderHelperClass::simpleTag('p','%0% a frappé %1%',[$this->fighters[0]->name, $this->fighters[1]->name]);
				RenderHelperClass::simpleTag('p','il reste %0% à %1%', [$this->fighters[0]->hp, $this->fighters[1]->name]);

				if ($this->fighters[1]->isDead()) {
					break;
				}

				// lance la phase d'attaque pour le Mage
				if ($this->fighters[1]->mp >= 5) {
					// Applique les dégats et le coût en MP
					$this->fighters[1]->fireBall($this->fighters[0]);
					$this->fighters[1]->setMp();

					RenderHelperClass::simpleTag('p','%0% envoie une boule de feu à %1%',[$this->fighters[1]->name, $this->fighters[0]->name]);
					RenderHelperClass::simpleTag('p','il reste %0% mp à %1%',[$this->fighters[1]->mp, $this->fighters[1]->name]);
					RenderHelperClass::simpleTag('p','il reste %0% hp à %1%',[$this->fighters[0]->mp, $this->fighters[0]->name]);
				} else {
					// Regeneration des Mp s'il n'en a pas assez
					$this->fighters[1]->regenMp();
					echo "<p>".$this->fighters[1]->name." régenère ". $this->fighters[1]->mp."</p>";

				}

				if ($this->fighters[0]->isDead()) {
					break;
				}
				echo "<br/>";
			}
			$this->endGame();
		}
		public function endGame()
		{
			if ($this->fighters[0]->hp <1) {
				echo $this->fighters[0]->name. " is dead";
			}else {
				echo $this->fighters[1]->name. " is dead";
			}
		}
	}