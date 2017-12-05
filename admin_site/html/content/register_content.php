<div class="ui grid">
    <div class="two wide column"></div>
    <div class="twelve wide column">
        <div class="ui raised padded brown segment">
            <div class="ui blue center aligned icon header">
                <i class="bus icon"></i>
                <div class="content">Transcomfy</div>
                <div class="sub header">Sacco Registration Form</div>
            </div>
            <form class="ui form" action="register.php" method="POST" enctype="multipart/form-data">
                <div class="required field">
                    <label for="sacco_name">Sacco name</label>
                    <input type="text" name="sacco_name" id="sacco_name" placeholder="Enter your sacco's name here...">
                </div>
                <div class="required field">
                    <label for="sacco_description">Sacco Description</label>
                    <textarea name="sacco_description" id="sacco_description" rows="2"></textarea>
                </div>
                <div class="required field">
                    <label for="admin_first_name">Sacco administrator first name</label>
                    <input type="text" id="admin_first_name" name="admin_first_name" placeholder="Enter your first name here...">
                </div>
                <div class="required field">
                    <label for="admin_last_name">Sacco administrator last name</label>
                    <input type="text" id="admin_last_name" name="admin_last_name" placeholder="Enter your last name here...">
                </div>
                <div class="required field">
                    <label for="admin_phone_number">Sacco administrator phone number.</label>
                    <div class="ui labeled input">
                        <div class="ui label">+254</div>
                        <input type="text" maxlength="9" id="admin_phone_number" name="admin_phone_number" placeholder="Enter your phone number here...">
                    </div>
                </div>
                <div class="required field">
                    <label for="admin_email_address">Sacco administrator email address</label>
                    <input type="email" id="admin_email_address" name="admin_email_address" placeholder="Enter your email address here...">
                </div>
                <div class="required field">
                    <label for="admin_password">Password</label>
                    <input type="password" id="admin_password" name="admin_password" placeholder="Enter your password here...">
                </div>
                <div class="required field">
                    <label for="admin_password_confirm">Confirm Password</label>
                    <input type="password" id="admin_password_confirm" name="admin_password_confirm" placeholder="Confirm your password here...">
                </div>
                <div class="field">
                    <button class="ui green button" type="submit">Register</button>
                </div>
            </form>
            <div class="ui small header">
                <p>Have an account?&nbsp;<a href="index.php">Login</a>&nbsp;here instead.</p>
            </div>
        </div>
    </div>
    <div class="two wide column"></div>
</div>