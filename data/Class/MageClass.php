<?php
	require_once ('./Class/AdventurerClass.php'); 
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
			if(isset($enemy) && is_subclass_of($enemy, 'AdventurerClass'))
			{
				$dmg = rand(5, 20);
				$enemy->receiveDamage($dmg);
			}
		}
	}