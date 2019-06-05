<?php

/**
 * This file is loaded automatically if present and can contain extra functions to provide theme specific extra functionality.
 * You can prefix or suffix theme specific funtions so they are easily recognizable from standard Zenphoto functions
 * But we actually recommend to use a (static) class to wrap them.
 *
 * If your theme is more complex and needs more than one class it is recommended to have individual files for 
 * each class and require_once them here
 *  
 * This is basically the same as in the main "demo_theme" folder but with some additions needed for using the Zenpage CMS plugin
 */
class myTheme {

	static function printSomething() {
		echo 'something';
	}

	/**
	 * A more complex addition may be needed if using Zenpage to check for valid pagination pages
	 * @param array $request the current url request
	 * @param string $gallery_page The current theme page, e.g. "album.php"
	 * @param int $page The current page number
	 */
	static function checkPageValidity($request, $gallery_page, $page) {
		switch ($gallery_page) {
			case 'gallery.php':
				$gallery_page = 'index.php'; //	same as an album gallery index
				break;
			case 'index.php':
				if (extensionEnabled('zenpage')) {
					if (getOption('zenpage_zp_index_news')) {
						$gallery_page = 'news.php'; //	really a news page
						break;
					}
					if (getOption('zenpage_homepage')) {
						return $page == 1; // only one page if zenpage enabled.
					}
				}
				break;
			case 'news.php': // addition for the Zenpage CMS plugin already
			case 'album.php':
			case 'search.php':
			case 'favorites.php':
				break;
			default: // no pagnation allowed for all pages not covered above
				if ($page != 1) {
					return false;
				}
		}
		return checkPageValidity($request, $gallery_page, $page);
	}

}

//	Standard check so pagination links are not referring to non existing pages
$_zp_page_check = 'myTheme::checkPageValidity';
