<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Web Upload</title>

    <style>
        *{
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: Arial, sans-serif;
        }

        body{
            background: linear-gradient(to right, #4facfe, #00f2fe);
            min-height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            padding: 20px;
        }

        .container{
            width: 500px;
            background: white;
            padding: 30px;
            border-radius: 15px;
            box-shadow: 0 5px 20px rgba(0,0,0,0.2);
        }

        h1{
            text-align: center;
            margin-bottom: 25px;
            color: #333;
        }

        input[type="file"]{
            width: 100%;
            margin: 20px 0;
        }

        .btn{
            width: 100%;
            padding: 12px;
            border: none;
            border-radius: 8px;
            background: #4facfe;
            color: white;
            font-size: 16px;
            cursor: pointer;
            transition: 0.3s;
        }

        .btn:hover{
            background: #008cdd;
        }

        .message{
            background: #d4edda;
            color: #155724;
            padding: 10px;
            border-radius: 5px;
            margin-bottom: 15px;
            text-align: center;
        }

        .file-list{
            margin-top: 30px;
        }

        .file-item{
            background: #f5f5f5;
            padding: 12px;
            border-radius: 8px;
            margin-bottom: 10px;
        }

        .file-item img{
            width: 100%;
            border-radius: 10px;
            margin-bottom: 10px;
        }

        .actions{
            margin-top: 10px;
        }

        .actions a{
            text-decoration: none;
            color: white;
            padding: 8px 12px;
            border-radius: 5px;
            margin-right: 5px;
            font-size: 14px;
        }

        .download{
            background: #28a745;
        }

        .delete{
            background: #dc3545;
        }
    </style>
</head>
<body>

<div class="container">

    <h1>📁 Web Upload</h1>

    <?php
        if(isset($_GET['success'])){
            echo "<div class='message'>File berhasil diupload!</div>";
        }

        if(isset($_GET['delete'])){
            echo "<div class='message'>File berhasil dihapus!</div>";
        }
    ?>

    <form action="upload.php" method="post" enctype="multipart/form-data">
        <input type="file" name="fileToUpload" required>
        <button type="submit" class="btn">Upload File</button>
    </form>

    <div class="file-list">
        <h2>Daftar File</h2>
        <br>

        <?php
            $folder = "uploads/";

            if(is_dir($folder)){
                $files = scandir($folder);

                foreach($files as $file){
                    if($file != "." && $file != ".."){
                        $path = $folder . $file;
                        $ext = strtolower(pathinfo($path, PATHINFO_EXTENSION));
                        
                        echo "<div class='file-item'>";
                        
                        // Jika file adalah gambar, tampilkan previewnya
                        if(in_array($ext, ['jpg','jpeg','png','gif'])){
                            echo "<img src='$path' alt='$file'>";
                        }

                        echo "<b>$file</b>";
                        
                        // Bagian ini sudah diperbaiki tanda kutipnya menggunakan backslash (\") agar tidak bentrok
                        echo "
                        <div class='actions'>
                            <a class='download' href='$path' download>Download</a>
                            <a class='delete' href='delete.php?file=$file' onclick=\"return confirm('Yakin ingin menghapus file ini?')\">Delete</a>
                        </div>
                        ";

                        echo "</div>";
                    }
                }
            }
        ?>
    </div>

</div>

</body>
</html>