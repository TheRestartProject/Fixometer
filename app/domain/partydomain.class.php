<?php

class PartyDomain
{
    public function calculateStatistics($averageCo2PerKilo, $displacementRatio)
    {
        $this->co2 = 0;
        $this->ewaste = 0;

        $this->fixed_devices = 0;
        $this->repairable_devices = 0;
        $this->dead_devices = 0;

        $this->hours_volunteered = $this->calculateHoursVolunteered();

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

            if($device->category == 46)
            {
                $this->guesstimates = true;
            }
        }

        $this->co2 = $this->co2 * $displacementRatio;
    }

    public function calculateHoursVolunteered()
    {
        $assumedHostVolunteerHours = 9;
        $assumedPartyHours = 3;
        $estimatedVolunteersHours = 12;

        $volunteersHours = 0;
        if ($this->volunteers > 0)
        {
            $volunteersHours = $this->volunteers * $assumedPartyHours;
        }
        else
        {
            $volunteersHours = $estimatedVolunteersHours;
        }

        return $assumedHostVolunteerHours + $volunteersHours;
    }

    public function getPartyName()
    {
        if ($this->venue)
            return $this->venue;
        else
            return $this->location;
    }
}
