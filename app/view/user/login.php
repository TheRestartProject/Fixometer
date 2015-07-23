
    
        <div class="login-form">
            <h1 class="text-center">FIX-O-METER</h1>
            <h3 class="text-center">login</h3>
            <p class="text-center">Welcome to our community space, where you can share upcoming Restart Parties and track their social and environmental impact. By doing so, we can empower and motivate at a local level, but also build global momentum for a change.</p>
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
                
                
                
                <div class="detail detail-chart">
                    <div id="chart-co2" class="charts">
                        <h4 class="text-center">CO<sub>2</sub> de-sequestered per year (kg)</h4>
                        <canvas id="co2ByYear" width="520" height="200"></canvas>                
                    </div>
                    <div id="chart-waste" class="charts">
                        <h4 class="text-center">eWaste prevented per year (kg)</h4>
                        <canvas id="wasteByYear" width="520" height="200"></canvas>
                    </div>
                    
                    <div class="btn-group btn-group-justified" role="group" aria-label="...">
                        <div class="btn-group">
                            <button type="button" class="btn btn-default btn-primary btn-sm switch-view active" data-family=".charts" data-target="#chart-co2">CO<sub>2</sub> de-sequestered</button>
                        </div>
                        <div class="btn-group">
                            <button type="button" class="btn btn-default btn-primary btn-sm switch-view" data-family=".charts" data-target="#chart-waste">eWaste prevented</button>            
                        </div>
                    </div>
                    <script>
                        var data_co2 = {
                            labels: ["<?php echo implode('", "', array_keys($bar_chart_stats)); ?>"],
                            datasets: [
                                {
                                label: "CO<sub>2</sub> By Year",
                                fillColor: "rgba(  3,148,166,0.5)",
                                strokeColor: "rgba(  3,148,166,0.8)",
                                highlightFill: "rgba(  3,148,166,0.75)",
                                highlightStroke: "rgba(  3,148,166,1)",
                                data: [<?php echo implode(', ', $bar_chart_stats); ?>]
                                }
                            ]
                        };
                        
                        var data_waste = {
                            labels: ["<?php echo implode('", "', array_keys($waste_bar_chart_stats)); ?>"],
                            datasets: [
                                {
                                label: "Waste By Year",
                                fillColor: "rgba(249,163, 63,0.5)",
                                strokeColor: "rgba(249,163, 63,0.8)",
                                highlightFill: "rgba(249,163, 63,0.75)",
                                highlightStroke: "rgba(249,163, 63,1)",
                                data: [<?php echo implode(', ', $waste_bar_chart_stats); ?>]
                                }
                            ]
                                
                        }
                        var opts = {
                            barValueSpacing : 20,
                            responsive: false
                        };
                        var ctx1 = document.getElementById("co2ByYear").getContext("2d");
                        var ctx2 = document.getElementById("wasteByYear").getContext("2d");
                        var theChart1 = new Chart(ctx1).Bar(data_co2, opts);
                        var theChart2 = new Chart(ctx2).Bar(data_waste, opts);
                    </script>
                </div>
                
                
                <div class="detail">
                    <h4>Devices Restarted</h4>
                    <span class="big-number">
                        <span class="big-number"><?php echo number_format($devices[0]->counter, 0, '-', ','); ?></span>
                    </span>
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