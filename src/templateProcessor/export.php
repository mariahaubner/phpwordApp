<?php

include_once '../includes.php';

use PhpOffice\PhpWord\TemplateProcessor;

if (isset($_POST['name'])) {
    export();
} else {
    error();
}

function export()
{
    $name = $_POST['name'];
    $street = $_POST['street'];
    $city = $_POST['city'];

    $filename = "Invitation_$name.docx";

    try {
        $templateProcessor = new TemplateProcessor(WORD_FILES . 'Invitation.docx');
        $templateProcessor->setValue('salutation', 'Dear ' . $_POST['name']);
        $templateProcessor->setValue(
            ['city', 'street'],
            [$city, $street]
        );

        $templateProcessor->saveAs(WORD_EXPORTS . $filename);

        download($filename);

    } catch (\Exception $e) {
        error_log(print_r($e, 1));
        error();
    }
}
