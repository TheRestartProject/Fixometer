<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            <h1><?php echo $title; ?></h1>
            <a class="btn btn-primary" href="/device/create"><i class="fa fa-plus"></i> New Device</a>


            <table class="table table-hover table-responsive bootg" id="devices-table">
                <thead>
                    <tr>
                        <th data-column-id="deviceID" data-identifier="true" data-type="numeric">ID</th>
                        <th data-column-id="category">Category</th>
                        <th data-column-id="groupName">Event (Group)</th>
                        <th data-column-id="eventDate">Event Date</th>
                        <th data-column-id="location">Location</th>
                        <th data-column-id="repairstatus">Repair state</th>
                    </tr>
                </thead>

                <tbody>
                    <?php foreach($list as $device){ ?>
                    <tr>
                        <td><?php echo $device->id; ?></td>
                        <td><?php echo $device->category_name; ?></td>
                        <td><?php echo $device->group_name; ?></td>
                        <td><?php echo strftime('%d/%m/%Y', $device->event_date); ?></td>
                        <td><?php echo $device->event_location; ?></td>
                        <td><?php echo $device->repair_status; ?></td>
                    </tr>
                    <?php } ?>
                </tbody>
            </table>
            <script>
            $(document).ready(function(){
              /** bootgrid tables **/
              $('.bootg').bootgrid();
            });
            </script>
        </div>
    </div>
</div>
