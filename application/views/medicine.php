<body class="">
  <div class="wrapper ">
    
    <?php $this->view('navbar/left_navbar', $active_menu); ?>
    
    <div class="main-panel">
      
      <?php $this->view('navbar/top_navbar'); ?>

      <div class="content">
        <div class="container-fluid">
           <!-- SEARCH -->
        <form>
          <input name="q" type="hidden" value="search">
          <div class="row">
            <div class="col-md-8">
              <div class="form-group">
                <label class="bmd-label-floating">Nama Obat</label>
                <input name="nama_obat" type="text" class="form-control" value="<?= $this->Ternary->isset_value($filter['medicine_name']) ?>">
              </div>
            </div>

            <div class="col-md-3">
              <div class="form-group">
                <select name="kadaluarsa" class="form-control" data-style="btn btn-link">
                  <?php foreach ($constant_expired_medicine as $key => $value) { ?>
                  <option value="<?=$key?>" <?= isset($filter['expired_date']) && $key == $filter['expired_date'] ? 'selected' : '' ?> > <?= $value ?> </option>
                  <?php } ?>
                </select>
              </div>
            </div>

            <div class="col-md-1">
              <button type="submit" class="btn btn-white btn-round pull-right">
                <i class="material-icons">search</i>
                Cari
              </button>
            </div>
          </div>
        </form>


          <div class="row">
            <div class="col-md-12">
              <div class="card">
                <div class="card-header card-header-primary">
                  <div class="row">
                    <div class="col-md-6 col-6">
                      <h4 class="card-title ">Data Obat</h4>
                    </div>
                    <!-- <p class="card-category"> Here is a subtitle for this table</p> -->
                    <div class="col-md-6 col-6">
                      <button class="btn btn-add btn-sm pull-right" data-toggle="tooltip" title="Tambah Data Obat" onClick="document.location.href='<?=base_url()?>obat/tambah'">
                        <span _ngcontent-usr-c19="" class="material-icons icon-image-preview">add</span> Tambah
                      </button>
                    </div>
                  </div>
                </div>
                <div class="card-body">
                  <div class="table-responsive">
                    <table class="table">
                      <thead class=" text-primary">
                        <th>
                          Nama Obat
                        </th>
                        <th>
                          Harga
                        </th>
                        <th>
                          Satuan
                        </th>
                        <th>
                          Stok
                        </th>
                        <th>
                          Tgl Kadaluarsa
                        </th>
                        <th>
                          Deskripsi Kegunaan
                        </th>
                        <th width="140px">
                          Opsi
                        </th>
                      </thead>
                      <tbody>
                        <?php if (empty($medicine)) { ?>
                        <tr>
                          <td colspan="6" align="center">
                            Data Tidak ditemukan. Gunakan filter untuk pencarian data.
                          </td>
                        </tr>
                        <?php } ?>

                        <?php foreach($medicine as $key) { ?>
                         <tr>
                          <td>
                            <?= $key['medicine_name'] ?>
                          </td>
                           <td>
                            <?= $this->Converter->rupiah($key['price']) ?>
                          </td>
                          <td>
                            <?= $constant_unit[$key['unit']] ?>
                          </td>
                          <td>
                            <?= $key['current_stock'] ?>
                          </td>
                          <td <?= $filter['current_date'] > $key['expired_date'] ? 'bgcolor = "red"' : ''; ?> >
                            <?= $this->Converter->to_indonesia_date($key['expired_date']) ?>
                          </td>
                          <td>
                            <?= $key['description'] ?>
                          </td>
                          <td class="text-primary">
                            <button type="button" class="btn btn-warning" data-toggle="tooltip" title="Edit Data Obat" onClick="document.location.href='<?= base_url() ?>obat/detail?id=<?= $key['medicine_id'] ?>'">
                              <span _ngcontent-jkp-c19="" class="material-icons icon-image-preview">edit</span>
                            </button>
                            <button type="button" class="btn btn-danger" data-toggle="tooltip" title="Hapus Data Obat" onClick="if (!confirm('Kamu yakin ingin hapus data obat ini?')) return; document.location.href='<?= base_url() ?>obat/delete?id=<?= $key['medicine_id'] ?>&<?= $_SERVER['QUERY_STRING'] ?>'">
                              <span _ngcontent-usr-c19="" class="material-icons icon-image-preview">delete</span>
                            </button>
                          </td>
                        </tr>
                        <?php } ?>
                      </tbody>
                    </table>
                  </div>
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