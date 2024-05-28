<?php
function pluginPatches( $plugin_meta, $plugin_file, $plugin_data, $status ) {
    echo '<code>' . $plugin_file . '</code><br />';
    return $plugin_meta;
}

add_filter( 'plugin_row_meta', 'pluginPatches', 10, 4 );