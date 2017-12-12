<?php # Script 10.3 - edit_user.php
// This page is for editing a user record.
// This page is accessed through view_users.php.
$page_title = 'Edit a User';
include ('includes/header.html');
echo '<h1>Edit a User</h1>';
// Check for a valid user ID, through GET or POST:
if ( (isset($_GET['id'])) && (is_numeric($_GET['id'])) ) { // From view_users.php
	$id = $_GET['id'];
} elseif ( (isset($_POST['id'])) && (is_numeric($_POST['id'])) ) { // Form submission.
	$id = $_POST['id'];
} else { // No valid ID, kill the script.
	echo '<p class="error">This page has been accessed in error.</p>';
	include ('includes/footer.html');
	exit();
}

DEFINE ('DB_USER', 'root');
DEFINE ('DB_PASSWORD', '');
DEFINE ('DB_HOST', 'localhost');
DEFINE ('DB_NAME', 'accounts');
// Make the connection:
$dbc = @mysqli_connect (DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
// Make the connection:
$dbc = @mysqli_connect (DB_HOST, DB_USER, DB_PASSWORD, DB_NAME) OR die ('Could not connect to MySQL: ' . mysqli_connect_error() );
// Set the encoding...
mysqli_set_charset($dbc, 'utf8');
// Check if the form has been submitted:
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
	$errors = array();

	// Check for a first name:
	if (empty($_POST['username'])) {
		$errors[] = 'You forgot to enter your username.';
	} else {
		$fn = mysqli_real_escape_string($dbc, trim($_POST['username']));
	}

	// Check for a last name:
	if (empty($_POST['email'])) {
		$errors[] = 'You forgot to enter your email.';
	} else {
		$ln = mysqli_real_escape_string($dbc, trim($_POST['email']));
	}
	// Check for an email address:
	if (empty($_POST['password'])) {
		$errors[] = 'You forgot to enter your password.';
	} else {
		$e = mysqli_real_escape_string($dbc, trim($_POST['password']));
	}

	if (empty($errors)) { // If everything's OK.

		//  Test for unique email address:
		$q = "SELECT id FROM users WHERE email='$e' AND id != $id";
		$r = @mysqli_query($dbc, $q);
		if (mysqli_num_rows($r) == 0) {
			// Make the query:
			$q = "UPDATE users SET username='$fn', email='$ln', password='$e' WHERE id=$id LIMIT 1";
			$r = @mysqli_query ($dbc, $q);
			if (mysqli_affected_rows($dbc) == 1) { // If it ran OK.
				// Print a message:
				echo '<p>The user has been edited.</p>';

			} else { // If it did not run OK.
				echo '<p class="error">The user could not be edited due to a system error. We apologize for any inconvenience.</p>'; // Public message.
				echo '<p>' . mysqli_error($dbc) . '<br />Query: ' . $q . '</p>'; // Debugging message.
			}

		} else { // Already registered.
			echo '<p class="error">The email address has already been registered.</p>';
		}

	} else { // Report the errors.
		echo '<p class="error">The following error(s) occurred:<br />';
		foreach ($errors as $msg) { // Print each error.
			echo " - $msg<br />\n";
		}
		echo '</p><p>Please try again.</p>';

	} // End of if (empty($errors)) IF.
} // End of submit conditional.
// Always show the form...
// Retrieve the user's information:
$q = "SELECT username, email, password FROM users WHERE id=$id";
$r = @mysqli_query ($dbc, $q);
if (mysqli_num_rows($r) == 1) { // Valid user ID, show the form.
	// Get the user's information:
	$row = mysqli_fetch_array ($r, MYSQLI_NUM);

	// Create the form:
	echo '<form action="edit_user.php" method="post">
<p>Username: <input type="text" name="username" size="15" maxlength="15" value="' . $row[0] . '" /></p>
<p>email: <input type="text" name="email" size="15" maxlength="30" value="' . $row[1] . '" /></p>
<p>password: <input type="text" name="password" size="20" maxlength="60" value="' . $row[2] . '"  /> </p>
<p><input type="submit" name="submit" value="Submit" /></p>
<input type="hidden" name="id" value="' . $id . '" />
</form>';
} else { // Not a valid user ID.
	echo '<p class="error">This page has been accessed in error.</p>';
}
mysqli_close($dbc);

include ('includes/footer.html');
?>
