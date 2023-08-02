
<div class="container-fluid">
            <table class="table table-striped ">
                <thead>
                    <tr>
                        <th scope="col-sm-1">No</th>
                        <th scope="col-sm-1">Tgl Pelaksanaan</th>
                        <th scope="col-sm-4">Judul Penelitian</th>
                        <th scope="col-sm-2">Lokasi</th>
                        <th scope="col-sm-2">No SK</th>
                        <th scope="col-sm-2">Bukti</th>
                    </tr>
                </thead>
                <tbody class="table-striped">

                    <?php 
                    $a = 1;
                    foreach($berkas as $row){?>
                    <tr>
                        <th scope="col-sm-1"><?php echo $a++;?></th>
                        <th scope="col-sm-2"><?php echo $row['TGL_PENELITIAN'];?></th>
                        <th scope="col-sm-4"><?php echo $row['JUDUL_PENELITIAN'];?> </th>
                        <th scope="col-sm-4"><?php echo $row['NAMA_JURNAL'];?></th>
                        <th scope="col-sm-3"><?php echo $row['NO_SK_PENELITIAN'];?></th>
                        <th scope="col-sm-2">
                            <button class="btn btn-info" onclick="myFunction()">Berkas</button>
                            <script>
                                function myFunction(){
                                    window.open("<?php echo site_url('Passing/showall') ?>/pengmas/<?php echo $row['BUKTI'];?> ")
                                }
                            </script>
                        </th>
                    </tr>
                    <?php }?>
                </tbody>
            </table>
        </div>