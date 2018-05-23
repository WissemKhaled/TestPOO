<?php
	class RenderHelperClass
	{
		// On mets quelques chose dans les parenthèse pour pouvoir les appeller et faire des choses généralistes ( le Static rend la fonction accessible partout avec "::")
		/*
			$tag = STRING
			$content = STRING
			$vars = Optional ARRAY
			$class = Optional STRING
		*/
		static function simpleTag($tag, $content, $vars = false, $class = false)
		{
			if ($vars && gettype($vars) == "array") {
				foreach ($vars as $key => $value) {
					$content = str_replace("%$key%", $value, $content);
				}
			}		
			echo "<$tag class='$class'>$content</$tag>";
		}
		static function displayTemplate($templateName, $vars = false)
		{
			$temp = "";
			$template = file_get_contents("./Views/$templateName.html");
			if ($vars) {
				foreach ($vars as $key => $value) {
					$temp += "<div>";
					$temp += "<ul>";
					$temp += "<li>Nom : " . $value->name . "</li>";
					$temp += "<li>HP : " . $value->hp . "</li>";
					$temp += "<li>MP : " . $value->mp . "</li>";
					$temp += "<li>Class : " . get_class($value) . "</li>";
					$temp += "</ul>";
					$temp += "</div>";
				}
			}
			echo $template;			
		}
	}