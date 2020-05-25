$(document).ready(function() {
  $().ready(function() {
    
    if (medicine_record.length < 1) {
      add_default_medicine();
    } else {
      for (var i = 0; i < medicine_record.length; i++) {
        var medicine = {
          medicine_name: medicine_record[i].medicine_name,
          medicine_record_id: medicine_record[i].medicine_record_id,
          medicine_id: medicine_record[i].medicine_id,
          total_amount: medicine_record[i].total_amount,
          dosis: medicine_record[i].dosis,
          price: medicine_record[i].total_amount/medicine_record[i].dosis,
        };
        data_medicine_record.push(medicine);
      }
    }

    append_medicine();

  });
});
// MEDICAL RECORD
var data_medicine_record = [];
var current_medicine_index = 0;

function init_main_function() {
  $(".icon-medicine-add").click(function(){
    add_default_medicine();
    remove_medicine();
    append_medicine();
  });

  $(".icon-medicine-delete").click(function(){
    var str = this.id;
    var ids = str.split('-');
    var id_medicine_class = '#' + 'row-medicine-list-' + ids[2];
    $(id_medicine_class).remove();
    data_medicine_record.splice(ids[2], 1);
  });

  $(".medicine-name").keyup(function(){
    remove_medicine_search();
    append_medicine_search(this.value);

    var index = this.id;
    ids =  index.split('-');
    current_medicine_index = ids[3];
  });

  $(".dosis").change(function(){
    var index = this.id;
    ids =  index.split('-');
    current_medicine_index = ids[2];

    data_medicine_record[current_medicine_index].dosis = this.value;
    calculate_from_dosis(this.attributes);

    remove_medicine();
    append_medicine();
  });

  $(".dropdown-item-medicine").click(function(){
    calculate_from_medicine_name(this.attributes);
    remove_medicine();
    append_medicine();
    $('#dropdown-medicine-list').removeClass('show');
  });
}

function add_default_medicine() {
  var medicine = {
        medicine_name: '',
        medicine_record_id: '',
        medicine_id: '',
        total_amount: 0,
        dosis: '',
        price: 0,
    };
  data_medicine_record.push(medicine);
}

function remove_medicine() {
  $('.row-medicine').remove();
}

function append_medicine() { 
  for (var i = 0; i < data_medicine_record.length; i++) {
    $( "#append-target-medicine" ).before(render_medicine_record(data_medicine_record[i], i) );
  }
  init_main_function();
}

function remove_medicine_search() {
  $('.dropdown-item-medicine').remove();
}

function append_medicine_search(keyword) {
  var found = false;
  for (var i = 0; i < medicine_list.length; i++) {
    var medicine = {
      medicine_name: medicine_list[i].medicine_name,
      medicine_id: medicine_list[i].medicine_id,
      price: medicine_list[i].price
    };

    if (medicine.medicine_name.toLocaleLowerCase().includes(keyword.toLocaleLowerCase())) {
      $('#dropdown-medicine-list').append(render_medicine_search(medicine));
      found = true;
    }
  }

  if (found) {
    $('#dropdown-medicine-list').addClass('show');
  } else {
    $('#dropdown-medicine-list').removeClass('show');
  }

  init_main_function();
}

function calculate_from_medicine_name(attr) {
  data_medicine_record[current_medicine_index].medicine_id = attr.medicine_id.value;
  data_medicine_record[current_medicine_index].medicine_name = attr.medicine_name.value;
  data_medicine_record[current_medicine_index].price = attr.price.value;
  data_medicine_record[current_medicine_index].total_amount = attr.price.value * data_medicine_record[current_medicine_index].dosis;
}

function calculate_from_dosis(attr) {
  data_medicine_record[current_medicine_index].price = attr.price.value;
  data_medicine_record[current_medicine_index].total_amount = attr.price.value * data_medicine_record[current_medicine_index].dosis;
}

function render_medicine_record(data, id) {
  var action_button = '';
  if (id == data_medicine_record.length-1) {
    action_button = `<i class="material-icons icon-medicine-add" id="medicine-add-` + id + `" style="padding-top: 10px; cursor:pointer;">add</i>`;
  } else {
    action_button = `<i class="material-icons icon-medicine-delete" id="medicine-delete-` + id + `" style="padding-top: 10px; cursor:pointer;">delete</i>`;
  }

  var medicine_row = ` 
    <div class="row row-medicine" id="row-medicine-list-` + id + `">
      <div class="col-md-5">
        <div class="form-group">
          <label class="">Nama Obat</label>
          <input type="text" id="medicine-name-id-` + id + `" class="form-control medicine-name" value="` + data.medicine_name + `">
          <input type="hidden" id="medicine-id-` + id + `" name="medicine_id[]" value="` + data.medicine_id + `">
          <input type="hidden" name="medicine_record_id[]" value="` + data.medicine_record_id + `">
        </div>
      </div>
      <div class="col-md-2">
        <div class="form-group">
          <label class="">Jumlah</label>
          <input name="dosis[]" id="dosis-id-` + id + `" class="form-control dosis" type="number" price="` + data.price + `" value="` + data.dosis+ `">
        </div>
      </div>
      <div class="col-md-3">
        <div class="form-group">
          <label class="">Harga</label>
          <input name="amount[]" id="amount-id-` + id + `" class="form-control" value="` + data.total_amount + `">
        </div>
      </div>
      <div class="col-md-2">
        <div class="form-group bmd-form-group">
          <label class="bmd-label-static">Opsi</label>
          ` + action_button + `
        </div>
      </div>
    </div>`;

  return medicine_row;
}

function render_medicine_search(data) {
  var medicine_unit = '';
  if (data.unit == 1) {
    medicine_unit = 'Butir';
  } else  if (data.unit == 2) {
    medicine_unit = 'Strip';
  }

  var medicine_search = `
    <a class="dropdown-item dropdown-item-medicine" price="` + data.price + `" medicine_name="` + data.medicine_name + `" medicine_id="` + data.medicine_id + `"  href="javascript:;" value="12"> ` + data.medicine_name + ` </a>
  `;

  return medicine_search;
}