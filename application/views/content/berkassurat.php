          
                <!-- Page content-->
        
            <nav class="navbar navbar-expand-lg navbar-light alert-warning">
                <div class="container-fluid">
                    <?php $user = $_SESSION['user'];?>
                    <div class="collapse navbar-collapse active" id="navbarNav">
                      <ul class="navbar-nav">
                        <li class="nav-item">
                            PERSURATAN
                            <?php 

                                foreach($dataprodi as $key){
                                    echo $key->NAMA_PRODI;
                                }
                            ?>
                        </li>                        
                      </ul>
                    </div>
                </div>
            </nav>
            
            
                <!-- Page content-->
        
          
  