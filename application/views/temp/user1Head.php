<!-- using passing header -->

<!-- end using nav passing -->  
          <!-- Page content-->

<nav class="navbar navbar-expand-lg navbar-light alert-default">
    <div class="container-fluid">
        <?php $user = $_SESSION['user'];?>
        <div class="collapse navbar-collapse active" id="navbarNav">
          <ul class="navbar-nav">
            <?php for($a=0;$a<Count($header);$a++){ ?>
            <li class="nav-item">
              <a class="nav-link" aria-current="page" href="<?php echo base_url()?>Passing/profile/<?php echo $header[$a]; ?>/<?php echo $a+1;?>/profile#!<?php echo hash('sha256',$_SESSION['user'])?>"><?php echo $header[$a]; ?></a>
            </li>
            <?php } ?>
            
          </ul>
        </div>
    </div>
</nav>
  