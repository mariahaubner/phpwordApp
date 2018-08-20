<?php
include_once '../includes.php';

use PhpOffice\PhpWord\PhpWord;
use PhpOffice\PhpWord\IOFactory;

if (isset($_POST['content']) && $_POST['content'] !== '') {
    generateContentFile();
    export();
} else {
    error();
}

function export()
{
    $generatedFile = WORD_EXPORTS . "Tmp.docx";
    $templateFile = WORD_FILES . "XPathTemplateOrange.docx";

    if ($_POST['templateChoice'] === 'blue') {
        $templateFile = WORD_FILES . "XPathTemplateBlue.docx";
    }

    $targetFileName = "XPathResult.docx";
    $targetFile = WORD_EXPORTS . $targetFileName;

    // copy template to target
    copy($templateFile, $targetFile);

    // open target
    $targetZip = new \ZipArchive();
    $targetZip->open($targetFile);
    $targetDocument = $targetZip->getFromName('word/document.xml');
    $targetDom = new DOMDocument();
    $targetDom->loadXML($targetDocument);
    $targetXPath = new \DOMXPath($targetDom);
    $targetXPath->registerNamespace("w", "http://schemas.openxmlformats.org/wordprocessingml/2006/main");

    // open source
    $sourceZip = new \ZipArchive();
    $sourceZip->open($generatedFile);
    $sourceDocument = $sourceZip->getFromName('word/document.xml');
    $sourceDom = new DOMDocument();
    $sourceDom->loadXML($sourceDocument);
    $sourceXPath = new \DOMXPath($sourceDom);
    $sourceXPath->registerNamespace("w", "http://schemas.openxmlformats.org/wordprocessingml/2006/main");

    /** @var DOMNode $placeholderNode node containing the replacement marker PLACEHOLDER$ */
    $placeholderNode = $targetXPath->query('//w:p[contains(translate(normalize-space(), " ", ""),"PLACEHOLDER")]')[0];

    // insert source nodes before the replacement marker
    $sourceNodes = $sourceXPath->query('//w:document/w:body/*[not(self::w:sectPr)]');

    foreach ($sourceNodes as $sourceNode) {
        $imported = $placeholderNode->ownerDocument->importNode($sourceNode, true);
        $inserted = $placeholderNode->parentNode->insertBefore($imported, $placeholderNode);
    }

    // remove $placeholderNode from the target DOM
    $placeholderNode->parentNode->removeChild($placeholderNode);

    // save target
    $targetZip->addFromString('word/document.xml', $targetDom->saveXML());
    $targetZip->close();

    download($targetFileName);
}

function generateContentFile()
{
    $content = $_POST['content'];

    $phpWord = new PhpWord();
    $section = $phpWord->addSection();

    $parts = explode("\n", $content);

    foreach ($parts as $part) {
        $section->addText($part);
    }

    $objWriter = IOFactory::createWriter($phpWord, 'Word2007');
    $objWriter->save(WORD_EXPORTS . 'Tmp.docx');
}
