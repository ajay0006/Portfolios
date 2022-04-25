<?php
include "../common/header.php";
include_once '../Controllers/loginController.php';
session_start();

if (isset($_SESSION["user"]) ) {
    header("Location: /Aisha/pages/dashboard.php");
}

// Clear validation messages
$isValidPassword = $isValidUserId = "";

// validation as false
$allValid = false;

// clear fields
function clear()
{
    $userId = "";
    $password = "";

    // Clear validation messages
    $validPassword = $valiUserId = "";

    // validation as false
    $allValid = false;

    $_SESSION["userId"] = null;
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    // Check if button clear was clicked
    if (isset($_POST["clear"])) {
        clear();
    } else {
        // Get values from fields
        $userId = trim($_POST["userId"]);
        $password = trim($_POST["password"]);


        ValidateLoginUserID($userId, $isValidUserId, $userId);
        ValidateLoginPassword($password, $isValidPassword, $password);



        $allValid = $isValidPassword == "" && $isValidUserId == "";
        // Validation ends ]
    }
} else {
   // $userId = $_SESSION["userId"];
}

// if you are here, it means everything was valid
if ($allValid) {

    try {
       // $dbConnection = parse_ini_file("../common/db_conn.ini");
        //extract($dbConnection);

        //$myPdo = new PDO($dsn, $scriptUser, $scriptPassword);
        //$myPdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $myPdo = getPdo();

        // Getting the name based on id
        $sql = $myPdo->prepare("select * from users where userid = ?");
        $sql->execute([$userId]);
        $result = $sql->fetch();

        if (password_verify($password, $result[3]) && $userId == $result[0]) {
            $user = new User($result[0], $result[1], $result[2]);
            $_SESSION['user'] = serialize($user);

            if ($_SESSION['ActivePage'] != null) {
                header('Location: dashboard.php' );
            } else {
                header("Location: ./index.php");
            }
        } else {
            $isValidUserId = "Incorrect user ID and/or Password.";
        }
    } catch (PDOException $e) {

        echo $sqlStatement . "<br>" . $e->getMessage();
    }

    $myPdo = null;
}

?>

<div class="container">
    <h2 class="text-center mt-3 mb-3">Login</h2>
<div class="row ">
            <div class="col-md-6  offset-md-3 shadow mb-5">
    <form action="" method="post">

        <br/>


        <div class="col-12 col-sm-6">
            <div class="form-group">
                <label class="form-label" id="userIDLbl">User ID:</label>
            </div>
            <input name="userId" id="userID" type="text" class="form-control" placeholder="(e.g.:AAAA0000)" value="<?php isset($userId) ? print($userId) : print "" ?>">
        </div>
        <span class="alert-danger"><?php echo $isValidUserId; ?></span>

        
        <div class="col-12 col-sm-6">
            <div class="form-group">
                <label class="form-label" id="passwordLbl">Password:</label>
            </div>
            <input name="password" id="password" type="password" class="form-control "
                   placeholder="(e.g.:Your Password)">
        </div>
        <span class="alert-danger"><?php echo $isValidPassword; ?></span>

        

        <div class="form-group row mt-3 mb-3">
            <div class="col-sm-3">
                <button type="submit" class="btn btn-primary btn-md">Submit</button>
            </div>
            <div class="col-sm-3">
                <button type="submit" name="clear" class="btn btn-danger btn-block">Clear</button>
            </div>
        </div>


    </form>
</div>
</div>
</div>

<?php
include "../common/footer.php";
?>