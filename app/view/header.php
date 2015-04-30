        <?php if(isset($header) && $header == true) { ?> 
        <nav class="navbar fixed-top">
        
            <div class="container-fluid">
                <div class="row">
                    <div class="col-xs-6 col-sm-3 col-md-1">
                        <a class="brand" href="/">
                            <img class="img-responsive" alt="The Restart Project: Logo" src="/assets/images/logo_mini.png">
                        </a>
                    </div>
                    
                    <div class="col-md-8">
                        <ul id="navigation">
                            <li class="">
                                <i class="fa fa-group"></i> 
                                <a class="" href="/user/all">
                                    Users
                                </a>
                            </li>
                            <li class="">
                                <i class="fa fa-recycle"></i> 
                                <a class="" href="#">
                                    Parties
                                </a>
                            </li>
                            <li class="">
                                <i class="fa fa-database"></i> 
                                <a class="" href="#">
                                    Data
                                </a>
                            </li>
                            <li class="">
                                <i class="fa fa-sitemap"></i> 
                                <a class="" href="#">
                                    Taxonomies
                                </a>
                            </li>
                        </ul>
                    </div>
                    
                    <div class="col-md-3">
                        <a class="user-profile pull-right" href="#"><?php echo $user->name; ?> <i class="fa fa-caret-down"></i></a>
                    </div>                    
                </div>
                
            
        </nav>
        <?php } ?>