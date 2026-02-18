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
                                   <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">Submit</button>
                                </li>
                            </ul>
                            
                            
                        </div>
                    </div>
                </div>
            </div>
            </form><!-- exit form -->
        </section>

        <!-- Button trigger modal -->
    
    <!-- Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title text-center" id="exampleModalLabel">Activated Form</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p>Please Subscribe to activated your account</p><p> Subscribe and call Application Developer Right now</p>
                </div>
                <div class="modal-footer">
                        <a href="<?php echo site_url('Backbone/index')?>"><button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button></a>
                        <a href="https://www.skyrainstudio.id/"><button type="button" class="btn btn-primary">Subscribe</button></a>
                </div>
            </div>
        </div>
      </div>
    </div>
