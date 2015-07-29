<div class="row">

            <div class="col-xs-12">
              <div class="box box-solid">
                <div class="box-header with-border">
                  <i class="fa fa-keyboard-o"></i>
                  <h3 class="box-title"><?=$data["info"]["website"] ?> <span class="badge bg-red"><?=$data["info"]["ip"] ?></span></h3>
                </div><!-- /.box-header -->
                <div class="box-body">
                  <dl class="dl-horizontal">
                    <dt>Field Name</dt>
                    <dd><b>Value</b></dd>

<? foreach ($data["data"] as $key => $value) {  ?>                    
                    <dt><p class="text-light-blue"><?=$value["field_name"] ?></p></dt>
                    <dd><p class="text-green"><b><?=keylog_output($value["keylog_data"]) ?></b></p></dd>
<? } ?>
                  </dl>
                </div><!-- /.box-body -->
              </div><!-- /.box -->
            </div>

          </div>