<div class="container">
    <div class="row">
        <div class="col-md-12">
            <h1>Edit Group <span class="orange"><?php echo $formdata->name; ?></span></h1>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <?php if(isset($response)) { printResponse($response); } ?>

            <form action="/group/edit/<?php echo $formdata->idgroups; ?>" method="post" enctype="multipart/form-data">
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group <?php if(isset($error) && isset($error['name']) && !empty($error['name'])) { echo "has-error"; } ?>">
                            <label for="name">Name: <i class="fa fa-question-circle" data-toggle="popover" title="{REPLACE TITLE}" data-content="{REPLACE CONTENT}"></i></label>
                            <input type="text" name="name" id="name" class="form-control" value="<?php echo $formdata->name; ?>">
                            <?php if(isset($error) && isset($error['name']) && !empty($error['name'])) { echo '<span class="help-block text-danger">' . $error['name'] . '</span>'; } ?>
                        </div>


                        <div class="form-group">
                            <label for="name">Website: <i class="fa fa-question-circle" data-toggle="popover" title="{REPLACE TITLE}" data-content="{REPLACE CONTENT}"></i></label>
                            <input type="text" name="website" id="website" class="form-control" value="<?php echo $formdata->website; ?>">                          
                        </div>


                        <div class="form-group">
                            <label for="free_text">Description: <i class="fa fa-question-circle" data-toggle="popover" title="{REPLACE TITLE}" data-content="{REPLACE CONTENT}"></i></label>
                            <textarea class="form-control rte" rows="6" name="free_text" id="free_text"><?php echo $formdata->free_text; ?></textarea>
                        </div>

                    </div>

                    <div class="col-md-6">

                        <div class="form-group">

                            <label for="location">Location: where do you keep your fixing tools and supplies?  <i class="fa fa-question-circle" data-toggle="popover" title="{REPLACE TITLE}" data-content="{REPLACE CONTENT}"></i></label>

                            <div class="input-group">
                                <input type="text" name="location" id="location" class="form-control"  value="<?php echo $formdata->location; ?>">
                                <span class="input-group-btn">
                                    <button type="button" class="btn btn-primary" onclick="codeAddress()"><i class="fa fa-map-marker"></i> geocode</button>
                                </span>
                            </div>
                        </div>


                        <div class="" id="map-canvas" style="height: 350px; padding: 25px 0px; ">
                            <i class="fa fa-spinner fa-pulse"></i>
                        </div>

                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <input type="text" name="latitude" id="latitude" class="form-control" placeholder="latitude..." value="<?php echo $formdata->latitude; ?>">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <input type="text" name="longitude" id="longitude" class="form-control" placeholder="longitude..." value="<?php echo $formdata->longitude; ?>">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <input type="text" name="area" id="area" class="form-control" placeholder="city..." value="<?php echo $formdata->area; ?>">
                                </div>
                            </div>
                        </div>

                        <div class="form-group image-wrap">
                            <small>Current Group Avatar:  <i class="fa fa-question-circle" data-toggle="popover" title="{REPLACE TITLE}" data-content="{REPLACE CONTENT}"></i></small>
                            <?php
                            if(!empty($formdata->path)){
                                echo '<img src="/uploads/mid_' . $formdata->path . '" class="img-responsive" style="width: 25%; height: 25%; ">';

                            }
                            else {
                                echo '<div class="alert alert-info">No Image</div>';
                            }
                            ?>
                        </div>

                        <div class="form-group">
                            <label for="image">Image:  <i class="fa fa-question-circle" data-toggle="popover" title="{REPLACE TITLE}" data-content="{REPLACE CONTENT}"></i></label>
                            <input type="file" class="form-control file" name="image" data-show-upload="false" data-show-caption="true">
                            <small>Icon, Avatar or Logo of the Group</small>
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
