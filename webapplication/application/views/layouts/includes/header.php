<!--Header will be called from main.php in views-->

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="../../favicon.ico">

    <title>Smart Fridge</title>

    <!-- Bootstrap core CSS -->

    <link href="<?php echo base_url();?>assets/css/bootstrap.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="<?php echo base_url();?>assets/css/custom.css" rel="stylesheet">

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script>
        window.jQuery || document.write('<script src="../../assets/js/vendor/jquery.min.js"><\/script>')
    </script>
    <script src="js/bootstrap.js"></script>
    <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
    <script src="js/ie10-viewport-bug-workaround.js"></script>


</head>

<body>

    <nav class="navbar navbar-inverse navbar-fixed-top">
        <div class="container">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="<?php echo base_url();?>">Smart Fridge</a>
            </div>
            <div id="navbar" class="collapse navbar-collapse">
                <ul class="nav navbar-nav">
                    <li class="active"><a href="<?php echo base_url();?>index.php">Home</a></li>

                    <?php if(!$this->session->userdata('logged_in')) : ?>

                        <li><a href="<?php echo base_url();?>users/register">Create Account</a></li>


                        <?php endif; ?>
                            <?php if($this->session->userdata('logged_in')) : ?>
                                <li><a href="<?php echo base_url();?>users/account">Account</a></li>
                                <?php endif; ?>

                </ul>

                <!--                if not logged in, show registration form-->
                <?php if(!$this->session->userdata('logged_in')) : ?>

                    <form method="post" action="<?php echo base_url(); ?>users/login" class="navbar-form navbar-right">
                        <div class="form-group">
                            <input name="username" type="text" class="form-control" placeholder="Enter Username">
                        </div>
                        <div class="form-group">
                            <input name="password" type="password" class="form-control" placeholder="Enter password">
                        </div>
                        <button name="submit" type="submit" class="btn btn-default">Log In</button>
                    </form>

                    <!--                else show logout form-->
                    <?php else : ?>
                        <form class="navbar-form navbar-right" method="post" action="<?php echo base_url(); ?>users/logout">
                            <!--users/logout: from users controller-->
                            <button name="submit" type="submit" class="btn btn-default">Logout</button>
                        </form>
                        <?php endif; ?>

            </div>
            <!--/.nav-collapse -->
        </div>
    </nav>

    <div class="container">

        <div class="row">
            <div class="col-md-4">
                <?php $this->load->view('layouts/includes/sidebar');?>
            </div>
        </div>
        <div class="col-md-8">
            <div class="panel panel-default">
                <div class="panel-heading panel-heading-green">
                    <h3 class="panel-title">Smart Fridge Items</h3>
                </div>
                <div class="panel-body">