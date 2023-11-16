<?php

require './../config/db.php';

if (isset($_POST['submit'])) {
    global $db_connect;
    
    $id = $_POST['id_tmukd'];
    $name = htmlspecialchars($_POST['name']);
    $price = $_POST['price'];

    if ($_FILES['image']['error'] !== UPLOAD_ERR_NO_FILE) {
        $image = $_FILES['image']['name'];
        $tempImage = $_FILES['image']['tmp_name'];

        $randomFilename = time() . '-' . md5(rand()) . '-' . $image;
        $uploadPath = $_SERVER['DOCUMENT_ROOT'] . '/upload/' . $randomFilename;

        if (move_uploaded_file($tempImage, $uploadPath)) {
            if ($_POST['image_old']) {
                unlink($_SERVER['DOCUMENT_ROOT'] . '/upload/' . $_POST['image_old']);
            }
        } else {
            echo "<script>alert('Error moving uploaded file. Data gagal diubah');</script>";
        }
    } else {
        $image = $_POST['image_old'];
    }

    mysqli_query($db_connect, "UPDATE products SET
        name = '$name',
        price = '$price',
        image = '$image'
        WHERE id = '$id'
    ");

    echo "<script>alert('Data berhasil diubah');</script>";
    header('location: ../show.php');
}
?>
