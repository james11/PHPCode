<?php
function delTree($dir) {
	$files = glob( $dir . '*', GLOB_MARK );
    foreach( $files as $file ){
        if( substr( $file, -1 ) == '/' )
            delTree( $file );
        else
            unlink( $file );
    } 

/*     if (is_dir($dir)) rmdir( $dir );  */

	}
	
?>	