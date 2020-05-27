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
          unit: medicine_record[i].unit,
          price: medicine_record[i].total_amount/medicine_record[i].dosis,
        };
        data_medicine_record.push(medicine);
      }
    }
    append_medicine();
    calculate_total_amount();

    $("#service_fee").keyup(function(){
      calculate_total_amount();
    });
  });
});

// MEDICAL RECORD
var data_medicine_record = [];
var current_medicine_index = 0;
var medicine_amount = 0;

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
    data_medicine_record.splice(ids[2], 1);
    remove_medicine();
    append_medicine();
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
    var id = '#dosis-id-' + current_medicine_index;

    data_medicine_record[current_medicine_index].dosis = this.value;
    calculate_from_dosis(this.attributes);

    remove_medicine();
    append_medicine();
    
    var num = $(id).val();        
    $(id).focus().val('').val(num);  

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
        unit: '',
        price: 0,
    };
  data_medicine_record.push(medicine);
}

function remove_medicine() {
  medicine_amount = 0;
  $('.row-medicine').remove();
}

function append_medicine() { 
  for (var i = 0; i < data_medicine_record.length; i++) {
    $( "#append-target-medicine" ).before(render_medicine_record(data_medicine_record[i], i) );
    medicine_amount = parseInt(medicine_amount) + parseInt(data_medicine_record[i].total_amount);
  }
  init_main_function();
  calculate_total_amount();
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
      price: medicine_list[i].price,
      unit: medicine_list[i].unit
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

function calculate_total_amount() {
  var service_fee = $('#service_fee').val() || 0;
  var result = parseInt(service_fee) + parseInt(medicine_amount);
  var rupiah = to_rupiah(result);
  $('#total_amount').html(rupiah);
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
    <div class="row row-medicine" id="row-medicine-list-` + id + `" style="margin-top: -15px;">
      <div class="col-md-5">
        <div class="form-group">
          <input type="text" id="medicine-name-id-` + id + `" class="form-control medicine-name" value="` + data.medicine_name + `">
          <input type="hidden" id="medicine-id-` + id + `" name="medicine_id[]" value="` + data.medicine_id + `">
          <input type="hidden" name="medicine_record_id[]" value="` + data.medicine_record_id + `">
        </div>
      </div>
      <div class="col-md-2">
        <div class="form-group">
          <input name="dosis[]" id="dosis-id-` + id + `" class="form-control dosis" type="number" price="` + data.price + `" value="` + data.dosis+ `">
        </div>
      </div>
      <div class="col-md-3">
        <div class="form-group">
          <input name="amount[]" type="number" id="amount-id-` + id + `" class="form-control" value="` + data.total_amount + `">
        </div>
      </div>
      <div class="col-md-2">
        <div class="form-group bmd-form-group">
          ` + action_button + `
        </div>
      </div>
    </div>`;

  return medicine_row;
}

function render_medicine_search(data) {
  var display_name = data.medicine_name;
  if (data.unit == '1') {
    display_name = display_name + '&nbsp<strong>(Butir)</strong>';
  } else  if (data.unit == '2') {
    display_name = display_name + '&nbsp<strong>(Strip)</strong>';
  }

  var medicine_search = `
    <a class="dropdown-item dropdown-item-medicine" price="` + data.price + `" medicine_name="` + data.medicine_name + `" medicine_id="` + data.medicine_id + `"  href="javascript:;" value=""> ` + display_name + ` </a>
  `;

  return medicine_search;
}

function to_rupiah(number) {
  var   number_string = number.toString(),
  split = number_string.split(','),
  sisa  = split[0].length % 3,
  rupiah  = split[0].substr(0, sisa),
  ribuan  = split[0].substr(sisa).match(/\d{1,3}/gi);
    
  if (ribuan) {
    separator = sisa ? '.' : '';
    rupiah += separator + ribuan.join('.');
  }
  
  rupiah = split[1] != undefined ? rupiah + ',' + split[1] : rupiah;
  return  'Rp ' + rupiah;
}