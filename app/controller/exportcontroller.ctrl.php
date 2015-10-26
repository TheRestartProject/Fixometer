<?php

    class ExportController extends Controller {
        
        
        public function devices(){
                
            $Device = new Device;
            
            $data = $Device->export();
            foreach($data as $i => $d){
                
                /** Fix date **/
                $data[$i]['event_date'] = date('d/m/Y', $d['event_timestamp']);
                unset($data[$i]['event_timestamp']);
                /** Readable status **/
                switch($d['repair_status']) {
                    case 1:
                        $data[$i]['repair_status'] = 'Fixed';
                        break;
                    case 2:
                        $data[$i]['repair_status'] = 'Repairable';
                        break;
                    case 3:
                        $data[$i]['repair_status'] = 'End of life';
                        break;
                }
                
                /** Spare parts parser **/
                $data[$i]['spare_parts'] = ($d['spare_parts'] == 1 ? 'Yes' : 'No');
                
                /** clean up linebreaks and commas **/
                $data[$i]['problem'] = '"' . preg_replace( "/\r|\n/", "", $d['problem']) . '"' ;
                $data[$i]['location'] = '"' . preg_replace( "/\r|\n/", "", $d['location']) . '"' ;
                
            }
            $header = array(
                        array(
                            'Category',
                            'Comments',
                            'Repair Status',
                            'Spare parts (needed/used)',
                            'Restart Party Location',
                            'Restart Group',
                            'Restart Party Date'
                            )
                        );
            $data = array_merge($header, $data);
            
            $this->set('data', $data); 
        }
        
    }