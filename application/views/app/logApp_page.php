<body>
    
        <section class="page-section clearfix">
            <div class="container">
                <div class="intro">
                    <img class="intro-img img-fluid mb-3 mb-lg-0 rounded" src="<?php echo base_url();?>assets/img/intro3.jpg" alt="..." />
                    <div class="intro-text left-0 text-center bg-faded p-5 rounded">
                        <form  action="<?php echo base_url()?>Backbone/LogAcc" method="post" name="form" >
                <input type="hidden" name="" value="" />
                <div class="row">
                    <div class="col-xxl-9 mx-auto">
                        <div class="cta-inner bg-faded text-center rounded">
                            <h5 class="section-heading mb-5"> Have You, Let's Login
                            </h5>
                            <ul class="list-unstyled list-hours mb-8 text-left mx-auto">
                                <li class="list-unstyled-item list-hours-item d-flex">
                                    <div class="input-group mb-8">
                                        <input type="text" class="form-control" placeholder="Username" aria-label="Username" aria-describedby="basic-addon1" name="Username">
                                    </div>
                                   
                                </li>
                                <li class="list-unstyled-item list-hours-item d-flex">
                                    <div class="input-group mb-8" id="show_hide_password a">
                                       
                                        <input type="password" class="form-control" placeholder="Password" aria-label="Password" aria-describedby="basic-addon1" name="Password" id="show_hide_password i"> 
                                    </div>
                                </li>
                                
                                
                                <li class="list-unstyled-item list-hours-item d-flex">
                                   <button class="btn btn-info" type="submit">Submit</button>
                                </li>
                            </ul>
                        </div>
                    </div>
               
            </div>
            </form>
                    </div>
                </div>
            </div>
        </section>
        <?php
        // put your code here
        ?>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js" />
        <script type="text/javascript">
                   $(document).ready(function() {
                        $("#show_hide_password a").on('click', function(event) {
                            event.preventDefault();
                            if($('#show_hide_password input').attr("type") == "text"){
                                $('#show_hide_password input').attr('type', 'password');
                                $('#show_hide_password i').addClass( "fa-eye-slash" );
                                $('#show_hide_password i').removeClass( "fa-eye" );
                            }else if($('#show_hide_password input').attr("type") == "password"){
                                $('#show_hide_password input').attr('type', 'text');
                                $('#show_hide_password i').removeClass( "fa-eye-slash" );
                                $('#show_hide_password i').addClass( "fa-eye" );
                            }
                        });
                    });
               </script>