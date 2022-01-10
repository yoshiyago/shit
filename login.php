<?php
include("connect.php");
global $conn;
if (!isset($_SESSION)){
    session_start();
}

if(isset($_SESSION['user'])) {
    header("location: secret.php");
}
if(isset($_REQUEST['login'])) {
    $account_number = $_REQUEST['account_number'];
    if (empty($account_number)) {
        echo "Empty bruh";
    } else {
        $s = $conn->prepare("SELECT * FROM users WHERE account_number = :account_number LIMIT 1");
        $s->execute([':account_number' => $account_number]);
        $row = $s->fetch(PDO::FETCH_ASSOC);
        if($s->rowCount() > 0) {
            session_regenerate_id();
            $_SESSION['account_number'] = $account_number;
            header("location: secret.php");
        } else {
            echo "login failed";
        }
    }
}
?>
<form action="login.php" method="post">
    <div class="container">
        <label for="account_number">account number</label>
        <input type="text" name="account_number" placeholder="9163311578763344">
        <p></p>
        <button type="submit" name="login">login</button>
    </div>
</form>
doesnt have an account? <a href="generate.php">login</a>
<style>
    .container {
        width: 500px;
        clear: both;
    }

    .container input {
        width: 100%;
        clear: both;
    }
</style>
