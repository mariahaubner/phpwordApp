<?php

include_once '../includes.php';

use PhpOffice\PhpWord\IOFactory;

if (isset($_POST['content']) && $_POST['content'] !== '') {
    export();
} else {
    error();
}

function export()
{
    $content   = $_POST['content'];

    $fileName = 'FactoryResult.docx';
    $phpWord = IOFactory::load(WORD_FILES . 'FactoryTemplate.docx', 'Word2007');

    $section = $phpWord->addSection();

    $parts = explode("\n", $content);

    foreach ($parts as $part) {
        $section->addText($part);
    }

    $phpWord->save(WORD_EXPORTS . $fileName);

    download($fileName);
}
