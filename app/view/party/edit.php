<div class="container">
    <div class="row">
        <div class="col-md-12">
            <h1>
                Edit Party
                <small>
                    <?php $home_url = (hasRole($user, 'Administrator') ? '/admin' : '/host'); ?>
                    <a href="<?php echo $home_url; ?>" class="btn btn-primary btn-sm"><i class="fa fa-home"></i> back to dashboard</a>
                </small>
            </h1>
        </div>
    </div>
    <!-- Profiles -->
    <?php if(hasRole( $user, 'Administrator' )) { ?>
    
    
    <section class="row profiles">
        <div class="col-md-12">
            <h5>Admin Console</h5>
            
        </div>
        <div class="col-md-6">
            <div class="btn-group btn-group-justified">
                
                
                <div class="btn-group" role="group">
                    <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        Groups
                      <span class="fa fa-chevron-down"></span>
                    </button>
                    <ul class="dropdown-menu">
                        <?php foreach($grouplist as $group) { ?>
                        <li class="group-list clearfix">
                            <div class="pull-left">
                                <?php if(!empty($group->path)) { ?> 
                                <img src="/uploads/thumbnail_<?php echo $group->path; ?>" width="40" height="40" alt="<?php echo $group->name; ?> Image" class="profile-pic" />
                                <?php } else { ?>
                                <div class="profile-pic clearfix" style="background: #ddd; width: 40px; height: 40px; ">&nbsp;</div>    
                                <?php } ?>                                
                            </div>
                            <div class="pull-left">
                                <a  href="/host/index/<?php echo $group->id; ?>" ><?php echo $group->name; ?></a>
                            </div>
                        </li>
                        
                        <?php } ?>
                    </ul>
                </div>
                
                <a class="btn btn-default" href="/group/create">Add Group</a>
            </div>
        </div>
        <div class="col-md-6">
            <div class="btn-group btn-group-justified">
                <a class="btn btn-default" href="/user/all">Users</a>
                <a class="btn btn-default" href="/user/create">Add User</a>
            </div>
        </div>
        
    </section>  
    
    
    
    <?php } ?>
    <div class="row">
        <div class="col-md-12">
            <?php if(isset($response)) { printResponse($response); } ?>
            
            <form action="/party/edit/<?php echo $formdata->idevents; ?>" method="post" id="party-edit" enctype="multipart/form-data">

                <div class="row">
                            <div class="col-md-6">
                                <input type="hidden" name="id" value="<?php echo $formdata->idevents; ?>" >
                                <div class="form-group <?php if(isset($error) && isset($error['event_date']) && !empty($error['event_date'])) { echo "has-error"; } ?>">
                                    <label for="event_date">Date:</label>
                                    <div class="input-group date">
                                        <input type="text" name="event_date" id="event_date" class="form-control datepicker" value="<?php echo strftime('%d/%m/%Y', strtotime($formdata->event_date)); ?>">
                                        
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
                                                <input type="text" name="start" id="start" class="form-control datepicker" value="<?php echo substr($formdata->start, 0, 5); ?>">
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
                                                <input type="text" name="end" id="end" class="form-control datepicker" value="<?php echo substr($formdata->end, 0, 5); ?>">
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
                                    <textarea class="form-control rte" rows="6" name="free_text" id="free_text"><?php echo $formdata->free_text; ?></textarea>
                                </div>
                                                        
                            </div>
                            
                            <div class="col-md-6">
                                <div class="form-group <?php if(isset($error) && isset($error['pax']) && !empty($error['pax'])) { echo "has-error"; } ?>">
                                    <label for="pax">Participants (#):</label>
                                    <input type="text" name="pax" id="pax" class="form-control" value="<?php echo $formdata->pax; ?>">
                                    <?php if(isset($error) && isset($error['pax']) && !empty($error['pax'])) { echo '<span class="help-block text-danger">' . $error['pax'] . '</span>'; } ?>
                                </div>
                                
                                <div class="form-group <?php if(isset($error) && isset($error['volunteers']) && !empty($error['volunteers'])) { echo "has-error"; } ?>">
                                    <label for="volunteers">Volunteers (#):</label>
                                    <input type="text" name="volunteers" id="volunteers" class="form-control" value="<?php echo $formdata->volunteers; ?>">
                                    <?php if(isset($error) && isset($error['volunteers']) && !empty($error['volunteers'])) { echo '<span class="help-block text-danger">' . $error['volunteers'] . '</span>'; } ?>
                                </div>
                                
                                <?php
                                if( hasRole($user, 'Host') ) {
                                ?>
                                
                                <input type="hidden" name="group" id="group" value="<?php echo $usergroup->idgroups; ?>">
                                
                                <?php
                                }
                                else {
                                ?>    
                                
                                <div class="form-group <?php if(isset($error) && isset($error['group']) && !empty($error['group'])) { echo "has-error"; } ?>">
                                    <label for="group">Group:</label>
                                    <select id="group" name="group"  class="form-control selectpicker users_group">
                                        <option></option>
                                        <?php foreach($group_list as $group){ ?>
                                        <option value="<?php echo $group->id; ?>" <?php echo($group->id == $formdata->group ? 'selected' : ''); ?>><?php echo $group->name; ?></option>
                                        <?php } ?>
                                    </select>
                                    <?php if(isset($error) && isset($error['group']) && !empty($error['group'])) { echo '<span class="help-block text-danger">' . $error['group'] . '</span>'; } ?>
                                    
                                    <div class="users_group_list">
                                        
                                    </div>    
                                </div>
                                <?php
                                }
                                ?>
                               
                                <div class="form-group">
                                    <label for="location">Location:</label>
                                    <div class="input-group">
                                        <input type="text" name="location" id="location" class="form-control" value="<?php echo $formdata->location; ?>">
                                        <span class="input-group-btn">
                                            <button type="button" class="btn btn-primary" onclick="codeAddress()"><i class="fa fa-map-marker"></i> geocode</button>
                                        </span>
                                    </div>
                                    <p class="help-block">To share an exact location, please use a street address here and press "geocode". Afterwards, please change this line to a recognisable place name, as this will be used in the event title.</p>
                                </div>
                                
                                
                                <div class="" id="map-canvas" style="height: 350px; ">
                                    <i class="fa fa-spinner"></i>
                                </div>
                                
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <input type="text" name="latitude" id="latitude" class="form-control" placeholder="latitude..." value="<?php echo $formdata->latitude; ?>">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <input type="text" name="longitude" id="longitude" class="form-control" placeholder="longitude..."  value="<?php echo $formdata->longitude; ?>">
                                        </div>
                                    </div>
                                </div>
                                
                                
                                <div class="form-group">
                                    <h3>Uploaded images</h3>
                                    <div class="party-images clearfix">
                                        <?php //dbga($images); ?>
                                        <?php
                                        foreach($images as $image) {
                                        ?>
                                        <div class="image">
                                            <a class="remove-image" href="/party/deleteimage" data-remove-image="<?php echo $image->idimages; ?>"  data-image-path="<?php echo $image->path; ?>">
                                                <i class="fa fa-trash"></i>
                                            </a>
                                            <img src="/uploads/<?php echo $image->path; ?>" class="img-responsive">
                                        </div>
                                        <?php
                                        }
                                        ?>
                                        
                                    </div>
                                    <small class="clearfix">Images are displayed in this ratio for ease of management</small>
                                    <label for="file" class="sr-only">Image:</label>
                                    <input type="file" name="file[]" id="file" class="form-control fileinput" multiple>
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