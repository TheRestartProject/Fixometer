
    
        <div class="login-form">
            <h1 class="text-center">FIX-O-METER</h1>
            <h3 class="text-center">login</h3>
            
            <?php if(isset($response)) { printResponse($response); } ?>
            
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
        
        <div class="login-deets">
                
                <div class="detail">
                    <h4>Devices Restarted</h4>
                    <span class="big-number">
                        <span class="big-number"><?php echo number_format($devices[0]->counter, 0, '-', ','); ?></span>
                    </span>
                </div>
                
                <div class="detail">
                    bar chart here
                </div>
                
                <div class="detail">
                    <h4>CO<sub>2</sub> de-sequestered</h4>
                    <span class="big-number"><?php echo number_format($weights[0]->total_footprints, 0, '-', ','); ?> kg</span>
                </div>
                <div class="detail">
                    <h4>waste prevented</h4>
                    <span class="big-number"><?php echo number_format($weights[0]->total_weights, 0, '-', ','); ?> kg</span>
                </div>
                
                
                <div class="detail">
                    <h4>parties thrown</h4>
                    <span class="big-number"><?php echo count($allparties) - count($nextparties); ?></span>
                </div>
                <div class="detail">
                    <h4>upcoming parties</h4>
                    <span class="big-number"><?php echo count($nextparties); ?></span>
                </div>
                
            
            
        </div>



            












<div class="container">
    
    <div class="row">
        <div class="col-xs-12 col-sm-8 col-sm-offset-2 col-md-4 col-md-offset-4">
            
        </div>
        
    </div>
</div>