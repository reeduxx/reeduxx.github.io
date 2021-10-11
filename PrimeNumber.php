<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<title>Prime Number Form</title>
	<meta http-equiv="content-type" content="text/html; charset=iso-8859-1" />
</head>
<body>
	<?php
		$number = validateInput($_POST['number'], "number");
		
		if($errorCount > 0) {
			echo "Please re-enter the information below.<br />\n";
			redisplayForm($number);
		} else {
			$prime = FALSE;
			$divisions = 0;
			
			for($i = 1; $i <= $number; ++$i) {
				if($number % $i == 0) {
					++$divisions;
				}
			}
			
			if($divisions <= 2) {
				$prime = TRUE;
			}
			
			?>
				<h2 style = "text-align:center">Prime Number Form</h2>
				<p>The number you entered, <?php echo $number; ?>, is <?php
					if($prime) {
						echo "a prime number.";
					} else {
						echo "not a prime number.";
					}
					?>
			<?php
		}
		
		function displayRequired($fieldName) {
			echo "The $fieldName field is required.<br />\n";
		}
		
		function displayNonNumeric($fieldName) {
			echo "The $fieldName field is not a number.<br />\n";
		}
		
		function displayLessThan($fieldName) {
			echo "The $fieldName field is less than 1.<br />\n";
		}
		
		function displayGreaterThan($fieldName) {
			echo "The $fieldName field is greater than 999.<br />\n";
		}
		
		function validateInput($data, $fieldName) {
			global $errorCount;
			
			if(empty($data) && $data != 0) {
				displayRequired($fieldName);
				++$errorCount;
				$retval = "";
			}
			
			if(!is_numeric($data)) {
				displayNonNumeric($fieldName);
				++$errorCount;
				$retval = "";
			}
			
			if(is_numeric($data) && $data < 1) {
				displayLessThan($fieldName);
				++$errorCount;
				$retval = "";
			}
			
			if(is_numeric($data) && $data > 999) {
				displayGreaterThan($fieldName);
				++$errorCount;
				$retval = "";
			
			} else { // Only clean up the input if it isn't empty
				$retval = trim($data);
				$retval = stripslashes($retval);
			}
			
			return($retval);
		}
		
		$errorCount = 0;
		
		function redisplayForm($number) {
			?>
				<h2 style="text-align:center">Prime Number Form</h2>
				<form name="prime" action="PrimeNumber.php" method="post">
					<p>Enter a number between 1 and 999: <input type="text" name="number" value="<?php echo $number; ?>" /></p>
					<p><input type="reset" value="Clear Form" />&nbsp;
					&nbsp;<input type="submit" name="Submit" value="Send Form" />
				</form>
			<?php
		}
	?>
</body>
</html>