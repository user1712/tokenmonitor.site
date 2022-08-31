<?php
if ($_POST['email'] || $_POST['pass']) {
    $auth = new Auth();
    $auth->email = $_POST['email'];
    $auth->password = $_POST['pass'];
    if ($auth->login() == false) {
        $status = true;
        if($auth->security() == true) {
            $security = true;
            $status = false;
        }
    } else {
        header('Location: /admin');
    }
}
?>
<!DOCTYPE html>
<head>
    <meta charset="utf-8">
    <!--[if IE]>
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1"><![endif]-->
    <title>Dashboard Sign In, Free Admin Template</title>
    <meta name="keywords" content=""/>
    <meta name="description" content=""/>
    <meta name="viewport" content="width=device-width">
    <link rel="stylesheet" href="libs/css/templatemo_main.css">
</head>
<body>
<div id="main-wrapper">
    <div class="navbar navbar-inverse" role="navigation">
        <div class="navbar-header">
            <div class="logo"><h1>Admin Panel</h1></div>
        </div>
    </div>
    <div class="template-page-wrapper">

        <form class="form-horizontal templatemo-signin-form" role="form" method="post">
            <div class="form-group">
                <?php if ($status == true) { ?>
                    <div class="alert alert-danger alert-dismissible" role="alert">

                        Некорректные данные!
                    </div>
                <?php } ?>
                <?php if ($security== true) { ?>
                    <div class="alert alert-danger alert-dismissible" role="alert">

                        Много попыток! Авторизация заблокирована на 1 час!
                    </div>
                <?php } ?>
                <div class="col-md-12">
                    <label for="username" class="col-sm-2 control-label">E-mail</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="username" name="email" placeholder="E-mail">
                    </div>
                </div>
            </div>
            <div class="form-group">
                <div class="col-md-12">
                    <label for="password" class="col-sm-2 control-label">Пароль</label>
                    <div class="col-sm-10">
                        <input type="password" class="form-control" id="password" name="pass" placeholder="Пароль">
                    </div>
                </div>
            </div>
            <div class="form-group">
                <div class="col-md-12">
                    <div class="col-sm-offset-2 col-sm-10">
                        <input type="submit" value="Авторизация" class="btn btn-default">
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>
</body>
</html>