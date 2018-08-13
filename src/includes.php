<?php
define('WORD_FILES', '/assets/wordFiles/');


function createZipFile($files, $name) {
    $zip           = new ZipArchive();
    $zipname       = $name . '.zip';
    $file          = WORD_FILES . $zipname;

    if (file_exists($file)) {
        unlink($file);
    }

    if ($zip->open($file, ZipArchive::CREATE) !== true) {
        error_log(print_r("cannot open <$zipname>\n", 1));
        return null;
    }

    foreach ($files as $file) {
        $zip->addFile(WORD_FILES . $file, $file);
    }

    $zip->close();

    return $zipname;
}



function download($file) {
    header('Content-type: octet/stream');
    header('Content-Disposition: attachment; filename="' . $file . '"');

    print_r($file);
}