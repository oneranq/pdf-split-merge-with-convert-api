<?php
require 'vendor/autoload.php';


use \ConvertApi\ConvertApi;
ConvertApi::setApiSecret('zhUBUFLK3G38OdHX');

function breakOutPDFIntoSeparatePages($bookName, $fileName) {
    /**
     * requirement from client
     *  
     */

    $numberOfPages = 0;
    //creating folder in output
    $dir = 'output/' . $bookName;
    if(is_dir($dir) == false) {
        mkdir($dir);
    }
    
    $result = ConvertApi::convert('split', [
        'File' => 'input/'. $fileName . '.pdf',
        ], 'pdf'
    );

    $result->saveFiles($dir);
    $numberOfPages = count($result->response['Files']);
    
    if(file_exists($dir)) {
        $files = array_diff(scandir($dir), array('..', '.'));
        foreach($files as $file) {
            $new_fileName = str_replace($fileName, $bookName, $file);
            if($new_fileName == $bookName.'.pdf'){
                $new_fileName = $bookName.'-1.pdf';
            }            
            rename($dir.'/'.$file, $dir.'/'.$new_fileName);
        }
    }
    print('split finished!');
    return $numberOfPages;
}

function combineSeparetePagesIntoPDF($bookName, $pageNumberArray, $newFilename) {
    /**
     * requirement from client
     * combine the pdf for each of the page numbers specifed in $page NumberArray into the pdf called $newFilename
     * use $bookName to identify the pages. E.g., if $bookName = "math" and $pageNumberArray = [2,4,7],
     * then combine files Math1-2. pdf, math1-4.pdf, and path1-7.pdf into jane pdf, where $newfilename = "jane"
     */

    $dir = 'output/' . $newFilename;
    if(is_dir($dir) == false) {
        mkdir($dir);
    }

    $pages = array();
    foreach($pageNumberArray as $value) {
        $fileName = 'input/'. $bookName . '-'. $value . '.pdf';
        array_push($pages, $fileName);
    }

    $result = ConvertApi::convert('merge', [
        'Files' => $pages,
        ], 'pdf'
    );
    $result->saveFiles($dir. '/' . $newFilename . '.pdf');
    print('merge finished!');
}


breakOutPDFIntoSeparatePages('Math1', 'sample');
// combineSeparetePagesIntoPDF('audit', [2, 3, 4], 'jane')

?>