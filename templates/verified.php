            
<div class="modal fade">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
        <h4 class="modal-title">You are verified.</h4>
      </div>
      <div class="modal-body">
        <p>You can now use your username and password to login. Have fun!<br /><br />
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-warning" data-dismiss="modal">Close</button>
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

<script type="text/javascript">
    $(".modal").modal("show");
</script>
            
            <div style="max-width:250px;margin-left: auto; margin-right: auto;text-align:center;padding-top: 55px;">
            <form action="login.php" method="post">
                <fieldset>
                    <div class="form-group">
                        <input autofocus class="my-form-control form-control" name="username" placeholder="Username" type="text"/>
                        <?php if(isset($nousername)): ?>
                        <p class="text-danger">Please enter your username.</p>
                        <?php endif ?>
                    </div>
                    <div class="form-group">
                        <input class="form-control my-form-control" name="password" placeholder="Password" type="password"/>
                        <?php if(isset($nopassword)): ?>
                        <p class="text-danger">It doesn't work without your password.</p>
                        <?php elseif(isset($invalidlogin)): ?>
                        <p class="text-danger">Your given login credentials are not valid.</p>
                        <?php endif ?>
                    </div>
                    <div class="form-group">
                        <button type="submit" class="btn btn-warning">Log In</button>
                    </div>
                </fieldset>
            </form>
            <div>
                or <a href="register.php">register</a> for an account
            </div>
            </div>

            <div style="min-height: 500px;"></div>
