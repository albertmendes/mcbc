            <div style="max-width: 240px;margin-right: auto; margin-left: auto;text-align:center;padding-top:55px;">
            <form action="login.php" method="post">
                <fieldset>
                    <div class="form-group">
                        <input autofocus class="form-control" name="username" placeholder="Username" type="text"/>
                        <?php if(isset($nousername)): ?>
                        <p class="text-danger">Please enter your username.</p>
                        <?php elseif(isset($alnum)): ?>
                        <p class="text-danger">Only alphanumerics.</p>
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
                or <a class="orange" href="register.php">register</a> for an account
            </div>
            </div>

            <div style="width:auto; min-height: 500px;"></div>
