<?php 
    //incluir conexión a la base de datos 
    include "conexionBD.php"; 
    
    $texto = $_GET['texto']; 
    // aut_nombre='$texto' or cap_titulo= $cap_titulo
    $sql = "SELECT * FROM autorr WHERE (aut_codigo = '$texto')"; 
    
    $result = $conn->query($sql); 

    echo " <table class='misdatos''> 
        <tr> 
            <th>Autor</th>
            <th>Nacionalidad Autor</th>
        </tr>"; 

    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            echo "<tr>";
            echo " <td>" . $row['aut_nombre'] ."</td>";
            echo " <td>" . $row['aut_nacionalidad'] . "</td>";
            echo "</tr>";
        }
    } else {
        echo "<tr>";
        echo " <td colspan='2'> No existen autores registrados </td>";
        echo "</tr>";
    }
    echo "</table>";
    echo "<br> <br> <hr>";
    
    $conn->close(); 

?>