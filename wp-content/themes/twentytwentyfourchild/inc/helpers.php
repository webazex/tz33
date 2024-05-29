<?php
//init gutenberg blocks
function initGutenBlock($blockName){
    try {
        if(!(is_plugin_active('advanced-custom-fields-pro/acf.php'))){
            Throw new \Exception("ACF PRO plugin not installed");
        }
        $gutenBlockFullPatch = get_stylesheet_directory().DS.'inc'.DS.'acf-gutenberg-blocks'.DS.$blockName.DS.'block.php';
        $gutenViewFullPatch = getGbSection($blockName);
        if(!file_exists($gutenBlockFullPatch)){
            Throw new \Exception("Not found Gutenberg $blockName block");
        }
        if(!file_exists($gutenViewFullPatch)){
            Throw new \Exception("Not found Gutenberg $blockName section");
        }
        require_once $gutenBlockFullPatch;
    }catch (\Exception $e){
        echo '<pre class="wbzx-debug">';
        echo $e->getFile();
        echo $e->getMessage();
        echo $e->getCode();
        echo $e->getLine();
        echo '</pre>';
    }
}
//gutenberg blocks directory
function getGbSection($name):string {
    return get_stylesheet_directory().DS.'inc'.DS.'acf-gutenberg-blocks'.DS.$name.DS.'section.php';
}

function getPlaceholderSrc( string $format = 'webp', $fileName = '' ) {
	$src = get_stylesheet_directory().DS.'src'.DS.'placeholder.'.$format;
	$name = (!empty($fileName))? $fileName : 'placeholder';
	if(file_exists(get_stylesheet_directory().DS.'src'.DS.$name.'.'.$format)){
		$src = get_stylesheet_directory().DS.'src'.DS.$name.'.'.$format;
	}
    return $src;
}
