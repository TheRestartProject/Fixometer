<div class="container">
    <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-4">
            <h1><?php echo $title; ?></h1>
        </div>
    </div>
    <div class="row">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    
                    <?php if(isset($response)) { printResponse($response); } ?>
                    
                    <form action="/party/create" method="post" enctype="multipart/form-data">
                        <div class="row">
                            <div class="col-md-6">
                                
                                <div class="form-group <?php if(isset($error) && isset($error['event_date']) && !empty($error['event_date'])) { echo "has-error"; } ?>">
                                    <label for="event_date">Date:</label>
                                    <div class="input-group date">
                                        <input type="text" name="event_date" id="event_date" class="form-control datepicker">
                                        <span class="input-group-addon">
                                            <i class="fa fa-calendar"></i>
                                        </span>
                                    </div>
                                    <?php if(isset($error) && isset($error['start']) && !empty($error['start'])) { echo '<span class="help-block text-danger">' . $error['start'] . '</span>'; } ?>
                                </div>
                                
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group <?php if(isset($error) && isset($error['start']) && !empty($error['start'])) { echo "has-error"; } ?>">
                                            <label for="start">Start:</label>
                                            <div class="input-group time">
                                                <input type="text" name="start" id="start" class="form-control datepicker">
                                                <span class="input-group-addon">
                                                    <i class="fa fa-clock-o"></i>
                                                </span>
                                            </div>
                                            <?php if(isset($error) && isset($error['start']) && !empty($error['start'])) { echo '<span class="help-block text-danger">' . $error['start'] . '</span>'; } ?>
                                        </div>
                                        
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group <?php if(isset($error) && isset($error['end']) && !empty($error['end'])) { echo "has-error"; } ?>">
                                            <label for="end">End:</label>
                                            <div class="input-group time">
                                                <input type="text" name="end" id="end" class="form-control datepicker">
                                                <span class="input-group-addon">
                                                    <i class="fa fa-clock-o"></i>
                                                </span>
                                            </div>
                                            <?php if(isset($error) && isset($error['end']) && !empty($error['end'])) { echo '<span class="help-block text-danger">' . $error['end'] . '</span>'; } ?>
                                        </div>
                                        
                                    </div>
                                    
                                </div>
                                
                                
                        
                                <div class="form-group">
                                    <label for="free_text">Description:</label>
                                    <textarea class="form-control rte" rows="6" name="free_text" id="free_text"></textarea>
                                </div>
                                                        
                            </div>
                            
                            <div class="col-md-6">
                                <div class="form-group <?php if(isset($error) && isset($error['pax']) && !empty($error['pax'])) { echo "has-error"; } ?>">
                                    <label for="pax">Participants (#):</label>
                                    <input type="text" name="pax" id="pax" class="form-control">
                                    <?php if(isset($error) && isset($error['pax']) && !empty($error['pax'])) { echo '<span class="help-block text-danger">' . $error['pax'] . '</span>'; } ?>
                                </div>
                                
                                <div class="form-group <?php if(isset($error) && isset($error['group']) && !empty($error['group'])) { echo "has-error"; } ?>">
                                    <label for="group">Group:</label>
                                    <select id="group" name="group"  class="form-control selectpicker users_group">
                                        <option></option>
                                        <?php foreach($group_list as $group){ ?>
                                        <option value="<?php echo $group->id; ?>"><?php echo $group->name; ?></option>
                                        <?php } ?>
                                    </select>
                                    <?php if(isset($error) && isset($error['group']) && !empty($error['group'])) { echo '<span class="help-block text-danger">' . $error['group'] . '</span>'; } ?>
                                    
                                    <div class="users_group_list">
                                        
                                    </div>    
                                </div>
            
                               
                                <div class="form-group">
                                    <label for="location">Location:</label>
                                    <div class="input-group">
                                        <input type="text" name="location" id="location" class="form-control" <?php if(isset($error) && !empty($error) && !empty($udata)) echo 'value="'.$udata['location'].'"' ; ?>>
                                        <span class="input-group-btn">
                                            <button type="button" class="btn btn-primary" onclick="codeAddress()"><i class="fa fa-map-marker"></i> geocode</button>
                                        </span>
                                    </div>
                                </div>
                                
                                
                                <div class="" id="map-canvas" style="height: 350px; ">
                                    <i class="fa fa-spinner"></i>
                                </div>
                                
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <input type="text" name="latitude" id="latitude" class="form-control" placeholder="latitude..." <?php if(isset($error) && !empty($error) && !empty($udata)) echo 'value="'.$udata['latitude'].'"' ; ?>>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <input type="text" name="longitude" id="longitude" class="form-control" placeholder="longitude..." <?php if(isset($error) && !empty($error) && !empty($udata)) echo 'value="'.$udata['longitude'].'"' ; ?>>
                                        </div>
                                    </div>
                                </div>
                                
                                
                                <div class="from-group">
                                    <label for="file">Image:</label>
                                    <input type="file" name="file" id="file" class="form-control file">
                                </div>        
                                        
                            </div>
                            
                        </div>
                        <div class="row buttons">
                            
                            <div class="col-md-6 col-md-offset-6">
                                
                                <div class="form-group">
                                    <button class="btn btn-default" type="reset"><i class="fa fa-refresh"></i> reset</button>
                                    <button class="btn btn-primary" type="submit"><i class="fa fa-save"></i> save</button>
                                </div>
                                
                            </div>
                            
                        </div>
                        
                    </form>
                </div>
            </div>
            
        </div>
    </div>
</div>