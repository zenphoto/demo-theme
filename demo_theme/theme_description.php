<?php
/**
 * Zenphoto theme definition file. This info is listed on the themes page on the backend
 * Change the values to match your theme
 */
/*
 * REQUIRED: The name of your plugin
 */
$theme_description['name'] = 'Theme name'; 

/*
 * OPTIONAL: The name(s) of the theme authors, myy containt HTML like author website links.
 */
$theme_description['author'] = 'Author(s) name(s)'; 

/*
 * OPTIONAL: The version number should follow semantic versioning like major.minor.patch
 */
$theme_description['version'] = '1.0.0'; 

/*
 * OPTIONAL: Release date of the current version - preferredly yyyy-mm-dd format
 */
$theme_description['date'] = '2020-07-03'; 

/*
 * OPTIONAL: A description of your theme
 */
$theme_description['desc'] = gettext('Short description of your theme');

/*
 * OPTIONAL: If the theme itself specifially (or some of its functionality) is deprecated note this here. It will be displayed on the backend (since 1.5.8b)
 */
$theme_description['deprecated'] = gettext('Some message'); 

/**
 * OPTIONAL: Use ternary operators to add dependency or requirements checks. If they match and this is not false, 
 * the plugin will be disabled/cannot be disabled and the message is displayed on the backend. The variable should not be present
 * or be set to empty the plugin may be enabled.
 * You can also provide an array with serveral conditions (since 1.5.8b)
 */
$theme_description['disable'] = ($something != $somecondition) ? gettext('Message about the failed check') : false;

/*
 * OPTIONAL: A short notice about e.g. specific settings that need to be made or similar. Also note here if your theme uses external sources (since 1.5.8b)
 */
$theme_description['notice'] = gettext('A short notice.');