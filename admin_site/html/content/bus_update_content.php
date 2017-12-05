<div class="ui grid">
    <div class="three wide column"></div>
    <div class="ten wide column">
        <div class="ui brown segment">
            <center>
                <div class="ui centered small image" >
                    <img src="static/images/app_logo.jpg">
                </div>
            </center>
            <div class="ui large brown center aligned header">Bus update form.</div>
            <form class="ui form" method="POST" action="bus_update.php" enctype="multipart/form-data">
                <input type="hidden" value="<?php echo $bus->id; ?>" name="sacco_bus_id">
                <div class="required field">
                    <label for="sacco_bus_plate">Bus number plate</label>
                    <input type="text" value="<?php echo $bus->plate; ?>" id="sacco_bus_plate" name="sacco_bus_plate" placeholder="Enter the bus number plate here...">
                </div>
                <div class="required field">
                    <label for="sacco_bus_capacity">Maximum passenger capacity</label>
                    <input type="text" value="<?php echo $bus->capacity; ?>" id="sacco_bus_capacity" name="sacco_bus_capacity" placeholder="Enter the maximum number of passengers here...">
                </div>
                <div class="required field">
                    <label for="sacco_bus_route_number">Route number</label>
                    <input type="text" value="<?php echo $bus->route_number; ?>" id="sacco_bus_route_number" name="sacco_bus_route_number" placeholder="Enter the bus route here...">
                </div>
                <div class="field">
                    <button type="submit" class="ui green button">Update bus details.</button>
                </div>
            </form>
            <div class="ui small header">
                <p>Cancel and go back to admin&nbsp;<a href="dashboard.php">dashboard.</a></p>
            </div>
        </div>
    </div>
    <div class="three wide column"></div>
</div>