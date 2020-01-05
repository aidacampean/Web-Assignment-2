<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Login</title>
</head>
<body>
<?php
include 'functions.php';
list($input,$errors) = validate_logon();
if ($errors) {
    echo show_errors($errors);
    echo"<p>Logon unsuccessful.</p>";
}
else {
        $previousPage = $_SERVER['HTTP_REFERER'];
        set_session('logged-in', 'true');
        header("location: $previousPage");

}
function validate_logon()
{

    $input = array();
    $errors = array();
    /* Retrieve the username and the password from the form (note you should also do appropriate validation – not included here) */
    $input['username'] = filter_has_var(INPUT_POST, 'username') ? $_POST ['username'] : null;
    $input ['username'] = trim($input['username']);
    $input['password'] = filter_has_var(INPUT_POST, 'password') ? $_POST ['password'] : null;
    $input ['password'] = trim($input['password']);

    if (empty($input['username'] || empty($input['password']))) {
        echo "<p>You need to provide a username and a password. Please try
          <a href='index.php'>again</a>.</p>\n";

    }
    else {
        try {
            unset($_SESSION['username']);
            unset($_SESSION['password']);
            require_once("functions.php");
            // Make a database connection
            $dbConn = getConnection();

            $querySQL = "SELECT passwordHash FROM NE_users
            WHERE username = :username";

            // Prepare the sql statement using PDO
            $stmt = $dbConn->prepare($querySQL);

            // Execute the query using PDO
            $stmt->execute(array(':username' => $input['username']));

            /* Check if a record was returned by the query. If yes, then there was a username matching what was entered in the logon form and we can test (we will add code to shortly) to see if the password entered in the logon form was correct. Otherwise, indicate an error. */
            $user = $stmt->fetchObject();
            if ($user) {
                $passwordHash = $user->passwordHash;
                if (password_verify($input['password'], $passwordHash)) {
                    $_SESSION['username'] = $input['username'];
                } else {
                    $errors[] = "The username or password were incorrect.";
                }
            } else {
                $errors[] = "The username or password were incorrect.";
            }
        } catch
        (Exception $e) {
            $errors[] = "Record not found: " . $e->getMessage();
        }
    }
    return array($input, $errors);
}

function show_errors($errors)
{
    $errString = "You have the following errors:<br>";
    foreach ($errors as $output) {
        $errString .= $output . "<br>";
    }

    return $errString;
}

if (!$errors) {

    echo makePageStart("Welcome to North Events!", "review.css");
    echo makeHeader("North Events");
    echo login("loginProcess.php","logout.php");
    echo makeNavMenu("", array("index.php" => "Home", "admin.php" => "Events", "credits.php" => "Credits", "form.php" => "Admin"));
    echo startMain();
    ?>
    <h2>You will find the latest events and shows coming up on our website.</h2>

    <?php
    echo endMain();
    echo makeFooter("The North Events Company, Copyright ©<br> Aida Campean w18002348");
    echo makePageEnd();
}

?>

</body>
</html>