<!DOCTYPE html>
<html>

<head>
    <title>Masuk</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Produk By Mfikri.com">
    <meta name="author" content="M Fikri Setiadi">
    <!-- Bootstrap -->
    <link href="<?php echo base_url() . 'assets/css/bootstrap.min.css' ?>" rel="stylesheet">
    <!-- styles -->
    <link href="<?php echo base_url() . 'assets/css/stylesl.css' ?>" rel="stylesheet">

</head>

<body class="masuk-bg">


    <div class="page-content container">
        <div class="row">
            <div class="col-md-4 col-md-offset-4">
                <div>
                    <div class="box" style="margin-top:20%;background-color:#00000085;padding:20px;border-radius:10px">
                        <div class=" content-wrap">
                            <img style="margin-left: 45px;" width="70%" src="<?php echo base_url() . 'assets/img/logo.png' ?>" />
                            <br>
                            <p style="color: white;"><?php echo $this->session->flashdata('msg'); ?></p>
                            <hr />
                            <form action="<?php echo base_url() . 'administrator/cekuser' ?>" method="post">


                                <div class="input-group" style="background-color:#00000085;">
                                    <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
                                    <input style="background-color:#00000085;" name="username" type="text" class="form-control" placeholder="Username">
                                </div>
                                <br>
                                <div class="input-group">
                                    <span class="input-group-addon"><i class="glyphicon glyphicon-lock"></i></span>
                                    <input style="background-color:#00000085;" type="password" class="form-control" name="password" placeholder="Password">
                                </div>

                                <div class="action" style="margin-top:20px">
                                    <button type="submit" class="btn btn-lg btn-dark" style="width:310px;margin-bottom:30px;background-color:#00000085;color:white">Login</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>



    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="<?php echo base_url() . 'assets/js/jquery.min.js' ?>"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="<?php echo base_url() . 'assets/js/bootstrap.min.js' ?>"></script>

</body>

</html>