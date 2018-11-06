$(document).ready(function(){

  // $('.form-submit').click(function(){
  //   $("#filter-fields").submit();
  // });

  $('#filter-applicants').click(function(){
    var filter = [];
    $('#filter .filter-field').each(function(){
      let entry = {
        name : $(this).attr("name")
      , value: $(this).val()
      };

      filter.push(entry);
    });
    filter.push({
      name : 'age-range'
    , value: $("[name=age-range]").attr("value")
    });
    filter.push({
      name: 'filter-type'
    , value :$("[name=filter-type]").val()
    });

    $.ajax({
			type: 'POST',
			dataType: 'json',
			url: global.site_name + 'applicant/filter-applicants',
			data : filter,
      complete : function(){
      },
			success : function(result){
        if(result.length > 0){
          $('#generate-excel').show();
        }
        else{
          $('#generate-excel').hide();
        }


        let html_data = '';
        result.forEach(function(row){
          html_data += row_format(row);
        });
        $('#applicant-list tbody').html('')
        $('#applicant-list tbody').html(html_data)
        console.log(result)
				// if(result.success){
				// 	window.location.reload();
				// }
			}
		});
  });

  $('#generate-excel').click(function(){
    var filter = [];
    $('#filter .filter-field').each(function(){
      let entry = {
        name : $(this).attr("name")
      , value: $(this).val()
      };

      filter.push(entry);
    });
    filter.push({
      name : 'age-range'
    , value: $("[name=age-range]").attr("value")
    });
    filter.push({
      name: 'filter-type'
    , value :$("[name=filter-type]").val()
    });

    $.ajax({
			type: 'POST',
			dataType: 'json',
			url: global.site_name + 'applicant/generate-excel',
			data : filter,
      complete : function(){
      },
			success : function(result){
        var win = window.open(global.site_name + 'upload/spreadsheet/' + result.file_name, '_blank');
        win.focus();
			}
		});
  });

  $("[name=age-range]").ionRangeSlider({
      min: 10,
      max: 90,
      from: $("[name=age-range]").data('default').split(';')[0],
      to: $("[name=age-range]").data('default').split(';')[1],
      type: 'double',
      postfix: " years",
      maxPostfix: "+",
      prettify: true,
      hasGrid: true
  });

  $('.select2-skill').select2({
    allowClear: true,
    ajax:{
      url: global.site_name + 'reference/ref',
      dataType: 'json',
      type:'post',
      data: function(params){
          let search = $.isEmptyObject(params)? '' : params.term;
          let option = {
            columns :[
              {   "data": "st_name"
                , "searchable": true
              },
              {   "data"  : "st_id"
                , "searchable": false
              }
            ],
            search : {
              'value' : search
            , 'regex' : false
            },
            option : {
              'type' : 'skill'
            },
            length : 25

          };
          return option;
      },
      processResults: function (data) {
      // Tranforms the top-level key of the response object from 'items' to 'results'
        let result = [];
        data['data'].forEach(function(d){
          result.push({
            id  : d.st_id
          , text: d.st_name
          });
        });
        return {
          results: result
        }
      }
    }
  });


  $('#update-profile').click(function(){
    helper.button_state('#update-profile', 'loading');
    let post_data = $('form').serializeArray();

    let educ_table = [];
    $('#education-list tbody .educ-row').each(function(){
      educ_table.push(JSON.parse(decodeURIComponent($(this).data('summary'))));
    });

    post_data.push({
      name :  'educ-table'
    , value:  JSON.stringify(educ_table)
    });
    console.log(post_data)
    $.ajax({
			type: 'POST',
			dataType: 'json',
			url: global.site_name + 'applicant/save_profile',
			data : post_data,
      complete : function(){
        helper.button_state('#update-profile', 'loading');
      },
			success : function(result){
				if(result.success){
					window.location.reload();
				}
			}
		});


  });

  $('.select2-educ-fos').select2({
    allowClear: true,
    ajax:{
      url: global.site_name + 'reference/ref',
      dataType: 'json',
      type:'post',
      data: function(params){
          let search = $.isEmptyObject(params)? '' : params.term;
          let option = {
            columns :[
              {
                "name" : 'fos_name'
              , "data": "child.fos_name"
              , "searchable": true },
              { "name" : 'fos_id'
              , "data": "child.fos_id"
              , "searchable": false}
            ],
            order : [
              {
                'column' : 1,
                'dir'   : 'asc'
              }
            ],
            search : {
              'value' : search
            , 'regex' : false
            },
            option : {
              'type' : 'field-of-study'
            },
            length : 25

          };
          return option;
      },
      processResults: function (data) {
      // Tranforms the top-level key of the response object from 'items' to 'results'
        let result = [];
        data['data'].forEach(function(d){
          result.push({
            id  : d.fos_id
          , text: d.fos_name
          });
        });
        return {
          results: result
        }
      }
    }
  });


  $('.select2-school').select2({
    allowClear: true,
    ajax:{
      url: global.site_name + 'reference/ref',
      dataType: 'json',
      type:'post',
      data: function(params){
          let search = $.isEmptyObject(params)? '' : params.term;
          let option = {
            columns :[
              {   "data": "school_name"
                , "searchable": true
              },
              {   "data": "city_name"
                , "searchable": true
              },
              {   "data": "province_name"
                , "searchable": true
              },
              {   "data": "country_name"
                , "searchable": true
              },
              {   "data": "address_desc"
                , "searchable": true
              },
              {   "data"  : "school_id"
                , "searchable": false
              }
            ],
            search : {
              'value' : search
            , 'regex' : false
            },
            option : {
              'type' : 'school'
            },
            length : 25

          };
          return option;
      },
      processResults: function (data) {
      // Tranforms the top-level key of the response object from 'items' to 'results'
        let result = [];
        data['data'].forEach(function(d){
          result.push({
            id  : d.school_id
          , text: d.school_name + ' - ' + d.province_name
          });
        });
        return {
          results: result
        }
      }
    }
  });


  $('.select2-educ-attainment').select2({
    allowClear: true,
    ajax:{
      url: global.site_name + 'reference/ref',
      dataType: 'json',
      type:'post',
      data: function(params){
          let search = $.isEmptyObject(params)? '' : params.term;
          let option = {
            columns :[
              {   "data": "ea_name"
                , "searchable": true
              },
              {   "data"  : "ea_id"
                , "searchable": false
              }
            ],
            search : {
              'value' : search
            , 'regex' : false
            },
            option : {
              'type' : 'educ-attainment'
            },
            length : 25

          };
          return option;
      },
      processResults: function (data) {
      // Tranforms the top-level key of the response object from 'items' to 'results'
        let result = [];
        data['data'].forEach(function(d){
          result.push({
            id  : d.ea_id
          , text: d.ea_name
          });
        });
        return {
          results: result
        }
      }
    }
  });


  // $('.select2-educ-type').select2({
  //   dropdownParent: $("#modal-educ-type")
  // })

  $('[name=add-region]').select2({
    allowClear: true,
    ajax:{
      url: global.site_name + 'reference/ref',
      dataType: 'json',
      type:'post',
      data: function(params){
          let search = $.isEmptyObject(params)? '' : params.term;
          let option = {
            columns :[
              {
                "data": "region_code"
              , "searchable": false },
              {
                "data": "region_desc"
              , "searchable": true },
              { "data": "region_id"
              , "searchable": false}
            ],
            order : [
              {
                'column' : 2,
                'dir'   : 'asc'
              }
            ],
            search : {
              'value' : search
            , 'regex' : false
            },
            option : {
              'type' : 'region'
            },
            length : 25,
            condition:[]

          };
          option.condition.push({
              column  : 'country_id'
            , value   : '178'
          });
          return option;
      },
      processResults: function (data) {
      // Tranforms the top-level key of the response object from 'items' to 'results'
        let result = [];
        data['data'].forEach(function(d){
          result.push({
            id  : d.region_id
          , text: d.region_code + ' - ' + d.region_desc
          });
        });
        return {
          results: result
        }
      }
    }
  }).change(function(){
    if($(this).val()){
      $('[name=add-province]').select2("enable",true)
    }
    else{
      $('[name=add-province]').select2("enable",false)
    }
    $('[name=add-province]').select2("val", '');
  });

  $('[name=add-province]').select2({
    allowClear: true,
    ajax:{
      url: global.site_name + 'reference/ref',
      dataType: 'json',
      type:'post',
      data: function(params){
          let search = $.isEmptyObject(params)? '' : params.term;
          let option = {
            columns :[
              {
                "data": "province_name"
              , "searchable": true },
              {
                "data": "province_id"
              , "searchable": false }
            ],
            order : [
              {
                'column' : 1,
                'dir'   : 'asc'
              }
            ],
            search : {
              'value' : search
            , 'regex' : false
            },
            option : {
              'type' : 'province'
            },
            length : 25,
            condition:[]
          };
          option.condition.push({
              column  : 'region_id'
            , value   : $('[name=add-region]').val()
          });
          return option;
      },
      processResults: function (data) {
      // Tranforms the top-level key of the response object from 'items' to 'results'
        let result = [];
        data['data'].forEach(function(d){
          result.push({
            id  : d.province_id
          , text: d.province_name
          });
        });
        return {
          results: result
        }
      }
    }
  }).change(function(){
    if($(this).val()){
      $('[name=add-city]').select2("enable",true)
    }
    else{
      $('[name=add-city]').select2("enable",false)
    }
    $('[name=add-city]').select2("val", '');
  });

  $('[name=add-city]').select2({
    allowClear: true,
    ajax:{
      url: global.site_name + 'reference/ref',
      dataType: 'json',
      type:'post',
      data: function(params){
          let search = $.isEmptyObject(params)? '' : params.term;
          let option = {
            columns :[
              {
                "data": "city_name"
              , "searchable": true },
              {
                "data": "city_id"
              , "searchable": false }
            ],
            order : [
              {
                'column' : 0,
                'dir'   : 'asc'
              }
            ],
            search : {
              'value' : search
            , 'regex' : false
            },
            option : {
              'type' : 'city'
            },
            length : 25,
            condition:[]
          };
          option.condition.push({
              column  : 'province_id'
            , value   : $('[name=add-province]').val()
          });
          return option;
      },
      processResults: function (data) {
      // Tranforms the top-level key of the response object from 'items' to 'results'
        let result = [];
        data['data'].forEach(function(d){
          result.push({
            id  : d.city_id
          , text: d.city_name
          });
        });
        return {
          results: result
        }
      }
    }
  });



}).on("keypress", "form", function(event) {
  return event.keyCode != 13;
});


var row_format = function(data){
  let contact = data.bc_phone_num1;

  if(data.bc_phone_num2){
    contact += ' / ' + data.bc_phone_num2;
  }
  if(data.bc_phone_num3){
    contact += ' / ' + data.bc_phone_num3;
  }
  let img_src = (data.fm_encypted_name)? data.fm_encypted_name : 'emp_img_default.png'
  return  '<tr class="ribbon-content">' +
              '<td width="90">' +
                  '<div>' +
                    '<img class="img-circle img-responsive" src="' + global.site_name + 'upload/profile/' + img_src + '">' +
                  '</div>' +
              '</td>' +
              '<td class="desc">' +
                  '<h3>' +
                  '<a href="' + global.site_name + 'applicant/view_profile/' + data.user_name + '" class="text-navy">' +
                      data.bc_first_name + ' ' + data.bc_middle_name + ' ' + data.bc_last_name + ' ' + data.bc_name_ext +
                  '</a>' +
                  '</h3>' +
                  '<p class="small">' +
                      data.applicant_summary +
                  '</p>' +
                  '<dl class="small m-b-none">' +
                      '<dt>Current Address</dt>' +
                      '<dd>' + data.address_desc + ', ' + data.city_name + ' City, ' + data.province_name + '</dd>' +
                  '</dl>' +
                  '<dl class="small m-b-none">' +
                      '<dt>Contact</dt>' +
                      '<dd>' + contact +  '</dd>' +
                  '</dl>' +

                  '<div class="m-t-sm">' +
                      // <a href="#" class="text-muted"><i class="fa fa-gift"></i> Add gift package</a>
                      // |
                      // <a href="#" class="text-muted"><i class="fa fa-trash"></i> Remove item</a>
                  '</div>' +
              '</td>' +

              '<td>' +
                  // $180,00
                  // <s class="small text-muted">$230,00</s>
              '</td>' +
              '<td width="150">' +
                  // <input type="text" class="form-control" placeholder="1">
                  '<h3>' +
                    '<a class="text-navy has-tooltip" title="Print" href="' + global.site_name + 'applicant/print-resume/' + data.user_name + '"><i class="fa fa-external-link"></i></a>' +
                  '</h3>' +
                  '<div class="ribbon-content">' +
                  '<div class="ribbon base-alt"><span>Match Score <br><strong>' + ((data.match_count/data.total_matches) * 100).toFixed(2)+ '%</strong></span></div>' +
                  '</div>' +
              '</td>' +
              '<td>' +

              '</td>' +
          '</tr>';



  // return '<tr>' +
  //           '<td width="90">' +
  //               <div class="cart-product-imitation">' +
  //               </div>' +
  //           </td>' +
  //           <td class="desc">' +
  //               <h3>' +
  //               <a href="#" class="text-navy">' +
  //                   Desktop publishing software' +
  //               </a>' +
  //               </h3>' +
  //               <p class="small">' +
  //                 It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is' +
  //               </p>' +
  //               <dl class="small m-b-none">' +
  //                   <dt>Description lists</dt>' +
  //                   <dd>A description list is perfect for defining terms.</dd>' +
  //               </dl>' +
  //
  //               <div class="m-t-sm">' +
  //                   <a href="#" class="text-muted"><i class="fa fa-gift"></i> Add gift package</a>' +
  //                   |
  //                   <a href="#" class="text-muted"><i class="fa fa-trash"></i> Remove item</a>
  //               </div>
  //           </td>
  //
  //           <td>
  //               $180,00
  //               <s class="small text-muted">$230,00</s>
  //           </td>
  //           <td width="65">
  //               <input type="text" class="form-control" placeholder="1">
  //           </td>
  //           <td>
  //               <h4>
  //                   $180,00
  //               </h4>
  //           </td>
  //       </tr>
  // return  '<tr>' +
  //           '<td class="col-md-2 text-center text-capitalize">' +
  //             data.bc_first_name + ' ' + data.bc_middle_name + ' ' +
  //             data.bc_last_name + ' ' + data.bc_name_ext +
  //           '</td>' +
  //           '<td class="col-md-1 text-center text-capitalize">' + data.bc_gender + '</td>' +
  //           '<td class="col-md-1 text-center">' + moment().diff(data.applicant_birthday, 'years') + '</td>' +
  //           '<td class="col-md-2 text-center">' + contact + '</td>' +
  //           '<td class="col-md-1 text-center"></td>' +
  //           '<td class="col-md-1 text-center">' + data.bc_email_address + '</td>' +
  //           '<td class="col-md-3 text-center">' + data.address_desc + ', ' + data.city_name + ' City, ' + data.province_name + '</td>' +
  //           '<td class="col-md-1 text-center">Skillset</td>' +
  //           '<td class="col-md-1 text-center no-sort">Action</td>' +
  //         '</tr>';
}
