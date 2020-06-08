<!DOCTYPE html>
<html lang="es">
    <head>
        <title>Inicio</title>
        <meta charset="utf-8"/>
        <script src="../../extras/js/buscar.js"></script>
        <link rel="stylesheet" type="text/css" href="../../extras/css/login.css" />
        <link rel="stylesheet" type="text/css" href="../../extras/css/crear_usuario.css" />

    </head>

    <body>

      <header class="cabecera">
        
        <h1>Registrar libro</h1>
      </header>

        <aside class="formulario">
          <?php
            $codigolib = $_GET['codigolib']; 
          ?>
            <form id="formulario01" method="POST" action="../controladores/crear_capitulos.php" 
                > 
                <span id="errorDatos" class="error"></span>  

                <input type="hidden" id="codigolib" name="codigolib" value='<?php echo $codigolib ?>' />

                <label for="ncapitulo"># Capitulo (*)</label> 
                <input type="number" id="ncapitulo" name="ncapitulo" />
                <br>
                <label for="nombrecap">Nombre Capitulo (*)</label> 
                <input type="text" id="nombrecap" name="nombrecap" value="" 
                placeholder="Ingrese el nombre del Capitulo ..." /> 
                <br>
                <label for="autorcod"># Código del autor (*)</label> 
                <input type="number" id="autorcod" name="autorcod" />
                <br>
                
                <input type="submit" id="crear" name="crear" value="Aceptar"/>                 
                <input type="reset" id="cancelar" name="cancelar" value="Cancelar" />
                
            </form>
        </aside>
        <aside class="datos">
          <h2>Buscar Autor</h2>
          <form onsubmit="return buscarAutor()" > 
            <input type="text" id="texto" name="texto" value=""> 
            <input type="button" id="buscar1" name="buscar1" value="Buscar" 
            onclick="buscarAutor()"> 
            <br>
            <br>
            <div id="informacion"><b>Datos del libro</b></div>
            <br>
            <br>
          </form>
        </aside>
        
       
    </body>
</html>