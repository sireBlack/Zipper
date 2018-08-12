<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>File Zipper</title>
    <style>
        div{
            margin-top: 30px;
        }
        form{
            margin-left: 40%;
            margin-top: 10%;
        }
    </style>
</head>
<body>

    <form action="zip.php" method="post" enctype="multipart/form-data">
        <div>
            Case folder title
            <input type="text" name="folderTitle" />
        </div>
        <div>
            Case files
            <input type="file" name="caseFiles[]" multiple>
        </div>
        <div>
            Folder passord
            <input type="text" name="password" />
        </div>

        <div>
            <button name="zip">SEND</button>
        </div>
        
    </form>

</body>
</html>
