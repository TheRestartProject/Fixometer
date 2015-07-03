<div class="container">
    <div class="row host-header">
        <div class="col-md-1">
            <a href="/host">
                <img class="img-responsive" alt="The Restart Project: Logo" src="/assets/images/logo_mini.png">
            </a>
        </div>
        <div class="col-md-8">
            <span class="">Welcome to the Fixometer, <strong><?php echo $user->name; ?></strong></span><br />
            <span class="">You have <span class="label label-success"><?php echo count($upcomingparties); ?></span> upcoming <?php echo (count($upcomingparties) == 1 ? 'party' : 'parties'); ?>.
            <span class="label label-danger"><?php echo $need_attention; ?></span> <?php echo ($need_attention == 1 ? 'party needs' : 'parties need'); ?> your attention.</span>
        </div>        
    </div>
    
</div>