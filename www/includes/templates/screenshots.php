<div class="row">
            <div class="col-md-12">
              <!-- The time line -->
              <ul class="timeline">
            <!-- timeline time label -->
                <li class="time-label">
                  <span class="bg-red">
                    <?=$data["ip"] ?>
                  </span>
                </li>
                <!-- /.timeline-label -->
    
                <!-- timeline item -->
                <li>
                  <i class="fa fa-camera-retro bg-purple"></i>
                  <div class="timeline-item">
                    <span class="time"><i class="fa fa-clock-o"></i> <?=time_elapsed_string($data["time"]) ?></span>
                    <h3 class="timeline-header"><a href="<?=$data["website"] ?>"><?=$data["website"] ?></a> captured! | To view image in full resolution  click <a href="<?=$config["path"] ?>capture/scr/<?=$data["image_id"] ?>.png" target="_blank">here</a></h3>
                    <div class="timeline-body">
                      <img class="margin" width="1000" alt="..." src="<?=$config["path"] ?>capture/scr/<?=$data["image_id"] ?>.png">
                    </div>
                  </div>
                </li>
                <!-- END timeline item -->
                <li>
                  <i class="fa fa-clock-o bg-gray"></i>
                </li>
              </ul>
            </div><!-- /.col -->
          </div>