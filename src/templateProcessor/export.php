<?php

include_once '../includes.php';

use PhpOffice\PhpWord\TemplateProcessor;

if (isset($_POST['data'])) {
    export();
} else {
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

function export()
{
    $templateProcessor = new TemplateProcessor('Template.docx');
    $data = json_decode($_POST['data']);
    $index = 0;
    $files = [];

    foreach ($data as $set) {
        $index++;
        $filename = WORD_FILES . "temp_$index.docx";

        $templateProcessor->setValue('name', $set['name']);
        $templateProcessor->setValue(
            ['city', 'street'],
            [$set['city'], $set['street']]
        );
        $templateProcessor->setValue('salutation', $set['salutation']);

        $templateProcessor->saveAs($filename);

        $files[] = $filename;
    }

    $file = createZipFile($files, 'invitations');

    download($file);

    #TODO: Redirect
}


