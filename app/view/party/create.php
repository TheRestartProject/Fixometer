<div class="container">
    <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-4">
            <h1><?php echo $title; ?>
            <small>
                    <?php $home_url = (hasRole($user, 'Administrator') ? '/admin' : '/host'); ?>
                    <a href="<?php echo $home_url; ?>" class="btn btn-primary btn-sm"><i class="fa fa-home"></i> back to dashboard</a>
            </small>
            </h1>
        </div>
    </div>
    <div class="row">
        <div class="container">

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

                    <?php if(isset($response)) { printResponse($response); } ?>
                    <div class="alert alert-info">
                        <?php echo WDG_PUBLIC_INFO; ?>
                    </div>
                    <form action="/party/create" method="post" enctype="multipart/form-data">
                        <div class="row">
                            <div class="col-md-6">

                                <div class="form-group <?php if(isset($error) && isset($error['event_date']) && !empty($error['event_date'])) { echo "has-error"; } ?>">
                                    <label for="event_date">Date:</label>
                                    <div class="input-group date">
                                        <input type="text" name="event_date" id="event_date" class="form-control date">
                                        <span class="input-group-addon">
                                            <i class="fa fa-calendar"></i>
                                        </span>
                                    </div>
                                    <?php if(isset($error) && isset($error['start']) && !empty($error['start'])) { echo '<span class="help-block text-danger">' . $error['start'] . '</span>'; } ?>
                                </div>





                                <div class="form-group">
                                    <label for="free_text">Description:</label>
                                    <textarea class="form-control rte" rows="6" name="free_text" id="free_text"></textarea>
                                </div>

                            </div>

                            <div class="col-md-6">

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group <?php if(isset($error) && isset($error['start']) && !empty($error['start'])) { echo "has-error"; } ?>">
                                            <label for="start">Start:</label>
                                            <div class="input-group time">
                                                <input type="text" name="start" id="start-pc" class="form-control time">
                                                <span class="input-group-addon">
                                                    <i class="fa fa-clock-o"></i>
                                                </span>
                                            </div>
                                            <?php if(isset($error) && isset($error['start']) && !empty($error['start'])) { echo '<span class="help-block text-danger">' . $error['start'] . '</span>'; } ?>
                                        </div>

                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group <?php if(isset($error) && isset($error['end']) && !empty($error['end'])) { echo "has-error"; } ?>">
                                            <label for="end">End:</label>
                                            <div class="input-group time">
                                                <input type="text" name="end" id="end-pc" class="form-control time">
                                                <span class="input-group-addon">
                                                    <i class="fa fa-clock-o"></i>
                                                </span>
                                            </div>
                                            <?php if(isset($error) && isset($error['end']) && !empty($error['end'])) { echo '<span class="help-block text-danger">' . $error['end'] . '</span>'; } ?>
                                        </div>

                                    </div>

                                </div>

                                    <input type="hidden" name="pax" id="pax" value="0">
                                    <input type="hidden" name="volunteers" id="volunteers" value="0">

                                <?php
                                if(hasRole($user, 'Host') && !hasRole($user, 'Root')) {
                                ?>

                                <input type="hidden" name="group" id="group" value="<?php echo $usergroup->idgroups; ?>">

                                <?php
                                }
                                else {
                                ?>

                                <div class="form-group <?php if(isset($error) && isset($error['group']) && !empty($error['group'])) { echo "has-error"; } ?>">
                                    <label for="group">Group:</label>
                                    <select id="group" name="group"  class="form-control selectpicker users_group">
                                        <option></option>
                                        <?php foreach($group_list as $group){ ?>
                                        <option value="<?php echo $group->id; ?>"><?php echo $group->name; ?></option>
                                        <?php } ?>
                                    </select>
                                    <?php if(isset($error) && isset($error['group']) && !empty($error['group'])) { echo '<span class="help-block text-danger">' . $error['group'] . '</span>'; } ?>

                                    <div class="users_group_list">

                                    </div>
                                </div>
                                <?php
                                }
                                ?>
                                <div class="form-group">
                                    <label for="venue">Venue Name:</label>
                                    <input type="text" name="venue" id="venue" class="form-control" <?php if(isset($error) && !empty($error) && !empty($udata)) echo 'value="'.$udata['venue'].'"' ; ?>>
                                </div>
                                <div class="form-group">
                                    <label for="location">Address:</label>
                                    <div class="input-group">
                                        <input type="text" name="location" id="location" class="form-control" <?php if(isset($error) && !empty($error) && !empty($udata)) echo 'value="'.$udata['location'].'"' ; ?>>
                                        <span class="input-group-btn">
                                            <button type="button" class="btn btn-primary" onclick="codeAddress()"><i class="fa fa-map-marker"></i> geocode</button>
                                        </span>


                                    </div>
                                    <p class="help-block">
                                        To pinpoint the party venue on the map, please enter the venue name and the address in the fields above, then press "geocode". 
                                    </p>
                                </div>


                                <div class="" id="map-canvas" style="height: 350px; ">
                                    <i class="fa fa-spinner"></i>
                                </div>

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <input type="text" name="latitude" id="latitude" class="form-control" placeholder="latitude..." <?php if(isset($error) && !empty($error) && !empty($udata)) echo 'value="'.$udata['latitude'].'"' ; ?>>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <input type="text" name="longitude" id="longitude" class="form-control" placeholder="longitude..." <?php if(isset($error) && !empty($error) && !empty($udata)) echo 'value="'.$udata['longitude'].'"' ; ?>>
                                        </div>
                                    </div>
                                </div>


                                <div class="from-group">
                                    <label for="file" class="sr-only">Image:</label>
                                    <input type="file" name="file" id="file" class="form-control fileinput">
                                </div>

                            </div>

                        </div>
                        <div class="row buttons">

                            <div class="col-md-6 col-md-offset-6">

                                <div class="form-group">
                                    <button class="btn btn-default" type="reset"><i class="fa fa-refresh"></i> reset</button>
                                    <button class="btn btn-primary" type="submit"><i class="fa fa-save"></i> save</button>
                                </div>

                            </div>

                        </div>

                    </form>
                </div>
            </div>

        </div>
    </div>
</div>
