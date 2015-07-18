
<form action="/party/manage/<?php echo $party->id; ?>" method="post" id="party-edit">
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <h1>Edit Party <small><button type="submit" class="btn btn-primary btn-sm"><i class="fa fa-floppy-o"></i> save</button></small></h1>
        </div>
    </div>
    
    <div class="row">
        <div class="col-md-12">
            
            <input type="hidden" name="idparty" id="idparty" value="<?php echo $party->id; ?>">
            
            <div class="row">
                <div class="col-md-12">
                    <div class="media-left">
                        <img class="media-object" alt="The Restart Project: Logo" src="/assets/images/logo_mini.png">        
                    </div>
                    
                    <div class="media-body">
                        <div class="short-body">
                            <time datetime="<?php echo dbDate($party->event_date); ?>"><?php echo dateFormatNoTime($party->event_date) . ' ' . $party->start; ?></time>
                            <span class="location"><?php echo $party->location; ?></span><br />
                            <span class="groupname"><?php echo $party->group_name; ?></span>
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
            </div>
            <!-- devices -->
            <div class="row">
                <div class="col-md-12">
                    <h3>Devices</h3>
                </div>
            </div>
            <div class="col-md-12">
                <table class="table " id="device-table">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Category</th>
                            <th>Problem</th>
                            <th>Brand/Model</th>
                            <th>Repair Status</th>
                            <th>Spare Parts?</th>
                        </tr>
                    </thead>
                    <tbody>
                        
                        <?php
                        if(!empty($devices)){
                            for($i = 1; $i <= count($devices); $i++){
                        ?>        
                                
                        
                        
                        <tr class="rs-<?php echo $devices[$i-1]->repair_status; ?>">
                            <td>
                                <?php echo $i; ?>.
                                <input type="hidden" name="device[<?php echo $i; ?>][id]" value="<?php echo $devices[$i-1]->iddevices; ?>">
                                
                            </td>            
                            <td>
                                <div class="form-group">
                                    <select id="device[<?php echo $i; ?>][category]" name="device[<?php echo $i; ?>][category]" class="selectpicker form-control" data-live-search="true">
                                        <?php foreach($categories as $cluster){ ?>
                                        <optgroup label="<?php echo $cluster->name; ?>">
                                            <?php foreach($cluster->categories as $c){ ?>
                                            <option value="<?php echo $c->idcategories; ?>"<?php echo ($devices[$i-1]->category == $c->idcategories ? ' selected':''); ?>><?php echo $c->name; ?></option>
                                            <?php } ?>
                                        </optgroup>
                                        <?php } ?>
                                    </select>
                                </div>
                            </td>            
                            <td>
                                <textarea class="form-control" id="device[<?php echo $i; ?>][problem]" name="device[<?php echo $i; ?>][problem]"><?php echo $devices[$i-1]->problem; ?></textarea>
                            </td>
                            <td>
                                <div class="form-group">
                                    <input type="text" name="device[<?php echo $i; ?>][brand]" id="device[<?php echo $i; ?>][brand]" class="form-control" placeholder="Brand..." value="<?php echo $devices[$i-1]->brand; ?>">
                                </div>
                                
                                <div class="form-group">
                                    <input type="text" name="device[<?php echo $i; ?>][model]" id="device[<?php echo $i; ?>][model]" class="form-control" placeholder="Model..." value="<?php echo $devices[$i-1]->model; ?>">
                                </div>
                                
                                
                            </td>
                            <td>
                                <div class="form-group">
                                    <div class="radio">                                                
                                        <label>
                                            <input
                                                   type="radio"
                                                   name="device[<?php echo $i; ?>][repair_status]"
                                                   id="device[<?php echo $i; ?>][repair_status_1]"
                                                   value="1"
                                                   <?php echo ($devices[$i-1]->repair_status == 1 ? 'checked="checked"' : ''); ?>>
                                                   Fixed
                                        </label>
                                    </div>
                                    <div class="radio">
                                        <label>
                                            <input
                                                   type="radio" 
                                                   <?php echo ($devices[$i-1]->repair_status == 2 ? 'checked="checked"' : ''); ?>
                                                   name="device[<?php echo $i; ?>][repair_status]"
                                                   id="device[<?php echo $i; ?>][repair_status_2]"
                                                   value="2"
                                                   class="repairable"
                                                   data-target-details="#repairable-details-<?php echo $i; ?>">
                                                   
                                                   Repairable
                                        </label>
                                    </div>
                                    <div id="repairable-details-<?php echo $i; ?>" class="repairable-details">
                                        <div class="checkbox">
                                            <label>
                                                <input type="checkbox" name="device[<?php echo $i; ?>][more_time_needed]" id="device[<?php echo $i; ?>][more_time_needed]" value="1" <?php echo ($devices[$i-1]->more_time_needed == 1 ? 'checked' : ''); ?> > More time needed
                                            </label>
                                        </div>
                                        <div class="checkbox">
                                            <label>
                                                <input type="checkbox" name="device[<?php echo $i; ?>][professional_help]" id="device[<?php echo $i; ?>][professional_help]" value="1" <?php echo ($devices[$i-1]->professional_help == 1 ? 'checked' : ''); ?> > Professional help
                                            </label>
                                        </div>
                                        <div class="checkbox">
                                            <label>
                                                <input type="checkbox" name="device[<?php echo $i; ?>][do_it_yourself]" id="device[<?php echo $i; ?>][do_it_yourself]" value="1" <?php echo ($devices[$i-1]->do_it_yourself == 1 ? 'checked' : ''); ?> > Do it yourself
                                            </label>
                                        </div>
                                    </div>
                                    <div class="radio">
                                        <label>
                                            <input
                                                   type="radio"
                                                   name="device[<?php echo $i; ?>][repair_status]"
                                                   id="device[<?php echo $i; ?>][repair_status_3]"
                                                   value="3" 
                                                   <?php echo ($devices[$i-1]->repair_status == 3 ? 'checked="checked"' : ''); ?>> End of lifecycle
                                        </label>
                                    </div>
                                </div>
                            </td>
                            <td>
                                <div class="form-group">
                                    <div class="checkbox">
                                        <label>
                                            <input type="hidden" name="device[<?php echo $i; ?>][spare_parts]" id="device[<?php echo $i; ?>][spare_parts_2]" value="2">
                                            <input type="checkbox" name="device[<?php echo $i; ?>][spare_parts]" id="device[<?php echo $i; ?>][spare_parts_1]" value="1" <?php echo ($devices[$i-1]->spare_parts == 1 ? 'checked' : ''); ?>> Yes
                                        </label>
                                    </div>
                                </div>
                            </td>
                            
                        </tr>
                        <?php 
                            }
                        }
                        ?>
                        
                    
                        <?php
                        $start = (!empty($devices) ? count($devices) + 1 : 1);
                        
                        
                        for ($i = $start; $i < $start + 3 ; $i++) {
                        ?>
                        <tr>
                            <td><?php echo $i; ?>.</td>            
                            <td>
                                <div class="form-group">
                                    <select id="device[<?php echo $i; ?>][category]" name="device[<?php echo $i; ?>][category]" class="selectpicker form-control" data-live-search="true" title="Choose category...">
                                        <option></option>
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
                                <textarea class="form-control" id="device[<?php echo $i; ?>][problem]" name="device[<?php echo $i; ?>][problem]"></textarea>
                            </td>
                            <td>
                                 <div class="form-group">
                                    <input type="text" name="device[<?php echo $i; ?>][brand]" id="device[<?php echo $i; ?>][brand]" class="form-control" placeholder="Brand...">
                                </div>
                                
                                <div class="form-group">
                                    <input type="text" name="device[<?php echo $i; ?>][model]" id="device[<?php echo $i; ?>][model]" class="form-control" placeholder="Model..." >
                                </div>
                            </td>
                            <td>
                                <div class="form-group">
                                    <div class="radio">                                                
                                        <label>
                                            <input type="radio" name="device[<?php echo $i; ?>][repair_status]" id="device[<?php echo $i; ?>][repair_status_1]" value="1" checked> Fixed
                                        </label>
                                    </div>
                                    <div class="radio">
                                        <label>
                                            <input type="radio" class="repairable" data-target-details="#repairable-details-<?php echo $i; ?>" name="device[<?php echo $i; ?>][repair_status]" id="device[<?php echo $i; ?>][repair_status_2]" value="2"> Repairable
                                        </label>
                                    </div>
                                    <div id="repairable-details-<?php echo $i; ?>" class="repairable-details">
                                        <div class="checkbox">
                                            <label>
                                                <input type="checkbox" name="device[<?php echo $i; ?>][more_time_needed]" id="device[<?php echo $i; ?>][more_time_needed]" value="1"> More time needed
                                            </label>
                                        </div>
                                        <div class="checkbox">
                                            <label>
                                                <input type="checkbox" name="device[<?php echo $i; ?>][professional_help]" id="device-<?php echo $i; ?>[professional_help]" value="1"> Professional help
                                            </label>
                                        </div>
                                        <div class="checkbox">
                                            <label>
                                                <input type="checkbox" name="device[<?php echo $i; ?>][do_it_yourself]" id="device[<?php echo $i; ?>][do_it_yourself]" value="1"> Do it yourself
                                            </label>
                                        </div>
                                    </div>
                                    <div class="radio">
                                        <label>
                                            <input type="radio" name="device[<?php echo $i; ?>][repair_status]" id="device[<?php echo $i; ?>][repair_status_3]" value="3"> End of lifecycle
                                        </label>
                                    </div>
                                </div>
                            </td>
                            <td>
                                <div class="form-group">
                                    <div class="checkbox">
                                        <label>
                                            <input type="hidden" name="device[<?php echo $i; ?>][spare_parts]" id="device[<?php echo $i; ?>][spare_parts_2]" value="2">
                                            <input type="checkbox" name="device[<?php echo $i; ?>][spare_parts]" id="device[<?php echo $i; ?>][spare_parts_1]" value="1"> Yes
                                        </label>
                                    </div>
                                    <div class="radio">
                                        <label>
                                            <input type="radio" name="device[<?php echo $i; ?>][spare_parts]" id="device[<?php echo $i; ?>][spare_parts_2]" value="2" checked> No
                                        </label>
                                    </div>
                                </div>
                            </td>
                            x
                        </tr>    
                        <?php } ?>
                    </tbody>
                </table>
                <div class="text-center">
                    <button class="btn btn-primary btn-lg text-center" type="button" id="add-device"><i class="fa fa-plus"></i> Add Device</button>
                </div>
            </div>
        </div>
    </div>
</div>
</form>
