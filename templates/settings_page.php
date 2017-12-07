        <div class="search-bg">
        <div class="titles">
            <h1 class="wohh1 settings"><span class="glyphicon glyphicon-cog h1search"></span>Settings</h1>
            <p class="text-danger" id="search-warnings">&nbsp;</p>

        </div>
        </div>
          <div class="settings-container">
            <h3 class="s_button ewl_button"><a href="javascript:void(0);" id="empty_want_list">Empty want list</a></h3>
            <div class="ewl_div">
                <label id="ewl_label">Are you sure?</label>
                <form onsubmit="return false;">
                <div class="form-group">
                    <input class="btn btn-primary" id="ewlbtn" type="submit" value="confirm">
                </div>
                </form>
            </div>
            <h3 class="s_button ehl_button"><a href="javascript:void(0);" id="empty_have_list">Empty have list</a></h3>
            <div class="ehl_div">
                <label id="ehl_label">Are you sure?</label>
                <form onsubmit="return false;">
                <div class="form-group">
                    <input class="btn btn-primary" id="ehlbtn" type="submit" value="confirm">
                </div>
                </form>
            </div>
            <h3 class="s_button pw_button"><a href="javascript:void(0);">Password</a></h3>
            <div class="pw_div">
                <label id="pw_label">Change your password:</label>
                <form onsubmit="ch_pw();return false;">
                    <div class="form-group">
                        <input id="old_pwd" class="form-control" placeholder="Old password" type="password">
                    </div>
                    <div class="form-group">
                        <input id="new_pwd" class="form-control" placeholder="New password" type="password">
                    </div>
                    <div class="form-group">
                        <input id="new_pwd_conf" class="form-control" placeholder="New one again" type="password">
                    </div>
                    <div class="form-group">
                        <input class="btn btn-primary" type="submit" >
                    </div>
                </form>
            </div>
            <h3 class="sd_button"><a href="javascript:void(0);" id="delete_account">Delete account</a></h3>
            <div class="del_div">
                <label id="del_label">Don't you love me anymore?</label>
                <form onsubmit="return false;">
                <div class="form-group">
                    <input class="btn btn-primary" id="delaccbtn" type="submit" value="confirm">
                </div>
                </form>
            </div>
          </div>
            <!--<p style="padding-top: 55px;padding-bottom:24px;">Careful .. There will be <b>no</b> confirmation beore deleting anything.</p>-->
