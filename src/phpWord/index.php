<?php

include_once '../includes.php';

$$phpWord = new PhpOffice\PhpWord\PhpWord();
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

$rows = 10;
$cols = 5;
$section->addText('Basic table', ['size' => 16, 'bold' => true]);

$table = $section->addTable();
for ($row = 1; $row <= 8; $row++) {
    $table->addRow();
    for ($cell = 1; $cell <= 5; $cell++) {
        $table->addCell(1750)->addText("Row {$row}, Cell {$cell}");
    }
}

$objWriter = \PhpOffice\PhpWord\IOFactory::createWriter($phpWord, 'Word2007');
$objWriter->save('MyDocument.docx');