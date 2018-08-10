<?php

include_once '../includes.php';

$phpWord = \PhpOffice\PhpWord\IOFactory::load('MergeTemplate.docx', 'Word2007');

$section = $phpWord->addSection();

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

$phpWord->save('LoadResult.docx');