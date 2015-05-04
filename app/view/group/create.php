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
                        <div class="form-group">
                            <label for="name">Name:</label>
                            <input type="text" name="name" id="name" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="frequency">Frequency:</label>
                            <input type="text" name="frequency" id="frequency" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="area">Area:</label>
                            <input type="text" name="area" id="area" class="form-control">
                        </div>
                    </div>
                    
                    <div class="col-md-6">
                        <div class="form-inline">
                            <div class="form-group">
                                <label for="location">Location:</label>
                                <input type="text" name="location" id="location" class="form-control">
                                
                            </div>
                            <div class="form-group">
                                <button type="button" class="btn btn-primary" onclick="codeAddress()"><i class="fa fa-map-marker"></i> geocode</button>
                            </div>
                        </div>
                        
                        
                        <div class="" id="map-canvas" style="height: 350px; ">
                            <i class="fa fa-spinner"></i>
                        </div>
                        
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <input type="text" name="latitude" id="latitude" class="form-control" placeholder="latitude...">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <input type="text" name="longitude" id="longitude" class="form-control" placeholder="longitude...">
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