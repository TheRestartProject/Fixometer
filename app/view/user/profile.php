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
                    <div class="badge toaster"></div>
                    <div class="badge computer"></div>
                    <div class="badge screen"></div>
                    <div class="badge over-10"></div>
                </div>
            </div>
            
        </div>
    
    </div>
    <div class="row">
        <div class="container">
            <div class="row">
                <div class="col-md-6">
                    maps maybe?
                </div>
            
                <div class="col-md-6">
                    latest device fixed
                    
                </div>
            </div>
            
            
        </div>
    </div>
</div>