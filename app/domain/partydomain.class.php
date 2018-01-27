<?php

class PartyDomain
{
    public function calculateStatistics($averageCo2PerKilo, $displacementRatio)
    {
        $this->co2 = 0;
        $this->fixed_devices = 0;
        $this->repairable_devices = 0;
        $this->dead_devices = 0;
        $this->ewaste = 0;

        foreach ($this->devices as $device)
        {
            switch($device->repair_status)
            {
                case DEVICE_FIXED:
                    $deviceCo2 = (!empty($device->estimate) && $device->category == 46 ? ($device->estimate * $averageCo2PerKilo) : $device->footprint);
                    $deviceEwaste = (!empty($device->estimate) && $device->category == 46  ? $device->estimate : $device->weight);

                    $this->co2 += $deviceCo2;
                    $this->ewaste += $deviceEwaste;

                    $this->fixed_devices++;
                    break;
                case DEVICE_REPAIRABLE:
                    $this->repairable_devices++;
                    break;
                case DEVICE_DEAD:
                    $this->dead_devices++;
                    break;
            }
        }

        $this->co2 = $this->co2 * $displacementRatio;
    }
}
