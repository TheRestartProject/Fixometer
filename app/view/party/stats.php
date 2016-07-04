                    
                    <div class="data <?php echo isset($class) && $class === 'wide' ? 'wide' : 'regular'; ?>">
                        <div class="stat double">
                            <div class="col">
                                <i class="fa fa-group"></i>
                                <span class="subtext">participants</span>
                            </div>
                            <div class="col">
                                <?php echo $party->pax; ?>    
                            </div>
                        </div>
                        
                        <div class="stat double">
                            <div class="col">
                                <img class="" alt="The Restart Project: Logo" src="/assets/images/logo_mini.png">
                                <span class="subtext">restarters</span>
                            </div>
                            <div class="col"><?php echo $party->volunteers; ?></div>                            
                        </div>
                        
                        <div class="stat">                            
                            <div class="footprint">
                                <?php echo $party->co2; ?>
                                <span class="subtext">kg of CO<sub>2</sub></span>
                                <br />
                                <?php echo number_format($party->ewaste, 0); ?>
                                <span class="subtext">kg of waste<span>
                            </div>
                        </div>
                        
                        <div class="stat fixed">
                            <div class="col"><i class="status mid fixed"></i></div>
                            <div class="col"><?php echo $party->fixed_devices; ?></div>    
                        </div>
                        
                        <div class="stat repairable">
                            <div class="col"><i class="status mid repairable"></i></div>
                            <div class="col"><?php echo $party->repairable_devices; ?></div>
                        </div>
                        
                        <div class="stat dead">
                            <div class="col"><i class="status mid dead"></i></div>
                            <div class="col"><?php echo $party->dead_devices; ?></div>
                        </div>
                        
                    </div>
                </div>