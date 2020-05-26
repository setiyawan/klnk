<body class="">
  <div class="wrapper ">
    
    <?php $this->view('navbar/left_navbar', $active_menu); ?>

    <div class="main-panel">

      <?php $this->view('navbar/top_navbar'); ?>
      <?php
        $unit = "";
        if (isset($medicine[0]) && $medicine[0]['unit'] != "") {
          $unit = $medicine[0]['unit'];
        }
      ?>
      
      <div class="content">
        <div class="container-fluid">
          <div class="row">
            <div class="col-md-8">
              <div class="card">
                <div class="card-header card-header-primary">
                  <div class="row">
                    <div class="col-md-6 col-6">
                      <h4 class="card-title "><?= $table_label ?></h4>
                    </div>
                    <?php if ($action == 'update') { ?>
                    <div class="col-md-6 col-6">
                      <button class="btn btn-add btn-sm pull-right" onClick="document.location.href='tambah'">
                        <span _ngcontent-usr-c19="" class="material-icons icon-image-preview">add</span> Tambah Lagi
                      </button>
                    </div>
                    <?php } ?>
                    <!-- <p class="card-category"> Here is a subtitle for this table</p> -->
                  </div>
                </div>
                <div class="card-body">
                  <form action="<?= $action ?>" method="post">
                    <input type="hidden" name="medicine_id" value="<?= isset($medicine[0]) ? $medicine[0]['medicine_id'] : '' ?>">
                    <div class="row">
                      <div class="col-md-6">
                        <div class="form-group">
                          <label class="">Nama Obat</label>
                          <input name="medicine_name" required type="text" class="form-control" value="<?= isset($medicine[0]) ? $medicine[0]['medicine_name'] : '' ?>">
                        </div>
                      </div>
                      <div class="col-md-6">
                        <div class="form-group">
                          <label class="">Tgl Kadaluarsa</label>
                          <input name="expired_date" type="date" required class="form-control" value="<?= isset($medicine[0]) ? $medicine[0]['expired_date'] : '' ?>">
                        </div>
                      </div>
                    </div>

                    <div class="row" style="padding-top: 20px;">  
                      <div class="col-md-6">
                        <div class="form-group">
                          <label class="">Harga (per satuan)</label>
                          <input name="price" type="number" required  class="form-control" value="<?= isset($medicine[0]) ? $medicine[0]['price'] : '' ?>">
                        </div>
                      </div>
                      <div class="col-md-6">
                        <div class="form-group bmd-form-group">
                          <label class="bmd-label-static">Satuan</label>
                          <select name="unit" class="form-control" data-style="btn btn-link">
                            <?php foreach ($constant_unit as $key => $value) { ?>
                            <option value="<?=$key?>" <?= $key == $unit ? 'selected' : '' ?> > <?= $value ?> </option>
                            <?php } ?>
                          </select>
                        </div>
                      </div>
                    </div>

                    <div class="row" style="padding-top: 10px;">
                      <div class="col-md-6">
                        <div class="form-group">
                          <label>Deskripsi</label>
                          <div class="form-group">
                            <textarea name="description" required class="form-control" rows="4"><?= isset($medicine[0]) ? $medicine[0]['description'] : '' ?></textarea>
                          </div>
                        </div>
                      </div>
                    </div>

                    <button type="submit" class="btn btn-primary pull-right">Submit</button>
                    <div class="clearfix"></div>
                  </form>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <?php $this->view('navbar/buttom_navbar'); ?>
    </div>
  </div>
</body>