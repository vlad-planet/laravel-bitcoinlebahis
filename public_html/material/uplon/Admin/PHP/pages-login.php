<?php require 'includes/header_account.php'; ?>

    <div class="account-bg">
        <div class="card-box m-b-0">
            <div class="text-xs-center m-t-20">
                <a href="index.html" class="logo">
                    <i class="zmdi zmdi-group-work icon-c-logo"></i>
                    <span>Uplon</span>
                </a>
            </div>
            <div class="m-t-30 m-b-20">
                <div class="col-xs-12 text-xs-center">
                    <h6 class="text-muted text-uppercase m-b-0 m-t-0">Sign In</h6>
                </div>
                <form class="form-horizontal m-t-20" action="index.html">

                    <div class="form-group ">
                        <div class="col-xs-12">
                            <input class="form-control" type="text" required="" placeholder="Username">
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="col-xs-12">
                            <input class="form-control" type="password" required="" placeholder="Password">
                        </div>
                    </div>

                    <div class="form-group ">
                        <div class="col-xs-12">
                            <div class="checkbox checkbox-custom">
                                <input id="checkbox-signup" type="checkbox">
                                <label for="checkbox-signup">
                                    Remember me
                                </label>
                            </div>

                        </div>
                    </div>

                    <div class="form-group text-center m-t-30">
                        <div class="col-xs-12">
                            <button class="btn btn-success btn-block waves-effect waves-light" type="submit">Log In
                            </button>
                        </div>
                    </div>

                    <div class="form-group m-t-30 m-b-0">
                        <div class="col-sm-12">
                            <a href="pages-recoverpw.html" class="text-muted"><i class="fa fa-lock m-r-5"></i> Forgot
                                your password?</a>
                        </div>
                    </div>

                    <div class="form-group m-t-30 m-b-0">
                        <div class="col-sm-12 text-xs-center">
                            <h5 class="text-muted"><b>Sign in with</b></h5>
                        </div>
                    </div>

                    <div class="form-group m-b-0 text-xs-center">
                        <div class="col-sm-12">
                            <button type="button" class="btn btn-facebook waves-effect waves-light m-t-20">
                                <i class="fa fa-facebook m-r-5"></i> Facebook
                            </button>

                            <button type="button" class="btn btn-twitter waves-effect waves-light m-t-20">
                                <i class="fa fa-twitter m-r-5"></i> Twitter
                            </button>

                            <button type="button" class="btn btn-googleplus waves-effect waves-light m-t-20">
                                <i class="fa fa-google-plus m-r-5"></i> Google+
                            </button>
                        </div>
                    </div>

                </form>

            </div>
        </div>
    </div>
    <!-- end card-box-->

    <div class="row m-t-20">
        <div class="col-sm-12 text-xs-center">
            <p class="text-white">Don't have an account? <a href="pages-register.php" class="text-white m-l-5"><b>Sign
                        Up</b></a></p>
        </div>
    </div>

    </div>
    <!-- end wrapper page -->


<?php require 'includes/footer_account.php'; ?>