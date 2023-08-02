                                <!-- Begin Page Content -->
                <div class="container-fluid">

                    <!-- Page Heading -->
                    <h1 class="h3 mb-1 text-gray-800">Form Pendaftaran MAGANG Berkelompok</h1>
                    

                    <!-- Content Row -->
                    <div class="row">

                        <div class="modal-body mb-3">
                        <?php echo form_open_multipart('MHS/insertpkl')?>
                           
                
                            <div class="modal-body modal-content bg-clear">
                                <div class="row pt-3">
                                    <div class="col-xl-8 mx-auto">
                                        <div class="cta-inner bg-faded rounded">
                                            
                                            <ul class="list-unstyled list-hours mb-5 text-left mx-auto">
                                               <li class="list-unstyled-item list-hours-item d-flex">
                                                    <div class="input-group mb-3">
                                                        <span class="input-group-text" for="ValidationCustom1">Tujuan</span>
                                                        <select class="form-control"  name="tujuan">
                                                          <?php foreach($tujuan as $row){ ?>         
                                                            <option value="<?php echo $row->ID_TUJUAN; ?>"><?php echo $row->NAMA_TUJUAN;?></option>
                                                            <?php }; ?>
                                                        </select>
                                                    </div>
                                                </li>
                                                <li class="list-unstyled-item list-hours-item d-flex">
                                                    <div class="input-group mb-3">
                                                        <span class="input-group-text" for="ValidationCustom1">Nama Perusahaan</span>
                                                        <input type="text" class="form-control" id="ValidationCustom1" placeholder="Nama Perusahaan" name="perusahaan">
                                                        </input>
                                                    </div>
                                                </li>
                                                <li class="list-unstyled-item list-hours-item d-flex">
                                                    <div class="input-group mb-3">
                                                        <span class="input-group-text" for="ValidationCustom1">Alamat Perusahaan</span>
                                                        <input type="text" class="form-control" id="ValidationCustom1" placeholder="Alamat Perusahaan (awal kata huruf besar)" name="almtprsh">
                                                        </input>
                                                    </div>
                                                </li>
                                                <li class="list-unstyled-item list-hours-item d-flex">
                                                    <div class="input-group mb-3">
                                                        <span class="input-group-text" for="ValidationCustom1">Kota</span>
                                                        <input type="text" class="form-control" id="ValidationCustom1" placeholder="Kota Tempat Perusahaan (awal kata huruf besar)" name="kota">
                                                        </input>
                                                    </div>
                                                </li>
                                                
                                                 <li class="list-unstyled-item list-hours-item d-flex">
                                                    <div class="input-group mb-3">
                                                        <span class="input-group-text" for="ValidationCustom1">Mulai Pelaksanaan</span>
                                                        <input type="date" class="form-control" id="ValidationCustom1" placeholder="Waktu Pelaksanaan" name="waktumulai">
                                                        </input>
                                                    </div>
                                                </li>
                                                <li class="list-unstyled-item list-hours-item d-flex">
                                                    <div class="input-group mb-3">
                                                        <span class="input-group-text" for="ValidationCustom1">Akhir Pelaksanaan</span>
                                                        <input type="date" class="form-control" id="ValidationCustom1" placeholder="Waktu Pelaksanaan" name="waktuakhir">
                                                        </input>
                                                    </div>
                                                </li>
                                                <li class="list-unstyled-item list-hours-item d-flex">
                                                    <div class="input-group mb-3">
                                                        <span class="input-group-text" for="ValidationCustom1">Email/No Tlp KPS</span>
                                                        <input type="text" class="form-control" id="ValidationCustom1" placeholder="Email/No tlp KPS" name="kps">
                                                        </input>
                                                    </div>
                                                </li>
                                                <li class="list-unstyled-item list-hours-item d-flex bg-clear mb-1">
                                                    <div class="input-group mb-3">
                                                        <header class="headline"><strong><u>Nama Peserta Magang Berkelompok</u></strong></header>
                                                    </div>
                                                </li>
                                                <li class="list-unstyled-item list-hours-item d-flex">
                                                    <div class="input-group mb-3">
                                                        <span class="input-group-text" for="ValidationCustom1">1</span>
                                                        <input type="text" class="form-control" id="ValidationCustom1" placeholder="Nama (Ketua Kelompok)" name="nm1">
                                                        </input>
                                                        <input type="text" class="form-control" id="ValidationCustom1" placeholder="NIM" name="nim1">
                                                        </input>
                                                        <input type="text" class="form-control" id="ValidationCustom1" placeholder="NO TLP" name="tlp1">
                                                        </input>
                                                    </div>
                                                </li>
                                                <li class="list-unstyled-item list-hours-item d-flex">
                                                    <div class="input-group mb-3">
                                                        <span class="input-group-text" for="ValidationCustom1">2</span>
                                                        <input type="text" class="form-control" id="ValidationCustom1" placeholder="Nama Mahasiswa" name="nm2">
                                                        </input>
                                                        <input type="text" class="form-control" id="ValidationCustom1" placeholder="NIM" name="nim2">
                                                        </input>
                                                        <input type="text" class="form-control" id="ValidationCustom1" placeholder="NO TLP" name="tlp2">
                                                        </input>
                                                    </div>
                                                </li>
                                                <li class="list-unstyled-item list-hours-item d-flex">
                                                    <div class="input-group mb-3">
                                                        <span class="input-group-text" for="ValidationCustom1">3</span>
                                                        <input type="text" class="form-control" id="ValidationCustom1" placeholder="Nama Mahasiswa" name="nm3">
                                                        </input>
                                                        <input type="text" class="form-control" id="ValidationCustom1" placeholder="NIM" name="nim3">
                                                        </input>
                                                        <input type="text" class="form-control" id="ValidationCustom1" placeholder="NO TLP" name="tlp3">
                                                        </input>
                                                    </div>
                                                </li>
                                                <li class="list-unstyled-item list-hours-item d-flex">
                                                    <div class="input-group mb-3">
                                                        <span class="input-group-text" for="ValidationCustom1">4</span>
                                                        <input type="text" class="form-control" id="ValidationCustom1" placeholder="Nama Mahasiswa" name="nm4">
                                                        </input>
                                                        <input type="text" class="form-control" id="ValidationCustom1" placeholder="NIM" name="nim4">
                                                        </input>
                                                        <input type="text" class="form-control" id="ValidationCustom1" placeholder="NO TLP" name="tlp4">
                                                        </input>
                                                    </div>
                                                </li>
                                                <li class="list-unstyled-item list-hours-item d-flex">
                                                    <div class="input-group mb-3">
                                                        <span class="input-group-text" for="ValidationCustom1">5</span>
                                                        <input type="text" class="form-control" id="ValidationCustom1" placeholder="Nama Mahasiswa" name="nm5">
                                                        </input>
                                                        <input type="text" class="form-control" id="ValidationCustom1" placeholder="NIM" name="nim5">
                                                        </input>
                                                        <input type="text" class="form-control" id="ValidationCustom1" placeholder="NO TLP" name="tlp5">
                                                        </input>
                                                    </div>
                                                </li>
                                                <li class="list-unstyled-item list-hours-item d-flex">
                                                    <div class="input-group mb-3">
                                                        <span class="input-group-text" for="ValidationCustom1">6</span>
                                                        <input type="text" class="form-control" id="ValidationCustom1" placeholder="Nama Mahasiswa" name="nm6">
                                                        </input>
                                                        <input type="text" class="form-control" id="ValidationCustom1" placeholder="NIM" name="nim6">
                                                        </input>
                                                        <input type="text" class="form-control" id="ValidationCustom1" placeholder="NO TLP" name="tlp6">
                                                        </input>
                                                    </div>
                                                </li>
                                                <li class="list-unstyled-item list-hours-item d-flex">
                                                    <div class="input-group mb-3">
                                                        <input type="hidden" class="form-control" id="ValidationCustom1" value="2" name="value">
                                                        </input>
                                                    </div>
                                                </li>
                                                <li><div class="modal-footer">
                                                    <button type="submit" class="btn btn-success" style="text-decoration:none; color:white;"data-bs-dismiss="modal">PROSES</a></button>
                                                  </div>
                                                </li>
                                                
                                            </ul>
                                                
                                        </div>
                                    </div>
                                </div>
                            </div>
                        

                      
                          
                        
                      </div>

                    </div>

                </div>
                <!-- /.container-fluid -->

            </div>
            <!-- End of Main Content -->

           