<?php
function removeDir($dir){
    if(!file_exists($dir)) return true;

    if(!is_dir($dir)) return unlink($dir);

    foreach(scandir($dir) as $item){
        if($item == "." || $item == "..") continue;

        if(!removeDir($dir.DIRECTORY_SEPARATOR.$item)) return false;
    }

    return rmdir($dir);
}

$wpContent = dirname(__DIR__)."/cms/wp-content";
removeDir($wpContent);