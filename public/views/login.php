<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="public/css/style.css">
    <link rel="icon" type="image/x-icon" href="public/img/favicon.svg">
    <title>Login Page</title>
</head>
<body>
    <div class="container">
        <div class="logo">
            <img src="public/img/logo.svg" alt="logo">
        </div>
        <div class="login-container">
            <form class="login" action="login" method="post">
                <div class="messages">
                    <?php
                    if(isset($messages)){
                        foreach ($messages as $message){
                            echo $message;
                        }
                    }
                    ?>
                </div>
                <p>username: </p>
                <input type="text" name="email" placeholder="email@email.com">
                <p>password: </p>
                <input type="password" name="password" placeholder="password">
                <button type="submit">Log in</button>
            </form>
        </div>
        
    </div>
</body>
</html>