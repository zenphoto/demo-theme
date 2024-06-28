<?php

/**
 * Plug-in for theme option handling
 * The Admin Options page tests for the presence of this file in a theme folder
 * If it is present it is linked to with a require_once call.
 * If it is not present, no theme options are displayed.
 *
 */
/*
 * This is optional and here required because of the usage of the function generateListFromArray() within handleOption() below.
 */
require_once(dirname(__FILE__) . '/functions.php');

/**
 * General option handler class any plugin having options must have
 */
class ThemeOptions {

	/**
	 * Here you set default values of your options.
	 * The options here an an example of the default theme.
	 */
	function __construct() {
		setThemeOptionDefault('Allow_search', true);
		setThemeOptionDefault('demoTheme_colors', 'none');
		setThemeOptionDefault('albums_per_page', 6);
		setThemeOptionDefault('albums_per_row', 2);
		setThemeOptionDefault('images_per_page', 20);
		setThemeOptionDefault('images_per_row', 5);
		setThemeOptionDefault('image_size', 595);
		setThemeOptionDefault('image_use_side', 'longest');
		setThemeOptionDefault('thumb_size', 100);
		setThemeOptionDefault('thumb_crop_width', 100);
		setThemeOptionDefault('thumb_crop_height', 100);
		setThemeOptionDefault('thumb_crop', 1);
		setThemeOptionDefault('thumb_transition', 1);

		/*
		 * You can also set other options if your theme requires this.
		 * This example enables the colorbox plugin if it is used for the theme pages noted.
		 */
		setOptionDefault('colorbox_default_album', 1);
		setOptionDefault('colorbox_default_image', 1);
		setOptionDefault('colorbox_default_search', 1);

		/*
		 * This adds support for the cache manager so you can pre-cache your thumbs and other sized images as defined.
		 * Zenphoto generally does this on the fly when needed but on very slow servers or if you have really a lot of images that also are quite big
		 * it may be necessary to do this.
		 */
		if (class_exists('cacheManager')) {
			cacheManager::deleteThemeCacheSizes('default');
			cacheManager::addThemeCacheSize('default', getThemeOption('image_size'), NULL, NULL, NULL, NULL, NULL, NULL, false, getOption('fullimage_watermark'), NULL, NULL);
			cacheManager::addThemeCacheSize('default', getThemeOption('thumb_size'), NULL, NULL, getThemeOption('thumb_crop_width'), getThemeOption('thumb_crop_height'), NULL, NULL, true, getOption('Image_watermark'), NULL, NULL);
		}
	}

	/**
	 * Reports the supported options
	 *
	 * @return array
	 */
	function getOptionsSupported() {
		/*
		 * The option definitions are stored in a multidimensional array. There are several predefined option types.
		 * Option types are the same for plugins and themes.
		 */
		$options = array(
				/* 
				 * Radio buttons 
				 */
				gettext('Radio buttons option') => array(// The Title of your option that can be translated.
						'key' => 'demo_theme_radiobuttons', // The real name of the option that is stored in the database.
						// Good practice is to name these like yourdemoplugin_optionname.
						'type' => OPTION_TYPE_RADIO, // This generates an option interface for radio buttons.
						'order' => 7, // OPTIONAL: It is recommended to just define the array in the order intended
						'buttons' => array(// The definition of the radio buttons to choose from and their values.
								//You can of course have more than three.
								gettext('Suboption 1-a') => 'value-to-store',
								gettext('Suboption 1-b') => 'value-to-store',
								gettext('Suboption 1-c') => 'value-to-store'
						),
						'desc' => gettext('Description')
				), // The description of the option.

				/*
				 * Checkbox list as an array 
				 * 
				 * Note that the checkboxes are individual boolean options themselves that only store 0 and 1.
				 * Therefore it is recommended to name the options accordingly. 
				 * 
				 * In code you don't check the main option (key) but these individual options themselves.
				 */
				gettext('Checkbox array list option') => array(
						'key' => 'demo_theme_checkbox_array',
						'type' => OPTION_TYPE_CHECKBOX_ARRAY,
						'checkboxes' => array(// The definition of the checkboxes which are actually individual boolean suboptions. 
								gettext('Suboption 2-a') => 'demo_theme_checkbox_array-suboption2-a', // this is the option db name, not the value!
								gettext('Suboption 2-b') => 'demo_theme_checkbox_array-suboption2-b',
								gettext('Suboption 2-c') => 'demo_theme_checkbox_array-suboption2-c'
						),
						'desc' => gettext('Description')),
				/* 
				 * Checkbox list as an unordered html list
				 * 
				 * Note that the checkboxes are individual boolean options themselves that only store 0 and 1.
				 * Therefore it is recommended to name the options accordingly. 
				 * 
				 * In code you don't check the main option (key) but these individual options themselves.
				 */
				gettext('Checkbox list') => array(
						'key' => 'demo_theme_checkbox_list',
						'type' => OPTION_TYPE_CHECKBOX_UL,
						'checkboxes' => array(// The definition of the checkboxes which are actually individual boolean suboptions. 
								gettext('Suboption 3-a') => 'demo_theme_checkbox_list-suboption3-a', // this is the option db name, not the value!
								gettext('Suboption 3-b') => 'demo_theme_checkbox_list-suboption3-b',
								gettext('Suboption 3-c') => 'demo_theme_checkbox_list-suboption3-c'
						),
						'desc' => gettext('Description')),
				/* 
				 * One checkbox option only - This example is a general theme option 
				 */
				gettext('Allow search') => array(
						'key' => 'Allow_search',
						'type' => OPTION_TYPE_CHECKBOX,
						'desc' => gettext('Check to enable search form.')),
				/* 
				 * Input text field option 
				 */
				gettext('Input text field option') => array(
						'key' => 'demo_theme_textbox',
						'type' => OPTION_TYPE_TEXTBOX,
						'multilingual' => 1, // optional if the field should be multilingual if Zenphoto is run in that mode.
						//Then there will be one input field per enabled language.
						'desc' => gettext('Description')),
				/* 
				 * Password input field option 
				 */
				gettext('Password input field option') => array(
						'key' => 'demo_theme_input_password',
						'type' => OPTION_TYPE_PASSWORD,
						'desc' => gettext('Description')),
				/* 
				 * Cleartext option 
				 */
				gettext('Cleartext input field option') => array(
						'key' => 'demo_theme_input_cleartext',
						'type' => OPTION_TYPE_CLEARTEXT,
						'desc' => gettext('Description')),
				/* 
				 * Textareafield option 
				 */
				gettext('Textarea field option') => array(
						'key' => 'demo_theme_textarea',
						'type' => OPTION_TYPE_TEXTAREA,
						'texteditor' => 1, // Optional: to enable the visual editor TinyMCE on this field.
						'multilingual' => 1, // Optional: if the field should be multilingual if Zenphoto is run
						//in that mode. Then there will be one textarea per enabled language.
						'desc' => gettext('Description')),
				/* 
				 * Dropdown selector option 
				 */
				gettext('Dropdown selector option') => array(
						'key' => 'demo_theme_selector',
						'type' => OPTION_TYPE_SELECTOR,
						'selections' => array(// The definition of the selector values. You can of course have more than three.
								gettext('Suboption1') => 'value-to-store',
								gettext('Suboption2') => 'value-to-store',
								gettext('Suboption3') => 'value-to-store'
						),
						'null_selection' => gettext('Disabled'), // Provides a NULL value to select to the above selections.
						'desc' => gettext('Description.')),
				/* 
				 * jQuery color picker option 
				 */
				gettext('jQuery color picker option') => array(
						'key' => 'demo_theme_colorpicker',
						'type' => OPTION_TYPE_COLOR_PICKER,
						'desc' => gettext('Description')),
				/* 
				 * Custom option if none of the above standard ones fit your purpose. You define what to do and show within the method handleOption() below.
				 */
				gettext('Theme colors') => array(
						'key' => 'demoTheme_colors',
						'type' => OPTION_TYPE_CUSTOM,
						'desc' => gettext('Select the colors of the theme'))
		);

		/*
		 * Sometimes you may want to print notes, for example if someone tries to run the plugin but its server lacks support.
		 * Then there is an option type for notes only. You can add them like this: 
		 */
		if (!getOption('zp_theme_demo_theme')) { // whatever you need to check (in this case that the plugin is enabled)
			$options['note'] = array(
					'key' => 'demotheme_note',
					'type' => OPTION_TYPE_NOTE,
					'desc' => gettext('<p class="notebox">Sometimes you might want to put out notes for example this version of the demo theme expects that the <strong>adminToolbox</strong> is inserted via the <code>theme_body_close</code> <em>filter</em>.
																Then there is an option type for notes only</p>') // the class 'notebox' is a standard class for styling notes on the backend, there is also 'errorbox' for errors.
			);
		}
		return $options;
	}

	/**
	 * If your theme uses specific image sizes for layout reasons you can disable the standard image size options here.
	 */
	function getOptionsDisabled() {
		return array('custom_index_page', 'image_size');
	}

	/**
	 * Handles optional custom option types
	 * 
	 * @param type $option
	 * @param type $currentValue
	 */
	function handleOption($option, $currentValue) {
		$themecolors = array('red', 'white', 'blue', 'none');
		if ($option == 'demoTheme_colors') {
			echo '<select id="demoTheme_themeselect_colors" name="' . $option . '"' . ">\n";
			generateListFromArray(array($currentValue), $themecolors, false, false);
			echo "</select>\n";
		}
	}

	/**
	 * handleOptionSave() will be called if it has been defined. Its job is to process the
	 * posting of custom options.
	 * @param string $themename
	 * @param string $themealbum
	 */
	function handleOptionSave($themename, $themealbum) {
		if (isset($_POST['demoTheme_colors'])) {
			setOption('demoTheme_colors', sanitize($_POST['demoTheme_colors']));
		}
		return false;
	}

}
