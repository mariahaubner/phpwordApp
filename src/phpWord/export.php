<?php

include_once '../includes.php';

use PhpOffice\PhpWord\PhpWord;
use PhpOffice\PhpWord\IOFactory;

if (isset($_POST['data'])) {
    export();
} else {
    error();
}

function export()
{
    $data = json_decode($_POST['data']);
    if (!$data) {
        error();
    }

    $phpWord = new PhpWord();

    #TODO: Export one document, two Designs (plain & styled), $data contains design-choice

    if ($data['styled']) {
        $phpWord = setStyle($phpWord);
    }

    $phpWord = setContent($phpWord);


    $objWriter = IOFactory::createWriter($phpWord, 'Word2007');
    $objWriter->save(WORD_FILES . 'MyDocument.docx');

    download(WORD_FILES . 'MyDocument.docx');

    #TODO: Redirect
}

function setContent(PhpWord $phpWord)
{
    $section = $phpWord->addSection();

    $header = $section->addHeader();
    $header->addText('This is my fabulous header!');

    $footer = $section->addFooter();
    $footer->addText('Footer text goes here.');

    $textrun = $section->addTextRun();
    $textrun->addText('Some text. ');
    $textrun->addText('And more Text in this Paragraph.');

    $textrun = $section->addTextRun();
    $textrun->addText('New Paragraph! ', ['bold' => true]);
    $textrun->addText('With text...', ['italic' => true]);

    $section->addText('Basic table', ['size' => 16, 'bold' => true]);

    $table = $section->addTable();
    for ($row = 1; $row <= 8; $row++) {
        $table->addRow();
        for ($cell = 1; $cell <= 5; $cell++) {
            $table->addCell(1750)->addText("Row {$row}, Cell {$cell}");
        }
    }

    return $phpWord;
}

function setStyle(PhpWord $phpWord)
{
    #TODO: Header, Footer, Margins, Textstyles, Watermark

    return $phpWord;
}

function error()
{
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


