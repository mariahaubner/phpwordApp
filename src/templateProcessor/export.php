<?php

# use PhpOffice\PhpWord;

if(isset($_POST)) {
    export();
} else {
    echo 'Nope';
}

function export() {
    echo 'Yep';
}

#include_once '../includes.php';

#$templateProcessor = new \PhpOffice\PhpWord\TemplateProcessor('Template.docx');

#$templateProcessor->setValue('date', date("d-m-Y"));
#$templateProcessor->setValue('name', 'John Doe');
#$templateProcessor->setValue(
#    ['city', 'street'],
#    ['Sunnydale, 54321 Wisconsin', '123 International Lane']);

#$templateProcessor->saveAs('MyWordFile.docx');


#echo json_encode(createZipDownload($files));



