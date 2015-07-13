
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <h1>Edit Party</h1>
        </div>
    </div>
    
    <div class="row">
        <div class="col-md-12">
            
            <form action="/party/manage/<?php echo $party->id; ?>" method="post" id="party-edit">

            <div class="row">
                <div class="media-left">
                    <img class="media-object" alt="The Restart Project: Logo" src="/assets/images/logo_mini.png">        
                </div>
                
                <div class="media-body">
                    <div class="short-body">
                        <time datetime="<?php echo dbDate($party->event_date); ?>"><?php echo dateFormatNoTime($party->event_date) . ' ' . $party->start; ?></time>
                        <span class="location"><?php echo $party->location; ?></span>      
                    </div>
                    
                    <div class="data">
                       
                        
                        <div class="stat double">
                            <div class="col">
                                <i class="fa fa-group"></i>
                                <span class="subtext">participants</span>
                            </div>
                            <div class="col">
                                <input class="party-input" name="party[pax]" value="<?php echo $party->pax; ?>" id="party[pax]">
                            </div>
                            
                        </div>
                        
                        <div class="stat double">
                            <div class="col">
                                <img class="" alt="The Restart Project: Logo" src="/assets/images/logo_mini.png">
                                <span class="subtext">restarters</span>
                            </div>
                            <div class="col">
                                <input class="party-input" name="party[volunteers]" value="<?php echo $party->volunteers; ?>" id="party[volunteers]">
                            </div>
                            
                        </div>
                        
                        <div class="stat">
                            
                            <div class="footprint">
                                <?php echo $party->co2; ?>
                                <span class="subtext">kg of CO<sub>2</sub></span>
                            </div>
                        </div>
                        
                        
                        <div class="stat fixed">
                            <div class="col"><i class="status mid fixed"></i></div>
                            <div class="col"><?php echo $party->fixed_devices; ?></div>    
                        </div>
                        
                        <div class="stat repairable">
                            <div class="col"><i class="status mid repairable"></i></div>
                            <div class="col"><?php echo $party->repairable_devices; ?></div>
                        </div>
                        
                        <div class="stat dead">
                            <div class="col"><i class="status mid dead"></i></div>
                            <div class="col"><?php echo $party->dead_devices; ?></div>
                        </div>
                        
                    </div>
                </div>                
            </div>
           
            <!-- devices -->
            <div class="row">
                <div class="col-md-12">
                    <h3>Devices</h3>
                </div>
            </div>
            <div class="col-md-12">
                
                <table class="table table-striped" id="device-table">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Category</th>
                            <th>Name</th>
                            <th>Problem</th>
                            <th>Repair Status</th>
                            <th>Spare Parts?</th>
                            <th>Restarter</th>
                        </tr>
                    </thead>
                    <tbody>
                    
                        <?php for ($i = 1; $i < 13 ; $i++) { ?>
                        <tr>
                            <td><?php echo $i; ?>.</td>            
                            <td>
                                <div class="form-group">
                                    <select id="device-<?php echo $i; ?>[category]" name="device-<?php echo $i; ?>[category]" class="selectpicker form-control" data-live-search="true">
                                        <?php foreach($categories as $cluster){ ?>
                                        <optgroup label="<?php echo $cluster->name; ?>">
                                            <?php foreach($cluster->categories as $c){ ?>
                                            <option value="<?php echo $c->idcategories; ?>"><?php echo $c->name; ?></option>
                                            <?php } ?>
                                        </optgroup>
                                        <?php } ?>
                                    </select>
                                </div>
                            </td>            
                            <td>
                                <textarea class="form-control" id="device-<?php echo $i; ?>[problem]" name="device-<?php echo $i; ?>[problem]"></textarea>
                            </td>
                            <td>
                                <textarea class="form-control" id="device-<?php echo $i; ?>[model]" name="device-<?php echo $i; ?>[model]"></textarea>
                            </td>
                            <td>
                                
                                <div class="form-group">
                                    <div class="radio">                                                
                                        <label>
                                            <input type="radio" name="device-<?php echo $i; ?>[repair_status]" id="device-<?php echo $i; ?>[repair_status_1]" value="1" checked> Fixed
                                        </label>
                                    </div>
                                    <div class="radio">
                                        <label>
                                            <input type="radio" class="repairable" data-target-details="#repairable-details-<?php echo $i; ?>" name="device-<?php echo $i; ?>[repair_status]" id="device-<?php echo $i; ?>[repair_status_2]" value="2"> Repairable
                                        </label>
                                    </div>
                                    <div id="repairable-details-<?php echo $i; ?>" class="repairable-details">
                                        <div class="checkbox">
                                            <label>
                                                <input type="checkbox" name="device-<?php echo $i; ?>[more_time_needed]" id="device-<?php echo $i; ?>[more_time_needed]" value="1"> More time needed
                                            </label>
                                        </div>
                                        <div class="checkbox">
                                            <label>
                                                <input type="checkbox" name="device-<?php echo $i; ?>[professional_help]" id="device-<?php echo $i; ?>[professional_help]" value="1"> Professional help
                                            </label>
                                        </div>
                                        <div class="checkbox">
                                            <label>
                                                <input type="checkbox" name="device-<?php echo $i; ?>[do_it_yourself]" id="device-<?php echo $i; ?>[do_it_yourself]" value="1"> Do it yourself
                                            </label>
                                        </div>
                                    </div>
                                    <div class="radio">
                                        <label>
                                            <input type="radio" name="device-<?php echo $i; ?>[repair_status]" id="device-<?php echo $i; ?>[repair_status_3]" value="3"> End of lifecycle
                                        </label>
                                    </div>
                                </div>
                            </td>
                            <td>
                                <div class="form-group">
                                    <div class="radio">
                                        <label>
                                            <input type="radio" name="device-<?php echo $i; ?>[spare_parts]" id="spare_parts_1" value="1"> Yes
                                        </label>
                                    </div>
                                    <div class="radio">
                                        <label>
                                            <input type="radio" name="device-<?php echo $i; ?>[spare_parts]" id="spare_parts_2" value="2" checked> No
                                        </label>
                                    </div>
                                </div>
                            </td>
                            <td></td>
                        </tr>    
                        <?php } ?>
                    </tbody>
                    
                </table>
                <div class="text-center">
                    <button class="btn btn-primary btn-lg text-center" type="button" id="add-device"><i class="fa fa-plus"></i> Add Device</button>
                </div>
            </div>
            
            <div class="col-md-12">
                    <?php
                        
                        
                        dbga($devices);
                        
                    ?>
                </div>
            </form>
        </div>
    </div>
</div>
