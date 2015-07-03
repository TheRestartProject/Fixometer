<div class="container">
    <section class="row profiles">
        <div class="col-md-6">
            <strong>My Group</strong> <a href="/groups/edit/<?php echo $group->idgroups; ?>" class="small"><i class="fa fa-edit"></i> Edit Group...</a>
            <div class="media">
                <div class="media-left">
                    <?php if(empty($group->path)){ ?>
                    <img src="http://www.lorempixum.com/80/80/abstract" alt="<?php echo $group->name; ?> Image" class="profile-pic" />
                    <?php } else { ?>
                    <img src="/uploads/<?php echo $group->path; ?>" alt="<?php echo $group->name; ?> Image" class="profile-pic" />
                    <?php } ?>
                </div>
                <div class="media-body">
                    <h3 class="media-heading"><?php echo $group->name; ?></h3>
                    <span><?php echo $group->location . (!empty($group->area) ? ', ' . $group->area : ''); ?></span>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <strong>My Profile</strong> <a href="/users/edit/<?php echo $profile->idusers; ?>" class="small"><i class="fa fa-edit"></i> Edit Profile...</a>
            <div class="media">
                <div class="media-left">
                    <?php if(empty($profile->path)){ ?>
                    <img src="http://www.lorempixum.com/80/80/people" alt="<?php echo $profile->name; ?> Image" class="profile-pic" />
                    <?php } else { ?>
                    <img src="/uploads/<?php echo $profile->path; ?>" alt="<?php echo $profile->name; ?> Image" class="profile-pic" />
                    <?php } ?>
                </div>
                <div class="media-body">
                    <h3 class="media-heading"><?php echo $profile->name; ?></h3>
                </div>
            </div>
        </div>
    </section>
    
    <!-- Upcoming Parties -->
    <section class="row parties">
        <header>
        <div class="col-md-12">
            <h2>Upcoming Restart Parties <a class="btn btn-primary btn-sm" href="/party/create"><i class="fa fa-plus"></i> New Party</a></h2>
        </div>
        </header>
        <?php foreach($upcomingparties as $party){ ?>
        <div class="col-md-6">
            <div class="media">
                <div class="media-left">
                    <img class="media-object" alt="The Restart Project: Logo" src="/assets/images/logo_mini.png">        
                </div>
                <div class="media-body">
                    <div class="body">
                        <time datetime="<?php echo dbDate($party->event_date); ?>"><?php echo dateFormatNoTime($party->event_date) . ' ' . $party->start; ?></time>
                        <span clasS="location"><?php echo $party->location; ?></span>      
                    </div>
                    <div class="links">
                        <a class="#"><i class="fa fa-edit"></i> edit...</a><br />
                        <a class="#"><i class="fa fa-trash"></i> delete...</a><br />
                    </div>
                </div>
            </div>
            
        </div>
        <?php } ?>
        
    </section>
    
    <section class="row parties">
        <header>
            <div class="col-md-12">
                <h2>
                    Latest Restart Parties
                    <a href="#" class="btn btn-default btn-sm"><i class="fa fa-list"></i> View All</a>
                </h2>
            </div>
        </header>
        
        <?php foreach($allparties as $party){ ?>
        
        <div class="col-md-12">
            <?php if($party->device_count < 1){ ?>
            <a class="media no-data-wrap party">
                
                <div class="media-left">
                    <img class="media-object" alt="The Restart Project: Logo" src="/assets/images/logo_mini.png">        
                </div>
                
                <div class="media-body">
                    <div class="short-body">
                        <time datetime="<?php echo dbDate($party->event_date); ?>"><?php echo dateFormatNoTime($party->event_timestamp) . ' ' . $party->start; ?></time>
                        <span clasS="location"><?php echo $party->location; ?></span>      
                    </div>
                    
                    <div class="no-data">
                        
                        <span class="btn btn-primary btn-lg pull-left add-info-btn">
                            <i class="fa fa-cloud-upload"></i> Add Information
                        </span>
                        
                        
                        <div class="stat greyed">
                            <div class="col"><i class="fa fa-check"></i></div>
                            <div class="col">?</div>
                        </div>
                        
                        <div class="stat greyed">
                            <div class="col"><i class="fa fa-wrench"></i></div>
                            <div class="col">?</div>
                        </div>
                        
                        <div class="stat greyed">
                            <div class="col"><i class="fa fa-times"></i></div>
                            <div class="col">?</div>
                        </div>
                        
                        
                    </div>
                </div>
            </a>
            <?php } else {  ?>
            <a class="media party">
                
                <div class="media-left">
                    <img class="media-object" alt="The Restart Project: Logo" src="/assets/images/logo_mini.png">        
                </div>
                
                <div class="media-body">
                    <div class="short-body">
                        <time datetime="<?php echo dbDate($party->event_date); ?>"><?php echo dateFormatNoTime($party->event_timestamp) . ' ' . $party->start; ?></time>
                        <span clasS="location"><?php echo $party->location; ?></span>      
                    </div>
                    
                    <div class="data">
                       
                        
                        <div class="stat double">
                            <div class="col">
                                <i class="fa fa-group"></i>
                                <span class="subtext">participants</span>
                            </div>
                            <div class="col">
                                <?php echo $party->pax; ?>    
                            </div>
                            
                        </div>
                        
                        <div class="stat double">
                            <div class="col">
                                <img class="media-object" alt="The Restart Project: Logo" src="/assets/images/logo_mini.png">
                                <span class="subtext">restarters</span>
                            </div>
                            <div class="col">
                                <?php echo $party->volunteers; ?>    
                            </div>
                            
                        </div>
                        
                        <div class="stat">
                            
                            <div class="footprint">
                                <?php echo $party->co2; ?>
                                <span class="subtext">kg of CO<sub>2</sub></span>
                            </div>
                        </div>
                        
                        
                        <div class="stat fixed"><i class="fa fa-check "></i> </div>
                        <div class="stat repairable"><i class="fa fa-wrench repairable"></i> </div>
                        
                        <div class="stat dead"><i class="fa fa-times"></i> </div>
                        
                    </div>
                </div>
                
            </a>
            <?php } ?>
        </div>
        <?php } ?>
    </section>
    
</div>