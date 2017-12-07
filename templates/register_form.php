        <div style="max-width:750px; margin-left: auto; margin-right: auto;padding-top: 55px;">
            <div id="features" style="max-width:500px; float: left;margin-right: 50px;">
                <img src="images/mcbclogo.png">
            </div>

            <div class="reg_form_wrapper">
                <form action="register.php" method="post">
                    <fieldset>
                        <div class="form-group">
                            <input autofocus class="form-control" name="username" placeholder="Username" type="text"
                                <?php if(isset($username)) { echo 'value="' . $username . '"'; } ?>
                            />
                            <?php if(isset($nousername)): ?>
                            <p class="text-danger">Please enter a username.</p>
                            <?php elseif(isset($useralready)): ?>
                            <p class="text-danger">That one is taken, sry. </p>
                            <?php elseif(isset($alnum)): ?>
                            <p class="text-danger">Only alphanumerics, please. </p>
                            <?php endif ?>
                        </div>
                        <div class="form-group">
                            <input autofocus class="form-control" name="email" placeholder="Email" type="text"
                                <?php if(isset($email)) { echo 'value="' . $email . '"'; } ?>
                            />
                            <?php if(isset($noemail)): ?>
                            <p class="text-danger">Email, please!</p>
                            <?php elseif(isset($emailalready)): ?>
                            <p class="text-danger">Already in database.</p>
                            <?php endif ?>
                        </div>
                        <div class="form-group">
                            <input class="form-control" name="password" placeholder="Password" type="password"/>
                            <?php if(isset($nopassword)): ?>
                            <p class="text-danger">Password,  please!</p>
                            <?php elseif(isset($tooshortpassword)): ?>
                            <p class="text-danger">At least 8 ... you know the drill!</p>
                            <?php endif ?>
                        </div>
                        <div class="form-group">
                            <input class="form-control" name="confirmation" placeholder="Password (again)" type="password"/>
                            <?php if(isset($nomatch)): ?>
                            <p class="text-danger">Passwords don't match</p>
                            <?php endif ?>
                        </div>
                        <div class="form-group">
                            <button type="submit" class="btn btn-warning">Register</button>
                        </div>
                    </fieldset>
                </form>
                <div>
                    or <a class="orange" href="login.php">log in</a> 
                </div>
            </div> <!-- reg_form_wrapper end -->
        </div>
                <div class="description">
                    <p>
                        <span>M</span>y <span>C</span>omic <span>B</span>ook
                        <span>C</span>ollection lets you manage a want and have list of your desired comics and books already in your collection as well as buy them on mycomicshop.com
                    </p>
                    <p>
                        Go ahead and register for a free account!
                    </p>
                </div>
    </div>
    </div>

<!--
<div style="width: 100% !important;padding-bottom: 144px; padding-top: 55px;background: #f8f8f8;text-align: center;">
    <div style="max-width: 750px; padding-left: 10px; padding-right: 10px; margin-left: auto; margin-right: auto;">
        <h1 class="whatdoes" style="padding-bottom: 55px;">What does MCBC do?</h1>
    </div>
    <div id="myframe">
        <iframe width="750" height="500" src="//www.youtube.com/embed/BApaPx-71qk" frameborder="0" allowfullscreen></iframe>
    </div>

    <script>
        if(window.innerWidth < 500) {
            $("#myframe iframe").css("width", "300");
            $("#myframe iframe").css("height", "180");
        }
        else if(window.innerWidth < 750) {
            $("#myframe iframe").css("width", "500");
            $("#myframe iframe").css("height", "310");
        }
    </script>
        
</div>
-->
<div style="width: 100%; height: 254px; background: transparent;">
</div>

<script>
    var wh = window.innerHeight;
    wh -= 160;
    $('.middle_reg').css("height", wh);
</script>

<div class="container-fluid">
<div class"middle">

            <?php if (isset($veri)): ?>
            <div class="modal fade">
              <div class="modal-dialog">
                <div class="modal-content">
                  <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                    <h4 class="modal-title">Thanks for registering</h4>
                  </div>
                  <div class="modal-body">
                    <p>I've sent you an email. Click the link in it for verification!</p>
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
            <?php endif ?>
