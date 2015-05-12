<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            <h1><?php echo $title; ?></h1>
            <a class="btn btn-primary" href="/party/create"><i class="fa fa-plus"></i> New Party</a>
            <table class="table table-hover table-responsive">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Group (Host)</th>
                        <th>Location</th>
                        <th>Start</th>
                        <th>End</th>
                        <th>Pax</th>
                    </tr>
                </thead>
                
                <tbody>
                    <?php foreach($list as $p){ ?>
                    <tr>
                        <td><?php echo $p->id; ?></td>
                        <td>
                            <?php
                            if(hasRole($user, 'Administrator') || hasRole($user, 'Host') || $user->group == $g->id) {
                            ?>
                            <a href="/party/edit/<?php echo $p->id; ?>" title="edit group"><?php echo $p->group_name . ' (' . $p->host_name . ')'; ?></a>
                            <?php
                            } else {
                            ?>
                            <?php echo $p->group_name . ' (' . $p->host_name . ')'; ?>
                            <?php } ?>    
                        </td>
                        <td><?php echo $p->location; ?></td>
                        
                        <td><?php echo dateFormat($p->start); ?></td>
                        <td><?php echo dateFormat($p->end); ?></td>
                        
                        <td><?php echo $p->pax; ?></td>
                        
                    </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div> 
    </div>
</div>