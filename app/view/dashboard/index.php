<div class="container-fluid" id="dashboard">
    <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-12">
            <h1>Welcome, <span class="orange"><?php echo $user->name; ?></span></h2>
            
        </div>
        
        
    </div>
    
    <div class="row">
        <div class="col-md-5">
            <div class="party-opt-in dbObject">
                <h3>Upcoming Parties!</h3>
                <ul>
                    <?php foreach($upcomingParties as $e){ ?> 
                    <li class="clearfix">
                        <time><?php echo dateFormatNoTime($e->event_date) . ' - FROM ' . $e->start . ' TO ' . $e->end; ?> </time>
                        <a class="location" title="<?php echo $e->location; ?>" href="http://maps.google.com/?ie=UTF8&hq=&q=<?php echo $e->location; ?>&ll=<?php echo $e->latitude; ?>,<?php echo $e->longitude; ?>&z=14" target="_blank"><i class="fa fa-map-marker"></i> <?php echo $e->location; ?></a>
                        <a class="cta" id="restarter-opt-in" data-party="<?php echo $e->idevents; ?>" href="#">OPT-IN!</a>
                        <div class="map-wrap clearfix" id="party-map-<?php echo $e->idevents; ?>" height="250px" width="100%"></div>
                    </li>                    
                    <?php } ?>
                </ul>
                
            </div>
        </div>
        
        <div class="col-md-7"><div class="db-object">A Block Here</div></div>
        <div class="col-md-7"><div class="db-object">A Block Here</div></div>
    </div>
    
    <div class="row">
        <div class="col-md-2"><div class="db-object">A Block Here</div></div> 
        <div class="col-md-2"><div class="db-object">A Block Here</div></div>
        <div class="col-md-8"><div class="db-object">A Block Here</div></div>
    </div>
    
    <div class="row">
        <div class="col-md-4"><div class="db-object">A Block Here</div></div> 
        <div class="col-md-4"><div class="db-object">A Block Here</div></div>
        <div class="col-md-4"><div class="db-object">A Block Here</div></div>
    </div>
</div>