<?php
    //incluir conexión a la base de datos
    include '../../config/conexionBD.php';

    $nombre = isset($_POST["nombre"]) ? mb_strtoupper(trim($_POST["nombre"]), 'UTF-8') : null;
    $isbn = isset($_POST["isbn"]) ? mb_strtoupper(trim($_POST["isbn"]), 'UTF-8') : null;
    $paginas = isset($_POST["npaginas"]) ? mb_strtoupper(trim($_POST["npaginas"]), 'UTF-8') : null;

    $sql = "INSERT INTO libror VALUES (0, '$nombre', '$isbn', '$paginas')";
    

    if ($conn->query($sql) === TRUE) { 
        echo "<p>Se ha creado el libro correctamemte!!!</p>";        
    } else {
        if($conn->errno == 1062){
            echo "<p class='error'>El libro $nombre ya esta registrada en el sistema </p>";
        }else{
            echo "<p class='error'>Error: " . mysqli_error($conn) . "</p>";
        }
    }

    $sqllib = "SELECT * FROM libror WHERE (lib_nombre='$nombre' )";
    $libro = $conn->query($sqllib);
    if ($libro->num_rows > 0) { 
        while($row = $libro->fetch_assoc()) {
            $codigolib = $row["lib_codigo"];
        }
    }else {
        if($conn->errno == 1062){
            echo "<p class='error'>Error </p>";
        }else{
            echo "<p class='error'>Error: " . mysqli_error($conn) . "</p>";
        }
    }
    $conn->close();
    echo "<a href='../vista/crear_capitulo.php?codigolib=",$codigolib,"'>Crear capitulos</a>";
?>