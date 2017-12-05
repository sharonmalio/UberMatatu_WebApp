<div class="ui grid">
    <div class="three wide column"></div>
    <div class="ten wide column">
        <div class="ui brown segment" >
            <center>
                <div class="ui centered small image" >
                    <img src="static/images/app_logo.jpg">
                </div>
            </center>
            <div class="ui large brown center aligned header">Driver update form.</div>
            <form method="POST" enctype="multipart/form-data" action="driver_update.php" class="ui form">
                <input type="hidden" value="<?php echo $driver->driver_id; ?>" name="sacco_driver_id">
                <div class="required field">
                    <label for="sacco_driver_first_name">First Name</label>
                    <input type="text" value="<?php echo $driver->first_name; ?>" id="sacco_driver_first_name" name="sacco_driver_first_name" placeholder="Enter driver's first name here...">
                </div>
                <div class="required field">
                    <label for="sacco_driver_last_name">Last Name</label>
                    <input type="text" value="<?php echo $driver->last_name; ?>" id="sacco_driver_last_name" name="sacco_driver_last_name" placeholder="Enter driver's last name here...">
                </div>
                <div class="required field">
                    <label for="sacco_driver_phone_number">Phone number</label>
                    <div class="ui labeled input">
                        <div class="ui label">+254</div>
                        <input type="text" value="<?php echo $driver->phone_number; ?>" maxlength="9" id="sacco_driver_phone_number" name="sacco_driver_phone_number" placeholder="Enter driver's phone number here...">
                    </div>
                </div>
                <div class="required field">
                    <label for="sacco_driver_license">Driver License ID</label>
                    <input type="text" value="<?php echo $driver->drivers_license; ?>" id="sacco_driver_license" name="sacco_driver_license" placeholder="Enter driver's license ID here...">
                </div>
                <div class="field">
                    <button class="ui green button" type="submit">Update driver.</button>
                </div>
            </form>
            <div class="ui small header">
                <p>Cancel and go back to admin&nbsp;<a href="dashboard.php">dashboard.</a></p>
            </div>
        </div>
    </div>
    <div class="three wide column"></div>
</div>