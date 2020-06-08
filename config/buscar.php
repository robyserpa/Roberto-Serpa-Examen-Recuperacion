<?php 
    //incluir conexión a la base de datos 
    include "conexionBD.php"; 
    $estado = false;
    // $autores = [];
    // $sql = "SELECT * FROM libror"; 
    
    // $result = $conn->query($sql); 

     
    // if ($result->num_rows > 0) { 
    //     while($row = $result->fetch_assoc()) {
    //         echo("<h3>Libro</h3>");
    //         echo " <table class='misdatos''> 
    //             <tr> 
    //                 <th>Nombre</th>
    //                 <th>ISBN</th>
    //                 <th># Paginas</th>
    //             </tr>";
                
    //         $codigolib = $row["lib_codigo"];  
    //         echo "<tr>"; 
    //         echo " <td>" . $row["lib_nombre"] . "</td>";
    //         echo " <td>" . $row['lib_isbn'] ."</td>";
    //         echo " <td>" . $row['lib_npaginas'] . "</td>";
    //         echo "</table>";
            
    //         // echo("<h3>Capitulos</h3>");
    //         echo " <table class='misdatos''> 
    //             <tr> 
    //                 <th>Numero</th>
    //                 <th>Capitulo</th>
    //             </tr>"; 
    //         $sqlcap = "SELECT * FROM capitulosr WHERE lib_codigofk LIKE '$codigolib'";
    //         $capitulos = $conn->query($sqlcap);
    //         if ($capitulos->num_rows > 0) {
    //             while ($row = $capitulos->fetch_assoc()) {
    //                 $autores[] = $row["aut_codigofk"];  
    //                 echo "<tr>";
    //                 echo " <td>" . $row['cap_numero'] ."</td>";
    //                 echo " <td>" . $row['cap_titulo'] . "</td>";
    //                 echo "</tr>";
                    
    //             }
    //             echo "</table>";
    //         } else {
    //             echo "<tr>";
    //             echo " <td colspan='2'> No existen capitulos registrados en ese usuario </td>";
    //             echo "</tr>";
    //             echo "</table>";
    //         }

    //         echo " <table class='misdatos''> 
    //                 <tr> 
    //                     <th>Autor</th>
    //                     <th>Nacionalidad Autor</th>
    //                 </tr>";
    //         for($i = 0 ; $i < sizeof($autores); $i++){
    //             $sqlaut = "SELECT * FROM autorr WHERE aut_codigo LIKE '$autores[$i]'";
    //             $autor = $conn->query($sqlaut);
    //             // echo("<h3>Autor</h3>");
                 
    //             if ($autor->num_rows > 0) {
    //                 while ($row = $autor->fetch_assoc()) {
    //                     echo "<tr>";
    //                     echo " <td>" . $row['aut_nombre'] ."</td>";
    //                     echo " <td>" . $row['aut_nacionalidad'] . "</td>";
    //                     echo "</tr>";
                        
    //                 }
                    
    //             } else {
    //                 echo "<tr>";
    //                 echo " <td colspan='2'> No existen autores registrados en ese usuario </td>";
    //                 echo "</tr>";
    //                 echo "</table>";
    //             }
    //         }
    //         echo "</table>";
    //         $autores=[];
            
    //     echo "<br> <br> <hr>";
    //     } 
    // } else { 
    //     echo "<tr>"; 
    //     echo " <td colspan='7'> No existen libros registradas en el sistema </td>"; 
    //     echo "</tr>";
    //     echo "</table>"; 
    // }

    // $conn->close(); 

    ////////////////////////////////////////
    
    $aux = [];
    $texto = $_GET['texto']; 
    echo("<h2>Información del Autor </h2>");

    $sqlaut = "SELECT * FROM autorr WHERE aut_nombre LIKE '$texto'";
    $autor = $conn->query($sqlaut);
    if ($autor->num_rows > 0) {
        echo " <table class='misdatos''> 
        <tr> 
            <th>Autor</th>
            <th>Nacionalidad Autor</th>
        </tr>"; 

        $estado = true;
        while ($row = $autor->fetch_assoc()) {
            $codigoaut = $row['aut_codigo'];
            echo "<tr>";
            echo " <td>" . $row['aut_nombre'] ."</td>";
            echo " <td>" . $row['aut_nacionalidad'] . "</td>";
            echo "</tr>";
        }
        echo "</table>";


        echo " <table class='misdatos''> 
                <tr> 
                    <th>Numero Capitulo</th>
                    <th>Capitulo</th>
                </tr>"; 
        if($estado){
            // echo("<h2>Capitulos</h2>");
                            
            $sqlcap = "SELECT * FROM capitulosr WHERE aut_codigofk LIKE '$codigoaut'";
            $capitulos = $conn->query($sqlcap);
  
            if ($capitulos->num_rows > 0) {
                while ($row = $capitulos->fetch_assoc()) {
                    $aux[] = $row["lib_codigofk"];  
                    echo "<tr>";
                    echo " <td>" . $row['cap_numero'] ."</td>";
                    echo " <td>" . $row['cap_titulo'] . "</td>";
                    echo "</tr>";
                }
            } else {
                echo "<tr>";
                echo " <td colspan='2'> No existen capitulos registrados en ese usuario </td>";
                echo "</tr>";
            }
            echo "</table>";
    
            // echo("<h2>Libro detalles</h2>");
            echo " <table class='misdatos''> 
                    <tr> 
                        <th>Nombre libro</th>
                        <th>ISBN</th>
                        <th># Paginas</th>
        
                    </tr>";
            for($i = 0 ; $i < sizeof($aux); $i++){
                $sql = "SELECT * FROM libror WHERE lib_codigo LIKE '$aux[$i]'";
    
                // $sql = "SELECT * FROM libror WHERE lib_codigo LIKE '$codigocap' "; 
                
                $result = $conn->query($sql); 
                if ($result->num_rows > 0) { 
                    $estado = true;
                    while($row = $result->fetch_assoc()) {  
                        echo "<tr>"; 
                        echo " <td>" . $row["lib_nombre"] . "</td>";
                        echo " <td>" . $row['lib_isbn'] ."</td>";
                        echo " <td>" . $row['lib_npaginas'] . "</td>";
                    } 
                } else { 
                    echo "<tr>"; 
                    echo " <td colspan='7'> No existen libros registradas en el sistema </td>"; 
                    echo "</tr>"; 
                }   
            }
            $autores=[];
            echo "</table>";
            
            echo "<br> <br> <hr>";
            
        }
    } else {
        // echo "<tr>";
        // echo " <td colspan='2'> No existen autores registrados en ese usuario </td>";
        // echo "</tr>";
        // echo "</table>";

        // echo("<h2>Capitulos</h2>");                   
        $sqlcap = "SELECT * FROM capitulosr WHERE cap_titulo LIKE '$texto'";
        $capitulos = $conn->query($sqlcap);

        echo " <table class='misdatos''> 
            <tr> 
                <th>Numero Capitulo</th>
                <th>Capitulo</th>
            </tr>"; 

        if ($capitulos->num_rows > 0) {
            $estado = true;
            while ($row = $capitulos->fetch_assoc()) {
                $codigoaut = $row["aut_codigofk"];  
                $codigolib = $row["lib_codigofk"];
                echo "<tr>";
                echo " <td>" . $row['cap_numero'] ."</td>";
                echo " <td>" . $row['cap_titulo'] . "</td>";
                echo "</tr>";
            }
        } else {
            echo "<tr>";
            echo " <td colspan='2'> No existen datos registrados </td>";
            echo "</tr>";
        }
        echo "</table>";

        if($estado){
            // echo("<h2>Información del Autor</h2>");

            $sqlaut = "SELECT * FROM autorr WHERE aut_codigo LIKE '$codigoaut'";
            $autor = $conn->query($sqlaut);

            echo " <table class='misdatos''> 
                <tr> 
                    <th>Autor</th>
                    <th>Nacionalidad Autor</th>
                </tr>"; 

            if ($autor->num_rows > 0) {
                while ($row = $autor->fetch_assoc()) {
                    echo "<tr>";
                    echo " <td>" . $row['aut_nombre'] ."</td>";
                    echo " <td>" . $row['aut_nacionalidad'] . "</td>";
                    echo "</tr>";
                }
            } else {
                echo "<tr>";
                echo " <td colspan='2'> No existen autores registrados en ese usuario </td>";
                echo "</tr>";
            }
            echo "</table>";

            // echo("<h2>Libro detalles</h2>");

            $sql = "SELECT * FROM libror WHERE lib_codigo LIKE '$codigolib' "; 
            
            $result = $conn->query($sql); 
    
            echo " <table class='misdatos''> 
                <tr> 
                    <th>Nombre Libro</th>
                    <th>ISBN</th>
                    <th># Paginas</th>
    
                </tr>"; 
            if ($result->num_rows > 0) { 
                $estado = true;
                while($row = $result->fetch_assoc()) {
                    $codigolib = $row["lib_codigo"];  
                    echo "<tr>"; 
                    echo " <td>" . $row["lib_nombre"] . "</td>";
                    echo " <td>" . $row['lib_isbn'] ."</td>";
                    echo " <td>" . $row['lib_npaginas'] . "</td>";
                } 
            } else { 
                echo "<tr>"; 
                echo " <td colspan='7'> No existen libros registradas en el sistema </td>"; 
                echo "</tr>"; 
            }   
            echo "</table>";
        }
        echo "<br> <br> <hr>";
    }
    $conn->close(); 
?>