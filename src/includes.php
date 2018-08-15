<?php
define('WORD_FILES', '/srv/assets/wordFiles/');
define('WORD_EXPORTS', '/srv/assets/wordFiles/exports');
define('BASE_URL', 'http://phpword.froscon2018');

require_once '/srv/vendor/autoload.php';


/**
 * @param array $files
 * @param string $zipName
 * @return null|string
 */
function createZipFile($files, $zipName) {
    $zip     = new ZipArchive();
    $zipName = $zipName . '.zip';
    $file    = WORD_EXPORTS . $zipName;

    if (file_exists($file)) {
        unlink($file);
    }

    if ($zip->open($file, ZipArchive::CREATE) !== true) {
        error_log(print_r("cannot open <$zipName>\n", 1));
        return null;
    }

    foreach ($files as $file) {
        $zip->addFile(WORD_EXPORTS . $file, $file);
    }

    $zip->close();

    return $zipName;
}


/**
 * @param string $fileName
 * @param string $redirect
 */
function download($fileName, $redirect) {
    header('Content-type: octet/stream');
    header('Content-Disposition: attachment; filename="' . $fileName . '"');
    readfile(WORD_EXPORTS . $fileName);

    header('Location: ' . BASE_URL . $redirect);
    die();
}