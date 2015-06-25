<?php

/* Recursively scan dir */
function dirToArray($dir, $firstLevel = true) {
    if(!$firstLevel){
        $result = "<ul style='display:none'>";
    }else{
        $result = "<ul id='dirList'>";
    }

    $cdir = scandir($dir);
    foreach ($cdir as $key => $value){
        if (!in_array($value,array(".",".."))){
            if (is_dir($dir . DIRECTORY_SEPARATOR . $value)) {
                $result .= "<li><a href='#' class='collection-item' id='". $dir . DIRECTORY_SEPARATOR . $value ."'>$value</a>";
                $result.= dirToArray($dir . DIRECTORY_SEPARATOR . $value, false);
                $result .= "</li>";
            }
        }
    }
    return $result."</ul>";
}

$result = array();
$result['error'] = true;

$confFile = parse_ini_file("../config.ini",true);
$startFolder = $confFile['scanDir']['startFolder'];

$folderTree = dirToArray($startFolder);
?>

<span class="collection">
    <?php echo $folderTree; ?>
</span>

