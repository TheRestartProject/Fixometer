<div class="container-fluid" id="profile-page">
    <div class="row header">
        
        <div class="container">
            <div class="row">
                <div class="col-md-3">
                    <img src="/uploads/mid_<?php echo $profile->path; ?>" class="img-responsive profile-image">
                </div>
                
                
                
                <div class="col-md-6">
                    <div class="row">
                        <div class="col-md-4 stat">
                            <span class="stat-label">groups participating in</span>
                            <span class="stat-value"><?php echo count($groups); ?></span>
                        </div>
                        <div class="col-md-4 stat">
                            <span class="stat-label">parties attended</span>
                            <span class="stat-value"><?php echo count($parties); ?></span>
                        </div>
                        <div class="col-md-4 stat">
                            <span class="stat-label">devices restarted</span>
                            <span class="stat-value"><?php echo count($devices); ?></span>
                        </div>
                    </div>
                    <h1><?php echo $profile->name; ?></h1>
                </div>
                
                <div class="col-md-3">
                    <div class="badge toaster"><img src="/assets/icons/toaster.png" alt="Toaster Master"></div>
                    <div class="badge computer"><img src="/assets/icons/lightbulb.png" alt="Ideas! Ideas Everywhere!"></div>
                    <div class="badge screen"><img src="/assets/icons/photo.png" alt="Camera Wondera"></div>
                    <div class="badge over-10"><img src="/assets/icons/flag.png" alt="10+ Restart Parties Attended"></div>
                </div>
            </div>
            
        </div>
    
    </div>
    <div class="row">
        <div class="container">
            <div class="row">
                <div class="col-md-3">
                    Parties Attended?
                </div>
                
                <div class="col-md-6">
                    Some sort of Graph?
                </div>
                
                <div class="col-md-3">
                    latest device(s) fixed
                    
                </div>
            </div>
            
            
        </div>
    </div>
</div>