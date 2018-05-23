<?php
	abstract class AdventurerClass 
	{
		public $name;
		public $hp;
		public $mp;
		const COST = 5;
		const REGEN = 2;

		//Methode
		function __construct($name)
		{
			// On doit assigner à la propriété name la valeur $name			
			$this->name = $name;
		}


		public function setMp () 
		{
			if (isset($this->mp) && gettype($this->mp) == "integer") {
				$this->mp = $this->mp - $this::COST ;
			}
			return $this->mp;
		}
		public function regenMp ()
		{
			if (isset($this->mp) && gettype($this->mp) == "integer") {
				$this->mp = $this->mp + $this::REGEN ;
			}
			return $this->mp;
		}
		protected function receiveDamage($dmg)
		{
			if (isset($this->hp) && gettype($this->hp) == "integer") {
				$this->hp = $this->hp - $dmg;
				return $this->hp;
			}
		}
		public function isDead()
		{
			if ($this->hp <= 0) {
				return true;
			} else {
				return false;
			}
		}
	}