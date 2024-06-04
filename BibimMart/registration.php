<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Registration Form</title>
    <link rel="stylesheet" href="css/bootstrap.css">

    <style>
        <style>
          body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
        }

        .container {
            margin-top: 10px;
            border: 2px solid #ddd;
            width: 400px;
            height: 565px;
            border-radius: 10px;
            padding: 20px;
            margin-left: auto;
            margin-right: auto
        }

        .display-3{
            margin-left:130px;
            margin-top: 1px;
        }

        .form-control {
            margin-bottom: 4px;
            width: 100%;
            border: 1px solid #ced4da;
            border-radius: 5px;
            height: 25px;
        }
        
        .form-control:focus {
            outline: none;
            border-color: #007bff;
            box-shadow: 0 0 5px rgba(0, 123, 255, 0.5);
        }


        .btn-success {
            margin-top: 7px;
            margin-left: auto;
            margin-right: auto;
            width: 90%;
            height: 25px;
            background: #A0DEFF;
            display: block;
            border: none;
            border-radius: 5px;
        }

        .login-wrapper {
            display: flex;
            align-items: center;
            justify-content: center; 
            margin-top: 3px;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="row">
            <div class="col-2"></div>
            <div class="col-8">
               <h3 class="display-3">Registration Form</h3>
               <?php
                if(isset($_GET['error'])){
                    echo "Error:" . $_GET['error'];
                }
                ?>
                <form action="registration_process.php" method="POST">
                    <div class="mb">
                       <label for="" class="form-label">Username</label>
                        <input name="r_username" type="text" class="form-control">
                    </div>
                    <div class="mb">
                       <label for="" class="form-label">Email</label>
                        <input name="r_email" type="text" class="form-control">
                    </div>
                    <div class="mb">
                       <label for="" class="form-label">Firstname</label>
                        <input name="r_firstname" type="text" class="form-control">
                    </div>
                    <div class="mb">
                       <label for="" class="form-label">Lastname</label>
                        <input name="r_lastname" type="text" class="form-control">
                    </div>
                    <div class="mb">
                       <label for="" class="form-label">Age</label>
                        <input name="r_age" type="text" class="form-control">
                    </div>
                    <div class="mb">
                       <label for="" class="form-label">Address</label>
                        <input name="r_address" type="text" class="form-control">
                    </div>
                    <div class="mb">
                       <label for="" class="form-label">Contact Number</label>
                        <input name="r_contact_number" type="text" class="form-control">
                    </div>
                    <div class="mb">
                       <label for="" class="form-label">Password</label>
                        <input name="r_passwrd" type="password" class="form-control">
                    </div>
                    <div class="mb">
                       <label for="" class="form-label">Confirm Password</label>
                        <input name="r_conf_passwrd" type="password" class="form-control">
                    </div>
                    <div class="mb">
                       <label for="" class="form-label">User_type</label>
                        <select class="form-select" name="r_user_type" id="">
                            <option value="A">Admin</option>
                            <option value="C">Customer</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <input type="submit" class="btn btn-success">
                        <div class="login-wrapper">
                        <p> Already have an account?</p>
                        <a href="index.php" class="btn btn-link">Login</a>
                    </div>
                </form>
            </div>
            <div class="col-2"></div>
        </div>
    </div>
    <script src="js/bootstrap.js"></script>
</body>
</html>
