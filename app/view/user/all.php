<div class="container-fluid">
    <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-4">
            <h1>User List</h1>
        
            <a class="btn btn-primary" href="/user/create"><i class="fa fa-plus"></i> New User</a>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <table class="table table-hover table-responsive">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Role</th>
                        <th>Permissions</th>
                    </tr>
                </thead>
                
                <tbody>
                    <?php 
                    foreach($userlist as $user){
                    ?>
                    <tr>
                        <td><?php echo $user->id; ?></td>
                        <td><?php echo $user->name; ?></td>
                        <td><?php echo $user->email; ?></td>
                        <td><?php echo $user->role; ?></td>
                        <td><?php foreach ($user->permissions as $permission) { echo $permission->permission . ' '; } ?></td>
                        
                    </tr>
                    <?php 
                    }
                    ?>
                </tbody>
            </table>
            
        </div>
    </div>
</div>