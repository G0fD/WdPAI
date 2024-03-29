<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="/public/css/style.css">
    <link rel="stylesheet" type="text/css" href="/public/css/signup.css">
    <script type="text/javascript" src="/public/js/script.js" defer></script>

    <link rel="icon" type="image/x-icon" href="public/img/favicon.svg">
    <title>Signup Page</title>
</head>
<body>

    <?php
    if(isset($_COOKIE["id_user"])){
        header("Location: main");
    }
    ?>

    <div class="container">
        <div class="logo">
            <img src="public/img/logo.svg" alt="logo">
        </div>
        <div class="signup-container">
            <?php
            if(isset($messages)){
                foreach ($messages as $message){
                    echo $message;
                }
            }
            ?>
            <form id="register-form" method="POST">
                <section class="title">
                    <p>We're so happy you wanna join us!</p></section> 
                <section class="basic">
                    <p>Name:</p>
                    <input type="text" name="name" placeholder="Tony" required>
                    <p>Surname: </p>
                    <input type="text" name="surname" placeholder="Stark" required>
                    <p>Email address: </p>
                    <input type="email" name="email" placeholder="imthebest@example.com" required>
                    <p>Password: </p>
                    <input type="password" name="password" placeholder="********" required>
                </section>
                <section class="details">
                    <p>My gender:</p>
                    <select name="sex" id="sexselect" required>
                        <option value="1">woman</option>
                        <option value="2">man</option>
                        <option value="3">other</option>
                    </select>
                    <p>Looking for:</p>
                    <select name="lookingfor" id="lookingforselect" required>
                        <option value="1">woman</option>
                        <option value="2">man</option>
                        <option value="3">anyone</option>
                    </select>
                    <p>Username: </p>
                    <input type="text" name="username" placeholder="imthebest" required>
                    <p>That's it!</p>
                    <button type="submit">Sign up</button>
                </section>
            </form>
        </div>
    </div>
</body>
</html>