<?php

  class SearchController extends Controller {

    public function __construct($model, $controller, $action){
        parent::__construct($model, $controller, $action);

        $Auth = new Auth($url);
        if(!$Auth->isLoggedIn() && $action != 'stats'){
            header('Location: /user/login');
        }
        else {

            $user = $Auth->getProfile();
            $this->user = $user;
            $this->set('user', $user);
            $this->set('header', true);


            if(hasRole($this->user, 'Host')){
                $User = new User;
                $this->set('profile', $User->profilePage($this->user->id));
            }
        }
    }

    public function index($response = null){
        /** Init all needed classes **/
        $Groups = new Group;
        $Parties = new Party;
        $this->set('title', 'Filter Stats');


        /** Get default data for the search dropdowns **/
        if(hasRole($this->user, 'Administrator')){
          $groups = $Groups->findList();
          $parties = $Parties->findAll();
          foreach( $parties as $i => $party ) {
            $parties[$i]->venue = $party->location;
          }
        }

        elseif(hasRole($this->user, 'Host')) {
          $groups =   $Groups->ofThisUser($this->user->id);
          $groupIds = array();
          foreach( $groups as $i => $group ) {
            $groups[$i]->id = $group->idgroups;
            $groupIds[] = $group->idgroups;
          }

          $parties =  $Parties->ofTheseGroups($groupIds);

          foreach( $parties as $i => $party ) {
            $parties[$i]->id = $party->idevents;
          }
        }


        $this->set('parties', $parties);
        $this->set('groups', $groups);

        if(isset($_GET['fltr']) && !empty($_GET['fltr'])) {
          $searched_groups = null;
          $searched_parties = null;
          $toTimeStamp = null;
          $fromTimeStamp = null;

          /** collect params **/
          if(isset($_GET['groups'])){
            $searched_groups = filter_var_array($_GET['groups'], FILTER_SANITIZE_NUMBER_INT);
          }

          if(isset($_GET['parties'])){
            $searched_parties = filter_var_array($_GET['parties'], FILTER_SANITIZE_NUMBER_INT);
          }

          if(isset($_GET['from-date']) && !empty($_GET['from-date'])){
            if (!DateTime::createFromFormat('d/m/Y', $_GET['from-date'])) {
              $response['danger'] = 'Invalid "from date"';
              $fromTimeStamp = null;
            }
            else {
              $fromDate = DateTime::createFromFormat('d/m/Y', $_GET['from-date']);
              $fromTimeStamp = strtotime($fromDate->format('Y-m-d'));
            }
          }

          if(isset($_GET['to-date']) && !empty($_GET['to-date'])){
            if (!DateTime::createFromFormat('d/m/Y', $_GET['to-date'])) {
              $response['danger'] = 'Invalid "to date"';
            }
            else {
              $toDate = DateTime::createFromFormat('d/m/Y', $_GET['to-date']);
              $toTimeStamp = strtotime($toDate->format('Y-m-d'));
            }
          }

          $PartyList = $this->Search->parties($searched_parties, $searched_groups, $fromTimeStamp, $toTimeStamp);

          $this->set('PartyList', $PartyList);
        }

        if(!is_null($response)){
            $this->set('response', $response);
        }

    }
  }
