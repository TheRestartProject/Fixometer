
<form action="/party/manage/<?php echo $party->id; ?>" method="post" id="party-edit" enctype="multipart/form-data">
<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            <h1>Edit Party
                <small>
                    <button type="submit" class="btn btn-primary btn-sm"><i class="fa fa-floppy-o"></i> save</button>
                    <a href="/party/edit/<?php echo $party->id; ?>" class="btn btn-primary btn-sm"><i class="fa fa-edit"></i> edit details</a>

                    <?php $home_url = (hasRole($user, 'Administrator') ? '/admin' : '/host'); ?>
                    <a href="<?php echo $home_url; ?>" class="btn btn-primary btn-sm"><i class="fa fa-home"></i> back to dashboard</a>

                </small>
            </h1>

            <div class="alert alert-info">
                <?php echo WDG_PUBLIC_INFO; ?>
            </div>

        </div>
    </div>
    <!-- Profiles -->
    <?php if(hasRole( $user, 'Administrator' )) { ?>


    <section class="row profiles">
        <div class="col-md-12">
            <h5>Admin Console</h5>

        </div>
        <div class="col-md-6">
            <div class="btn-group btn-group-justified">


                <div class="btn-group" role="group">
                    <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        Groups
                      <span class="fa fa-chevron-down"></span>
                    </button>
                    <ul class="dropdown-menu">
                        <?php foreach($grouplist as $group) { ?>
                        <li class="group-list clearfix">
                            <div class="pull-left">
                                <?php if(!empty($group->path)) { ?>
                                <img src="/uploads/thumbnail_<?php echo $group->path; ?>" width="40" height="40" alt="<?php echo $group->name; ?> Image" class="profile-pic" />
                                <?php } else { ?>
                                <div class="profile-pic clearfix" style="background: #ddd; width: 40px; height: 40px; ">&nbsp;</div>
                                <?php } ?>
                            </div>
                            <div class="pull-left">
                                <a  href="/host/index/<?php echo $group->id; ?>" ><?php echo $group->name; ?></a>
                            </div>
                        </li>

                        <?php } ?>
                    </ul>
                </div>

                <a class="btn btn-default" href="/group/create">Add Group</a>
            </div>
        </div>
        <div class="col-md-6">
            <div class="btn-group btn-group-justified">
                <a class="btn btn-default" href="/user/all">Users</a>
                <a class="btn btn-default" href="/user/create">Add User</a>
            </div>
        </div>

    </section>



    <?php } ?>

    <div class="row">
        <div class="col-md-12">

            <input type="hidden" name="idparty" id="idparty" value="<?php echo $party->id; ?>">

            <div class="row party " >
                <div class="col-md-12">
                    <div class="header-col header-col-2">
                        <div class="date">
                            <span class="month"><?php echo date('M', $party->event_timestamp); ?></span>
                            <span class="day">  <?php echo date('d', $party->event_timestamp); ?></span>
                            <span class="year"> <?php echo date('Y', $party->event_timestamp); ?></span>
                        </div>

                        <div class="short-body">
                            <span class="location"><?php echo (!empty($party->venue) ? $party->venue . ', ' . $party->location : $party->location); ?></span><br />
                            <span class="groupname"><?php echo $party->group_name; ?></span>
                        </div>
                    </div>
                        <div class="data">
                            <div class="stat double">
                                <div class="col">
                                    <i class="fa fa-group"></i>
                                    <span class="subtext">participants</span>
                                </div>
                                <div class="col">
                                    <input class="party-input" name="party[pax]" value="<?php echo $party->pax; ?>" id="party[pax]">
                                </div>

                            </div>

                            <div class="stat double">
                                <div class="col">
                                    <img class="" alt="The Restart Project: Logo" src="/assets/images/logo_mini.png">
                                    <span class="subtext">restarters</span>
                                </div>
                                <div class="col">
                                    <input class="party-input" name="party[volunteers]" value="<?php echo $party->volunteers; ?>" id="party[volunteers]">
                                </div>

                            </div>

                            <div class="stat">

                                <div class="footprint">
                                    <?php echo $party->co2; ?>
                                    <span class="subtext">kg of CO<sub>2</sub></span>
                                    <br />
                                    <?php echo number_format($party->ewaste, 0); ?>
                                    <span class="subtext">kg of waste<span>
                                </div>
                            </div>


                            <div class="stat fixed">
                                <div class="col"><i class="status mid fixed"></i></div>
                                <div class="col"><?php echo $party->fixed_devices; ?></div>
                            </div>

                            <div class="stat repairable">
                                <div class="col"><i class="status mid repairable"></i></div>
                                <div class="col"><?php echo $party->repairable_devices; ?></div>
                            </div>

                            <div class="stat dead">
                                <div class="col"><i class="status mid dead"></i></div>
                                <div class="col"><?php echo $party->dead_devices; ?></div>
                            </div>


                        </div>
                    </div>
                    <div class="col-md-12 text-right">
                      <button class="btn btn-default" type="button" data-toggle="modal" data-target="#esw"><i class="fa fa-share"></i> Share your stats</button>
                    </div>
                </div>
            </div>
            <!-- devices -->
            <div class="col-md-12">
              <h3>Devices</h3>
            </div>


            <div class="col-md-12">
                <table class="table sticky-header" id="device-table">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Category</th>
                            <th>Comment</th>
                            <th style="width: 280px !important;">Image</th>
                            <th>Brand/Model/Age</th>
                            <th>Repair Status</th>
                            <th>Spare Parts?</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>

                        <?php
                        if(!empty($devices)){
                            for($i = 1; $i <= count($devices); $i++){
                        ?>



                        <tr class="rs-<?php echo $devices[$i-1]->repair_status; ?>">
                            <td>
                                <?php echo $i; ?>.
                                <input type="hidden" name="device[<?php echo $i; ?>][id]" value="<?php echo $devices[$i-1]->iddevices; ?>">

                            </td>
                            <td>
                                <div class="form-group">
                                    <select id="device[<?php echo $i; ?>][category]" name="device[<?php echo $i; ?>][category]" class="category-select form-control" data-live-search="true">
                                        <?php foreach($categories as $cluster){ ?>
                                        <optgroup label="<?php echo $cluster->name; ?>">
                                            <?php foreach($cluster->categories as $c){ ?>
                                            <option value="<?php echo $c->idcategories; ?>"<?php echo ($devices[$i-1]->category == $c->idcategories ? ' selected':''); ?>><?php echo $c->name; ?></option>
                                            <?php } ?>
                                        </optgroup>
                                        <?php } ?>
                                        <option value="46" <?php echo ($devices[$i-1]->category == 46 ? ' selected':''); ?>>None of the above...</option>
                                    </select>
                                </div>
                                <div class="form-group
                                    <?php echo ($devices[$i-1]->category == 46 ? 'show' : 'hide'); ?>
                                     estimate-box">
                                    <small>Please input an estimate weight (in kg)</small>
                                    <input type="text" name="device[<?php echo $i; ?>][estimate]" id="device[<?php echo $i; ?>][estimate]" class="form-control" placeholder="Estimate..." value="<?php echo $devices[$i-1]->estimate; ?>">
                                </div>
                            </td>
                            <td>
                                <textarea class="form-control" id="device[<?php echo $i; ?>][problem]" name="device[<?php echo $i; ?>][problem]"><?php echo $devices[$i-1]->problem; ?></textarea>
                            </td>
                            <td>

                              <?php if(!empty($devices[$i-1]->path)) { ?>
                                <img src="/public/uploads/<?php echo $devices[$i-1]->path; ?>" class="img-responsive device-img">
                              <?php } ?>

                              <div class="form-group">
                                <input type="file" class="form-control file" name="device[<?php echo $i; ?>][image]"
                                data-show-upload="false"
                                data-show-caption="true"
                                data-preview-file-icon="<i class='fa fa-file'></i>",
                                data-browse-icon="<i class='fa fa-folder-open'></i> &nbsp;",
                                data-upload-icon="<i class='fa fa-upload'></i>"
                                data-remove-icon="<i class='fa fa-trash'></i>"
                                data-cancel-icon="<i class='fa fa-ban-circle'></i>"
                                data-file-icon="<i class='fa fa-file'></i>" 
                                >
                              </div>

                            </td>
                            <td>
                                <div class="form-group">
                                    <input type="text" name="device[<?php echo $i; ?>][brand]" id="device[<?php echo $i; ?>][brand]" class="form-control" placeholder="Brand..." value="<?php echo $devices[$i-1]->brand; ?>">
                                </div>

                                <div class="form-group">
                                    <input type="text" name="device[<?php echo $i; ?>][model]" id="device[<?php echo $i; ?>][model]" class="form-control" placeholder="Model..." value="<?php echo $devices[$i-1]->model; ?>">
                                </div>

                                <div class="form-group">
                                    <input type="text" name="device[<?php echo $i; ?>][age]" id="device[<?php echo $i; ?>][age]" class="form-control" placeholder="Age..." value="<?php echo $devices[$i-1]->age; ?>">
                                </div>

                            </td>
                            <td>
                                <div class="form-group">
                                    <div class="radio">
                                        <label>
                                            <input
                                              type="radio"
                                              name="device[<?php echo $i; ?>][repair_status]"
                                              id="device[<?php echo $i; ?>][repair_status_1]"
                                              value="1"
                                              <?php echo ($devices[$i-1]->repair_status == 1 ? 'checked="checked"' : ''); ?>>
                                              Fixed
                                        </label>
                                    </div>
                                    <div class="radio">
                                        <label>
                                            <input
                                                   type="radio"
                                                   <?php echo ($devices[$i-1]->repair_status == 2 ? 'checked="checked"' : ''); ?>
                                                   name="device[<?php echo $i; ?>][repair_status]"
                                                   id="device[<?php echo $i; ?>][repair_status_2]"
                                                   value="2"
                                                   class="repairable"
                                                   data-target-details="#repairable-details-<?php echo $i; ?>">

                                                   Repairable
                                        </label>
                                    </div>
                                    <div id="repairable-details-<?php echo $i; ?>" class="repairable-details">
                                        <div class="checkbox">
                                            <label>
                                                <input type="checkbox" name="device[<?php echo $i; ?>][more_time_needed]" id="device[<?php echo $i; ?>][more_time_needed]" value="1" <?php echo ($devices[$i-1]->more_time_needed == 1 ? 'checked' : ''); ?> > More time needed
                                            </label>
                                        </div>
                                        <div class="checkbox">
                                            <label>
                                                <input type="checkbox" name="device[<?php echo $i; ?>][professional_help]" id="device[<?php echo $i; ?>][professional_help]" value="1" <?php echo ($devices[$i-1]->professional_help == 1 ? 'checked' : ''); ?> > Professional help
                                            </label>
                                        </div>
                                        <div class="checkbox">
                                            <label>
                                                <input type="checkbox" name="device[<?php echo $i; ?>][do_it_yourself]" id="device[<?php echo $i; ?>][do_it_yourself]" value="1" <?php echo ($devices[$i-1]->do_it_yourself == 1 ? 'checked' : ''); ?> > Do it yourself
                                            </label>
                                        </div>
                                    </div>
                                    <div class="radio">
                                        <label>
                                            <input
                                                   type="radio"
                                                   name="device[<?php echo $i; ?>][repair_status]"
                                                   id="device[<?php echo $i; ?>][repair_status_3]"
                                                   value="3"
                                                   <?php echo ($devices[$i-1]->repair_status == 3 ? 'checked="checked"' : ''); ?>> End of lifecycle
                                        </label>
                                    </div>
                                </div>
                            </td>
                            <td>
                                <div class="form-group">
                                  <div class="checkbox">
                                    <label>
                                      <input type="hidden" name="device[<?php echo $i; ?>][spare_parts]" id="device[<?php echo $i; ?>][spare_parts_2]" value="2">
                                      <input type="checkbox" name="device[<?php echo $i; ?>][spare_parts]" id="device[<?php echo $i; ?>][spare_parts_1]" value="1" <?php echo ($devices[$i-1]->spare_parts == 1 ? 'checked' : ''); ?>> Yes
                                    </label>
                                  </div>
                                </div>
                            </td>
                            <td>
                                <a class="btn delete-control" href="/device/delete/<?php echo $devices[$i-1]->iddevices; ?>"><i class="fa fa-trash"></i></a>
                            </td>

                        </tr>
                        <?php
                            }
                        }
                        ?>


                        <?php
                        $start = (!empty($devices) ? count($devices) + 1 : 1);


                        for ($i = $start; $i < $start  ; $i++) {
                        ?>
                        <tr>
                            <td><?php echo $i; ?>.</td>
                            <td>
                                <div class="form-group">
                                    <select id="device[<?php echo $i; ?>][category]" name="device[<?php echo $i; ?>][category]" class="selectpicker form-control category-select" data-live-search="true" title="Choose category...">
                                        <option></option>
                                        <?php foreach($categories as $cluster){ ?>
                                        <optgroup label="<?php echo $cluster->name; ?>">
                                            <?php foreach($cluster->categories as $c){ ?>
                                            <option value="<?php echo $c->idcategories; ?>"><?php echo $c->name; ?></option>
                                            <?php } ?>
                                        </optgroup>
                                        <?php } ?>
                                        <option value="46">None of the above...</option>
                                    </select>
                                </div>
                                <div class="form-group hide estimate-box">
                                    <small>Please input an estimate weight (in kg)</small>
                                    <input type="text" name="device[<?php echo $i; ?>][estimate]" id="device[<?php echo $i; ?>][estimate]" class="form-control" placeholder="Estimate...">
                                </div>
                            </td>
                            <td>
                                <textarea class="form-control" id="device[<?php echo $i; ?>][problem]" name="device[<?php echo $i; ?>][problem]"></textarea>
                            </td>
                            <td>

                              <div class="form-group">
                                <input type="file" class="form-control file" name="device[<?php echo $i; ?>][image]" data-show-upload="false" data-show-caption="true">
                              </div>

                            </td>
                            <td>
                                 <div class="form-group">
                                    <input type="text" name="device[<?php echo $i; ?>][brand]" id="device[<?php echo $i; ?>][brand]" class="form-control" placeholder="Brand...">
                                </div>

                                <div class="form-group">
                                    <input type="text" name="device[<?php echo $i; ?>][model]" id="device[<?php echo $i; ?>][model]" class="form-control" placeholder="Model..." >
                                </div>

                                <div class="form-group">
                                    <input type="text" name="device[<?php echo $i; ?>][age]" id="device[<?php echo $i; ?>][age]" class="form-control" placeholder="Age..." >
                                </div>
                            </td>
                            <td>
                                <div class="form-group">
                                    <div class="radio">
                                        <label>
                                            <input type="radio" name="device[<?php echo $i; ?>][repair_status]" id="device[<?php echo $i; ?>][repair_status_1]" value="1" checked> Fixed
                                        </label>
                                    </div>
                                    <div class="radio">
                                        <label>
                                            <input type="radio" class="repairable" data-target-details="#repairable-details-<?php echo $i; ?>" name="device[<?php echo $i; ?>][repair_status]" id="device[<?php echo $i; ?>][repair_status_2]" value="2"> Repairable
                                        </label>
                                    </div>
                                    <div id="repairable-details-<?php echo $i; ?>" class="repairable-details">
                                        <div class="checkbox">
                                            <label>
                                                <input type="checkbox" name="device[<?php echo $i; ?>][more_time_needed]" id="device[<?php echo $i; ?>][more_time_needed]" value="1"> More time needed
                                            </label>
                                        </div>
                                        <div class="checkbox">
                                            <label>
                                                <input type="checkbox" name="device[<?php echo $i; ?>][professional_help]" id="device-<?php echo $i; ?>[professional_help]" value="1"> Professional help
                                            </label>
                                        </div>
                                        <div class="checkbox">
                                            <label>
                                                <input type="checkbox" name="device[<?php echo $i; ?>][do_it_yourself]" id="device[<?php echo $i; ?>][do_it_yourself]" value="1"> Do it yourself
                                            </label>
                                        </div>
                                    </div>
                                    <div class="radio">
                                        <label>
                                            <input type="radio" name="device[<?php echo $i; ?>][repair_status]" id="device[<?php echo $i; ?>][repair_status_3]" value="3"> End of lifecycle
                                        </label>
                                    </div>
                                </div>
                            </td>
                            <td>
                                <div class="form-group">
                                    <div class="checkbox">
                                        <label>
                                            <input type="hidden" name="device[<?php echo $i; ?>][spare_parts]" id="device[<?php echo $i; ?>][spare_parts_2]" value="2">
                                            <input type="checkbox" name="device[<?php echo $i; ?>][spare_parts]" id="device[<?php echo $i; ?>][spare_parts_1]" value="1"> Yes
                                        </label>
                                    </div>

                                </div>
                            </td>

                        </tr>
                        <?php } ?>


                    </tbody>
                    <tfoot>
                         <tr>
                            <td colspan="3"><button class="btn btn-primary text-center" type="button" id="add-device"><i class="fa fa-plus"></i> Add Device</button></td>
                            <td colspan="3"></td>
                        </tr>
                    </tfoot>
                </table>
                <div class="text-center">
                    <br /><br />
                    <button type="submit" class="btn btn-primary btn-lg"><i class="fa fa-floppy-o"></i> Save</button>
                    <br /><br /><br />
                </div>
            </div>
        </div>
    </div>
</div>
</form>



<div class="modal fade" tabindex="-1" role="dialog" id="esw">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Embeddable Party Stats Widget</h4>
      </div>
      <div class="modal-body">
        <p>Copy and paste this code snippet into a page on your website to share your party achievements!</p>
          <code>
            <pre>&lt;iframe src="https://community.therestartproject.org/party/stats/<?php echo $party->id; ?>/wide" frameborder="0" width="100%" height="80"&gt;&lt;/iframe&gt;</pre>
          </code>
          <p>This widget will display an infographic such as the ones found on the group pages in the Restart Project website. </p>
            <code>
              <pre>&lt;iframe src="https://community.therestartproject.org/outbound/info/party/<?php echo $party->id; ?>" frameborder="0" width="100%" height="600"&gt;&lt;/iframe&gt;</pre>
            </code>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
