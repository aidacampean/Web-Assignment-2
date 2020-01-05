<?php
ini_set("session.save_path", "/home/unn_w18002348/sessionData");
session_start();

function getConnection()
{
    try {
        $connection = new PDO("mysql:host=localhost;dbname=unn_w18002348",
            "unn_w18002348", "akatsuki07");
        $connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        return $connection;
    } catch (Exception $e) {
        /* We should log the error to a file so the developer can look at any logs. However, for now we won't */
        echo"A problem occurred. Please try again." ;
        log_error($e) ;
}
return $e;
    }

function set_session($key, $value)
    {
        // Set key element = value
        $_SESSION[$key] = $value;
        return true;
    }

function get_session($key)
    {
        $returnString = "";
        if (isset($_SESSION[$key])) {
            $returnString = $_SESSION[$key];
        }
        return $returnString;
    }
function login($login, $logout)
    {
          $makeLogin = "";
         if(isset($_SESSION['username'])) {
            $makeLogin = <<<PAGESTART
        <form class = "login"  method="post" action="$logout">
            <input type ="submit" value = "logout">
        </form>
PAGESTART;
            $makeLogin .= "\n";
         }

        else if(!isset($_SESSION['username'])) {
            $makeLogin = <<<PAGESTART
        <form class = "login" method="post" action="$login">
        Username <input type="text" name="username">
        Password <input type="password" name="password">
        <input type ="submit" value="login">
        </form>
PAGESTART;
            $makeLogin .= "\n";

        }
        return $makeLogin;
    }



function check_login()
        {
            if ($_SESSION['logged-in'] == true) {
                return true;
            } else {
                return false;
            }
        }

function makePageStart($title, $style)
        {
            $pageStartContent = <<<PAGESTART
    
	<!doctype html>
	<html lang="en">
	<head>
		<meta charset="UTF-8">
		<title>$title</title> 
		<link href="$style" rel="stylesheet" type="text/css">
	</head>
	<body>
	
	</body>

PAGESTART;
            $pageStartContent .= "\n";
            return $pageStartContent;
        }

function makeHeader($headerOne)
        {
            $headContent = <<<HEAD
		<header>
			<h1>$headerOne</h1>
		</header>
HEAD;
            $headContent .= "\n";
            return $headContent;
        }

function makeNavMenu($navMenuHeader, array $links)
        {


            $linkString = "";
            foreach ($links as $key => $value) {
                $linkString .= "<li><a href='$key'>$value</a></li>\n";
            }

            $navMenuContent = <<<NAVMENU
			<nav>
				<h2>$navMenuHeader</h2>
				<ul>
					$linkString
				</ul>	
			</nav>
NAVMENU;
            $navMenuContent .= "\n";
            return $navMenuContent;
        }

function startMain()
        {
            return "<main>\n";
        }

function endMain()
        {
            return "</main>\n";
        }

function makeFooter($footerTag)
        {
            $footContent = <<<FOOT
<footer>
<p id="footer">$footerTag</p>
</footer>
FOOT;
            $footContent .= "\n";
            return $footContent;
        }

function makePageEnd()
        {
            return "</div>\n</body>\n</html>";
        }

function log_error($e) {
    $fileHandle = fopen("error_log_file.log", "ab");
    $errorDate = date('D M j G:i:s T Y');
    $errorMessage = $e->getMessage();
    fwrite($fileHandle, "$errorDate|$errorMessage".PHP_EOL);
    fclose($fileHandle);
}


