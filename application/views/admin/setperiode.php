<div>&nbsp;</div>
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-4">
                         <?php echo form_open_multipart('Admin/setperiodeyudisium')?>  
                        <div class="card-header">SETTING PERIODE YUDISIUM</div>
                        <div class="card-body">
                             <div class="modal-body modal-content bg-clear">
                                <div class="row pt-3">
                                    <div class="col-xl-8 mx-auto">
                                        <div class="cta-inner bg-faded rounded">
                                            
                                            <ul class="list-unstyled list-hours mb-5 text-left mx-auto">
                                                
                                                <li class="list-unstyled-item list-hours-item d-flex">
                                                    <div class="input-group mb-3">
                                                        <span class="input-group-text" for="ValidationCustom1">PERIODE</span>
                                                        <input type="text" class="form-control" placeholder="isi tanggal yudisium" id="ValidationCustom1"  name="tglperiode" required>
                                                        </input>
                                                    </div>
                                                </li>
                                                <li class="list-unstyled-item list-hours-item d-flex">
                                                    <div class="input-group mb-3">
                                                        <span class="input-group-text" for="ValidationCustom1">CLOSED PERIODE</span>
                                                        <input type="text" class="form-control" placeholder="isi tanggal yudisium" id="ValidationCustom1"  name="close" required>
                                                        </input>
                                                    </div>
                                                </li>
                                                <li class="list-unstyled-item list-hours-item d-flex">
                                                    <div class="input-group mb-3">
                                                        <span class="input-group-text" for="ValidationCustom1">Tahun Ajaran</span>
                                                        <input type="text" class="form-control" id="ValidationCustom1"  name="tahun" required>
                                                        </input>
                                                    </div>
                                                </li>
                                                <li class="list-unstyled-item list-hours-item d-flex">
                                                    <div class="input-group mb-3">
                                                        <span class="input-group-text" for="ValidationCustom1">Semester</span>
                                                        <select class="form-control"  name="semester">
                                                          <?php foreach($semester as $row){ ?>         
                                                            <option name="periode" value="<?php echo $row['ID_SEMESTER']; ?>"><?php echo $row['SEMESTER'];?></option>
                                                            <?php }; ?>
                                                        </select>
                                                        </input>
                                                    </div>
                                                </li>
                                                <li class="list-unstyled-item list-hours-item d-flex">
                                                    <div class="input-group mb-3">
                                                        <span class="input-group-text" for="ValidationCustom1">SESI KE-</span>
                                                        <input type="text" class="form-control" id="ValidationCustom1" name="gelombang" required>
                                                        </input>
                                                    </div>
                                                </li>
                                                <li><div class="modal-footer">
                                                    <button type="submit" class="btn btn-success" style="text-decoration:none; color:white;" ata-bs-dismiss="modal">Proses</a></button>
                                                  </div>
                                                </li>
                                                
                                            </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-sm-8">
                    <table class="table table-striped caption-top ">
                        <thead class="bg-info">
                            <tr>
                                <th scope="col-sm-4">N0</th>
                                <th scope="col-sm-2">Tanggal Yudisium</th>
                                <th scope="col-sm-2">Semester</th>
                                <th scope="col-sm-2">Gelombang</th>
                                <th scope="col-sm-2">Tahun</th>
                                <th scope="col-sm-2">Status</th>
                            </tr>
                        </thead>
                        <tbody class="text-muted">

                             <?php
                             $a = 1; 
                             foreach ($periode as $key => $value) { ?>
                            <tr>
                                <th scope="col-sm-1"><?php echo $a++;?></th>
                                <th scope="col-sm-1"><?php echo $value['TGL_PERIODE']; ?></th>
                                <th scope="col-sm-4"><?php echo $value['SEMESTER']; ?></th>
                                <th scope="col-sm-4"><?php echo $value['GELOMBANG']; ?></th>
                                <th scope="col-sm-2"><?php echo $value['TAHUN']; ?></th>
                                <th scope="col-sm-2"><?php if($value['AKTIFASI'] == 0){
                                    print('TIDAK AKTIF');
                                    }else{?>
                                        <a href="<?php echo site_url('Admin/upperiode')?>/Updatae/<?php echo $value['ID_PERIODE'];?>/0/diNonAktifkan" style="text-decoration: none;">AKTIF</a>
                                        <?php
                                    }; ?></th>
                            </tr>
                            <?php }?>
                        </tbody>
                    </table>
                </div>

          </div>
        </div>
        <!-- end table user-->
       <!-- Bootstrap core JS-->
