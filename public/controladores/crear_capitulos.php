<?php
    //incluir conexión a la base de datos
    include '../../config/conexionBD.php';
   
    $codigolib = isset($_POST["codigolib"]) ? mb_strtoupper(trim($_POST["codigolib"]), 'UTF-8') : null;
    $ncapitulo = isset($_POST["ncapitulo"]) ? mb_strtoupper(trim($_POST["ncapitulo"]), 'UTF-8') : null;
    $nombrecap = isset($_POST["nombrecap"]) ? mb_strtoupper(trim($_POST["nombrecap"]), 'UTF-8') : null;
    $autorcod = isset($_POST["autorcod"]) ? mb_strtoupper(trim($_POST["autorcod"]), 'UTF-8') : null;

    $sqlcap = "INSERT INTO capitulosr VALUES (0, '$ncapitulo', '$nombrecap', '$codigolib', '$autorcod')";
    if ($conn->query($sqlcap) === TRUE) { 
        echo "<p>Se ha creado el capitulo correctamemte!!!</p>";
    }else {
        if($conn->errno == 1062){
            echo "<p class='error'>El Capitulo  $nombrecap ya esta registrada en el sistema </p>";
        }else{
            echo "<p class='error'>Error: " . mysqli_error($conn) . "</p>";
        }
    }
    $conn->close();
    echo "<a href='../vista/index.html'>Regresar al inicio</a>";
    echo "<br><a href='../vista/crear_capitulo.php?codigolib=",$codigolib,"'>Agregar otro capitulo</a>";
?>