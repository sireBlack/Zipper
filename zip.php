<?php
if (isset($_POST['zip'])){

    $zip = new ZipArchive();

    $folderName = $_POST['folderTitle']; //Folder name as recieved from the form
    $password = $_POST['password']; //Password to lock the folder with

    $zipFile = __DIR__ . '/zippedFiles/'.$folderName.'.zip'; //Specify the zip file

    $zipStatus = $zip->open($zipFile, ZipArchive::CREATE);
    
    //Check if the zipped file has been created...

    if ($zipStatus !== true) {
        throw new RuntimeException(sprintf('Failed to create zip archive. (Status code: %s)', $zipStatus));
    }

    //Set the password of the folder

    if (!$zip->setPassword($password)) {
        throw new RuntimeException('Set password failed');
    }

    /**
     * Move the files to a temporary location
     * Add the files to the zip folder
     */

    for($i=0; $i < count($_FILES['caseFiles']['name']); $i++)
    {   
        move_uploaded_file($_FILES['caseFiles']['tmp_name'][$i], __DIR__.'/tempLocation/'.''.$_FILES['caseFiles']['name'][$i]);
        $fileName = __DIR__.'/tempLocation/'.''.$_FILES['caseFiles']['name'][$i];
        $baseName = basename($fileName);
        if (!$zip->addFile($fileName, $baseName)) {
            throw new RuntimeException(sprintf('Add file failed: %s', $fileName));
        }
        if (!$zip->setEncryptionName($baseName, ZipArchive::EM_AES_256)) {
            throw new RuntimeException(sprintf('Set encryption failed: %s', $baseName));
        }
    }
    $zip->close();
}