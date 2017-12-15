<div class="container">
    <div class="row">
        <div class="col-md-12">
            <h1><?php _t("Create New Group");?></h1>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <?php if(isset($response)) { printResponse($response); } ?>

            <form action="/group/create" method="post" enctype="multipart/form-data">
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group <?php if(isset($error) && isset($error['name']) && !empty($error['name'])) { echo "has-error"; } ?>">
                            <label for="name"><?php _t("Name:");?>  <i class="fa fa-question-circle" data-toggle="popover" title="{REPLACE TITLE}" data-content="{REPLACE CONTENT}"></i></label>
                            <input type="text" name="name" id="name" class="form-control" <?php if(isset($error) && !empty($error) && !empty($udata)) echo 'value="'.$udata['name'].'"' ; ?>>
                            <?php if(isset($error) && isset($error['name']) && !empty($error['name'])) { echo '<span class="help-block text-danger">' . $error['name'] . '</span>'; } ?>
                        </div>

                        <div class="form-group">
                            <label for="name">Website: <i class="fa fa-question-circle" data-toggle="popover" title="{REPLACE TITLE}" data-content="{REPLACE CONTENT}"></i></label>
                            <input type="text" name="website" id="website" class="form-control" <?php if(isset($error) && !empty($error) && !empty($udata)) echo 'value="'.$udata['website'].'"' ; ?>>                          
                        </div>

                        <div class="form-group">
                            <label for="free_text"><?php _t("Description:");?>  <i class="fa fa-question-circle" data-toggle="popover" title="{REPLACE TITLE}" data-content="{REPLACE CONTENT}"></i></label>
                            <textarea class="form-control rte" rows="6" name="free_text" id="free_text"></textarea>
                        </div>

                    </div>

                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="location"><?php _t("Location: where do you keep your fixing tools and supplies?");?>  <i class="fa fa-question-circle" data-toggle="popover" title="{REPLACE TITLE}" data-content="{REPLACE CONTENT}"></i></label>

                            <div class="input-group">
                                <input type="text" name="location" id="location" class="form-control" <?php if(isset($error) && !empty($error) && !empty($udata)) echo 'value="'.$udata['location'].'"' ; ?>>
                                <span class="input-group-btn">
                                    <button type="button" class="btn btn-primary" onclick="codeAddress()"><i class="fa fa-map-marker"></i> <?php _t("geocode");?></button>
                                </span>
                            </div>

                        </div>


                        <div class="" id="map-canvas" style="height: 350px; ">
                            <i class="fa fa-spinner"></i>
                        </div>

                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <input type="text" name="latitude" id="latitude" class="form-control" placeholder="<?php _t("latitude...");?>" <?php if(isset($error) && !empty($error) && !empty($udata)) echo 'value="'.$udata['latitude'].'"' ; ?>>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <input type="text" name="longitude" id="longitude" class="form-control" placeholder="<?php _t("longitude...");?>" <?php if(isset($error) && !empty($error) && !empty($udata)) echo 'value="'.$udata['longitude'].'"' ; ?>>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <input type="text" name="area" id="area" class="form-control" placeholder="<?php _t("city...");?>" <?php if(isset($error) && !empty($error) && !empty($udata)) echo 'value="'.$udata['area'].'"' ; ?>>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="image">Image: <i class="fa fa-question-circle" data-toggle="popover" title="{REPLACE TITLE}" data-content="{REPLACE CONTENT}"></i></label>
                            <input type="file" class="form-control file" name="image" data-show-upload="false" data-show-caption="true">
                            <small><?php _t("Icon, Avatar or Logo of the Group");?></small>
                        </div>
                    </div>


                </div>
                <div class="row buttons">

                            <div class="col-md-6 col-md-offset-6">

                                <div class="form-group">
                                    <button class="btn btn-default" type="reset"><i class="fa fa-refresh"></i> <?php _t("reset");?></button>
                                    <button class="btn btn-primary" type="submit"><i class="fa fa-save"></i> <?php _t("save");?></button>
                                </div>

                            </div>

                        </div>
            </form>

        </div>
    </div>


</div>
