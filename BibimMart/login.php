<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <title>Login Page</title>
    
    <style>
        
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
        }

        .container {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        .login-container {
            width: 350px;
            padding: 20px;
            background-color: #fff;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }



        .login-title {
            text-align: center;
            margin-bottom: 20px;
            color: #333;
        }

        .login-form input[type="text"],
        .login-form input[type="password"] {
            width: 88%;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
            padding-left: 35px;
        }

        .login-form button {
            width: 101%;
            padding: 10px;
            background-color: #6DC5D1;
            color: #fff;
            border: none;
            border-radius: 5px;
            margin-top: 20px;
        }

        .login-form button:hover {
            background-color: #A0DEFF;
        }

        .icon {
            position: relative;
            top: 30px;
            margin-right: 315px;
        }
        
    </style>
</head>
<body>
    <div class="container">
        <body id="formlogin">
        <div class="login-container">
            <div class="login-title">
                <h1>Login Page</h1>
                
            <form action="login_process.php" method="post" class="login-form">
           
            <div>
                <i class='bx bx-user icon'></i>
                <input type="text" name="Username" id="Username" autocomplete="off" placeholder="Username" required>
                 </div>

                 <div>
                    <i class='bx bxs-lock-alt icon'></i>
                <input type="password" name="Password" id="Password" placeholder="Password" required>
                </div> 

                <button type="submit" name="login">Login</button>
            </form>
        </div>
    </div>
</body>
</html>