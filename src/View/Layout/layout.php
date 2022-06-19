<!DOCTYPE html>

<html lang="en">
<head>
    <meta charset="utf-8">
    <title>Upload Image</title>


    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    



</head>
<body>
<div class="container">
    <h2>Upload an Image</h2>
    <?php echo $_SESSION['message']; ?>

    <form method="POST" action="<?php echo BASE_URL;?>user/add" enctype="multipart/form-data">        
        <div>Name: <input type="text" name="image_name" value=""></div>
        <div>Description: <textarea name="description" ></textarea></div>
            <div>
           <div>Upload an Image: <input type="file" name="image_upload" value=""></div>
            <div><button type="submit" name="uploadfile">UPLOAD</button></div>

        </form>
</div>
</body>
</html>