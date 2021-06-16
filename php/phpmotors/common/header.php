
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $title; ?></title>
    <meta name="description" content="Template Page">
    <link rel="stylesheet" href = "/phpmotors/css/style.css" media="screen">
</head>

<body>
    <header>
    <img class="logo" src="/phpmotors/images/site/logo.png" title="PHP Motors logo" alt="site logo">
    <?php if (!isset($_SESSION['loggedin']) || !$_SESSION['loggedin']){
        echo "<a href='http://localhost/phpmotors/accounts/index.php?action='></a>";
        echo "<a class='account' title='accounts page' href='http://localhost/phpmotors/accounts/index.php?action=login-page'>My Account</a>";
    }
    else {
        $clientFirstname = $_SESSION['clientData']['clientFirstname'];
        echo "<a class='account' title='Logout' href='http://localhost/phpmotors/accounts/index.php?action=Logout'>Logout</a>";
        echo "<a href='http://localhost/phpmotors/accounts/index.php?action=adminPage'>Welcome $clientFirstname</a>";
    }
    ?>
    </header>

