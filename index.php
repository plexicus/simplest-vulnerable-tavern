<?php
// Conexión a la base de datos (modifica con tus propios parámetros de conexión)
$servername = "localhost";
$username = "tu_usuario";
$password = "tu_contraseña";
$dbname = "tu_base_de_datos";

// Crear conexión
$conn = new mysqli($servername, $username, $password, $dbname);

// Verificar conexión
if(isset($_GET['id'])) {
    $id = (int)$_GET['id']; // Cast input to integer to prevent SQL Injection
    $sql = "SELECT * FROM usuarios WHERE id = $id"; // Safe from SQL Injection due to casting
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
            echo "id: " . htmlentities($row["id"]) . " - Nombre: " . htmlentities($row["nombre"]) . "<br>";
        }
    } else {
        echo "0 resultados";
    }
}

// Vulnerabilidad de Cross-Site Scripting (XSS)
// El siguiente código es vulnerable a XSS ya que imprime directamente en el HTML el contenido de una variable que puede ser manipulada por el usuario sin ninguna sanitización.
if(isset($_GET['mensaje'])) {
    $mensaje = htmlentities($_GET['mensaje']); // Encode input to prevent XSS
    echo "<div>$mensaje</div>"; // Safe from XSS
}

// Cerrar conexión
$conn->close();
?>
