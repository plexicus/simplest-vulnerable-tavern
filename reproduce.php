<?php
// Simulating SQL Injection vulnerability
$servername = "localhost";
$username = "tu_usuario";
$password = "tu_contraseña";
$dbname = "tu_base_de_datos";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Vulnerable SQL query
if (isset($_GET['id'])) {
    $id = $_GET['id']; // User input taken directly from the URL
    $sql = "SELECT * FROM usuarios WHERE id = $id"; // Vulnerable to SQL Injection
    $stmt = $conn->prepare("SELECT * FROM usuarios WHERE id = ?"); // Use prepared statement
    $stmt->bind_param("i", $id); // Bind the user input to the prepared statement
    $stmt->execute(); // Execute the prepared statement
    $result = $stmt->get_result(); // Get the result set from the executed statement
    $stmt->bind_param("i", $id); // Bind the user input to the prepared statement
    $stmt->execute(); // Execute the prepared statement
    $result = $stmt->get_result(); // Get the result set from the executed statement

    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            echo "id: " . $row["id"] . " - Nombre: " . $row["nombre"] . "<br>";
        }
    } else {
        echo "0 resultados";
    }
}

// Close connection
$conn->close();
?>
