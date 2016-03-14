<?php

class Util {
	function verificarRol($array,$rol){
		foreach ($array as $item){
			if($item==$rol){
				return true;
			}
		}
		return false;
	}
}