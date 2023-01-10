<?php 

// Agregar el codigo para verificar en la BD que el usuario y pass sean validos
    if ($_SERVER["REQUEST_METHOD"]=="POST")
      {
            $us=$_POST['nombre'];
            $ps=$_POST['pass'];

            $ins = json_encode(array("user" => "$us", "pwd" => "$ps"));
            
            $curl = curl_init();

            curl_setopt_array($curl, array(
                    CURLOPT_URL => 'http://127.0.0.1/api_restful/controllers/usuarios.php?op=sesion',
                    CURLOPT_RETURNTRANSFER => true,
                    CURLOPT_ENCODING => '',
                    CURLOPT_MAXREDIRS => 10,
                    CURLOPT_TIMEOUT => 0,
                    CURLOPT_FOLLOWLOCATION => true,
                    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                    CURLOPT_CUSTOMREQUEST => 'GET',
                    CURLOPT_POSTFIELDS =>$ins,
                    CURLOPT_HTTPHEADER => array(
                      'Content-Type: text/plain'
                    ),
                  ));
            
            $response = curl_exec($curl);
            curl_close($curl);
            $data = json_decode($response, true);

            if (count($data)>0)
            {
                echo "<script>
                         alert('.:: - B I E N V E N I D O - :: ');
                         location.href='index.php'; //redireccionar a otro archivo 
                       </script>";
            }
            else
            {
                echo "<script>
                        alert('.:: - Verificar Usuario y Contraseña - :: ');
                        location.href='login.php';
                      </script>";
            }    
            
      }

?>



<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>LOGIN DE ACCESO</title>
    <link rel='stylesheet' href='consumer/estilos.css'>
 

</head>
<body>
    <h1 align="center">ACCESO AL SISTEMA "API RESTful"</h1>
    <hr>
    

    <form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
        <table align="center">
            <tr align="center">
                <td><label for="us">Usuario:</label></td>
                <td><input type="text" name="nombre" id="us" required></td>
            </tr>
            <tr align="center">
                <td><label for="ps">Contraseña:</label></td>
                <td><input type="password" name="pass" id="ps" required></td>
            </tr>
            <tr align="center">
                <td><input type="submit" value="Entrar" name="entrar"></td>
                <td><input type="reset" value="Borrar" name="borrar"></td>
            </tr>
        </table>
    </form>

    <hr>
 

</body>
</html>


<?php 
//include_once("alertas.php");
?>