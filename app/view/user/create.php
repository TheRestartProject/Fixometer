<div class="container">
    <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-4">
            <h1>Create New User</h1>
        </div>
    </div>
    <div class="row">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <form action="/user/create" method="post">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="name">User Name:</label>
                                    <input type="text" name="name" id="name" class="form-control"> 
                                </div>
                                <div class="form-group">
                                    <label for="email">Email:</label>
                                    <input type="email" name="email" id="email" class="form-control"> 
                                </div>
                                <div class="form-group">
                                    <label for="role">User Role:</label>
                                    <select id="role" name="role"  class="form-control selectpicker">
                                        <option></option>
                                        <?php foreach($roles as $role){ ?>
                                        <option value="<?php echo $role->idroles; ?>"><?php echo $role->role; ?></option>
                                        <?php } ?>
                                    </select>
                                </div>
                                
                            </div>    
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="password">Password:</label>
                                    <input type="password" name="password" id="password" class="form-control"> 
                                </div>
                                <div class="form-group">
                                    <label for="c-password">Confirm Password:</label>
                                    <input type="password" name="c-password" id="c-password" class="form-control"> 
                                </div>
                                
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