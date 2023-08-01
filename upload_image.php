


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>

    <form action="upload_image.php" method="post" enctype="multipart/form-data">
        <input type="file" name="my_image">
        <input type="submit" name="submit" value="upload">

    </form>
</body>
</html>


<?php
if (isset($_POST['submit'])) {
    $file = $_FILES['my_image'];

    print_r($file); // Using print_r to display the array containing file information

    $fileExt = explode('.', $file['name']);
    echo "<pre>";


    $fileActualExt = strtolower( end($fileExt));
    print_r($fileActualExt);

    $allowedExt = array('jpg','jpeg','png');

// check file extension
    if( in_array($fileActualExt , $allowedExt) ){

        // check file upload sucessful or not
        if($file['error'] === 0){

            // check file size lesss than 10kb
            if( $file['size'] < 100000){
                //give a unique id to name ie time in ms + file_name
                $file_id = uniqid('',true).".".$file['name'];
               
                $file_destination = './upload/'.$file['name'];
               
                // uploading image by specifying current and destination location
                move_uploaded_file($file['tmp_name'], $file_destination);

                echo "<br> file upload Successful";

                header("Location: upload_image.php?uploadsucessful");
            }
            else{
                echo "file size is large";
            }
        }
        else{
            echo "cant upload file";
        }

    }
    else{
        echo "File type not match";
    }
}
?>
