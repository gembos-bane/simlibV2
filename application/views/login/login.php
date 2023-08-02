<body class="bg-gradient-primary">

    <div class="container">

        <!-- Outer Row -->
        <div class="row justify-content-center" >

            <div class="col-xl-7 col-lg-12 col-md-9 " >

                <div class="card o-hidden border-0 shadow-lg my-5 bg-secondary bg-gradient  " >
                    <div class="card-body p-0" >
                        <!-- Nested Row within Card Body -->
                        <div class="row" >
                            <div class="card col-lg-6"  style="background-image: url(<?php echo base_url()?>/asset/images/sample-image1.jpg)">
                                <div class="p-4">
                                </div>
                            </div>
                            <div class="col-lg-6 ">
                                <div class="p-5 ">
                                    <div class="text-center">
                                        <h1 class="h4 text-white mb-4">Welcome Back!</h1>
                                    </div>
                                    <form action="<?php echo site_url('Backbone/LogAcc') ?>" method="post" name="form">
                                        <div class="form-group">
                                            <input type="text" class="form-control form-control-user"
                                                id="exampleInputEmail" aria-describedby="emailHelp"
                                                placeholder="Enter username ......" name="Username">
                                        </div>
                                        <div class="form-group">
                                            <input type="password" class="form-control form-control-user"
                                                id="exampleInputPassword" placeholder="Password" name="Password">
                                        </div>
                                        <div class="form-group">
                                            <div class="custom-control custom-checkbox small">
                                                <input type="checkbox" class="custom-control-input" id="customCheck">
                                                <label class="custom-control-label" for="customCheck">Remember
                                                    Me</label>
                                            </div>
                                        </div>
                                        <button type="submit" class="btn btn-primary btn-user btn-block">
                                            Login
                                        </button>
                                        <hr>
                                        <a href="#" class="btn btn-google btn-user btn-block">
                                            <i class="fab fa-google fa-fw"></i> Login with Google
                                        </a>
                                        <a href="#" class="btn btn-facebook btn-user btn-block">
                                            <i class="fab fa-facebook-f fa-fw"></i> Login with Facebook
                                        </a>
                                    </form>
                                    <hr>
                                    <!--<div class="text-center">
                                        <a class="small" href="<?php echo site_url('Pasing/forgotpass')?>">Forgot Password?</a>
                                    </div> -->
                                    <div class="text-center">
                                        <a class="small" href="<?php echo site_url('MHS/newmhs')?>" style="color: white;">Create an Account for Mahasiswa!</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

        </div>

    </div>

    <!-- Bootstrap core JavaScript-->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="js/sb-admin-2.min.js"></script>

</body>

</html>