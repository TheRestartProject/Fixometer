<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            <h1><?php echo $title; ?></h1>
            <a class="btn btn-default btn-sm" href="/device/create"><i class="fa fa-plus"></i> New Device</a>
            <a href="/export/devices" class="btn btn-default btn-sm"><i class="fa fa-download"></i> All Device Data</a>
            <hr />
        </div>
        <div class="col-md-1">
            <h2>Search</h2>

        </div>
        <div class="col-md-11">
          <form action="/device/index" method="get">
            <input type="hidden" name="fltr" value="<?php echo bin2hex(openssl_random_pseudo_bytes(8)); ?>">
            <div class="row">
              <div class="col-md-3">
                <div class="form-group">
                  <select id="categories" name="categories[]" class="selectpicker form-control" multiple data-live-search="true" title="Choose categories...">
                    <?php foreach($categories as $cluster){ ?>
                    <optgroup label="<?php echo $cluster->name; ?>">
                      <?php foreach($cluster->categories as $c){ ?>
                      <option value="<?php echo $c->idcategories; ?>"><?php echo $c->name; ?></option>
                      <?php } ?>
                    </optgroup>
                    <?php } ?>
                    <option value="46">Misc</option>
                  </select>

                </div>
              </div>
              <div class="col-md-3">
                <div class="form-group">
                  <select id="groups" name="groups[]" class="selectpicker form-control" multiple data-live-search="true" title="Choose groups...">
                    <?php foreach($groups as $g){ ?>
                    <option value="<?php echo $g->id; ?>"><?php echo $g->name; ?></option>
                    <?php } ?>
                  </select>
                </div>
              </div>
              <div class="col-md-3">
                <div class="form-group">
                  <div class="input-group">
                    <input type="text" class="form-control date" id="search-from-date" name="from-date" placeholder="From date...">
                    <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                  </div>
                </div>
              </div>
              <div class="col-md-3">
                <div class="form-group">
                  <div class="input-group">
                    <input type="text" class="form-control date" id="search-to-date" name="to-date" placeholder="To date...">
                    <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                  </div>
                </div>
              </div>
            </div>

            <div class="row">
              <div class="col-md-3">
                <div class="form-group">
                  <input type="text" class="form-control " id="model" name="model" placeholder="Model...">
                </div>
              </div>
              <div class="col-md-3">
                <div class="form-group">
                  <input type="text" class="form-control " id="brand" name="brand" placeholder="Brand...">
                </div>
              </div>
              <div class="col-md-5">
                <div class="form-group">
                  <input type="text" class="form-control " id="free-text" name="free-text" placeholder="Search in the description...">
                </div>
              </div>

              <div class="col-md-1">

                <button class="btn btn-primary"><i clasS="fa fa-search"></i> Search</button>
              </div>
            </div>
          </form>
        </div>

        <div class="col-md-12">

            <table class="table table-hover table-responsive table-striped bootg" id="devices-table">
                <thead>
                    <tr>
                        <th data-column-id="deviceID"  data-header-css-class="comm-cell" data-identifier="true" data-type="numeric">#</th>
                        <th data-column-id="category">Category</th>
                        <th data-column-id="brand">Brand</th>
                        <th data-column-id="model">Model</th>
                        <th data-column-id="groupName">Event (Group)</th>
                        <th data-column-id="eventDate" data-header-css-class="mid-cell">Event Date</th>
                        <th data-column-id="location">Location</th>
                        <th data-column-id="repairstatus" data-header-css-class="mid-cell" data-formatter="statusBox">Repair state</th>
                        <th data-column-id="edit" data-header-css-class="comm-cell" data-formatter="editLink" data-sortable="false">edit</th>
                    </tr>
                </thead>

                <tbody>
                    <?php foreach($list as $device){ ?>
                    <tr>
                        <td><?php echo $device->id; ?></td>
                        <td><?php echo $device->category_name; ?></td>
                        <td><?php echo $device->brand; ?></td>
                        <td><?php echo $device->model; ?></td>
                        <td><?php echo $device->group_name; ?></td>
                        <td><?php echo strftime('%Y-%m-%d', $device->event_date); ?></td>
                        <td><?php echo $device->event_location; ?></td>
                        <td><?php echo $device->repair_status; ?></td>
                        <td><a href="/device/edit/<?php echo $device->id; ?>">edit</a></td>
                    </tr>
                    <?php } ?>
                </tbody>
            </table>
            <script>
            $(document).ready(function(){
              /** bootgrid tables **/
              $('.bootg').bootgrid({
                formatters: {
                    "editLink": function(column, row){
                        return "<a href=\"/device/edit/" + row.deviceID + "\"><i class=\"fa fa-pencil\"</a>";
                    },
                    "statusBox": function(column, row){
                      var deviceState = '';
                      if(row.repairstatus == 1){
                        devicestate = 'fixed';
                      }
                      else if(row.repairstatus == 2){
                        devicestate = 'repairable';
                      }
                      else if(row.repairstatus == 3){
                        devicestate = 'end of life';
                      }
                      else {
                        devicestate = 'N.A.';
                      }
                      return "<div class=\"repair-status repair-status-" + row.repairstatus + "\">" + devicestate + "</div>";
                    }
                }

              });
            });
            </script>
        </div>
    </div>
</div>
