<?php
// Simulate a request with a malicious mensaje parameter
$mensaje = "<script>alert('XSS Attack!');</script>";
echo "<div>" . htmlentities($mensaje, ENT_QUOTES, 'UTF-8') . "</div>";
?>
