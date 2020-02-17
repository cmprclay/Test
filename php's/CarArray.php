<!DOCTYPE html>
<html>
<body>

<?php
$cars = array("Volvo","BMW","Toyota");

foreach ($cars as $car)
{
	echo $car . " is a very nice car.<br>";
}
if(strcmp('Toyota', 'Toyota') == 0)
{
	echo '50% Sale.';
} else {
	echo 'Strings do not match.';
}
?>

</body>
</html>

