<div class="container" id="host-dashboard">
    
    
    <?php if(isset($response)) { ?>
    <div class="row">
        <div class="col-md-12">
            <?php printResponse($response);  ?>
        </div>
    </div>
    <?php } ?>
            
    
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
                        <?php foreach($grouplist as $g) { ?>
                        <li class="group-list clearfix">
                            <div class="pull-left">
                                <?php if(!empty($g->path)) { ?> 
                                <img src="/uploads/thumbnail_<?php echo $g->path; ?>" width="40" height="40" alt="<?php echo $g->name; ?> Image" class="profile-pic" />
                                <?php } else { ?>
                                <div class="profile-pic clearfix" style="background: #ddd; width: 40px; height: 40px; ">&nbsp;</div>    
                                <?php } ?>                                
                            </div>
                            <div class="pull-left">
                                <a  href="/host/index/<?php echo $g->id; ?>" ><?php echo $g->name; ?></a>
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
    
    <section class="row profiles" id="group-profile">
        <div class="col-md-3">
            <div class="media">
                <h3 class="media-heading"><?php echo $group->name; ?></h3>
                
                <div class="media-left">
                    <?php if(empty($group->path)){ ?>
                    <img src="http://www.placehold.it/60?text=group+avatar" alt="<?php echo $group->name; ?> Image" class="profile-pic" />
                    <?php } else { ?>
                    <img src="/uploads/thumbnail_<?php echo $group->path; ?>" width="60" height="60" alt="<?php echo $group->name; ?> Image" class="profile-pic" />
                    <?php } ?>
                </div>
                <div class="media-body">
                    
                    <span><?php echo $group->location . (!empty($group->area) ? ', ' . $group->area : ''); ?></span><br />
                    <a href="/group/edit/<?php echo $group->idgroups; ?>" class="small"><i class="fa fa-edit"></i> Edit Group...</a>
            
                </div>
            </div>
        </div>
        
        
        <div class="col-md-9">
            <div class="row" id="group-main-stats">
                <div class="col">
                    <h5>participants</h5>
                    <span class="largetext"><?php echo $pax; ?></span>
                </div>
                
                <div class="col">
                    <h5>hours volunteered</h5>
                    <span class="largetext"><?php echo $hours; ?></span>
                </div>
                
                <div class="col">
                    <h5>parties thrown</h5>
                    <span class="largetext"><?php echo count($allparties); ?></span>
                </div>
                
                <div class="col">
                    <h5>waste prevented</h5>
                    <?php
                        $sum = 0;
                        foreach($waste_year_data as $y){
                            $sum += $y->waste;
                        }
                    ?>
                    <span class="largetext">
                        <?php echo number_format(round($sum), 0, '.', ','); ?> kg 
                    </span>
                </div>
                
                <div class="col">
                    <h5>CO<sub>2</sub> emission prevented</h5>
                    <?php
                        $sum = 0;
                        foreach($year_data as $y){
                            $sum += $y->co2;
                        }
                    ?>
                    <span class="largetext"><?php echo number_format(round($sum), 0, '.', ','); ?> kg</span>
                </div>
                
            </div>
        </div>
       
    </section>
    
    
    
    
    <!-- Tabs -->
    <!-- Nav tabs -->
    <ul class="nav nav-pills nav-justified" role="tablist">
        <li role="presentation" class="active"><a href="#parties-tab" aria-controls="Parties" role="tab" data-toggle="pill">Parties</a></li>
        <li role="presentation"><a href="#impact-tab" aria-controls="Impact" role="tab" data-toggle="pill">Impact</a></li>
        <li role="presentation"><a href="#details-tab" aria-controls="Details" role="tab" data-toggle="pill">Details</a></li>        
    </ul>

    
    
    <!-- Tab panes -->
    <div class="tab-content">
        <div role="tabpanel" class="tab-pane active" id="parties-tab">
            <section class="row parties">
                <header>
                <div class="col-md-12" id="upcomingparties">
                    <h2>
                        <span class="title-text">Upcoming Restart Parties <a href="/party/create" class="btn btn-primary btn-sm"><i class="fa fa-plus"></i> New Party</a></span>
                    
                    </h2>
                </div>
                </header>
                
                
                <?php
                if(empty($upcomingparties)){
                ?>
                <div class="col-md-12"><p class="text-center">No Upcoming Parties. <a href="/party/create">Add a party.</a></p></div>
                <?php
                } else { ?>
                
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
                                <a href="/party/edit/<?php echo $party->idevents; ?>" class="btn btn-default btn-sm btn-block"><i class="fa fa-edit"></i> edit</a>
                                <a href="/party/delete/<?php echo $party->idevents; ?>" class="btn btn-danger btn-sm btn-block delete-control"><i class="fa fa-trash"></i> delete</a>
                            </div>
                        </div>
                    </div>
                    
                </div>
                <?php } ?>
                <div class="col-md-3 col-md-offset-9">
                    
                </div>
                <?php } ?>
            </section>
            
            
            <!-- Latest Parties -->
            <section class="row parties">
                <header>
                    <div class="col-md-12"  id="allparties">
                        <h2>
                           <span class="title-text">All <span class="grey"><?php echo $group->name; ?></span> Parties</span>                     
                        </h2>
                    </div>
                </header>
                
                <div class="col-md-12" id="party-list-header">
                    <div class="header-col header-col-2" id="header-link-box">
                        <a href="http://www.therestartproject.org/party">view all upcoming events</a>
                    </div>
                    
                    <div class="header-col">
                        <img src="/assets/icons/icon_pax.png" alt="Participants" class="header-icon">
                        <span class="icon-label">Participants</span>
                    </div>
                    
                    <div class="header-col">
                        <img src="/assets/icons/icon_volunters.png" alt="Restarters" class="header-icon">
                        <span class="icon-label">Restarters</span>
                    </div>
                    
                    <div class="header-col">
                        <img src="/assets/icons/icon_emissions.png" alt="CO2 Emissions Prevented" class="header-icon">
                        <span class="icon-label">CO<sub>2</sub> Emissions prevented</span>
                    </div>
                    
                    <div class="header-col">
                        <img src="/assets/icons/icon_fixed.png" alt="Fixed" class="header-icon">
                        <span class="icon-label">Fixed</span>
                    </div>
                    
                    <div class="header-col">
                        <img src="/assets/icons/icon_repairable.png" alt="Repairable" class="header-icon">
                        <span class="icon-label">Repairable</span>
                    </div>
                    
                    <div class="header-col">
                        <img src="/assets/icons/icon_dead.png" alt="Dead" class="header-icon">
                        <span class="icon-label">Dead</span>
                    </div>
                    
                </div>
                
                <div class="col-md-12 well" id="party-list">
                
                    <?php
                    $nodata = 0;
                    $currentYear = date('Y', time());
                    foreach($allparties as $party){
                        $partyYear = date('Y', $party->event_timestamp);
                        if( $partyYear < $currentYear){
                    ?>           
                    <div class="year-break">
                        <?php echo $partyYear; ?>
                    </div>
                    <?php            
                            $currentYear = $partyYear;
                        }                
                    ?>
                    <?php if($party->device_count < 1){ $nodata++; ?>
                    <a class="no-data-wrap party" href="/party/manage/<?php echo $party->idevents; ?>" <?php echo ($nodata == 1 ? 'id="attention"' : ''); ?>>
                        
                        <div class="header-col header-col-2">
                            <div class="date">
                                <span class="month"><?php echo strftime('%b', $party->event_timestamp); ?></span>
                                <span class="day">  <?php echo strftime('%d', $party->event_timestamp); ?></span>
                                <span class="year"> <?php echo strftime('%Y', $party->event_timestamp); ?></span>
                            </div>
                       
                            <div class="short-body">                        
                                <span class="location"><?php echo $party->venue; ?></span>
                                <time datetime="<?php echo dbDate($party->event_date); ?>"><?php echo substr($party->start, 0, -3); ?></time>
                            </div>                    
                        </div>
                        
                        <div class="header-col header-col-3">
                            <button class="btn btn-primary btn-lg add-info-btn">
                                <i class="fa fa-cloud-upload"></i> Add Information
                            </button>
                        </div>
                        <div class="header-col">
                            <span class="largetext greyed">?</span>
                        </div>
                        
                        <div class="header-col">
                            <span class="largetext greyed">?</span>
                        </div>
                        
                        <div class="header-col">
                            <span class="largetext greyed">?</span>
                        </div>
                        
                    </a>
                    <?php } else {  ?>
                    <a class="party"  href="/party/manage/<?php echo $party->idevents; ?>">
                        <div class="header-col header-col-2">
                            <div class="date">
                                <span class="month"><?php echo date('M', $party->event_timestamp); ?></span>
                                <span class="day">  <?php echo date('d', $party->event_timestamp); ?></span>
                                <span class="year"> <?php echo date('Y', $party->event_timestamp); ?></span>
                            </div>
                            
                             <div class="short-body">
                                <span class="location"><?php echo $party->venue; ?></span>
                                <time datetime="<?php echo dbDate($party->event_date); ?>"><?php echo  substr($party->start, 0, -3); ?></time>
                            </div>
                        </div>
                        
                        
                        <div class="header-col">
                            <span class="largetext">
                                <?php echo $party->pax; ?> 
                            </span>
                        </div>
                        
                        <div class="header-col">
                            <span class="largetext">
                                <?php echo $party->volunteers; ?>
                            </span>
                        </div>
                        
                        <div class="header-col">
                            <span class="largetext">
                                 <?php echo $party->co2; ?> kg
                            </span>
                        </div>
                        
                        <div class="header-col">
                            <span class="largetext fixed">
                                <?php echo $party->fixed_devices; ?>
                            </span>
                        </div>
                        
                        <div class="header-col">
                            <span class="largetext repairable">
                                <?php echo $party->repairable_devices; ?> 
                            </span>
                        </div>
                        
                        <div class="header-col">
                            <span class="largetext dead">
                                <?php echo $party->dead_devices; ?> 
                            </span>
                        </div>
                        
                    </a>
                    <?php } ?>
                <?php } ?>
                </div>
                
            </section>
        
        
        </div>
        
        <div role="tabpanel" class="tab-pane" id="impact-tab">
        
            <section class="row" id="impact-header">
                <div class="col-sm-12 text-center">
                    <img src="/uploads/mid_<?php echo $group->path; ?>" class="img-circle impact-avatar" width="180" />
                    <h2><?php echo $group->name; ?></h2>
                    
                    <p class="big">                        
                        <span class="big blue"><?php echo $pax; ?> participants</span> aided by <span class="big blue"><?php echo $hours; ?> hours of volunteered time</span> worked on <span class="big blue"><?php echo ($group_device_count_status[0]->counter + $group_device_count_status[1]->counter + $group_device_count_status[2]->counter) ?> devices.</span>
                    </p> 
                    
                </div>
            </section>
            
            <section class="row" id="impact-devices">
                <div class="col-md-6 col-md-offset-3  text-center">
                    <div class="impact-devices-1">
                        <img src="/assets/icons/impact_device_1.jpg" class="">
                        <span class="title"><?php echo $group_device_count_status[0]->counter;?></span>
                        <span class="legend">were fixed</span>
                    </div>
                    
                    <div class="impact-devices-2">
                        <img src="/assets/icons/impact_device_2.jpg" class="">
                        <span class="title"><?php echo $group_device_count_status[1]->counter;?></span>
                        <span class="legend">were still repairable</span>
                    </div>
                    
                    <div class="impact-devices-3">
                        <img src="/assets/icons/impact_device_3.jpg" class="">
                        <span class="title"><?php echo $group_device_count_status[2]->counter;?></span>
                        <span class="legend">were dead</span>
                    </div>
                    
                </div>
                <div class="col-md-12">
                    <h2><span class="title-text">Most Repaired Devices</span></h2>
                    
                    <div class="row">
                        <div class="col-md-4"><div class="topper  text-center"><?php echo $top[0]->name . ' [' . $top[0]->counter . ']'; ?></div></div>
                        <div class="col-md-4"><div class="topper  text-center"><?php echo $top[1]->name . ' [' . $top[1]->counter . ']'; ?></div></div>
                        <div class="col-md-4"><div class="topper  text-center"><?php echo $top[2]->name . ' [' . $top[2]->counter . ']'; ?></div></div>
                    </div>
                </div>
                
            </section>
        
            <section class="row" id="impact-dataviz">                    
                <div class="col-md-12 text-center texter">
                    <?php
                        $sum = 0;
                        foreach($waste_year_data as $y){
                            $sum += $y->waste;
                        }
                    ?>
                    <span class="datalabel">Total waste prevented: </span><span class="blue">  <?php echo number_format(round($sum), 0, '.', ','); ?> kg </span>
                    
                </div>
                <div class="col-md-12 text-center texter">
                    <?php
                        $sum = 0;
                        foreach($year_data as $y){
                            $sum += $y->co2;
                        }
                        //$di_co2 = number_format(round($sum), 0, '.', ',');
                    ?>
                    <span class="datalabel">Total CO<sub>2</sub> emission prevented: </span><span class="blue"><?php echo number_format(round($sum), 0, '.', ','); ?> kg</span>
                    
                </div>
                <div class="col-md-12">
                    <?php
                    /** find size of needed SVGs **/
                    if($sum > 6000) { 
                        $consume_class = 'car';
                        $consume_image = 'Counters_C2_Driving.svg';
                        $consume_label = 'Equal to driving';
                        $consume_eql_to = 0.12 * $sum;
                        $consume_eql_to = number_format(round($consume_eql_to), 0, '.', ',') . '<small>km</small>';
                        
                        $manufacture_eql_to = round($sum / 6000);
                        $manufacture_img = 'Icons_04_Assembly_Line.svg';
                        $manufacture_label = 'or like the manufacture of <span class="dark">' . $manufacture_eql_to . '</span> cars';
                        $manufacture_legend = ' 6000kg of CO<sub>2</sub>';
                    }
                    else {
                        $consume_class = 'tv';
                        $consume_image = 'Counters_C1_TV.svg';
                        $consume_label = 'Like watching TV for';
                        $consume_eql_to = 0.024 * $sum;
                        $consume_eql_to = number_format(round($consume_eql_to), 0, '.', ',') . '<small>hours</small>';
                        
                        $manufacture_eql_to = round($sum / 100);
                        $manufacture_img = 'Icons_03_Sofa.svg';
                        $manufacture_label = 'or like the manufacture of <span class="dark">' . $manufacture_eql_to . '</span> sofas';
                        $manufacture_legend = ' 100kg of CO<sub>2</sub>';
                    }
                    ?>
                    
                    <div class="di_consume <?php echo $consume_class; ?>">
                        <img src="/assets/icons/<?php echo $consume_image; ?>" class="img-responsive">
                        <div class="text">
                            <div class="blue"><?php echo $consume_label; ?></div>
                            <div class="consume"><?php echo $consume_eql_to; ?></div>
                        </div>
                    </div>
                
                    <div class="di_manufacture">
                        <div class="col-md-12 text-center"><div class="lightblue"><?php echo $manufacture_label; ?></div></div>
                        <?php for($i = 1; $i<= $manufacture_eql_to; $i++){ ?>
                            <div class="col-md-3 text-center">
                                <img src="/assets/icons/<?php echo $manufacture_img; ?>" class="img-responsive">
                            </div>
                        <?php } ?>
                        <div class="col-md-12 text-center">
                            <div class="legend">1 <img src="/assets/icons/<?php echo $manufacture_img; ?>"> = <?php echo $manufacture_legend; ?> (approximately)</div>
                            
                        </div>
                    </div>
                    
                    
                </div>
                
            </section>
        
        
        </div>
        
        <div role="tabpanel" class="tab-pane" id="details-tab">
            <!-- Group Achievements -->
            <!--<section class="row">
            <div class="col-md-12">
                <h2>
                       <span class="title-text">Group Achievements</span>                     
                    </h2>
            </div>
            </section>-->
            
            <!-- CO2 stats -->
            <section class="row">
            <div class="col-md-12">
                <h3>Impact</h3>
            </div>
            
            <div class="col-md-4">
                <h5 class="text-center">e-Waste Prevented to date</h5> 
                <?php
                    $sum = 0;
                    foreach($waste_year_data as $y){
                        $sum += $y->waste;
                    }
                ?>
                <span class="largetext">
                    <?php echo number_format(round($sum), 0, '.', ','); ?> kg 
                </span>
                <span class="subtext">Total: <?php echo number_format(round($wasteTotal), 0, '.', ','); ?></span>
                <hr />
                
                <h5 class="text-center">e-Waste prevented this year</h5> 
                <?php
                    
                    foreach($waste_year_data as $y){
                        if($y->year == date('Y', time())) {
                ?>
                <span class="largetext">
                    <?php echo number_format(round($y->waste), 0, '.', ','); ?> kg 
                </span>
                <span class="subtext">Total: <?php echo number_format(round($wasteThisYear), 0, '.', ','); ?></span>
                <?php 
                        }
                    }
                ?>
                
            </div>
            
            <div class="col-md-4">
                <h5 class="text-center">CO<sub>2</sub> emission prevented to date</h5> 
                <?php
                    $sum = 0;
                    foreach($year_data as $y){
                        $sum += $y->co2;
                    }
                ?>
                <span class="largetext">
                    <?php echo number_format(round($sum), 0, '.', ','); ?> kg of CO<sub>2</sub> 
                </span>
                <span class="subtext">Total: <?php echo number_format(round($co2Total), 0, '.', ','); ?></span>
                
                <hr />
                
                <h5 class="text-center">CO<sub>2</sub> emission prevented this year</h5> 
                <?php
                    
                    foreach($year_data as $y){
                        if($y->year == date('Y', time())) {
                ?>
                <span class="largetext">
                    <?php echo number_format(round($y->co2), 0, '.', ','); ?> kg of CO<sub>2</sub> 
                </span>
                <span class="subtext">Total: <?php echo number_format(round($co2ThisYear), 0, '.', ','); ?></span>
                <?php 
                        }
                    }
                ?>
                
            </div>
            <div class="col-md-4">
                <div id="chart-co2" class="charts">
                    <h4 class="text-center">CO<sub>2</sub> emission prevented per year (kg)</h4>
                    <canvas id="co2ByYear" width="450" height="250"></canvas>                
                </div>
                <div id="chart-waste" class="charts">
                    <h4 class="text-center">eWaste prevented per year (kg)</h4>
                    <canvas id="wasteByYear" width="450" height="250"></canvas>
                </div>
                
                <div class="btn-group btn-group-justified" role="group" aria-label="...">
                    <div class="btn-group">
                        <button type="button" class="btn btn-default btn-primary btn-sm switch-view active" data-family=".charts" data-target="#chart-co2">CO<sub>2</sub> emission prevented</button>
                    </div>
                    <div class="btn-group">
                        <button type="button" class="btn btn-default btn-primary btn-sm switch-view" data-family=".charts" data-target="#chart-waste">eWaste prevented</button>            
                    </div>
                </div>
                <script>
                    var data_co2 = {
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
                    
                    var data_waste = {
                        labels: ["<?php echo implode('", "', array_keys($waste_bar_chart_stats)); ?>"],
                        datasets: [
                            {
                            label: "Waste By Year",
                            fillColor: "rgba(249,163, 63,0.5)",
                            strokeColor: "rgba(249,163, 63,0.8)",
                            highlightFill: "rgba(249,163, 63,0.75)",
                            highlightStroke: "rgba(249,163, 63,1)",
                            data: [<?php echo implode(', ', $waste_bar_chart_stats); ?>]
                            }
                        ]
                            
                    }
                    var opts = {
                        barValueSpacing : 20   
                    };
                    var ctx1 = document.getElementById("co2ByYear").getContext("2d");
                    var ctx2 = document.getElementById("wasteByYear").getContext("2d");
                    var theChart1 = new Chart(ctx1).Bar(data_co2, opts);
                    var theChart2 = new Chart(ctx2).Bar(data_waste, opts);
               </script>
                
            </div>
            
            </section>
            
            <hr />
            
            
            <section class="row">
            <!-- Device count -->
            
            <div class="col-md-12">
                <h3>Devices Restarted</h3>
                <div class="row">
                    <div class="col-md-4 count">
                        <div class="col">
                            <img src="/assets/icons/fixed_circle.jpg">
                        </div>
                        <div class="col">
                            <span class="status_title">Fixed</span>
                            <span class="largetext fixed">
                                <?php echo $group_device_count_status[0]->counter; ?>
                            </span>
                            <span class="subtext textblue">total: <?php echo $device_count_status[0]->counter; ?></span>
                        </div>
                    </div>
                    
                    <div class="col-md-4 count">
                        <div class="col repairable">
                            <img src="/assets/icons/repairable_circle.jpg">
                        </div>
                        <div class="col">
                            <span class="status_title">Repairable</span>
                            <span class="largetext repairable">
                                <?php echo $group_device_count_status[1]->counter; ?>
                            </span>
                            <span class="subtext textblue">total: <?php echo $device_count_status[1]->counter; ?></span>
                        </div>
                    </div>
                    
                    
                    <div class="col-md-4 count">
                        <div class="col dead">
                            <img src="/assets/icons/dead_circle.jpg">
                        </div>
                        <div class="col">
                            <span class="status_title">Dead</span>
                            <span class="largetext dead">
                                <?php echo $group_device_count_status[2]->counter; ?>
                            </span>
                            <span class="subtext textblue">total: <?php echo $device_count_status[2]->counter; ?></span>
                        </div>
                    </div>
                </div>
            </div>        
            </section>    
            <hr />    
            
            
            
            
            <!-- category details -->
            <section class="row">
            <div class="col-md-12">
                <h3>Category Details</h3>
            </div>
            
            <div class="row">
                <div class="col-md-2">&nbsp;</div>
                <div class="col-md-4">
                    <div class="col3">
                        <img src="/assets/icons/icon_fixed.png" title="fixed items" alt="Fixed Items icon">
                        <span class="subtext">fixed</span>
                    </div>
                    <div class="col3 no-brd">
                        <img src="/assets/icons/icon_repairable.png" title="repairable items" alt="repairable Items icon">
                        <span class="subtext">repairable</span>
                    </div>
                    <div class="col3">
                        <img src="/assets/icons/icon_dead.png" title="dead items" alt="dead Items icon">
                        <span class="subtext">dead</span>
                    </div>
                </div>
                
            </div>
            <div class="row">
                <div class="col-md-2  text-center">
                    <i class="cluster big cluster-1"></i>                
                </div>
                <div class="col-md-4">
                    <div class="col3">
                        <span class="largetext fixed"><?php echo $clusters['all'][1][0]->counter; ?></span>
                    </div>
                    <div class="col3">
                        
                        <span class="largetext repairable"><?php echo $clusters['all'][1][1]->counter; ?></span>
                    </div>
                    <div class="col3">
                        
                        <span class="largetext dead"><?php echo $clusters['all'][1][2]->counter; ?></span>
                    </div>
                </div>
                <div class="col-md-6">
                    
                    <div class="category-detail">
                        <table cellspacing="0">
                            <thead>
                                <tr>
                                    <th colspan="3">
                                        Computers and Home Office
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td class="table-label">Most seen:</td>
                                    <td class="table-data"><?php echo $mostleast[1]['most_seen'][0]->name; ?></td>
                                    <td class="table-count"><?php echo $mostleast[1]['most_seen'][0]->counter; ?></td>
                                </tr>
                                <tr>
                                    <td class="table-label">Most repaired:</td>
                                    <td class="table-data"><?php echo $mostleast[1]['most_repaired'][0]->name; ?></td>
                                    <td class="table-count"><?php echo $mostleast[1]['most_repaired'][0]->counter; ?></td>
                                </tr>
                                <tr>
                                    <td class="table-label">Least repaired:</td>
                                    <td class="table-data"><?php echo $mostleast[1]['least_repaired'][0]->name; ?></td>
                                    <td class="table-count"><?php echo $mostleast[1]['least_repaired'][0]->counter; ?></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    
                    
                </div>
            </div>
            
            
            <div class="row">
                <div class="col-md-2  text-center">
                    <i class="cluster big cluster-2"></i>
                    
                </div>
                <div class="col-md-4">
                    <div class="col3">
                        
                        <span class="largetext fixed"><?php echo $clusters['all'][2][0]->counter; ?></span>
                    </div>
                    <div class="col3">
                        
                        <span class="largetext repairable"><?php echo $clusters['all'][2][1]->counter; ?></span>
                    </div>
                    <div class="col3">
                        
                        <span class="largetext dead"><?php echo $clusters['all'][2][2]->counter; ?></span>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="category-detail">
                        <table cellspacing="0">
                            <thead>
                                <tr>
                                    <th colspan="3">
                                        Electronic Gadgets
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td class="table-label">Most seen:</td>
                                    <td class="table-data"><?php echo $mostleast[2]['most_seen'][0]->name; ?></td>
                                    <td class="table-count"><?php echo $mostleast[2]['most_seen'][0]->counter; ?></td>
                                </tr>
                                <tr>
                                    <td class="table-label">Most repaired:</td>
                                    <td class="table-data"><?php echo $mostleast[2]['most_repaired'][0]->name; ?></td>
                                    <td class="table-count"><?php echo $mostleast[2]['most_repaired'][0]->counter; ?></td>
                                </tr>
                                <tr>
                                    <td class="table-label">Least repaired:</td>
                                    <td class="table-data"><?php echo $mostleast[2]['least_repaired'][0]->name; ?></td>
                                    <td class="table-count"><?php echo $mostleast[2]['least_repaired'][0]->counter; ?></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    
                    
                </div>
            </div>
            
            <div class="row">
                <div class="col-md-2  text-center">
                    <i class="cluster big cluster-3"></i>
                    
                </div>
                <div class="col-md-4">
                    <div class="col3">
                        
                        <span class="largetext fixed"><?php echo $clusters['all'][3][0]->counter; ?></span>
                    </div>
                    <div class="col3">
                        
                        <span class="largetext repairable"><?php echo $clusters['all'][3][1]->counter; ?></span>
                    </div>
                    <div class="col3">
                        
                        <span class="largetext dead"><?php echo $clusters['all'][3][2]->counter; ?></span>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="category-detail">
                        <table cellspacing="0">
                            <thead>
                                <tr>
                                    <th colspan="3">
                                        Home Entertainment
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td class="table-label">Most seen:</td>
                                    <td class="table-data"><?php echo $mostleast[3]['most_seen'][0]->name; ?></td>
                                    <td class="table-count"><?php echo $mostleast[3]['most_seen'][0]->counter; ?></td>
                                </tr>
                                <tr>
                                    <td class="table-label">Most repaired:</td>
                                    <td class="table-data"><?php echo $mostleast[3]['most_repaired'][0]->name; ?></td>
                                    <td class="table-count"><?php echo $mostleast[3]['most_repaired'][0]->counter; ?></td>
                                </tr>
                                <tr>
                                    <td class="table-label">Least repaired:</td>
                                    <td class="table-data"><?php echo $mostleast[3]['least_repaired'][0]->name; ?></td>
                                    <td class="table-count"><?php echo $mostleast[3]['least_repaired'][0]->counter; ?></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    
                </div>
            </div>
            <div class="row">
                <div class="col-md-2 text-center">
                    <i class="cluster big cluster-4"></i>
                    
                </div>
                <div class="col-md-4">
                    <div class="col3">
                        
                        <span class="largetext fixed"><?php echo $clusters['all'][4][0]->counter; ?></span>
                    </div>
                    <div class="col3">
                        
                        <span class="largetext repairable"><?php echo $clusters['all'][4][1]->counter; ?></span>
                    </div>
                    <div class="col3">
                        
                        <span class="largetext dead"><?php echo $clusters['all'][4][2]->counter; ?></span>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="category-detail">
                        <table cellspacing="0">
                            <table cellspacing="0">
                            <thead>
                                <tr>
                                    <th colspan="3">
                                        Kitchen and Household Items
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td class="table-label">Most seen:</td>
                                    <td class="table-data"><?php echo $mostleast[4]['most_seen'][0]->name; ?></td>
                                    <td class="table-count"><?php echo $mostleast[4]['most_seen'][0]->counter; ?></td>
                                </tr>
                                <tr>
                                    <td class="table-label">Most repaired:</td>
                                    <td class="table-data"><?php echo $mostleast[4]['most_repaired'][0]->name; ?></td>
                                    <td class="table-count"><?php echo $mostleast[4]['most_repaired'][0]->counter; ?></td>
                                </tr>
                                <tr>
                                    <td class="table-label">Least repaired:</td>
                                    <td class="table-data"><?php echo $mostleast[4]['least_repaired'][0]->name; ?></td>
                                    <td class="table-count"><?php echo $mostleast[4]['least_repaired'][0]->counter; ?></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    
                </div>
            </div>
            
            
            </section>
            
            
            <!--categories-->
            <section class="row">
            <div class="col-md-12">
                <h3>Devices Restarted per Category</h3>            
            </div>
            <?php
            //dbga($clusters);
            $c = 1;
            foreach($clusters as $key => $cluster){ ?>
            <div class="col-md-10 <?php echo($c == 1 ? 'show' : 'hide'); ?> bargroup" id="<?php echo $key; ?>">
            
                <div class="row">
                    <div class="col-md-2">
                        <span class="cluster big cluster-1"></span>
                    </div>
                    <div class="col-md-4">
                        <div class="barpiece fixed" style="width :<?php echo round((($cluster[1][0]->counter / $cluster[1]['total']) * 100) , 4); ?>%">&nbsp;</div><div class="barpiece-label fixed"><?php echo round((($cluster[1][0]->counter / $cluster[1]['total']) * 100) , 2); ?>%</div>
                        <div class="barpiece repairable" style="width :<?php echo round((($cluster[1][1]->counter / $cluster[1]['total']) * 100) , 4); ?>%">&nbsp;</div><div class="barpiece-label repairable"><?php echo round((($cluster[1][1]->counter / $cluster[1]['total']) * 100) , 2); ?>%</div>
                        <div class="barpiece end-of-life" style="width :<?php echo round((($cluster[1][2]->counter / $cluster[1]['total']) * 100) , 4); ?>%">&nbsp;</div><div class="barpiece-label dead"><?php echo round((($cluster[1][2]->counter / $cluster[1]['total']) * 100) , 2); ?>%</div>
                    </div>
                    
                
                    <div class="col-md-2">
                        <span class="cluster big cluster-2"></span>
                    </div>
                    <div class="col-md-4">
                        <div class="barpiece fixed" style="width :<?php echo round((($cluster[2][0]->counter / $cluster[2]['total']) * 100) , 4); ?>%">&nbsp;</div><div class="barpiece-label fixed"><?php echo round((($cluster[2][0]->counter / $cluster[2]['total']) * 100) , 2); ?>%</div>
                        <div class="barpiece repairable" style="width :<?php echo round((($cluster[2][1]->counter / $cluster[2]['total']) * 100) , 4); ?>%">&nbsp;</div><div class="barpiece-label repairable"><?php echo round((($cluster[2][1]->counter / $cluster[2]['total']) * 100) , 2); ?>%</div>
                        <div class="barpiece end-of-life" style="width :<?php echo round((($cluster[2][2]->counter / $cluster[2]['total']) * 100) , 4); ?>%">&nbsp;</div><div class="barpiece-label dead"><?php echo round((($cluster[2][2]->counter / $cluster[2]['total']) * 100) , 2); ?>%</div>
                    </div>
                    
                </div>
                          
                <div class="row">
                    <div class="col-md-2">
                        <span class="cluster big cluster-3"></span>
                    </div>
                    <div class="col-md-4">
                        <div class="barpiece fixed" style="width :<?php echo round((($cluster[3][0]->counter / $cluster[3]['total']) * 100) , 4); ?>%">&nbsp;</div><div class="barpiece-label fixed"><?php echo round((($cluster[3][0]->counter / $cluster[3]['total']) * 100) , 2); ?>%</div>
                        <div class="barpiece repairable" style="width :<?php echo round((($cluster[3][1]->counter / $cluster[3]['total']) * 100) , 4); ?>%">&nbsp;</div><div class="barpiece-label repairable"><?php echo round((($cluster[3][1]->counter / $cluster[3]['total']) * 100) , 2); ?>%</div>
                        <div class="barpiece end-of-life" style="width :<?php echo round((($cluster[3][2]->counter / $cluster[3]['total']) * 100) , 4); ?>%">&nbsp;</div><div class="barpiece-label dead"><?php echo round((($cluster[3][2]->counter / $cluster[3]['total']) * 100) , 2); ?>%</div>
                    </div>
                    
               
                    <div class="col-md-2">
                        <span class="cluster big cluster-4"></span>
                    </div>
                    <div class="col-md-4">
                        <div class="barpiece fixed" style="width :<?php echo round((($cluster[4][0]->counter / $cluster[4]['total']) * 100) , 4); ?>%">&nbsp;</div><div class="barpiece-label fixed"><?php echo round((($cluster[4][0]->counter / $cluster[4]['total']) * 100) , 2); ?>%</div>
                        <div class="barpiece repairable" style="width :<?php echo round((($cluster[4][1]->counter / $cluster[4]['total']) * 100) , 4); ?>%">&nbsp;</div><div class="barpiece-label repairable"><?php echo round((($cluster[4][1]->counter / $cluster[4]['total']) * 100) , 2); ?>%</div>
                        <div class="barpiece end-of-life" style="width :<?php echo round((($cluster[4][2]->counter / $cluster[4]['total']) * 100) , 4); ?>%">&nbsp;</div><div class="barpiece-label dead"><?php echo round((($cluster[4][2]->counter / $cluster[4]['total']) * 100) , 2); ?>%</div>
                    </div>
                    
                    
                </div>
                
                
            </div>
            <?php
                $c++;
            }
            ?>
            
            <div class="col-md-2">
                <div class=" barpiece-tabs">
                    <ul>
                    <?php
                    $c = 1;
                    foreach($clusters as $key => $cluster){
                    ?>
                        <li><button class="btn btn-primary btn-sm <?php echo($c == 1 ? 'active' : ''); ?> switch-view" data-family=".bargroup" data-target="#<?php echo $key; ?>"><?php echo strtoupper($key); ?></button></li>
                    <?php
                    $c++;
                    }
                    ?>
                        
            
                    </ul>
                </div>
            
            </div>
            </section>
            
            
            
            
            
        </div>
        
    </div>
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    <!-- EOF Tabs -->
    
    <br />
    <br />
    <br />
    <br />

</div>