<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            <h1><?php echo $title; ?></h1>
            <a class="btn btn-primary" href="/device/create"><i class="fa fa-plus"></i> New Device</a>
            
            <div class="row">
                <div class="col-md-12">
                    <h2>Some Stats</h2>
                </div>
                <div class="col-md-4">
                    <p><strong>Total Waste Prevented (kg):</strong> <?php echo $stats['weights']; ?></p>
                    <p><strong>Total CO<sub>2</sub> Emission Prevented (kg):</strong> <?php echo $stats['footprints']; ?></p>
                </div>
                <div class="col-md-4">
                    Top 10 Item Types Fixed (and kg)
                    <?php
                    for($i = 0; $i<10; $i++){
                    ?>
                    <p><strong><?php echo $counts[$i]->catcount. ' ' . $counts[$i]->name; ?></strong> - [<?php echo $counts[$i]->catcount_weight; ?> kg]</p>
                    <?php
                    }
                    ?>
                </div>
            </div>
            <table class="table table-hover table-responsive sortable">
                <thead>
                    <tr>
                        
                        <th>ID</th>
                        <th>Category</th>
                        <th>Event (Group)</th>
                        <th>Event Date</th>
                        <th>Location</th>
                        <th>Restarter</th>
                        
                        <th class="status-header">Status</th>
                        
                        
                    </tr>
                </thead>
                
                <tbody>
                    <?php foreach($list as $device){ ?>
                    <tr>
                        <td><?php echo $device->id; ?></td>
                        <td><a href="/device/edit/<?php echo $device->id; ?>" title="edit device"><?php echo $device->category_name; ?></a></td>
                        <td><?php echo $device->group_name; ?></td>
                        <td data-dateformat="DD/MM/YYYY"><?php echo date('d/m/Y', $device->event_date); ?></td>
                        <td><?php echo $device->event_location; ?></td>
                        <td><?php echo $device->restarter; ?></td>
                        
                        <td><?php parseRepairStatus($device->repair_status); ?></td>
                        
                    </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div> 
    </div>
</div>