<?php
// Conexión a la base de datos (modifica con tus propios parámetros de conexión)
$servername = "localhost";
$username = "tu_usuario";
$password = "tu_contraseña";
$dbname = "tu_base_de_datos";

// Crear conexión
$conn = new mysqli($servername, $username, $password, $dbname);

// Verificar conexi\u00f3n
if ($conn->connect_error) {
    die("Conexi\u00f3n fallida: " . $conn->connect_error);
}

// Mitigated SQL Injection Vulnerability
if(isset($_GET['id'])) {
    $id = $_GET['id'];

    // Validate the input to ensure it's numeric
    if (is_numeric($id)) {
        // Use prepared statements to prevent SQL Injection
        $stmt = $conn->prepare("SELECT * FROM usuarios WHERE id = ?");
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($stmt->num_rows > 0) {
            while($row = $stmt->fetch_assoc()) {
                echo "<div>"htmlspecialchars($row['mensaje']";}}
                echo "id: " . htmlspecialchars($row["id"], ENT_QUOTES, 'UTF-8') . " - Nombre: " . htmlspecialchars($row["nombre"], ENT_QUOTES, 'UTF-8') . "<br>";
            }
        } else {
            echo "0 resultados";
        }
    } else {
        echo "ID inv\u00e1lido.";
    }
}

    if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
            echo "id: " . $row["id"]. " - Nombre: " . $row["nombre"]. "<br>";
        }
    } else {
        echo "0 resultados";
    }
}

// Vulnerabilidad de Cross-Site Scripting (XSS)
// El siguiente código es vulnerable a XSS ya que imprime directamente en el HTML el contenido de una variable que puede ser manipulada por el usuario sin ninguna sanitización.
if(isset($_GET['mensaje'])) {
    $mensaje = $_GET['mensaje']; // Input del usuario susceptible a XSS
    echo "<div>$mensaje</div>"; // Vulnerable a XSS
}

// Cerrar conexión
$conn->close();
?>
