<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            <h1><?php echo $title; ?></h1>
            
           
            
            
            <table class="table table-hover table-responsive sortable">
                <thead>
                    <tr>
                        
                        <th>ID</th>
                        <th>Name</th>
                        <th>Weight</th>
                        <th>CO<sub>2</sub> Footprint</th>
                        <th>Reliability</th>
                        
                    </tr>
                </thead>
                
                <tbody>
                    <?php foreach($list as $p){ ?>
                    <tr>
                        <td><?php echo $p->idcategories; ?></td>
                        <td><?php echo $p->name; ?></td>
                        <td><?php echo $p->weight; ?></td>
                        <td><?php echo $p->footprint; ?></td>
                        <td width="25"><span class="indicator indicator-<?php echo $p->footprint_reliability; ?>"><?php echo $p->footprint_reliability; ?></span></td>
                        
                    </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div> 
    </div>
</div>