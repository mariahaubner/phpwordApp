<?php
define('WORD_FILES', '/assets/wordFiles/');
define('BASE_URL', 'http://phpword.froscon2018');

require_once '/srv/vendor/phpoffice/phpword/bootstrap.php';


/**
 * @param array $files
 * @param string $zipName
 * @return null|string
 */
function createZipFile($files, $zipName) {
    $zip     = new ZipArchive();
    $zipName = $zipName . '.zip';
    $file    = WORD_FILES . $zipName;

    if (file_exists($file)) {
        unlink($file);
    }

    if ($zip->open($file, ZipArchive::CREATE) !== true) {
        error_log(print_r("cannot open <$zipName>\n", 1));
        return null;
    }

    foreach ($files as $file) {
        $zip->addFile(WORD_FILES . $file, $file);
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

    print_r($fileName);

    header('Location: ' . BASE_URL . $redirect);
    die();
}