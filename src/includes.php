<?php
error_reporting(E_ALL);
ini_set("display_errors", 1);

define('WORD_FILES', '/srv/assets/wordFiles/');
define('WORD_EXPORTS', '/tmp/exports');
define('BASE_URL', '//');

mkdir(WORD_EXPORTS);

require_once __DIR__ . '/../vendor/autoload.php';

/**
 * @param array $files
 * @param string $zipName
 * @return null|string
 */
function createZipFile($files, $zipName)
{
    $zip = new ZipArchive();
    $zipName = $zipName . '.zip';
    $file = WORD_EXPORTS . $zipName;

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
 */
function download($fileName)
{
    header('Content-type: octet/stream');
    header('Content-Disposition: attachment; filename="' . $fileName . '"');
    readfile(WORD_EXPORTS . $fileName);
    die();
}

function error()
{
    $host = $_SERVER['HTTP_HOST'];
    header("Location: http://$host/index.php?page=error");
    exit;
}
