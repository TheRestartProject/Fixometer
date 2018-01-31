<div class="row">

    <div class="col-xs-4 col-sm-2 stat">
        <div class="row">
            <div class="col-sm-6" style="height:80px">
                <i class="fa fa-group"></i>
                <span class="subtext">participants</span>
            </div>
            <div class="col-sm-6 vcenter">
                <?php echo $party->pax; ?>
            </div>
        </div>
    </div>

    <div class="col-xs-4 col-sm-2 stat">
        <div class="row">
            <div class="col-sm-6">
                <img class="" alt="The Restart Project: Logo" src="/assets/images/logo_mini.png">
                <span class="subtext">restarters</span>
            </div>
            <div class="col-sm-6 vcenter">
                <?php echo $party->volunteers; ?>
            </div>
        </div>
    </div>

    <div class="col-xs-4 col-sm-2 stat">
        <div class="footprint">
            <span id="co2-diverted-value"><?php echo $party->co2; ?></span>
            <span class="subtext">kg of CO<sub>2</sub></span>
            <br />
            <span id="ewaste-diverted-value"><?php echo number_format($party->ewaste, 0); ?></span>
            <span class="subtext">kg of waste</span>
        </div>
    </div>

    <div class="col-xs-4 col-sm-2 stat">
        <div class="row">
            <div class="col-sm-6"><i class="status mid fixed"></i></div>
            <div class="col-sm-6 vcenter">
                <?php echo $party->fixed_devices; ?>
            </div>
        </div>
    </div>

    <div class="col-xs-4 col-sm-2 stat">
        <div class="row">
            <div class="col-sm-6"><i class="status mid repairable"></i></div>
            <div class="col-sm-6 vcenter">
                <?php echo $party->repairable_devices; ?>
            </div>
        </div>
    </div>

    <div class="col-xs-4 col-sm-2 stat">
        <div class="row">
            <div class="col-sm-6"><i class="status mid dead"></i></div>
            <div class="col-sm-6 vcenter">
                <?php echo $party->dead_devices; ?>
            </div>
        </div>
    </div>

</div>
