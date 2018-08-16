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

    $section = $phpWord->addSection();

    if ($useStyles) {
        $phpWord->setDefaultFontName('Courier New');
        $phpWord->setDefaultFontSize(10);


        $phpWord->setDefaultParagraphStyle(
            [
                "spaceAfter" => 140,
                "spaceBefore" => 0,
                "lineHeight" => 1.2,
                "keepLines" => true
            ]
        );
        $section->getStyle()->setMarginLeft(2.5 * 567);
        $section->getStyle()->setMarginTop(5.0 * 567);
        $section->getStyle()->setMarginBottom(10 * 567);
        $section->getStyle()->setMarginRight(2.0 * 567);


        $phpWord->addTableStyle('headerTable', ['borderBottomSize' => 1, 'borderBottomColor' => '000000']);

        $header = $section->addHeader();
        $headerTable = $header->addTable('headerTable')->addRow();
        $headerTable->addCell(4500)->addText('A Header got generated!');
        $headerTable->addCell(4500)->addImage(IMAGES . 'froscon_frog_small.png', ['align' => 'right']);

        $footer = $section->addFooter();
        $footer->addPreserveText('Page {PAGE} of {NUMPAGES}.');

        $header->addWatermark(IMAGES . 'froscon_frog_transparent.png');
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




