<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            <h1><?php echo $title; ?></h1>
            <a class="btn btn-primary" href="/group/create"><i class="fa fa-plus"></i> New Group</a>
            <table class="table table-hover table-responsive sortable">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Group</th>
                        <th>Location</th>
                        <th>Frequency</th>
                        <th>Restarters</th>
                    </tr>
                </thead>
                
                <tbody>
                    <?php foreach($list as $g){ ?>
                    <tr>
                        <td><?php echo $g->id; ?></td>
                        <td><a href="/group/edit/<?php echo $g->id; ?>" title="edit group"><?php echo $g->name; ?></a></td>
                        <td><?php echo $g->location . ', ' . $g->area; ?></td>
                        <td><?php echo $g->frequency; ?> Parties/Year</td>
                        <td><?php echo $g->user_list; ?></td>
                    </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div> 
    </div>
</div>