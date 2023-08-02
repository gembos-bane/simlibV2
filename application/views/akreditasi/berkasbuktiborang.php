<nav class="navbar navbar-expand-lg navbar-light bg-white">
          <div class="container container-fluid">
            <ul class="navbar-nav">
              <li class="nav-item">
                <button type="button" class="btn btn-danger"  data-bs-toggle="modal" data-bs-target="#Modal2">Upload Bukti Borang </button>
              </li>
            </ul>
          </div>
    </nav>
    <div class="container-fluid col-sm-8 col-xl-9">
      <div class="modal" id="Modal2">
                  <div class="modal-dialog">
                    <div class="modal-content">

                      <!-- Modal Header -->
                      <div class="modal-header bg-info">
                        <h4 class="modal-title">Upload Bukti Borang Akreditasi</h4>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                      </div>

                      <!-- Modal body -->
                      <div class="modal-body">
                            <?php echo form_open_multipart('Akreditasi/uploadbuktiborang')?>
                
                            <div class="container text-center">
                                <div class="row">
                                    <div class="col-xl-9 mx-auto">
                                        <div class="cta-inner bg-faded rounded">
                                            
                                            <ul class="list-unstyled list-hours mb-5 text-left mx-auto">
                                                <li class="list-unstyled-item list-hours-item d-flex">
                                                    <div class="input-group mb-3">
                                                        <span class="input-group-text" id="basic-addon1">Standar Borang</span>
                                                        <select class="form-control" placeholder="Standar Borang" name="idstandar">

                                                            <?php foreach ($std as $row ){ ?>
                                                            <option value="<?php echo $row->ID_BORANG; ?>"><?php echo $row->STANDART; ?></option>

                                                            <?php ;}?>

                                                        </select>
                                                    </div>
                                                </li>
                                                <li class="list-unstyled-item list-hours-item d-flex">
                                                    <div class="input-group mb-3">
                                                        <span class="input-group-text" id="basic-addon1">Nama Bukti </span>
                                                        <input type="text" class="form-control" placeholder="Judul" name="judul">
                                                        </input>
                                                    </div>
                                                </li>
                                                <li class="list-unstyled-item list-hours-item d-flex">
                                                    <div class="input-group mb-3">
                                                        <span class="input-group-text" id="basic-addon1">Komentar</span>
                                                        <input type="text" class="form-control" placeholder="Komentar" name="Komen">
                                                        </input>
                                                    </div>
                                                </li>
                                                
                                                <?php foreach($data as $id){ ?>
                                                 
                                                <li class="list-unstyled-item list-hours-item d-flex">
                                                  <input class="form-check-input" type="hidden" value="<?php echo $id['ID_PEGAWAI']?>"  name="idpegawai" /> <?php };?></li>
                                                <li class="list-unstyled-item list-hours-item d-flex">
                                                    File Upload Maximal 10 Mb doc / pdf / jpg 
                                                </li>
                                                <li class="btn-group" role="group" aria-label="Basic radio toggle button group">
                                                    <input type="radio" class="btn-check" name="btnradio" id="btnradio1" autocomplete="off" value="doc">
                                                    <label class="btn btn-outline-secondary" for="btnradio1">File .Doc</label>

                                                    <input type="radio" class="btn-check" name="btnradio" id="btnradio2" autocomplete="off" value="pdf">
                                                    <label class="btn btn-outline-secondary" for="btnradio2">File .pdf</label>

                                                    <input type="radio" class="btn-check" name="btnradio" id="btnradio3" autocomplete="off" value="jpg">
                                                    <label class="btn btn-outline-secondary" for="btnradio3">File .JPEG</label>
                                                </li>
                                                <li class="list-unstyled-item list-hours-item d-flex">
                                                    <div class="input-group mb-3">
                                                        <input type="file" class="form-control" placeholder="LAMPIRAN BERKAS" aria-label="berkassurat" aria-describedby="basic-addon1" name="berkas">
                                                    </div>
                                                </li>
                                            </ul>
                                                
                                        </div>
                                    </div>
                                </div>
                            </div>
                        

                      <!-- Modal footer -->
                          <div class="modal-footer">
                            <button type="submit" class="btn btn-danger" data-bs-dismiss="modal">Submit</button>
                          </div>
                        </form><!-- exit form -->
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <!-- end Modal -->
<div class="row justify-content-center">
<div class="card">
  <div class="card-header bg-secondary">
    <?php foreach ($data as $row ){ ?>                            
    Berkas Borang Akreditasi Prodi <?php echo $row['NAMA_PRODI']; ?><?php } ?> - <?php  echo str_replace('%20',' ',$namaborang);?>
    
  </div>
    <div class="card-body">
      <div class="cta-inner bg-faded rounded">
          <table class="table table-hover">
              <thead>
                  <tr>
                    <th scope="col">No</th>
                    <th scope="col">Uploader</th>
                    <th scope="col">Tgl Upload</th>
                    <th scope="col">Komentar</th>
                    <th scope="col">Link Berkas</th>
                  </tr>
              </thead>
              <tbody>
                <?php $a =1;
                      foreach($bukti_borang as $key){ ?>   
                  <tr>
                    <td scope="row"><?php echo $a++;?></td>
                    <td><?php echo $key->NAMA_PEGAWAI;?></td>
                    <td><?php echo $key->TGL_UPLOAD;?></td>
                    <td><?php echo $key->KETERANGAN;?></td>
                    <td scope="col-sm-11">
                        <a style="text-decoration: none" href="<?php echo site_url('Akreditasi/download') ?>/buktiAKD/<?php echo $key->LINK_BUKTI;?>/<?php echo $key->TYPE_FILE; ?>"><button type="button" class="btn btn-success"><i class="fa fa-file-word-o" aria-hidden="true"></i> <i class="fa fa-file-pdf-o" aria-hidden="true"></i>&nbsp;Open</button></a>    
                    </td>
                  </tr>
                <?php } ?>
              </tbody>
          </table>

        </div>
      </div>
    </div>
  </div>