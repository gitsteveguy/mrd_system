<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
include('connect.php');
include_once('header.php');
pheader("Login");
$invalidcred= false;
if(isset($_POST['submit']))
{
    $username = $_POST['username'];
    $password = $_POST['password'];
    $sql = "SELECT * FROM FSbNJe9_user_data WHERE username = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s",$username);
    if (!$stmt->execute()) {
        die("Error: " . $stmt->error);
      }
    $result = $stmt->get_result();
      $user = $result->fetch_assoc();
      if($user)
      {
        if(password_verify($password,$user['password']))
        {
            session_start();
            session_regenerate_id();
            $_SESSION["user_id"]= $user['user_id'];
            header("Location: mrddashboard.php");
            exit;
            
        }
        else
        {
            $invalidcred =true;
        }
      }
}
?>

<body id="body">
    <h1 class="text-center">Login</h1>
    <div class="container my-3 d-flex justify-content-center">
        <form method="POST" action="">


            <div class="row my-2">
                <div class="col">
                    <div class="form-group">
                        <?php if($invalidcred) {?>
                            <h6>Invalid Login</h6>
                            <?php }?>
                        <label for="username">Username</label>
                        <input type="text" name="username" style="width:110%;" class="form-control" value="">
                    </div>
                </div>
            </div>
            <div class="row my-2">
                <div class="col" style="display:inline;">
                    <div class="form-group">
                        <label for="password">Password</label>
                        <input type="password" name="password" style="width:120%;" class="form-control" value="" id="passwordfield">
                    </div>
                </div>
                <div class="col-1" style="margin-top:20px;">
                    <i class="far fa-eye" style="display:inline;cursor:pointer;" id="pview" aria-hidden="true">
                    </i>
                </div>

            </div>
            <div class="row my-2">
                <div class="col">
                <input type="submit" class="btn btn-success" name="submit" value="Login">
                </div>
            </div>

    </div>
    </div>
    </form>
    </div>
    <script>
        const togglePassword = document.querySelector('#pview');
        const password = document.querySelector('#passwordfield');

        togglePassword.addEventListener('click', function(e) {
            // toggle the type attribute
            const type = password.getAttribute('type') === 'password' ? 'text' : 'password';
            password.setAttribute('type', type);
            // toggle the eye slash icon
            this.classList.toggle('fa-eye-slash');
        });
    </script>
</body>