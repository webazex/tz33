<?php
const DS = DIRECTORY_SEPARATOR;
//dev snippets
require_once get_stylesheet_directory().DS.'inc'.DS.'dev-snippets.php';

//css&js
require_once get_stylesheet_directory().DS.'inc'.DS.'sources.php';

//added custom post type
require_once get_stylesheet_directory().DS.'inc'.DS.'cpt.php';

//helpers
require_once get_stylesheet_directory().DS.'inc'.DS.'helpers.php';

//shortcodes
require_once get_stylesheet_directory().DS.'inc'.DS.'shortcodes.php';
