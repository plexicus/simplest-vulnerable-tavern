<?php
// Simulating a request with a malicious mensaje parameter
$_GET['mensaje'] = '<script>alert("XSS Attack");</script>';
include 'index.php'; // Include the index.php file to test the output
?>
