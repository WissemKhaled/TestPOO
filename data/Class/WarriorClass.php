<?php
	require_once ('./Class/AdventurerClass.php'); 
	class WarriorClass extends AdventurerClass
	{		
		function __construct($name, $hp, $mp)
		{
			parent::__construct($name);
			$this->hp = $hp;
			$this->mp = $mp;
		}
		public function hit($enemy)
		{
			if(isset($enemy) && is_subclass_of($enemy, 'AdventurerClass'))
			{
				$dmg = rand(1, 10);
				$enemy->receiveDamage($dmg);
			}
		}
	}