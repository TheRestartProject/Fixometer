<?php

class ApiController extends Controller {

    public function homepage_data() {
        $result = array();

        $Party = new Party;
        $Device = new Device;
        $averageCo2PerKilo = $Device->getWasteEmissionRatio();

        $allparties = $Party->ofThisGroup('admin', true, true);

        $participants = 0;
        $hours_volunteered = 0;


        foreach($allparties as $i => $party){
            $party->calculateStatistics($averageCo2PerKilo, $Device->displacement);

            $participants += $party->pax;
            $hours_volunteered += $party->hours_volunteered;
        }

        $impactStats = $Device->getWeights();

        $result[hours_volunteered] = $hours_volunteered;
        $result[items_fixed] = $Device->statusCount()[0]->counter;
        $result[weights] = $impactStats[0]->total_weights;

        echo json_encode($result);
    }
}

?>