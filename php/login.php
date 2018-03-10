<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title>tode - Log in or sign up</title>
        <link rel="stylesheet" href="styles/main.css">
        <link href="https://fonts.googleapis.com/css?family=Open+Sans:400,400i|PT+Serif:700" rel="stylesheet">
    </head>
    <body>
        <div class="wrapper">
            <h1><a href="/">tode</a></h1>
            <h2>log-in or sign-up</h2>

            <div class="forms">
                <form class="login" action="newsession" method="post">
                    <h3>Log-in to an existing account:</h3>
                    <input type="text" name="username" placeholder="Username">
                    <input type="password" name="password" placeholder="Password">
                    <input type="submit" value="Log in">
                </form>

                <form class="signup" action="newuser" method="post">
                    <h3>Create a new account:</h3>
                    <input type="text" name="username" placeholder="Username">
                    <input type="text" name="email" placeholder="Email">
                    <input type="password" name="password" placeholder="Password">
                    <input type="submit" value="Sign up">
                </form>
            </div>
        </div>
    </body>
</html>
