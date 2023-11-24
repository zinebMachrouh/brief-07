<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>LogIn</title>
    <link rel="shortcut icon" href="./public/brand.png" type="image/x-icon">
    <link rel="stylesheet" href="./public/style.css" type="text/css">
</head>
<body class="login-body">
    <div class="login-page">
        <div class="left">
            <img src="./public/logo.png" alt="logo">
            <h2>Welcome <br> Back!</h2>
        </div>
        <div class="right">
            <h4 class="title">LogIn</h4>
            <p>Welcome back! Please login to your account.</p>
            <form action="" method="post">
                <label for="email">
                    <h4>Email</h4>
                    <input type="email" name="email" id="email" placeholder="example@gmail.com" required >
                </label>
                <label for="password">
                    <h4>Password</h4>
                    <input type="password" name="password" id="password" placeholder="Enter Password" required >
                </label>
                <div class="btns">
                    <button type="reset">Cancel</button>
                    <button type="submit" name="sendF">Submit</button>
                </div>
            </form>
            <p class="sign">Don't Have an account? <a href="./Views/signup.php">SignUp</a></p>
        </div>
    </div>
</body>
</html>