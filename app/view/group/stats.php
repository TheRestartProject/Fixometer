            <div id="group-main-stats">
                <div class="col">
                    <h5>participants</h5>
                    <span class="largetext"><?php echo $pax; ?></span>
                </div>
                
                <div class="col">
                    <h5>hours volunteered</h5>
                    <span class="largetext"><?php echo $hours; ?></span>
                </div>
                
                <div class="col">
                    <h5>parties thrown</h5>
                    <span class="largetext"><?php echo count($allparties); ?></span>
                </div>
                
                <div class="col">
                    <h5>waste prevented</h5>
                    <?php
                        $sum = 0;
                        foreach($waste_year_data as $y){
                            $sum += $y->waste;
                        }
                    ?>
                    <span class="largetext">
                        <?php echo number_format(round($sum), 0, '.', ','); ?> kg 
                    </span>
                </div>
                
                <div class="col">
                    <h5>CO<sub>2</sub> emission prevented</h5>
                    <?php
                        $sum = 0;
                        foreach($year_data as $y){
                            $sum += $y->co2;
                        }
                    ?>
                    <span class="largetext"><?php echo number_format(round($sum), 0, '.', ','); ?> kg</span>
                </div>
                
            </div>