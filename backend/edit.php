<?php

require './../config/db.php';

if (isset($_POST['submit'])) {
    global $db_connect;

    $id = $_POST['id'];
    $name = htmlspecialchars($_POST['name']);
    $price = $_POST['price'];
    $gambar_lama = $_POST['image_old'];

    if ($_FILES['image']['error'] === 4) {
        // Jika tidak ada gambar yang diupload, gunakan gambar lama
        $gambar = $gambar_lama;
    } else {
        $image = $_FILES['image']['name'];
        $tempImage = $_FILES['image']['tmp_name'];

        $randomFilename = time() . '-' . md5(rand()) . '-' . $image;
        $uploadPath = '../upload/' . $randomFilename;

        $gambar = "/upload/$randomFilename";

        $upload = move_uploaded_file($tempImage, $uploadPath);
        if (!$upload) {
            echo "gagal upload";
            exit; // Keluar dari skrip jika gagal upload
        }
    }

    // Memperbarui data di database
    mysqli_query($db_connect, "UPDATE products SET
        name = '$name',
        price = '$price',
        image = '$gambar' 
        WHERE id = '$id'
    ");
    header('location: ./../show.php');
}
