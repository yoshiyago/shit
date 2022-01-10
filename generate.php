<?php
include("connect.php");
session_start();
if (isset($_SESSION['account_number'])){
    echo "already has account: ".$_SESSION['account_number']."";
} else {
    echo "doesnt have an account -_-";
}
global $conn;
try {
    if(isset($_REQUEST['generate'])) {
        $acc = rand(1111111111111111, 9999999999999999);
        $id = $conn->lastInsertId();
        $sql = "INSERT INTO users (id, account_number) VALUES (:id, :account_number)";
        $result = $conn->prepare($sql);
        $values = array(':id' => $id, ':account_number' => $acc);
        $res = $result->execute($values);
    }
    if ($res){
        echo "ur account: ".$acc."";
    }
} catch (Exception $e) {
    echo $e;
}

?>
<form action="generate.php" method="post">
    <div class="container">
        <p>Generate account</p>
        <button type="submit" name="generate">register</button>
    </div>
</form>
already have a account? <a href="login.php">login</a>
<style>
    button {
        width: 25%;
        height: 25%;
    }
</style>