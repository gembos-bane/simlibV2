  <!-- Begin Page Content -->
                <div class="container-fluid">

                    <!-- Page Heading -->
                    <h1 class="h3 mb-1 text-gray-800">Create News</h1>
                    

                    <!-- Content Row -->
                    <div class="row">

                        <div class="modal-body">
                        <form method="post" action="<?php echo site_url('Admin/insertnews');?>">
                            <div class="modal-body modal-content bg-clear">
                                <div class="row">
                                    <div class="col-xl-9 mx-auto">
                                        <div class="cta-inner bg-faded rounded">
                                            
                                            <ul class="list-unstyled list-hours mb-5 text-left mx-auto">
                                                <li class="list-unstyled-item list-hours-item d-flex">
                                                    <div class="input-group mb-3">
                                                        <span class="input-group-text" for="ValidationCustom1">JUDUL</span>
                                                        <input type="text" class="form-control" id="ValidationCustom1" placeholder="judul berita" name="judul">
                                                        </input>
                                                    </div>
                                                </li>
                                                <li class="list-unstyled-item list-hours-item d-flex">
                                                    <div class="input-group mb-3">
                                                        <span class="input-group-text" id="basic-addon1">Tanggal Terbit</span>
                                                        <input type="date" class="form-control"  value="" name="tanggal">
                                                        </input>
                                                        
                                                    </div>
                                                </li>
                                                <li class="list-unstyled-item list-hours-item d-flex">
                                                    <div class="input-group mb-3">
                                                        <span class="input-group-text" id="basic-addon1">ISI BERITA</span>
                                                        <textarea  class="form-control"  value="" name="isiberita"></textarea>
                                                        
                                                    </div>
                                                </li>
                                               
                                                <!-- Modal footer -->
                                                  <div class="modal-footer">
                                                    <button type="submit" class="btn btn-success" style="text-decoration:none; color:white;"data-bs-dismiss="modal">SIMPAN</a></button>
                                                  </div>
                                              </li>
                                              
                                            </ul>
                                                
                                        </div>
                                    </div>
                                </div>
                            </div>
                        
                        </form><!-- exit form -->
                      </div>

                    </div>

                </div>
                <!-- /.container-fluid -->

            </div>
            <!-- End of Main Content -->

           