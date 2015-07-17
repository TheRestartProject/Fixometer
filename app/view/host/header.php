<div class="container">
    <div class="row host-header">
        
        <div class="col-md-1">
            <a href="/host">
                <img class="img-responsive" alt="The Restart Project: Logo" src="/assets/images/logo_mini.png">
            </a>
        </div>
        
        <div class="col-md-8">
            <span class="">Welcome to the Fixometer, <strong><?php echo $user->name; ?></strong></span><br />
            
            <?php if ($showbadges) { ?> 
                <span class="">You have <span class="label label-success"><?php echo count($upcomingparties); ?></span> upcoming <?php echo (count($upcomingparties) == 1 ? 'party' : 'parties'); ?>.
                <?php if ($need_attention > 0) { ?>
                    <span class="label label-danger"><?php echo $need_attention; ?></span> <?php echo ($need_attention == 1 ? 'party needs' : 'parties need'); ?> your attention.</span>
                <?php } ?>
            <?php  } ?>
        </div>
        
        <div class="col-md-1 col-md-offset-2">
            <a class="btn btn-primary btn-sm" href="/user/logout"><i class="fa fa-sign-out"></i> Logout</a>
        </div>
    </div>
    
</div>