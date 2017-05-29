<?php

  class Search extends Model {

    public function parties($list = array(), $groups = array(), $from = null, $to = null){
      $conditions = array();

      $sql .= 'SELECT
                *,
                `e`.`location` AS `venue`,
                UNIX_TIMESTAMP( CONCAT(`e`.`event_date`, " ", `e`.`start`) ) AS `event_timestamp`
              FROM `events` AS `e`

              INNER JOIN `groups` as `g` ON `e`.`group` = `g`.`idgroups`

              LEFT JOIN (
                SELECT COUNT(`dv`.`iddevices`) AS `device_count`, `dv`.`event`
                FROM `devices` AS `dv`
                GROUP BY  `dv`.`event`
              ) AS `d` ON `d`.`event` = `e`.`idevents`
              WHERE 1=1 ';



      if(!empty($list)){
        $conditions[] = ' `e`.`idevents` IN (' . implode(', ', $list). ') ' ;
      }

      //        TIMESTAMP(`e`.`event_date`, `e`.`start`) >= NOW() '; // added one day to make sure it only gets moved to the past the next day


      if(!is_null($groups)){
          $conditions[] = ' `e`.`group` IN (' . implode(', ', $groups) . ') ';
      }
      if(!is_null($from)){
        $conditions[] = ' UNIX_TIMESTAMP(`e`.`event_date`) >= ' . $from ;
      }
      if(!is_null($to)){
        $conditions[] = ' UNIX_TIMESTAMP(`e`.`event_date`) <= ' . $to ;
      }
      if(!empty($conditions)) {
        $sql .= ' AND ' . implode(' AND ', $conditions);
      }
      $sql .= ' ORDER BY `e`.`event_date` DESC';
      
      $stmt = $this->database->prepare($sql);
      $stmt->execute();

      $parties = $stmt->fetchAll(PDO::FETCH_OBJ);


      $devices = new Device;
      foreach($parties as $i => $party){
        $parties[$i]->devices = $devices->ofThisEvent($party->idevents);
      }


      return $parties;

    }

   }
