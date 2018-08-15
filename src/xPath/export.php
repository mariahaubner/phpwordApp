<?php
include_once '../includes.php';

use PhpOffice\PhpWord\PhpWord;
use PhpOffice\PhpWord\IOFactory;

if (isset($_POST['content']) && $_POST['content'] !== '') {
    export();
} else {
    var_dump($_POST);
    #error();
}

function export()
{
    $templateFile  = "MergeTemplate.docx";
    $generatedFile = "MyDocument.docx";
    $targetFile    = "MergeResult.docx";

// copy template to target
    copy($templateFile, $targetFile);

// open target
    $targetZip = new \ZipArchive();
    $targetZip->open($targetFile);
    $targetDocument = $targetZip->getFromName('word/document.xml');
    $targetDom      = new DOMDocument();
    $targetDom->loadXML($targetDocument);
    $targetXPath = new \DOMXPath($targetDom);
    $targetXPath->registerNamespace("w", "http://schemas.openxmlformats.org/wordprocessingml/2006/main");

// open source
    $sourceZip = new \ZipArchive();
    $sourceZip->open($generatedFile);
    $sourceDocument = $sourceZip->getFromName('word/document.xml');
    $sourceDom      = new DOMDocument();
    $sourceDom->loadXML($sourceDocument);
    $sourceXPath = new \DOMXPath($sourceDom);
    $sourceXPath->registerNamespace("w", "http://schemas.openxmlformats.org/wordprocessingml/2006/main");

    /** @var DOMNode $replacementMarkerNode node containing the replacement marker $CONTENT$ */
    $replacementMarkerNode = $targetXPath->query('//w:p[contains(translate(normalize-space(), " ", ""),"$CONTENT$")]')[0];

// insert source nodes before the replacement marker
    $sourceNodes = $sourceXPath->query('//w:document/w:body/*[not(self::w:sectPr)]');

    foreach ($sourceNodes as $sourceNode) {
        $imported = $replacementMarkerNode->ownerDocument->importNode($sourceNode, true);
        $inserted = $replacementMarkerNode->parentNode->insertBefore($imported, $replacementMarkerNode);
    }

// remove $replacementMarkerNode from the target DOM
    $replacementMarkerNode->parentNode->removeChild($replacementMarkerNode);

// save target
    $targetZip->addFromString('word/document.xml', $targetDom->saveXML());
    $targetZip->close();
}
