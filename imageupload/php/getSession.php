<?php
session_start();
?>

<!DOCTYPE html>
<html>
<head>
<title>Page Title</title>
</head>
<body>

<?php
echo "Username is: " . $_SESSION["user"] . ".";
?>
<h1>This is a Heading</h1>
<p>This is a paragraph.</p>

</body>
</html>

