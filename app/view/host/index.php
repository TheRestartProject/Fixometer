<div class="container" id="host-dashboard">
    <section class="row profiles">
        <div class="col-md-6">
            <strong>My Group</strong> <a href="/groups/edit/<?php echo $group->idgroups; ?>" class="small"><i class="fa fa-edit"></i> Edit Group...</a>
            <div class="media">
                <div class="media-left">
                    <?php if(empty($group->path)){ ?>
                    <img src="http://www.lorempixum.com/80/80/abstract" alt="<?php echo $group->name; ?> Image" class="profile-pic" />
                    <?php } else { ?>
                    <img src="/uploads/<?php echo $group->path; ?>" width="80" height="80" alt="<?php echo $group->name; ?> Image" class="profile-pic" />
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
                        <span class="location"><?php echo $party->venue; ?></span>      
                    </div>
                    
                    <div class="no-data">
                        
                        <div style="width: 16%; float: left; clear: none; ">&nbsp;</div>
                        
                        <span class="btn btn-primary btn-lg pull-left add-info-btn">
                            <i class="fa fa-cloud-upload"></i> Add Information
                        </span>
                        
                        
                        <div class="stat greyed">
                            <div class="col"><i class="status mid fixed greyed"></i></div>
                            <div class="col">?</div>
                        </div>
                        
                        <div class="stat greyed">
                            <div class="col"><i class="status mid repairable greyed"></i></div>
                            <div class="col">?</div>
                        </div>
                        
                        <div class="stat greyed">
                            <div class="col"><i class="status mid dead greyed"></i></div>
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
                        <span class="location"><?php echo $party->venue; ?></span>      
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
                                <img class="" alt="The Restart Project: Logo" src="/assets/images/logo_mini.png">
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
                
            </a>
            <?php } ?>
        </div>
        <?php } ?>
    </section>
    
    <section class="row">
        <div class="col-md-12">
            <h2>Group Achievements</h2>
        </div>
        <div class="col-md-12">
            <h3>Devices Restarted</h3>
            <div class="row">
                <div class="col-md-4 count">
                    <div class="col fixed">
                        <i class="status mid fixed"></i>
                        <span class="subtext fixed">fixed</span>
                    </div>
                    <div class="col">
                        <span class="largetext">
                            <?php echo $group_device_count_status[0]->counter; ?>
                        </span>
                        <span class="subtext">total: <?php echo $device_count_status[0]->counter; ?></span>
                    </div>
                </div>
                <div class="col-md-4 count">
                    <div class="col repairable">
                        <i class="status mid repairable"></i>
                        <span class="subtext repairable">repairable</span>
                    </div>
                    <div class="col">
                        <span class="largetext">
                            <?php echo $group_device_count_status[1]->counter; ?>
                        </span>
                        <span class="subtext">total: <?php echo $device_count_status[1]->counter; ?></span>
                    </div>
                </div>
                <div class="col-md-4 count">
                    <div class="col dead">
                        <i class="status mid dead"></i>
                        <span class="subtext dead">dead</span>
                    </div>
                    <div class="col">
                        <span class="largetext">
                            <?php echo $group_device_count_status[2]->counter; ?>
                        </span>
                        <span class="subtext">total: <?php echo $device_count_status[2]->counter; ?></span>
                    </div>
                </div>
            </div>
        </div>
        
    </section>
    
    <hr />
    
    <section class="row">
        <div class="col-md-7">
            <h5 class="text-center">CO<sub>2</sub> de-sequestered to date</h5> 
            <?php
                $sum = 0;
                foreach($year_data as $y){
                    $sum += $y->co2;
                }
            ?>
            <span class="largetext">
                <?php echo round($sum, 2); ?> kg of CO<sub>2</sub> 
            </span>
            <span class="subtext">Total: <?php echo $co2Total; ?></span>
            
            <hr />
            
            <h5 class="text-center">CO<sub>2</sub> de-sequestered this year</h5> 
            <?php
                
                foreach($year_data as $y){
                    if($y->year == date('Y', time())) {
            ?>
            <span class="largetext">
                <?php echo round($y->co2, 2); ?> kg of CO<sub>2</sub> 
            </span>
            <span class="subtext">Total: <?php echo $co2ThisYear; ?></span>
            <?php 
                    }
                }
            ?>
            
        </div>
        <div class="col-md-5">
            <h4 class="text-center">CO<sub>2</sub> de-sequestered per year</h4>
            <canvas id="co2ByYear" width="450" height="250"></canvas>
            
            <script>
                
                var data = {
                    labels: ["<?php echo implode('", "', array_keys($bar_chart_stats)); ?>"],
                    datasets: [
                        {
                        label: "CO<sub>2</sub> By Year",
                        fillColor: "rgba(  3,148,166,0.5)",
                        strokeColor: "rgba(  3,148,166,0.8)",
                        highlightFill: "rgba(  3,148,166,0.75)",
                        highlightStroke: "rgba(  3,148,166,1)",
                        data: [<?php echo implode(', ', $bar_chart_stats); ?>]
                        }
                    ]
                };
                var opts = {
                    barValueSpacing : 20   
                };
                var ctx = document.getElementById("co2ByYear").getContext("2d");
                var theChart = new Chart(ctx).Bar(data, opts);

            </script>
            
        </div>
        
    </section>

    <section class="row">
        <div class="col-md-12">
            <h3>Devices Restarted per Category</h3>            
        </div>
       <div class="col-md-10">
            <div class="row">
                <div class="col-md-1">
                    <span class="cluster min cluster-1"></span>
                </div>
                <div class="col-md-11">
                    <div class="barpiece fixed" style="width :<?php echo round((($clusters[1][0]->counter / $clusters[1]['total']) * 100) , 4); ?>%"><?php echo round((($clusters[1][0]->counter / $clusters[1]['total']) * 100) , 2); ?>%</div>
                    <div class="barpiece repairable" style="width :<?php echo round((($clusters[1][1]->counter / $clusters[1]['total']) * 100) , 4); ?>%"><?php echo round((($clusters[1][1]->counter / $clusters[1]['total']) * 100) , 2); ?>%</div>
                    <div class="barpiece end-of-life" style="width :<?php echo round((($clusters[1][2]->counter / $clusters[1]['total']) * 100) , 4); ?>%"><?php echo round((($clusters[1][2]->counter / $clusters[1]['total']) * 100) , 2); ?>%</div>
                </div>
                
            </div>
            <hr />
            <div class="row">
                <div class="col-md-1">
                    <span class="cluster min cluster-2"></span>
                </div>
                <div class="col-md-11">
                    <div class="barpiece fixed" style="width :<?php echo round((($clusters[2][0]->counter / $clusters[2]['total']) * 100) , 4); ?>%"><?php echo round((($clusters[2][0]->counter / $clusters[2]['total']) * 100) , 2); ?>%</div>
                    <div class="barpiece repairable" style="width :<?php echo round((($clusters[2][1]->counter / $clusters[2]['total']) * 100) , 4); ?>%"><?php echo round((($clusters[2][1]->counter / $clusters[2]['total']) * 100) , 2); ?>%</div>
                    <div class="barpiece end-of-life" style="width :<?php echo round((($clusters[2][2]->counter / $clusters[2]['total']) * 100) , 4); ?>%"><?php echo round((($clusters[2][2]->counter / $clusters[2]['total']) * 100) , 2); ?>%</div>
                </div>
                
            </div>
            <hr />
            
            <div class="row">
                <div class="col-md-1">
                    <span class="cluster min cluster-3"></span>
                </div>
                <div class="col-md-11">
                    <div class="barpiece fixed" style="width :<?php echo round((($clusters[3][0]->counter / $clusters[3]['total']) * 100) , 4); ?>%"><?php echo round((($clusters[3][0]->counter / $clusters[3]['total']) * 100) , 2); ?>%</div>
                    <div class="barpiece repairable" style="width :<?php echo round((($clusters[3][1]->counter / $clusters[3]['total']) * 100) , 4); ?>%"><?php echo round((($clusters[3][1]->counter / $clusters[3]['total']) * 100) , 2); ?>%</div>
                    <div class="barpiece end-of-life" style="width :<?php echo round((($clusters[3][2]->counter / $clusters[3]['total']) * 100) , 4); ?>%"><?php echo round((($clusters[3][2]->counter / $clusters[3]['total']) * 100) , 2); ?>%</div>
                </div>
                
            </div>
            <hr />
            
            <div class="row">
                <div class="col-md-1">
                    <span class="cluster min cluster-4"></span>
                </div>
                <div class="col-md-11">
                    <div class="barpiece fixed" style="width :<?php echo round((($clusters[4][0]->counter / $clusters[4]['total']) * 100) , 4); ?>%"><?php echo round((($clusters[4][0]->counter / $clusters[4]['total']) * 100) , 2); ?>%</div>
                    <div class="barpiece repairable" style="width :<?php echo round((($clusters[4][1]->counter / $clusters[4]['total']) * 100) , 4); ?>%"><?php echo round((($clusters[4][1]->counter / $clusters[4]['total']) * 100) , 2); ?>%</div>
                    <div class="barpiece end-of-life" style="width :<?php echo round((($clusters[4][2]->counter / $clusters[4]['total']) * 100) , 4); ?>%"><?php echo round((($clusters[4][2]->counter / $clusters[4]['total']) * 100) , 2); ?>%</div>
                </div>
                
                
            </div>
            
            
       </div>
       <div class="col-md-2">
        tabs
       </div>
    </section>
    
    
    <section class="row">
        <div class="col-md-12">
            <h3>Category Details</h3>
        </div>
        
        
        <div class="row">
            <div class="col-md-2  text-center">
                <i class="cluster mid cluster-1"></i>
                Computers and Home Office
            </div>
            <div class="col-md-4">
                <div class="col3">
                    <i class="status mid fixed"></i>
                    34
                </div>
                <div class="col3">
                    <i class="status mid repairable"></i>
                    34
                </div>
                <div class="col3">
                    <i class="status mid dead"></i>
                    34
                </div>
            </div>
            <div class="col-md-6">
                <div class="category-detail">
                    <dl>
                        <dt>Most seen:</dt>
                        <dd>Laptop large | <span class="count">25 times</span></dd>
                        <dt>Most repaired:</dt>
                        <dd>Desktop computer | <span class="count">16/21</span></dd>
                        <dt>Least repaired:</dt>
                        <dd>Kettle | <span class="count">2/14</span></dd>
                    </dl>
                </div>
            </div>
        </div>
        
        <hr />
        
        <div class="row">
            <div class="col-md-2  text-center">
                <i class="cluster mid cluster-2"></i>
                Electronic Gadgets
            </div>
            <div class="col-md-4">
                <div class="col3">
                    <i class="status mid fixed"></i>
                    34
                </div>
                <div class="col3">
                    <i class="status mid repairable"></i>
                    34
                </div>
                <div class="col3">
                    <i class="status mid dead"></i>
                    34
                </div>
            </div>
            <div class="col-md-6">
                
                
            </div>
        </div>
        
        <hr />
        
        <div class="row">
            <div class="col-md-2  text-center">
                <i class="cluster mid cluster-3"></i>
                Home Entertainment
            </div>
            <div class="col-md-4">
                <div class="col3">
                    <i class="status mid fixed"></i>
                    34
                </div>
                <div class="col3">
                    <i class="status mid repairable"></i>
                    34
                </div>
                <div class="col3">
                    <i class="status mid dead"></i>
                    34
                </div>
            </div>
            <div class="col-md-6">
                
                
            </div>
        </div>
        <hr />
        <div class="row">
            <div class="col-md-2 text-center">
                <i class="cluster mid cluster-4"></i>
                Kitchen and Household Items
            </div>
            <div class="col-md-4">
                <div class="col3">
                    <i class="status mid fixed"></i>
                    34
                </div>
                <div class="col3">
                    <i class="status mid repairable"></i>
                    34
                </div>
                <div class="col3">
                    <i class="status mid dead"></i>
                    34
                </div>
            </div>
            <div class="col-md-6">
                
                
            </div>
        </div>
        
        
    </section>
</div>