<!-- app/views/login.blade.php -->
@extends('layouts.login')
@section('title', 'Login')
<?php
/*
        session_start();
        //include ('session.php');

        if(isset($_SESSION['login_user'])){
            
            if($role == "Admin"){
                header("location: admin/profile.php");
            }else{
                header("location: profile.php");
            }
        }

    function test_input($data) {
      $data = trim($data);
      $data = stripslashes($data);
      $data = htmlspecialchars($data);
      return $data;
    }


if(isset ($_POST['submit'])){
    $user = $_POST['user'];
    $username = test_input($user);
   
    $pass = $_POST['pass'];
    $password = test_input($pass);
    
    $sql = "SELECT * FROM users WHERE username='$username'";
    $result = $dbh->query($sql);
    $resultArray = $result->fetch(PDO::FETCH_ASSOC);
    
    $usernameQuery = $resultArray['username'];
    $passwordQuery = $resultArray['password'];
    $role = $resultArray['role'];
    
    if($resultArray==null){
        $error="Username/Password Invalid.";
    }
    else{
        if(password_verify($password, $passwordQuery)){
            
            
            $date = date('d-m-Y');
            $time = date('h:i a');
            $sql ="INSERT INTO users_stats(username, date_logged_in, time_logged_in) VALUES('$usernameQuery','$date','$time')";
            
               if($dbh->query($sql)){
                    $side_sql = "SELECT * FROM users_stats ORDER BY id desc";
                    $side_result = $dbh->query($side_sql);
                    $user_stat_array = $side_result->fetch(PDO::FETCH_ASSOC);

                    $user_logged_id = $user_stat_array['id'];

                    $_SESSION['login_user'] = $usernameQuery;
                    $_SESSION['login_user_id'] = $user_logged_id;
                   
                   if($role == "Admin"){
                    header('location:admin/profile.php');
                    }
                    else{
                        header('location:profile.php');
                    }
                }
                else{
                      $error="Please try again";
                }
        }
        else{
            $error="Username/Password Invalid.";
        }//closes check for same username and password
        
    }//closes else after check for valid username
    
    $dbh=null;
}
*/
?>
@section('content')
    <!-- BEGIN LOGIN SECTION -->
    <section class="section-account">

        <div class="spacer"></div>
        <div class="col-sm-3"></div>
        <div class="col-sm-6">

            <?php if( isset($error) ): ?>
                    <div class="alert alert-danger" role="alert">
                        <?php echo $error; ?>
                    </div>
            <?php endif; ?>

             <div class="card">
                <div class="card-head style-primary">
                    <header>User Log in</header>
                </div>
                <div class="card-body">
                    <form class="form" action="signin" accept-charset="utf-8" method="post">
                        <div class="form-group">
                            <input type="text" class="form-control" required autocomplete="off" id="user" name="user">
                            <label for="user">Username</label>
                        </div>
                        <div class="form-group">
                            <input type="password" class="form-control" required autocomplete="off" id="password" name="pass">
                            <label for="password">Password</label>
                        </div>
                        <br/>
                        <div class="row">
                            <div class="col-xs-6"></div>
                            <div class="col-xs-6 text-right">
                                <button name="submit" value="submit" class="btn btn-primary btn-loading-state btn-flat ink-reaction" type="submit" data-loading-text="<i class='fa fa-spinner fa-spin'></i> Hold on...">Login</button>
                            </div><!--end .col -->
                        </div><!--end .row -->
                    </form>
                </div><!--end .card-body -->
            </div><!--end .card -->
        </div>
        <div class="col-sm-3"></div>
    </section>
    <!-- END LOGIN SECTION -->
@endsection