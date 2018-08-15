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
    $useStyles = $_POST['designChoice'] === '1';

    $fileName = 'MyGeneratedWord.docx';
    $phpWord  = new PhpWord();

    if ($useStyles) {
        $phpWord = setStyle($phpWord);
    }

    $section = $phpWord->addSection();

    if ($useStyles) {
        $header = $section->addHeader();
        $header->addText('This is my fabulous header!');

        $footer = $section->addFooter();
        $footer->addText('Footer text goes here.');
    }


    $textrun = $section->addTextRun();
    $textrun->addText('Some text. ');
    $textrun->addText('And more Text in this Paragraph.');
    $textrun->addText($content);

    $textrun = $section->addTextRun();
    $textrun->addText('New Paragraph!phpword office 365 ', ['bold' => true]);
    $textrun->addText('With text...', ['italic' => true]);

    $section->addText('Basic table', ['size' => 16, 'bold' => true]);

    $table = $section->addTable();
    for ($row = 1; $row <= 8; $row++) {
        $table->addRow();
        for ($cell = 1; $cell <= 5; $cell++) {
            $table->addCell(1750)->addText("Row {$row}, Cell {$cell}");
        }
    }


    $objWriter = IOFactory::createWriter($phpWord, 'Word2007');
    $objWriter->save(WORD_EXPORTS . $fileName);

    download($fileName);
}

function setStyle(PhpWord $phpWord)
{
    #TODO: Header, Footer, Margins, Textstyles, Watermark

    return $phpWord;
}




