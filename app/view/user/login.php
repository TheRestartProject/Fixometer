<div class="container">
    
    <div class="row">
        <div class="col-xs-12 col-sm-8 col-sm-offset-2 col-md-4 col-md-offset-4">
            <h1 class="text-center">FIX-O-METER</h1>
            <h3 class="text-center">login</h3>
            
            <?php
                print_r($response);
            ?>
            
            
            <form class="" method="post" action="/user/login">
                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="email" class="form-control" name="email" id="email">
                </div>
                
                <div class="form-group">
                    <label for="password">Password</label>
                    <input type="password" class="form-control" name="password" id="password">
                </div>
                
                <div class="form-group">
                    <button type="submit" class="form-control btn btn-primary" name="submit" id="submit"><i class="fa fa-sign-in"></i> Login</button>
                </div>
                
                
            </form>
            
        </div>
        
    </div>
</div>