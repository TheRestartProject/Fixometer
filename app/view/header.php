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
                        <ul id="" class="nav nav-pills">
                            <li role="presentation" class="dropdown">
                                    <a class="dropdown-toggle" id="user-management-dropdown" data-toggle="dropdown" href="#" role="button" aria-expanded="false"> 
                                        <i class="fa fa-group"></i> 
                                        Users
                                    </a>
                                    <ul class="dropdown-menu" role="menu" aria-labelledby="user-management-dropdown">
                                        <li role="presentation"><a role="menuitem" tabindex="-1" href="/user/all"> User List</a></li>
                                        <li role="presentation"><a role="menuitem" tabindex="-1" href="/user/create">New User</a></li>
                                        <li role="presentation"><a role="menuitem" tabindex="-1" href="/role">Roles</a></li>
                                    </ul>
                                
                            </li>
                            <li class="">
                                
                                <a class="" href="/party">
                                    <i class="fa fa-recycle"></i> Parties
                                </a>
                            </li>
                            <li class="">
                                
                                <a class="" href="#">
                                    <i class="fa fa-database"></i> Data
                                </a>
                            </li>
                            <li class="">
                                 
                                <a class="dropdown-toggle" id="taxonomies-dropdown" data-toggle="dropdown" href="#" role="button" aria-expanded="false">
                                   <i class="fa fa-sitemap"></i> Taxonomies
                                </a>
                                
                                <ul class="dropdown-menu" role="menu" aria-labelledby="taxonomies-dropdown">
                                    <li role="presentation"><a role="menuitem" tabindex="-1" href="/group"> Groups</a></li>
                                    <li role="presentation"><a role="menuitem" tabindex="-1" href="">Categories</a></li>
                                    
                                </ul>
                            </li>
                        </ul>
                    </div>
                    
                    <div class="col-md-2 col-md-offset-1">
                        
                        <div class="dropdown">
                            
                            <button style="margin-top: 10px;" class="btn btn-primary dropdown-toggle" id="user-profile-dropdown" data-toggle="dropdown" aria-expanded="true"><?php echo $user->name; ?> <i class="fa fa-caret-down"></i></button>
                            
                            <ul class="dropdown-menu" role="menu" aria-labelledby="user-profile-dropdown">
                              <li role="presentation"><a role="menuitem" tabindex="-1" href="/user/logout"><i class="fa fa-sign-out"></i> Logout</a></li>
                              <li role="presentation"><a role="menuitem" tabindex="-1" href="#">Another action</a></li>
                              <li role="presentation"><a role="menuitem" tabindex="-1" href="#">Something else here</a></li>
                              <li role="presentation"><a role="menuitem" tabindex="-1" href="#">Separated link</a></li>
                            </ul>
                          </div>
                        
                    </div>                    
                </div>
                
            
        </nav>
        <?php } ?>