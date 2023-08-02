<!-- Modal Header -->
                      <div class="modal-header alert-info">
                        <h4 class="modal-title">Edit Arsip Surat</h4>
                        
                      </div>

                      <!-- Modal body -->
                      <?php foreach ($edit as $key) {
                      	// code...
                      ?>
                      <div class="modal-body">
                        <form method="post" action="<?php echo site_url('Upload/Apiheader')?>/edit/<?php echo $key['ID_SURAT']?>/persuratan">
                           
                
                            <div class="modal-body modal-content bg-clear">
                                <div class="row">
                                    <div class="col-xl-9 mx-auto">
                                        <div class="cta-inner bg-faded rounded">
                                            
                                            <ul class="list-unstyled list-hours mb-5 text-left mx-auto">
                                                <li class="list-unstyled-item list-hours-item d-flex">
                                                	<div class="input-group mb-3">
                                                        <span class="input-group-text" for="ValidationCustom1">Jenis Surat</span>
                                                        <input type="text-muted" class="form-control" id="ValidationCustom1" placeholder="<?php echo $key['JENIS_SURAT'] ?>"name=" ">                 
                                                        </input>
                                                        <span class="input-group-text" id="basic-addon1">Rubah Jenis Surat</span>
                                                        <select class="form-control" name="jenissurat">

                                                            <?php foreach ($surat as $row ){ ?>
                                                            <option value="<?php echo $row->ID_JENIS_SURAT; ?>"><?php echo $row->JENIS_SURAT; ?></option>

                                                            <?php ;}?>

                                                        </select>
                                                        <div class="valid-feedback">Its Good</div>
                                                    </div>
                                                    
                                                </li>
                                                <li class="list-unstyled-item list-hours-item d-flex">
                                                    <div class="input-group mb-3">
                                                        <span class="input-group-text" id="basic-addon1">Tanggal Surat</span>
                                                        <input type="date" class="form-control"  value="<?php echo $key['TANGGAL_SURAT']; ?>">
                                                        </input>
                                                        
                                                    </div>
                                                </li>
                                                <li class="list-unstyled-item list-hours-item d-flex">
                                                    <div class="input-group mb-3">
                                                        <span class="input-group-text" id="basic-addon1">Nomor Surat</span>
                                                        <input type="text" class="form-control"  value="<?php echo $key['NO_SURAT']?>" >
                                                        </input>
                                                        
                                                    </div>
                                                </li>
                                                <li class="list-unstyled-item list-hours-item d-flex">
                                                    <div class="input-group mb-3">
                                                        <span class="input-group-text" id="basic-addon1">Perihal Surat</span>
                                                        <input type="text" class="form-control" value="<?php echo $key['PERIHAL_SURAT']; ?>" name="perihal">
                                                        </input>
                                                        
                                                    </div>
                                                </li>
                                                <li class="list-unstyled-item list-hours-item d-flex">
                                                    <div class="input-group mb-3">
                                                        <span class="input-group-text" id="basic-addon1">Prodi Tujuan</span>
                                                        <input type="text" class="form-control" value="<?php echo $key['NAMA_PRODI']; ?> " disabled>
                                                        </input>
                                                        <span class="input-group-text" id="basic-addon1">Ubah Prodi Tujuan</span>
                                                        <select class="form-control"  name="idprodi">

                                                            <?php foreach ($prodi as $row ){ ?>
                                                            <option value="<?php echo $row->ID_PRODI; ?>"><?php echo $row->NAMA_PRODI; ?></option>

                                                            <?php ;}?>

                                                        </select>
                                                    </div>
                                                </li>
                                                
                                                <li class="list-unstyled-item list-hours-item d-flex">
                                                  <input class="form-check-input" type="hidden" value="<?php echo $key['ID_PENGIRIM']?>"  name="idpengirim" /> </li>
                                                                                            
                                                <li class="list-unstyled-item list-hours-item d-flex">
                                                    <div class="input-group mb-3">
                                                        <span class="input-group-text" id="basic-addon1">Berkas Surat</span>
                                                        <input type="text" class="form-control" value="<?php echo $key['PERIHAL_SURAT']; ?> - <?php echo $key['LOKASI_SURAT'] ?>">
                                                        </input>
                                                        <input type="file" class="form-control" placeholder="LAMPIRAN BERKAS" aria-label="berkassurat" aria-describedby="basic-addon1" name="berkassurat"/>


                                                    </div>
                                                </li>
                                                <li class="list-unstyled-item list-hours-item d-flex">
                                                    <div class="input-group mb-3">
                                                        <input type="hidden" class="form-control" placeholder="LAMPIRAN BERKAS" aria-label="berkassk" aria-describedby="basic-addon1" name="prodi" value="<?php ?>">
                                                    </div>
                                                </li>
                                                <li class="list-unstyled-item list-hours-item d-flex">
                                                  <input class="form-check-input" type="checkbox" value="zip" id="flexCheckDefault" name="tipe">&nbsp; <small>Saya Benar benar yakin untuk merubah data arsip surat</small>
                                              	</li>
                                                  <li class="list-unstyled-item list-hours-item d-flex">
                                                  <div class="modal-footer">
						                            <button type="submit" class="btn btn-warning" style="text-decoration:none; color:red;"data-bs-dismiss="modal">EDIT</a></button>
						                          
						                            <button type="button" class="btn btn-danger" data-bs-dismiss="modal"><a style="text-decoration:none; color:white;" href="">DELETE</a></button>

						                          </div></li>
                                            </ul>
                                                
                                        </div>
                                    </div>
                                </div>
                            </div>
                        

                      <!-- Modal footer -->
                          
                        </form><!-- exit form -->
                      </div>
                  <?php } ?>
                    </div>
                  </div>
                </div>