<?php
// Include config file
require_once '../config/config.php';

// Start session
session_start();

// Define variables and initialize with empty values
$username = $password = $confirm_password = "";

$username_err = $password_err = $confirm_password_err = "";

// Process submitted form data
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    // Check if username is empty
    if (empty(trim($_POST['username']))) {
        $username_err = "Please enter a username.";
    } else {
        // Prepare a select statement
        $sql = 'SELECT id FROM users WHERE username = ?';

        // Change $pdo to $mysql_db
        if ($stmt = $mysql_db->prepare($sql)) {
            // Set parameter
            $param_username = trim($_POST['username']);

            // Bind param variable to prepared statement
            $stmt->bindParam(1, $param_username);

            // Attempt to execute statement
            if ($stmt->execute()) {
                // Store executed result
                if ($stmt->rowCount() == 1) {
                    $username_err = 'This username is already taken.';
                } else {
                    $username = trim($_POST['username']);
                }
            } else {
                echo "Oops! Something went wrong. Please try again later.";
            }

            // Close statement
            $stmt->closeCursor();
        } else {
            // Close db connection if needed
            $mysql_db = null;
        }
    }

    // Validate password
    if (empty(trim($_POST["password"]))) {
        $password_err = "Please enter a password.";
    } elseif (strlen(trim($_POST["password"])) < 6) {
        $password_err = "Password must have at least 6 characters.";
    } else {
        $password = trim($_POST["password"]);
    }

    // Validate confirm password
    if (empty(trim($_POST["confirm_password"]))) {
        $confirm_password_err = "Please confirm password.";
    } else {
        $confirm_password = trim($_POST["confirm_password"]);
        if (empty($password_err) && ($password != $confirm_password)) {
            $confirm_password_err = "Password did not match.";
        }
    }

    // Check input error before inserting into database
    if (empty($username_err) && empty($password_err) && empty($confirm_password_err)) {
        // Prepare insert statement
        $sql = 'INSERT INTO users (username, password) VALUES (?, ?)';

        // Change $pdo to $mysql_db
        if ($stmt = $mysql_db->prepare($sql)) {
            // Set parameter
            $param_username = $username;
            $param_password = password_hash($password, PASSWORD_DEFAULT); // Create a password hash

            // Bind param variable to prepared statement
            $stmt->bindParam(1, $param_username);
            $stmt->bindParam(2, $param_password);

            // Attempt to execute
            if ($stmt->execute()) {
                // Set session variable for username
                $_SESSION['username'] = $username;

                // Redirect to login page
                header('location: ./login.php');
                exit;
            } else {
                echo "Something went wrong. Try signing in again.";
            }

            // Close statement
            $stmt->closeCursor();
        }

        // Close connection if needed
        $mysql_db = null;
    }
}

// Check if the user is logged in and display username
if (isset($_SESSION['username'])) {
    echo "Welcome, " . htmlspecialchars($_SESSION['username']) . "!";
    // Optionally hide the login button here
} else {
    // Display login button
    echo '<a href="login.php">Login</a>';
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Sign in</title>
    <link href="https://stackpath.bootstrapcdn.com/bootswatch/4.4.1/cosmo/bootstrap.min.css" rel="stylesheet" integrity="sha384-qdQEsAI45WFCO5QwXBelBe1rR9Nwiss4rGEqiszC+9olH1ScrLrMQr1KmDR964uZ" crossorigin="anonymous">
    <style>
        .wrapper {
            width: 500px;
            padding: 20px;
        }

        .wrapper h2 {
            text-align: center
        }

        .wrapper form .form-group span {
            color: red;
        }
    </style>
</head>

<body>
    <main>
        <section class="container wrapper">
            <h2 class="display-4 pt-3">Sign Up</h2>
            <p class="text-center">Please fill in your credentials.</p>
            <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="POST">
                <div class="form-group <?php (!empty($username_err)) ? 'has_error' : ''; ?>">
                    <label for="username">Username</label>
                    <input type="text" name="username" id="username" class="form-control" value="<?php echo $username ?>">
                    <span class="help-block"><?php echo $username_err; ?></span>
                </div>

                <div class="form-group <?php (!empty($password_err)) ? 'has_error' : ''; ?>">
                    <label for="password">Password</label>
                    <input type="password" name="password" id="password" class="form-control" value="<?php echo $password ?>">
                    <span class="help-block"><?php echo $password_err; ?></span>
                </div>

                <div class="form-group <?php (!empty($confirm_password_err)) ? 'has_error' : ''; ?>">
                    <label for="confirm_password">Confirm Password</label>
                    <input type="password" name="confirm_password" id="confirm_password" class="form-control" value="<?php echo $confirm_password; ?>">
                    <span class="help-block"><?php echo $confirm_password_err; ?></span>
                </div>

                <div class="form-group">
                    <input type="submit" class="btn btn-block btn-outline-success" value="Submit">
                    <input type="reset" class="btn btn-block btn-outline-primary" value="Reset">
                </div>
                <p>Already have an account? <a href="login.php">Login here</a>.</p>
            </form>
        </section>
    </main>
</body>

</html>
