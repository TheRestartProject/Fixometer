<div class="container" id="admin-dashboard">


    <?php if(isset($response)) { ?>
    <div class="row">
        <div class="col-md-12">
            <?php printResponse($response);  ?>
        </div>
    </div>
    <?php } ?>

    <section class="row profile">
      <div clasS="col-md-12">
        <form class="form-inline" action="/search" method="get">
          <input type="hidden" name="fltr" value="<?php echo bin2hex(openssl_random_pseudo_bytes(8)); ?>">
          <div class="form-group">
            <label for="groups" class="sr-only">Groups</label>
            <select class="form-control selectpicker show-tick" data-width="150px" id="groups" name="groups[]" title="Select groups..." multiple data-live-search="true">
              <?php foreach($groups as $group){ ?>
              <option value="<?php echo $group->id; ?>"><?php echo $group->name; ?></option>
              <?php } ?>
            </select>
          </div>

          <div class="form-group">
            <label for="parties" class="sr-only">Parties</label>
            <select class="form-control selectpicker show-tick" data-width="150px" id="parties" name="parties[]" title="Select parties..." multiple data-live-search="true">
              <?php foreach($parties as $party){ ?>
              <option value="<?php echo $party->id; ?>" data-subtext="<?php echo strftime('%d/%m/%Y', $party->event_timestamp); ?>"><?php echo $party->venue; ?></option>
              <?php } ?>
            </select>
          </div>

          <div class="form-group">
            <label for="from-date" class="sr-only">From date</label>

            <div class="input-group">
              <input type="text" class="form-control date" id="from-date" name="from-date" placeholder="From date...">
              <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
            </div>
          </div>

          <div class="form-group">
            <label for="from-date" class="sr-only">To date</label>
            <div class="input-group">
              <input type="text" class="form-control date" id="to-date" name="to-date" placeholder="To date...">
              <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
            </div>
          </div>

          <div class="form-group">
            <button type="submit" class="btn btn-primary"><i class="fa fa-filter"></i> Filter</button>
          </div>
        </form>
      </div>
    </section>


    <?php if($PartyList){ ?>
      <section class="row parties">
          <header>
              <div class="col-md-12"  id="allparties">
                  <h2>
                      Filtered Party Results
                  </h2>
              </div>
          </header>




          <br />
          <div class="col-md-12" id="party-list-header">
              <div class="header-col header-col-2">&nbsp;</div>

              <div class="header-col">
                  <img src="/assets/icons/icon_pax.png" alt="Participants" class="header-icon">
                  <span class="icon-label">Participants</span>
              </div>

              <div class="header-col">
                  <img src="/assets/icons/icon_volunters.png" alt="Restarters" class="header-icon">
                  <span class="icon-label">Restarters</span>
              </div>

              <div class="header-col">
                  <img src="/assets/icons/icon_emissions.png" alt="CO2 Emissions Prevented" class="header-icon">
                  <span class="icon-label">CO<sub>2</sub> Emissions prevented</span>
              </div>

              <div class="header-col">
                  <img src="/assets/icons/icon_fixed.png" alt="Fixed" class="header-icon">
                  <span class="icon-label">Fixed</span>
              </div>

              <div class="header-col">
                  <img src="/assets/icons/icon_repairable.png" alt="Repairable" class="header-icon">
                  <span class="icon-label">Repairable</span>
              </div>

              <div class="header-col">
                  <img src="/assets/icons/icon_dead.png" alt="Dead" class="header-icon">
                  <span class="icon-label">Dead</span>
              </div>

          </div>
          <div class="col-md-12 fader" id="party-list">

              <?php
              $nodata = 0;
              $currentYear = date('Y', time());
              foreach($PartyList as $party){
                  $partyYear = date('Y', $party->event_timestamp);
                  if( $partyYear < $currentYear){
              ?>
              <div class="year-break">
                  <?php echo $partyYear; ?>
              </div>
              <?php
                      $currentYear = $partyYear;
                  }
              ?>
              <?php if($party->device_count < 1){ $nodata++; ?>
              <a class="no-data-wrap party" href="/party/manage/<?php echo $party->idevents; ?>" <?php echo ($nodata == 1 ? 'id="attention"' : ''); ?>>

                  <div class="header-col-2 header-col">
                      <div class="date">
                          <span class="month"><?php echo date('M', $party->event_timestamp); ?></span>
                          <span class="day">  <?php echo date('d', $party->event_timestamp); ?></span>
                          <span class="year"> <?php echo date('Y', $party->event_timestamp); ?></span>
                      </div>

                      <div class="short-body">
                          <span class="location"><?php echo $party->venue; ?></span>
                          <time datetime="<?php echo dbDate($party->event_date); ?>"><?php echo substr($party->start, 0, -3); ?></time>

                      </div>
                  </div>
                  <div class="header-col header-col-3">
                      <button class="btn btn-primary btn-lg add-info-btn">
                          <i class="fa fa-cloud-upload"></i> Add Information
                      </button>
                  </div>
                  <div class="header-col">
                      <span class="largetext greyed">?</span>
                  </div>

                  <div class="header-col">
                      <span class="largetext greyed">?</span>
                  </div>

                  <div class="header-col">
                      <span class="largetext greyed">?</span>
                  </div>

              </a>
              <?php } else {  ?>
              <a class=" party <?php echo ($party->guesstimates == true ? ' guesstimates' : ''); ?>"  href="/party/manage/<?php echo $party->idevents; ?>">
                  <div class="header-col header-col-2">
                      <div class="date">
                          <span class="month"><?php echo date('M', $party->event_timestamp); ?></span>
                          <span class="day">  <?php echo date('d', $party->event_timestamp); ?></span>
                          <span class="year"> <?php echo date('Y', $party->event_timestamp); ?></span>
                      </div>

                      <div class="short-body">
                          <span class="location"><?php echo $party->venue; ?></span>
                          <time datetime="<?php echo dbDate($party->event_date); ?>"><?php echo  substr($party->start, 0, -3); ?></time>

                      </div>
                  </div>

                  <div class="header-col">
                      <span class="largetext">
                          <?php echo $party->pax; ?>
                      </span>
                  </div>

                  <div class="header-col">
                      <span class="largetext">
                          <?php echo $party->volunteers; ?>
                      </span>
                  </div>

                  <div class="header-col">
                      <span class="largetext">
                           <?php echo $party->co2; ?> kg
                      </span>
                  </div>

                  <div class="header-col">
                      <span class="largetext fixed">
                          <?php echo $party->fixed_devices; ?>
                      </span>
                  </div>

                  <div class="header-col">
                      <span class="largetext repairable">
                          <?php echo $party->repairable_devices; ?>
                      </span>
                  </div>

                  <div class="header-col">
                      <span class="largetext dead">
                          <?php echo $party->dead_devices; ?>
                      </span>
                  </div>

              </a>
              <?php } ?>
          <?php } ?>
          </div>

      </section>

    <?php } ?>
</div>
