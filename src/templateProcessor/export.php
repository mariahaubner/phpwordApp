<?php

include_once '../includes.php';

use PhpOffice\PhpWord\TemplateProcessor;

if (isset($_POST['name'])) {
    export();
} else {
    error();
}

function export() {

    $filename = WORD_FILES . "Invitation_${$_POST['name']}.docx";

    try {
        $templateProcessor = new TemplateProcessor(WORD_FILES . 'Invitation.docx');
        $templateProcessor->setValue('salutation', 'Dear ' . $_POST['name']);
        $templateProcessor->setValue(
            ['city', 'street'],
            [$_POST['city'], $_POST['street']]
        );

        /**
         * TODO:
         * [Tue Aug 14 18:42:09.494944 2018] [php7:warn] [pid 1048] [client 192.168.56.1:42250] PHP Warning:
         * copy(/srv/assets/wordFiles/Invitation_joe.docx): failed to open stream:
         * Permission denied in /srv/vendor/phpoffice/phpword/src/PhpWord/TemplateProcessor.php on line 431,
         * referer: http://phpword.froscon2018/src/templateProcessor/index.php
         */
        $templateProcessor->saveAs($filename);

        download($filename, '/src/templateProcessor/index.php');

    } catch (\Exception $e) {
        error_log(print_r($e, 1));
        error();
    }
}

function error() {
    echo <<<EOF
<!doctype html>
<html class="no-js" lang="en" dir="ltr">
<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>FrosCon2018</title>
    <link rel="stylesheet" href="/assets/css/foundation.css">
    <link rel="stylesheet" href="/assets/css/app.css">
</head>

<body>
<div class="grid-container">
    <div class="grid-x grid-padding-x">
        <div class="large-12 cell">
            <h1>Something went wrong! :(</h1>
            
            <p><a href="/src/templateProcessor/index.php" class="button">go back</a><br/></p>
        </div>
    </div>
</div>


<script src="/assets/js/vendor/jquery.js"></script>
<script src="/assets/js/vendor/what-input.js"></script>
<script src="/assets/js/vendor/foundation.js"></script>
<script src="/assets/js/app.js"></script>

</body>
</html>
EOF;
}


