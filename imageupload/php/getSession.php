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
header("Location: ../home.php");
?>

<?php 
	if ($_SESSION["user"] == "admin") { ?>
<h1>This is a Heading</h1>
<?php } ?>
<p>This is a paragraph.</p>

</body>
</html>

