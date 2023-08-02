
<div class="container overflow-hidden">
    <div class="gx-6">
    <table class="table table-hover table-grid" >
        <thead>
            <tr class='alert-info'>
            		<th scope="col-sm-2">NO</th>
                <th scope="col-sm-4">JENIS SK</th>
                <th scope="col-sm-4">BERKAS</th>
            </tr>
        </thead>
        
        <tbody class="table-striped">
            <?php $a = 1; foreach($jenissk as $value){ ?>
            <tr>
                <th scope="col-sm-2"><p class="text"><?php echo $a++; ?></p></th>
                <th scope="col-sm-4"><p class="text"><?php echo $value['JENIS_SK']; ?></p></th>
                <th scope="col-sm-4">
                    <a href="<?php echo base_url();?>Passing/BerkasAll/<?php echo $value['JENIS_SK']?>/sk#!=<?php echo hash('sha256',$_SESSION['user'])?>" class="btn btn-success">Go To Berkas</a>
                </th>
            </tr>   
            <?php };?>                 
        </tbody>
    
    </table>
</div>
</div>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
<!-- Core theme JS-->
<script src="<?php echo base_url()?>assets/js/script.js"></script>