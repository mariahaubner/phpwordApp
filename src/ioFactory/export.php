<?php

include_once '../includes.php';

use PhpOffice\PhpWord\PhpWord;
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

    $textrun = $section->addTextRun();
    $textrun->addText('Some text. ');
    $textrun->addText('And more Text in this Paragraph.');
    $textrun->addText($content);

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

    $phpWord->save(WORD_EXPORTS . $fileName);

    download($fileName);
}
