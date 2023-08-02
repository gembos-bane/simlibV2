
<div class="container-fluid">
            <table class="table table-striped ">
                <thead>
                    <tr>
                        <th scope="col-sm-1">No</th>
                        <th scope="col-sm-1">Nama Sertifikat</th>
                        <th scope="col-sm-4">No Sertifikat</th>
                        <th scope="col-sm-2">Tgl Pelaksanaan</th>
                        <th scope="col-sm-2">Intasi Penyelenggara</th>
                        <th scope="col-sm-2">Bukti</th>
                    </tr>
                </thead>
                <tbody class="table-striped">

                    <?php 
                    $a = 1;
                    foreach($berkas as $row){?>
                    <tr>
                        <th scope="col-sm-1"><?php echo $a++;?></th>
                        <th scope="col-sm-2"><?php echo $row['NAMA_SERTIFIKAT'];?></th>
                        <th scope="col-sm-4"><?php echo $row['NO_SERTIFIKAT'];?> </th>
                        <th scope="col-sm-4"><?php echo $row['TGL_PELAKSANAAN_SERDOS'];?></th>
                        <th scope="col-sm-3"><?php echo $row['INTANSI'];?></th>
                        <th scope="col-sm-2">
                            <button class="btn btn-info" onclick="myFunction()">Berkas</button>
                            <script>
                                function myFunction(){
                                    window.open("<?php echo site_url('Passing/showall') ?>/serdos/<?php echo $row['LOKASI_BERKAS'];?> ")
                                }
                            </script>
                        </th>
                    </tr>
                    <?php }?>
                </tbody>
            </table>
        </div>