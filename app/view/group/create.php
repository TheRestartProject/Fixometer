<div class="container">
    <div class="row">
        <div class="col-md-12">
            <h1>Create New Group</h1>
        </div>
    </div>
    
    <div class="row">
        <div class="col-md-12">
            <?php if(isset($response)) { printResponse($response); } ?>
            
            <form action="/group/create" method="post">
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group <?php if(isset($error) && isset($error['name']) && !empty($error['name'])) { echo "has-error"; } ?>">
                            <label for="name">Name:</label>
                            <input type="text" name="name" id="name" class="form-control" <?php if(isset($error) && !empty($error) && !empty($udata)) echo 'value="'.$udata['name'].'"' ; ?>>
                            <?php if(isset($error) && isset($error['name']) && !empty($error['name'])) { echo '<span class="help-block text-danger">' . $error['name'] . '</span>'; } ?>
                        </div>
                        <div class="form-group">
                            <label for="frequency">Frequency:</label>
                            <input type="text" name="frequency" id="frequency" class="form-control" <?php if(isset($error) && !empty($error) && !empty($udata)) echo 'value="'.$udata['frequency'].'"' ; ?>>
                        </div>
                        <div class="form-group">
                            <label for="free_text">Description:</label>
                            <textarea class="form-control rte" rows="6" name="free_text" id="free_text"></textarea>
                        </div>
                    </div>
                    
                    <div class="col-md-6">
                        
                        <div class="form-group">
                            <label for="area">Area:</label>
                            <input type="text" name="area" id="area" class="form-control" <?php if(isset($error) && !empty($error) && !empty($udata)) echo 'value="'.$udata['area'].'"' ; ?>>
                        </div>
                        
                        
                        <div class="form-group">
                            <label for="location">Location:</label>
                            
                            <div class="form-inline">
                                <div class="form-group">
                                    <input type="text" name="location" id="location" class="form-control" <?php if(isset($error) && !empty($error) && !empty($udata)) echo 'value="'.$udata['location'].'"' ; ?>>
                                    <button type="button" class="btn btn-primary" onclick="codeAddress()"><i class="fa fa-map-marker"></i> geocode</button>
                                </div>    
                            </div>
                        
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
                    </div>
                    
                    
                </div>
                <div class="row">
                    <div class="col-md-6 col-md-offset-6">
                        <button type="submit" class="btn btn-primary"><i class="fa fa-save"></i> save</button>
                    </div>
                </div>
            </form>
            
        </div>
    </div>
    
    
</div>