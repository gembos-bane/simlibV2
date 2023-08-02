<body>
        <section class="page-section cta">
            <form  action="<?php echo base_url()?>Backbone/index" method="post" >
                <input type="hidden" name="" value="" />
            <div class="container">
                <div class="row">
                    <div class="col-xl-9 mx-auto">
                        <div class="cta-inner bg-faded text-center rounded">
                            
                            <ul class="list-unstyled list-hours mb-5 text-left mx-auto">
                                <li class="list-unstyled-item list-hours-item d-flex">
                                    <h5 class="section-heading mb-5">
                                        <span class="section-heading-lower">
                                            <text class="text text-danger"><?php echo $warning;?></text> 
                                        </span>
                                    </h5>    
                                </li>
                                
                                <li class="list-unstyled-item list-hours-item d-flex">
                                   <button class="btn btn-info" type="submit">Submit</button>
                                </li>
                            </ul>
                            
                            
                        </div>
                    </div>
                </div>
            </div>
            </form><!-- exit form -->
        </section>