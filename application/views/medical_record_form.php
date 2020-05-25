<body class="">
  <div class="wrapper ">
    
    <?php $this->view('navbar/left_navbar', $active_menu); ?>

    <?php
      $conscious = "";
       if (isset($medical_record[0]) && $medical_record[0]['conscious'] != "") {
        $conscious = $medical_record[0]['conscious'];
      }
      
      $patient_name = "";
      if (isset($medical_record[0]) && $medical_record[0]['patient_name'] != "") {
        $patient_name = $medical_record[0]['patient_name'];
      } elseif (isset($default_value['patient_name'])) {
        $patient_name = $default_value['patient_name'];
      }

      $patient_id = "";
      if (isset($medical_record[0]) && $medical_record[0]['patient_id'] != "") {
        $patient_id = $medical_record[0]['patient_id'];
      } if (isset($default_value['patient_id'])) {
        $patient_id = $default_value['patient_id'];
      }

      $birth_date = "";
      if (isset($medical_record[0]) && $medical_record[0]['birth_date'] != "") {
        $birth_date = $medical_record[0]['birth_date'];
      } if (isset($default_value['birth_date'])) {
        $birth_date = $default_value['birth_date'];
      }


      $visit_date_time = isset($medical_record[0]) ? $medical_record[0]['visit_date_time'] : date("Y-m-d h:i:s");

    ?>

    <div class="main-panel">

      <?php $this->view('navbar/top_navbar'); ?>

            <!-- form -->
      <div class="content">
        <form action="<?= $action ?>" method="post">
          <div class="container-fluid">
            <div class="row">
              <div class="col-md-7">
                <div class="card">
                  <div class="card-header card-header-primary">
                    <h4 class="card-title"><?= $table_label ?></h4>
                    <!-- <p class="card-category">Complete your profile</p> -->
                  </div>
                  <div class="card-body">
                      <input type="hidden" name="medical_record_id" value="<?= isset($medical_record[0]) ? $medical_record[0]['medical_record_id'] : '' ?>">
                      <input type="hidden" name="patient_id" value="<?= $patient_id ?>">
                      <div class="row">
                        <div class="col-md-6">
                          <div class="form-group">
                            <label class="">Nama</label>
                            <input type="text" class="form-control" disabled value="<?= $patient_name?>">
                          </div>
                        </div>
                        <div class="col-md-6">
                          <div class="form-group">
                            <label class="">Usia</label>
                            <input type="text" disabled class="form-control" disabled value="<?= $this->Converter->birth_date_to_age($birth_date) ?>">
                          </div>
                        </div>
                      </div>

                      <div class="row" style="padding-top: 20px;">
                        <div class="col-md-6">
                          <div class="form-group">
                            <label class="">Tanggal Kunjungan</label>
                            <input name="visit_date_time" class="form-control" disabled value="<?= $this->Converter->to_indonesia_timestamp($visit_date_time) ?>">
                          </div>
                          <div class="form-group">
                            <label class="">Tingkat Kesadaran</label>
                            <select name="conscious" class="form-control" data-style="btn btn-link">
                              <?php foreach ($constant_conscious as $key => $value) { ?>
                              <option value="<?=$key?>" <?= $key == $conscious ? 'selected' : '' ?> > <?= $value ?> </option>
                              <?php } ?>
                            </select>
                          </div>
                        </div>
                        <div class="col-md-6">
                          <div class="form-group bmd-form-group">
                            <label class="bmd-label-static">Keluhan Utama</label>
                            <div class="form-group">
                              <textarea name="symptom" class="form-control" rows="5"><?= isset($medical_record[0]) ? $medical_record[0]['symptom'] : '' ?></textarea>
                            </div>
                          </div>
                        </div>
                      </div>

                      <div class="row" style="padding-top: 20px;">  
                        <div class="col-md-6">
                          <div class="form-group">
                            <label class="">Tekanan Darah (mmHg)</label>
                            <input name="blood_pressure" type="text" class="form-control" value="<?= isset($medical_record[0]) ? $medical_record[0]['blood_pressure'] : '' ?>">
                          </div>
                        </div>
                        <div class="col-md-6">
                          <div class="form-group">
                            <label class="">Suhu Tubuh (<span>&#8451;</span>)</label>
                            <input name="body_temperature" type="number" class="form-control" value="<?= isset($medical_record[0]) ? $medical_record[0]['body_temperature'] : '' ?>">
                          </div>
                        </div>
                      </div>

                      <div class="row" style="padding-top: 20px;">
                        <div class="col-md-6">
                          <div class="form-group">
                            <label class="">Detak Jantung (per menit)</label>
                            <input name="pulse" type="number" class="form-control" value="<?= isset($medical_record[0]) ? $medical_record[0]['pulse'] : '' ?>">
                          </div>
                        </div>
                        <div class="col-md-6">
                        <div class="form-group bmd-form-group">
                            <label class="bmd-label-static">Pernapasan (per menit)</label>
                            <input name="respiration" type="number" class="form-control" value="<?= isset($medical_record[0]) ? $medical_record[0]['respiration'] : '' ?>">
                          </div>                       
                        </div>
                      </div>

                      <div class="row" style="padding-top: 20px;">
                        <div class="col-md-6">
                          <div class="form-group">
                            <label class="">Tinggi Badan (cm)</label>
                            <input name="height" type="number" class="form-control" value="<?= isset($medical_record[0]) ? $medical_record[0]['height'] : '' ?>">
                          </div>
                        </div>
                        <div class="col-md-6">
                          <div class="form-group">
                            <label class="bmd-label-static">Berat Badan (kg)</label>
                            <input name="weight" type="number" class="form-control" value="<?= isset($medical_record[0]) ? $medical_record[0]['weight'] : '' ?>">
                          </div>                       
                        </div>
                      </div>

                      <div class="row" style="padding-top: 10px;">
                        <div class="col-md-6">
                          <div class="form-group">
                            <label>Hasil lab</label>
                            <div class="form-group">
                              <textarea name="lab_result" class="form-control" rows="3"><?= isset($medical_record[0]) ? $medical_record[0]['lab_result'] : '' ?></textarea>
                            </div>
                          </div>
                        </div>
                        <div class="col-md-6">
                          <div class="form-group">
                            <label>Diagnosa</label>
                            <div class="form-group">
                              <textarea name="diagnosis" class="form-control" rows="3"><?= isset($medical_record[0]) ? $medical_record[0]['diagnosis'] : '' ?></textarea>
                            </div>
                          </div>
                        </div>
                      </div>

                      <div class="row" style="padding-top: 10px;">
                        <div class="col-md-6">
                          <div class="form-group">
                            <label>Terapi</label>
                            <div class="form-group">
                              <textarea name="therapy" class="form-control" rows="3"><?= isset($medical_record[0]) ? $medical_record[0]['therapy'] : '' ?></textarea>
                            </div>
                          </div>
                        </div>
                        <div class="col-md-6">
                          <div class="form-group">
                            <label>KIE</label>
                            <div class="form-group">
                              <textarea name="patient_education" class="form-control" rows="3"><?= isset($medical_record[0]) ? $medical_record[0]['patient_education'] : '' ?></textarea>
                            </div>
                          </div>
                        </div>
                      </div>
                      <div class="clearfix"></div>
                  </div>
                </div>
              </div>

              <div class="col-md-5">
                <div class="card">
                  <div class="card-header card-header-primary">
                    <h4 class="card-title">Obat</h4>
                    <!-- <p class="card-category">Complete your profile</p> -->
                  </div>
                  <div class="card-body" id="card-body-medicine">
                      <div id="append-target-medicine"></div>
                      <div id="dropdown-medicine-list" class="dropdown-menu" aria-labelledby="dropdownMenuButton" style="margin-top: -80px; margin-left: 20px;">
                      </div>
                      <button type="submit" class="btn btn-primary pull-right">Submit</button>
                      <div class="clearfix"></div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </form>
      </div>
      <?php $this->view('navbar/buttom_navbar'); ?>
    </div>
  </div>
</body>
<script>
    var medicine_record = <?php echo json_encode($medicine_record); ?>;
    var medicine_list = <?php echo json_encode($medicine); ?>;
</script>