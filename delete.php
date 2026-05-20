<?php
    if(isset($_GET['file'])){
        $file = basename($_GET['file']); // basename untuk keamanan
        $path = "uploads/" . $file;

        if(file_exists($path)){
            unlink($path);
            header("Location: index.php?delete=1");
        } else {
            echo "File tidak ditemukan.";
        }
    } else {
        header("Location: index.php");
    }
?>