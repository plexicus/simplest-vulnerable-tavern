<?php
echo "Visit the following URL to test the XSS vulnerability mitigation:\n";
echo "http://localhost/path/to/index.php?mensaje=<script>alert('XSS');</script>\n"; // Adjust the path as necessary
