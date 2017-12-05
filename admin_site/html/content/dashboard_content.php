<div class="ui brown padded segment">
    <center>
        <div class="ui centered small image" >
            <img src="static/images/app_logo.jpg">
        </div>
    </center>
    <div class="ui brown center aligned huge dividing header"><?php echo isset($sacco_name)?$sacco_name:"" ?> administration dashboard.</div>
    <div class="ui divided grid">
        <br>
        <?php echo isset($success)?$success:"" ?>
        <div class="four wide column">
            <div class="ui vertical fluid tabular menu">
                <div class="active item" data-tab="sacco_buses">
                    <a href=""><i class="bus icon"></i>&nbsp;Sacco buses</a>
                </div>
                <div class="item" data-tab="sacco_drivers">
                    <a href=""><i class="user icon"></i>&nbsp;Sacco drivers</a>
                </div>
            </div>
        </div>
        <div class="twelve wide column">
            <div class="ui active tab basic segment" data-tab="sacco_buses">
                <div class="ui secondary pointing menu">
                    <a class="active item" data-tab="sacco_buses_add">
                        <i class="plus icon"></i>&nbsp;Register bus.
                    </a>
                    <a class="item" data-tab="sacco_buses_list">
                        <i class="list icon"></i>&nbsp;List of registered sacco buses.
                    </a>
                </div>
                <div class="ui basic active tab segment" data-tab="sacco_buses_add">
                    <form class="ui form" method="POST" action="dashboard.php" enctype="multipart/form-data">
                        <input type="hidden" value="sacco_buses_add" name="sacco_buses_add">
                        <div class="required field">
                            <label for="sacco_bus_plate">Bus number plate</label>
                            <input type="text" id="sacco_bus_plate" name="sacco_bus_plate" placeholder="Enter the bus number plate here...">
                        </div>
                        <div class="required field">
                            <label for="sacco_bus_capacity">Maximum passenger capacity</label>
                            <input type="text" id="sacco_bus_capacity" name="sacco_bus_capacity" placeholder="Enter the maximum number of passengers here...">
                        </div>
                        <div class="required field">
                            <label for="sacco_bus_route_number">Route number</label>
                            <input type="text" id="sacco_bus_route_number" name="sacco_bus_route_number" placeholder="Enter the bus route here...">
                        </div>
                        <div class="field">
                            <button type="submit" class="ui green button">Add bus.</button>
                        </div>
                    </form>
                </div>
                <div class="ui basic tab segment" data-tab="sacco_buses_list">
                    <div class="ui large brown label" >Total sacco buses :&nbsp;<?php echo isset($sacco_buses)?count($sacco_buses):0?></div>
                    <table class="ui single line celled center aligned table">
                        <thead>
                        <tr>
                            <th>Bus Route</th>
                            <th>Bus number plate</th>
                            <th>Maximum number of passengers</th>
                            <th>Operations</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php
                            if(isset($sacco_buses)){
                                foreach ($sacco_buses as $sacco_bus){
                                    echo "
                                         <tr>
                                            <td>$sacco_bus->route_number</td>
                                            <td>$sacco_bus->plate</td>
                                            <td>$sacco_bus->capacity</td>
                                            <td>
                                                <form class='ui form' enctype='multipart/form-data' method='POST' action='dashboard.php'>
                                                    <input type='hidden' value='".$sacco_bus->id."' name='sacco_bus_id'>
                                                    <input type='hidden' value='sacco_bus_operation' name='sacco_bus_operation'>
                                                    <div class='fields'>
                                                        <div class='field'>
                                                            <button class='ui green icon button' type='submit' name='sacco_bus_update'>
                                                                <i class='write icon'></i>&nbsp; Edit / Update  
                                                            </button>
                                                        </div>
                                                        <div class='field'>
                                                            <button type='submit' class='ui red icon button' name='sacco_bus_delete' data-tooltip='Are you sure? This action cannot be undone.' data-inverted=''>
                                                                <i class='trash icon'></i>&nbsp; Delete
                                                            </button>
                                                        </div>
                                                        <div class='field'>
                                                            <button type='submit' class='ui blue icon button' name='sacco_bus_assign' >
                                                                <i class='user icon'></i>&nbsp; Assign / Change Driver
                                                            </button>
                                                        </div>
                                                    </div>
                                                </form>
                                            </td>
                                         </tr>";
                                }
                            }
                        ?>
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="ui tab basic segment" data-tab="sacco_drivers">
                <div class="ui secondary pointing menu">
                    <a class="active item" data-tab="sacco_drivers_add">
                        <i class="plus icon"></i>&nbsp;Register driver.
                    </a>
                    <a class="item" data-tab="sacco_drivers_list">
                        <i class="list icon"></i>&nbsp;List of drivers.
                    </a>
                </div>
                <div class="ui active tab basic segment" data-tab="sacco_drivers_add">
                    <form method="POST" enctype="multipart/form-data" action="dashboard.php" class="ui form">
                        <input type="hidden" value="sacco_drivers_add" name="sacco_drivers_add">
                        <div class="required field">
                            <label for="sacco_driver_first_name">First Name</label>
                            <input type="text" id="sacco_driver_first_name" name="sacco_driver_first_name" placeholder="Enter driver's first name here...">
                        </div>
                        <div class="required field">
                            <label for="sacco_driver_last_name">Last Name</label>
                            <input type="text" id="sacco_driver_last_name" name="sacco_driver_last_name" placeholder="Enter driver's last name here...">
                        </div>
                        <div class="required field">
                            <label for="sacco_driver_phone_number">Phone number</label>
                            <div class="ui labeled input">
                                <div class="ui label">+254</div>
                                <input type="text" maxlength="9" id="sacco_driver_phone_number" name="sacco_driver_phone_number" placeholder="Enter driver's phone number here...">
                            </div>
                        </div>
                        <div class="required field">
                            <label for="sacco_driver_license">Driver License ID</label>
                            <input type="text" id="sacco_driver_license" name="sacco_driver_license" placeholder="Enter driver's license ID here...">
                        </div>
                        <div class="field">
                            <button class="ui green button" type="submit">Add driver.</button>
                        </div>
                    </form>
                </div>
                <div class="ui tab basic segment" data-tab="sacco_drivers_list">
                    <div class="ui large brown label" >Total sacco drivers :&nbsp;<?php echo isset($sacco_drivers)?count($sacco_drivers):0?></div>
                    <table class="ui single line celled center aligned table">
                        <thead>
                        <tr>
                            <th>Driver name</th>
                            <th>Driver phone number</th>
                            <th>Driver license ID</th>
                            <th data-inverted="" data-tooltip="Assign bus to driver on the 'Sacco Buses' tab.">Assigned to a bus?</th>
                            <th>Operations</th>
                        </tr>
                        </thead>
                        <tbody>
                            <?php
                            if(isset($sacco_drivers)){
                                foreach ($sacco_drivers as $sacco_driver){
                                    $has_bus=($sacco_driver->has_assigned_bus)?"Yes":"No";
                                    $deassign_button =($sacco_driver->has_assigned_bus)?"<div class='field'>
                                                            <button type='submit' class='ui red icon button' name='sacco_driver_deassign' >
                                                                <i class='bus icon'></i>&nbsp; Deassign bus
                                                            </button>
                                                        </div>":"";
                                    echo "
                                         <tr>
                                            <td>$sacco_driver->first_name&nbsp;$sacco_driver->last_name</td>
                                            <td>+254$sacco_driver->phone_number</td>
                                            <td>$sacco_driver->drivers_license</td>
                                            <td>$has_bus</td>
                                            <td>
                                                <form class='ui form' enctype='multipart/form-data' method='POST' action='dashboard.php'>
                                                    <input type='hidden' value='".$sacco_driver->driver_id."' name='sacco_driver_id'>
                                                    <input type='hidden' value='sacco_driver_operation' name='sacco_driver_operation'>
                                                    <div class='fields'>
                                                        <div class='field'>
                                                            <button class='ui green icon button' type='submit' name='sacco_driver_update'>
                                                                <i class='write icon'></i>&nbsp; Edit / Update  
                                                            </button>
                                                        </div>
                                                        <div class='field'>
                                                            <button type='submit' class='ui red icon button' name='sacco_driver_delete' data-tooltip='Are you sure? This action cannot be undone.' data-inverted=''>
                                                                <i class='trash icon'></i>&nbsp; Delete
                                                            </button>
                                                        </div>
                                                        $deassign_button
                                                    </div>
                                                </form>
                                            </td>
                                         </tr>";
                                }
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>