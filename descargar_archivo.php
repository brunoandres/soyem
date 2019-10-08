<?php
if(!empty($_GET['archivo'])){
    $fileName = basename($_GET['archivo']);
    $filePath = 'back_muni/'.$fileName;
    if(!empty($fileName) && file_exists($filePath)){
        // Define headers
        header("Cache-Control: public");
        header("Content-Description: File Transfer");
        header("Content-Disposition: attachment; filename=$fileName");
        header("Content-Type: application/zip");
        header("Content-Transfer-Encoding: binary");
        
        // Read the file
        readfile($filePath);
        exit;
    }else{
        echo '<script>
        alert("El archivo no existe!");
        window.location="listado_muni.php";
        </script>';

    }
}