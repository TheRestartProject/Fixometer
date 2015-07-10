
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <h1>Edit Party</h1>
        </div>
    </div>
    
    <div class="row">
        <div class="col-md-12">
            <?php if(isset($response)) { printResponse($response); } ?>
            
            <form action="/party/manage/<?php echo $party[0]->idevents; ?>" method="post" id="party-edit">

            <div class="row">
                
            </div>
           
            <!-- devices -->
            <div class="row">
                <div class="col-md-12">
                    <h3>Devices</h3>
                </div>
                
                
                    <ol class="col-md-12">
                    <?php for ($i = 1; $i < 13 ; $i++) { ?>
                    <li class="row">
                        <div class="col-md-2">
                            <div class="form-group">
                                
                                
                                
                                <select id="device-<?php echo $i; ?>[category]" name="device-<?php echo $i; ?>[category]" class="selectpicker form-control" data-live-search="true">
                                    <?php foreach($categories as $cluster){ ?>
                                    <optgroup label="<?php echo $cluster->name; ?>">
                                        <?php foreach($cluster->categories as $c){ ?>
                                        <option value="<?php echo $c->idcategories; ?>"><?php echo $c->name; ?></option>
                                        <?php } ?>
                                    </optgroup>
                                    <?php } ?>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-2">device name</div>
                        <div class="col-md-2">problem</div>
                        <div class="col-md-2">repair status</div>
                        <div class="col-md-2">spare</div>
                        <div class="col-md-2">restarter</div>
                    </li>
                    <?php } ?>
                    </ol>
                
            </div>
<?php
    
    dbga($party);
    
    dbga($devices);
    
    dbga($categories);
    
?>

            </form>
        </div>
    </div>
</div>
