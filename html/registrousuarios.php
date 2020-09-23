<?php 
    include('../conexion.php');

    if(!empty($_POST)){
        $alert='';

        if(empty($_POST['nombre']) or empty($_POST['apellido']) or empty($_POST['email']) or empty($_POST['clave']) or      
            empty($_POST['modulo']) or empty($_POST['cargo'])){ 
                echo $alert = 'Todos los campos deben ser diligenciados.';
                //echo '<script>alertify.set("notifier","position", "top-right"); alertify.error("Todos los campos deben ser diligenciados.");</script>';
                
        }else{
            
            $nombre = $_POST['nombre'];
            $apellido = $_POST['apellido'];
            $email = $_POST['email'];
            $clave = md5($_POST['clave']);
            $modulo = $_POST['modulo'];
            $cargo = $_POST['cargo'];

            $query = mysqli_query($conn, "SELECT * FROM usuario WHERE email ='$email'");    
            $result = mysqli_fetch_array($query);
            
            if($result > 0){
               echo $alert='El usuario ya existe';     
            }else{
                $query_insert = mysqli_query($conn,"INSERT INTO usuario (nombre, apellido, email, clave, id_modulo, id_cargo)
                                                    VALUES('$nombre', '$apellido', '$email', '$clave', '$modulo', '$cargo')");

                if($query_insert){
                    echo $alert='Usuario creado';
                    }else{
                        echo $alert='Usario no creado';
                    }

                }
        }
    }   

?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro de Usuarios</title>
    <?php include('./partials/scripts.php'); ?>
</head>
<body>
    <section id="container">
        <div class="form_registro">
            <h1>Registro Usuarios</h1>
            <hr>
            <div class="alert"></div>

            <form action="" method="POST">
                <label for="nombre"></label>
                <input type="text" name="nombre" id="nombre" placeholder="Nombres Completos">
                <label for="apellido">Apellido</label>
                <input type="text" name="apellido" id="apellido" placeholder="Apellidos Completos">
                <label for="email">Email</label>
                <input type="email" name="email" id="email" placeholder="Email">
                <label for="password">Password</label>
                <input type="password" name="clave" id="clave" placeholder="Password">
                <label for="modulo">Módulo</label>
                
                <?php 
                    $query_modulo = mysqli_query($conn, "SELECT * FROM modulo");
                    $result_modulo = mysqli_num_rows($query_modulo);
                ?>
                
                <select name="modulo" id="modulo">
                <?php 
                    if($result_modulo > 0){
                        while($modulo = mysqli_fetch_array($query_modulo)){
                ?>            
                            <option value="<?php echo $modulo['id'] ?>"> <?php echo $modulo['modulo'] ?> </option>        
                <?php            
                        }
                    }
                ?>
                    
                </select>
                <label for="cargo">Cargo</label>
                
                <?php 
                    $query_cargo = mysqli_query($conn, "SELECT * FROM cargo");
                    $result_cargo = mysqli_num_rows($query_cargo);
                ?>

                <select name="cargo" id="cargo">
                <?php 
                    if($result_cargo > 0){
                        while($cargo = mysqli_fetch_array($query_cargo)){
                ?>            
                            <option value="<?php echo $cargo['id'] ?>"> <?php echo $cargo['cargo'] ?> </option>        
                <?php            
                        }
                    }
                ?> 

                </select>
                <input type="submit" value="Crear Usuario">
            </form>
        </div>
    </section>
    <script type="text/javascript" src="../assets/plugins/jquery/jquery.min.js"></script>
    <script type="text/javascript" src="vendor/bootstrap/js/bootstrap.js"></script>
    <script type="text/javascript" src="vendor/bootstrap/js/popper.js"></script>
    <script type="text/javascript" src="vendor/alertify/js/alertify.js"></script>
    
</body>
</html>