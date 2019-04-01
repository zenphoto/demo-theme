<?php
/**
 * This file is loaded automatically if present and can contain extra functions to provide theme specific extra functionality.
 * You can prefix or suffix theme specific funtions so they are easily recognizable from standard Zenphoto functions
 * But we actually recommend to use a (static) class to wrap them.
 *
 * If your theme is more complex and needs more than one class it is recommended to have individual files for 
 * each class and require_once them here
 *  
 */
class myTheme {
	
	static function printSomething() {
		echo "something";
	}
	
}

//	Standard check so pagination links are not referring to non existing pages
$_zp_page_check = 'checkPageValidity'; 