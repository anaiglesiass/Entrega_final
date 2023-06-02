<!DOCTYPE html>
<html>
	<head>
		<title>Formulario Entrega final</title>
        <link rel="stylesheet" href="style.css" type="text/css">
	</head>
	<body>        
        <div class="middle_div" id='register_div'>
        <form method="POST" action="">
            <h2>Formulario de registro</h2>
            <br><br>
                <label for="nombre">Nombre<span><em>(requerido)</em></span></label><br>
                <input type="text" name="nombre" id="nombre" required><br>
                <br>

                <label for="p_apellido">Primer Apellido<span><em>(requerido)</em></span></label><br>
                <input type="text" name="p_apellido" id="p_apellido" required><br>
                <br>
                
                <!-- No imponemos que el segundo apellido sea obligatorio porque hay personas que no tienen dos apellidos:-->
                <label for="s_apellido">Segundo Apellido</label><br>
                <input type="text" name="s_apellido" id="s_apellido" ><br>
                <br>

                <label for="email">Email<span><em>(requerido)</em></span></label><br>
                <input type="email" name="email" id="email" required><br>
                
                <label for="nickname">Nickname<span><em>(requerido)</em></span></label><br>
                <input type="text" name="nickname" id="nickname" required><br>
                <br>
                <label for="password">Contraseña<span><em>(requerido)</em></span></label><br>
                <input type="password" name="password" id="password" required minlength="4" maxlength="8"><br>
                <br>

                
                <input class= "registerbtn" type="submit" name="submit" value="Registro" />
                
            <?php
                if(isset($_POST['submit'])){
                    $nombre = $_POST['nombre'];
                    $p_apellido = $_POST['p_apellido'];
                    $s_apellido = $_POST['s_apellido'];
                    $email = $_POST['email'];
                    // Supongo que el login que nos pide el enunciado es un nickname para hacer el login:
                    $nickname = $_POST['nickname'];
                    // Hasheamos la contraseña para guardarla con una capa de seguridad:
                    $password = password_hash($_POST['password'], PASSWORD_BCRYPT);

                // Comprobamos que todos los campos obligatorios están definidos:
                if (empty($nombre) || empty($p_apellido) || empty($email) || empty($nickname) || empty($password)) {
                    die("Los campos nombre, primer apellido, email, nickname y contraseña son obligatorios.");
                }

                // Comprobammos el formato de los datos:
                $email_pattern = "/^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/";


                if (!preg_match($email_pattern, $email)) {
                    die("El email no es válido");
                }

                if (strlen($_POST['password']) > 8 || strlen($_POST['password']) < 4) {
                    die("La contraseña debe tener entre 4 y 8 caracteres");
                }

                // Conexión con PDO

                $servername = "localhost:4324";
                $username_bbdd = "root";
                $password_bbdd = "";
                $dbname = "cursosql";
                
                    // Crear la conexión
                    $conn = new mysqli($servername, $username_bbdd, $password_bbdd, $dbname);

                    // Comprobar la conexión
                    if ($conn -> connect_error){
                        die('La conexión ha fallado'.$conn->connect_error);
                    }

                    $sql_register = "INSERT INTO registros(nombre, p_apellido, s_apellido, email, nickname, password) VALUES ('$nombre', '$p_apellido', '$s_apellido', '$email', '$nickname', '$password')";

                    try{
                    $conn->query($sql_register);
                        echo "<span style=\"text-align: center;\">Registro completado con éxito</span>";

                    
                    $conn->close();
                    } 
                    catch (mysqli_sql_exception $e) {
                        if (strpos($e, 'EMAIL') !== false){
                            echo "<span style=\"text-align: center;\">No se ha podido realizar el registro. <br>
                            Ya hay un usuario con este email.</span>";
                        }
                        else{
                        // Handle the mysqli_sql_exception exception
                        echo "Caught exception: " . $e->getMessage();}
                    }
                }
                ?>
        </form>
        <form  method="POST" action="">
         <input class= "registerbtn" type="submit" name="consulta" value="Consulta usuarios de la base de datos" />
         <span id='info_bbdd'>
        <?php
                
                // Conexión con PDO
                
                $servername = "localhost:4324";
                $username_bbdd = "root";
                $password_bbdd = "";
                $dbname = "cursosql";
                
                // Crear la conexión

                try {
                    // Create a new PDO instance
                    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username_bbdd, $password_bbdd);
                    
                    // Set the PDO error mode to exception
                    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                    
                    // Check if the button has been clicked
                    if (isset($_POST['consulta'])) {
                        // SQL query
                        $sql = "SELECT id, nombre, p_apellido, email FROM registros";
                        
                        // Execute the query and fetch the result set
                        $result = $conn->query($sql);
                        
                        // Check if the query was successful
                        if ($result) {
                            echo "<table>
                            <thead>
                                <tr>
                                    <th>Nombre</th>
                                    <th>Apellido</th>
                                    <th>Email</th>
                                </tr>
                            </thead>
                            <tbody>";
                            // Process the query result here (fetch rows, display data, etc.)
                            while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
                                // Access the retrieved data
                                echo "<tr><td>" . $row["nombre"] . "</td><td> " . $row["p_apellido"] . "</td><td>" . $row["email"] . "</td></tr>";
                            }
                            echo "</tbody></table>";
                            echo "<br><button class='registerbtn' type=\"button\" onclick=\"borrar_info()\">Cerrar información</button>";
                        } else {
                            // Handle query error
                            echo "Error: " . $sql . "<br>" . $conn->errorInfo()[2];
                        }
                    }
                } catch (PDOException $e) {
                    // Handle database connection errors
                    echo "La conexión ha fallado: " . $e->getMessage();
                }
                
                // Close the database connection
                $conn = null;
                ?>
                </span>
            </form>
        
        </div>
	</body>
<script>
borrar_info = function(){
    document.getElementById('info_bbdd').innerHTML='';
}
</script>
</html>
