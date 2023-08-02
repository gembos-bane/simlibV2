<div class="row justify-content-center">
<div class="col-sm-4">
<div class="card">
    <div class="card-body">
      <div class="card-title text-dark">Edit User Account </div>
      <div class="cta-inner bg-faded rounded">

              <form action="<?php echo site_url('Edit/changeuserpas');?>" method="post">
                <?php foreach ($data as $value){?>
              <div class="form-floating mb-3">
                <input type="text" class="form-control" id="floatingInput" placeholder="Your username -><?php echo $value['LOGIN_USER'];?>" name="username">
                <label for="floatingInput">USERNAME</label>
              </div>
            <?php };?>
              <div class="form-floating mb-3">
                <input type="text" class="form-control" id="floatingInput" placeholder="type your old password" name="password">
                <label for="floatingInput">Old Password</label>
              </div>
              <div class="form-floating mb-3">
                <input type="text" class="form-control" id="floatingInput" placeholder="type your new password" name="password1">
                <label for="floatingInput">New Password</label>
              </div>
              <div class="form-floating mb-3">
                <input type="text" class="form-control" id="floatingInput" placeholder="type confirm new password" name="password2">
                <label for="floatingInput">Confirm New Password</label>
              </div>
              <div class="form-check">
                <input class="form-check-input" type="checkbox" value="1" id="flexCheckDefault" name="confirm">
                <label class="form-check-label" for="flexCheckDefault">
                 <small>check this for confirmation to change your account Password And Username</small> 
                </label>
              </div>
              <div class="form-group mr-3">
                <label>&nbsp;</label>
                <button type="submit" class="btn btn-danger">EDIT USER</button> 
              </div>
              </form>
        </div>
    </div>
  </div>
</div>
</div>