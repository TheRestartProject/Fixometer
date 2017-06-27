/** Select picker defaults **/

$.fn.selectpicker.Constructor.DEFAULTS.iconBase = 'fa';
$.fn.selectpicker.Constructor.DEFAULTS.tickIcon = 'fa-check';

$(document).ready(function(){

  $('.selectpicker, .category-select').selectpicker({
    iconBase: 'fa',
    tickIcon: 'fa-check'
  });

  $('button[type=reset]').click(function(e){
    $($(this).data('form')).find('.selectpicker').val('default').selectpicker('refresh');
  });

  /** Add Device Row in Party Management **/
  $('#add-device').click(function(e){
      e.preventDefault();
      var rows = $('#device-table > tbody > tr').length,
          categories = null,
          restarters = null,
          n = rows + 1;

      $.ajax({
          async: false,
          url: '/ajax/category_list',
          data: {},
          dataType: "html",
          success: function(r){
              categories = r;
          }
      });



      var tablerow =  '<tr class="newdevice">' +
                          '<td>' + n + '.</td>'+
                          '<td>' +
                              '<div class="form-group">' +
                                  '<select id="device[' + n +'][category]" name="device[' + n + '][category]" class="category-select  form-control" data-live-search="true" tite="Choose category...">' +
                                  '<option></option>' +
                                  categories +
                                  '<option value="46">None of the above...</option>' +
                                  '</select>' +
                              '</div>' +
                              '<div class="form-group hide estimate-box">' +
                                  '<small>Please input an estimate weight (in kg)</small>' +
                                  '<input type="text" name="device[' + n +'][estimate]" id="device[' + n +'][estimate]" class="form-control" placeholder="Estimate...">' +
                              '</div>' +
                          '</td>' +
                          '<td>' +
                              '<textarea class="form-control" id="device[' + n +'][problem]" name="device[' + n +'][problem]"></textarea>' +
                          '</td>' +
                          '<td>' +
                              '<div class="form-group">' +
                                  '<input type="text" name="device[' + n +'][brand]" id="device[' + n +'][brand]" class="form-control" placeholder="Brand...">' +
                              '</div>' +

                              '<div class="form-group">' +
                                  '<input type="text" name="device[' + n +'][model]" id="device[' + n +'][model]" class="form-control" placeholder="Model...">' +
                              '</div>' +
                          '</td>' +
                          '<td>' +
                              '<div class="form-group">' +
                                  '<div class="radio">' +
                                      '<label>' +
                                          '<input type="radio" name="device[' + n +'][repair_status]" id="device[' + n +'][repair_status_1]" value="1" checked> Fixed' +
                                      '</label>' +
                                  '</div>' +
                                  '<div class="radio">' +
                                      '<label>' +
                                          '<input type="radio" class="repairable" data-target-details="#repairable-details[' + n +']" name="device[' + n +'][repair_status]" id="device[' + n +'][repair_status_2]" value="2"> Repairable' +
                                      '</label>' +
                                  '</div>' +
                                  '<div id="repairable-details[' + n +']" class="repairable-details">' +
                                      '<div class="checkbox">' +
                                          '<label>' +
                                              '<input type="checkbox" name="device[' + n +'][more_time_needed]" id="device[' + n +'][more_time_needed]" value="1"> More time needed' +
                                          '</label>' +
                                      '</div>' +
                                      '<div class="checkbox">' +
                                          '<label>' +
                                              '<input type="checkbox" name="device[' + n +'][professional_help]" id="device[' + n +'][professional_help]" value="1"> Professional help' +
                                          '</label>' +
                                      '</div>' +
                                      '<div class="checkbox">' +
                                          '<label>' +
                                              '<input type="checkbox" name="device[' + n +'][do_it_yourself]" id="device[' + n +'][do_it_yourself]" value="1"> Do it yourself' +
                                          '</label>' +
                                      '</div>' +
                                  '</div>' +
                                  '<div class="radio">' +
                                      '<label>' +
                                          '<input type="radio" name="device[' + n +'][repair_status]" id="device[' + n +'][repair_status_3]" value="3"> End of lifecycle' +
                                      '</label>' +
                                  '</div>' +
                              '</div>' +
                          '</td>' +
                          '<td>' +
                              '<div class="form-group">' +
                                  '<div class="checkbox">' +
                                      '<label>' +
                                          '<input type="hidden" name="device[' + n +'][spare_parts]" id="device[' + n +'][spare_parts_2]" value="2">' +
                                          '<input type="checkbox" name="device[' + n +'][spare_parts]" id="device[' + n +'][spare_parts_1]" value="1"> Yes' +
                                      '</label>' +
                                  '</div>' +
                              '</div>' +
                          '</td>' +
                          '<td></td>' +
                      '</tr>';

      $('#device-table tbody').append(tablerow);

      $('tr.newdevice .category-select').selectpicker();

      $('tr.newdevice .category-select').change(function(){
        var theVal = parseInt( $(this).val() );
        if( theVal > 0 &&  theVal != null) {
          if(theVal === 46) {
          $(this).parent().parent().next('.estimate-box').removeClass('hide').addClass('show');
          }
          else {
            $(this).parent().parent().next('.estimate-box').removeClass('show').addClass('hide');
            $(this).parent().parent().next('.estimate-box').children('input').val('');
          }
        }
    });

      /** Show/Hide Repairable details ( /party/manage ) (Host management page) **/
      $('tr.newdevice .repairable').click(function(){
          $(this).parent().parent().next('.repairable-details').addClass('show');
          detailswrap.css({'display': 'block'});
      });
  });


  $('#search-groups').change(function(){
      var chainer = $(this).find('option[value]:selected').map(function() {
                      return this.text;
                    }).get();

      $('#search-parties optgroup').addClass('hidden');
      for(i = 0; i < chainer.length; i++){
        var label = chainer[i];
        $('#search-parties optgroup[label="' + label + '"]').removeClass('hidden');
      }

      $('#search-parties').selectpicker('refresh');
    });

  $('.category-select').change(function(){
    var theVal = parseInt( $(this).val() );
    if( theVal > 0 &&  theVal != null) {
      if(theVal === 46) {
      $(this).parent().parent().next('.estimate-box').removeClass('hide').addClass('show');
    }
    else {
      $(this).parent().parent().next('.estimate-box').removeClass('show').addClass('hide');
    }
  }
  });

  /** startup datepickers **/
  $('.date, .date input').datetimepicker({
                icons: {
                    time: "fa fa-clock-o",
                    date: "fa fa-calendar",
                    up: "fa fa-arrow-up",
                    down: "fa fa-arrow-down",
                    previous: 'fa fa-chevron-left',
                    next: 'fa fa-chevron-right',
                    today: 'fa fa-screenshot',
                    clear: 'fa fa-trash'
                },
                format: 'DD/MM/YYYY',
                defaultDate: $(this).val()
            });
  $('.time').datetimepicker({
            icons: {
                time: "fa fa-clock-o",
                date: "fa fa-calendar",
                up: "fa fa-arrow-up",
                down: "fa fa-arrow-down",
                previous: 'fa fa-chevron-left',
                next: 'fa fa-chevron-right',
                today: 'fa fa-screenshot',
                clear: 'fa fa-trash'
            },
            format: 'HH:mm',
            defaultDate: $(this).val()

        });

  $('.from-date').datetimepicker({
   useCurrent: false //Important! See issue #1075
  });
  $('.to-date').datetimepicker({
    useCurrent: false //Important! See issue #1075
  });
  $(".from-date").on("dp.change", function (e) {
    $('.to-date').data("DateTimePicker").minDate(e.date);
  });
  $(".to-date").on("dp.change", function (e) {
    $('.from-date').data("DateTimePicker").maxDate(e.date);
  });


  /** linking two times in party creation **/
  $("#start-pc").on("dp.change", function (e) {
        //alert(e);

        var curtime = $(this).val(),
            arrtime = curtime.split(':');
        console.log(arrtime[0] + ' | ' + arrtime[1]);

        $('#end-pc').data("DateTimePicker").date(e.date.add(3, 'h'));
    });



  /** Rich Text Editors **/
  $('.rte').summernote({
        height:     300,
        toolbar:    [
            ['style', ['style','bold', 'italic', 'underline', 'clear']],
            ['para', ['ul', 'ol', 'paragraph']],
            ['insert', ['link', 'hr']],
            ['misc', ['codeview']]
        ],
        cleaner: {
          notTime: 2400, // Time to display Notifications.
          action: 'both', // both|button|paste 'button' only cleans via toolbar button, 'paste' only clean when pasting content, both does both options.
          newline: '<br />', // Summernote's default is to use '<p><br></p>'
          notStyle: 'position:absolute;top:0;left:0;right:0', // Position of Notification
          icon: '<i class="note-icon">[Your Button]</i>',
          keepHtml: false, // Remove all Html formats
          keepClasses: false, // Remove Classes
          badTags: ['style', 'script', 'applet', 'embed', 'noframes', 'noscript', 'html'], // Remove full tags with contents
          badAttributes: ['style', 'start'] // Remove attributes from remaining tags
        }
    });

  /** Load list of invitable restarters ( /party/create ) **/
  $('.users_group').change(function(){ // selectpicker users_group
        var groupId = $(this).val();
        $.getJSON('/ajax/restarters_in_group', {'group': groupId}, function(data){
            var checkboxes = '';
            data.forEach(function(e){
                checkboxes +=   '<div class="checkbox">' +
                                    '<label for="users-' + e.id + '">' +
                                        '<input type="checkbox" checked name="users[]" id="users-' + e.id + '" value="' + e.id + '"> ' +
                                        e.name + ' (' + e.role + ')' +
                                    '</label>' +
                                '</div>';
            });
            $('.users_group_list').html(checkboxes);
        });
    });

  /** Show/Hide repairable details ( /device/create ) **/
  $('[name="repair_status"]').click(function(){
        if($(this).is(':checked') && $(this).attr('id') == 'repair_status_2') {

            $('#repairable-details').slideDown('slow');
        }
        else {
            $('#repairable-details').hide('fast');
        }
    });

  /** Show/Hide Repairable details ( /party/manage ) (Host management page) **/
  $('.repairable').click(function(){
        var detailsWrap = $(this).data('target-details');
        if ($(this).is(':checked')) {
            $(detailsWrap).slideDown('slow');
        }
    });

  /** Delete object control **/
  $('.delete-control').click(function(e){
        e.preventDefault();

        var deleteTarget     =  $(this).attr('href');
        var deleteControlBox =  '<div class="ctrl-box-wrap">' +
                                    '<div class="ctrl-box">' +
                                        '<div class="ctrl-box-hdr">' +
                                            '<h3>Are You Sure?<h3>' +
                                        '</div>' +
                                        '<div class="ctrl-box-body">' +
                                            '<p>Please note that this operation is <strong>irreversible</strong>.</p>' +
                                        '</div>' +
                                        '<div class="ctrl-box-foot">' +
                                            '<a href="' + deleteTarget + '" class="btn btn-danger"><i class="fa fa-trash"></i> Delete</a> &nbsp;' +
                                            '<a href="#" class="btn btn-default ctrl-box-close"><i class="fa fa-undo"></i> Cancel</a>' +
                                        '</div>' +
                                    '</div>' +
                                '</div>';

        if ($('.ctrl-box-wrap').length > 0) { $('.ctrl-box-wrap').remove(); }

        $('body').append(deleteControlBox);
        $('.ctrl-box-close').click(function(){ $('.ctrl-box-wrap').remove(); });

        return false;
    });

  // file deletion
  $('.remove-image').click(function(e){
        e.preventDefault();

        var Holder = $(this).parent();
        var image = $(this).data('remove-image');
        var path = $(this).data('image-path');

        $.getJSON( $(this).attr('href'), {id: image, path: path}, function(){
            Holder.remove();
        });

        return false;
    });



  /** switch stat bars / host dashboard **/
  $('.switch-view').click(function(e){
        e.preventDefault();
        var target = $(this).data('target');
        var family = $(this).data('family');

        $('.switch-view').removeClass('active');
        $(this).addClass('active');

        $(family).removeClass('show').addClass('hide');
        $(target).addClass('show');

    });

  /** toggle party views in admin console **/
  $('.party-switch').click(function(e){
        e.preventDefault();
        var target = $(this).data('target');
        var family = $(this).data('family');

        $('.party-switch').removeClass('active');
        $(this).addClass('active');

        if (target == 'all') {
            $('.party').addClass('show').removeClass('hide');
        }
        else {
            $('.party').removeClass('show').addClass('hide');
            $(target).addClass('show');
        }
    });



  /* manage needed visibility to load correctly charts (host dahsboard) */
  /* $('.charts:first-child').addClass('show');
     $('.charts:not(:first-child)').addClass('hide');
  */
  /** sticky table headers **/
  if( $('#device-table').length > 0 ) {
    $('#device-table').floatThead();
  }

  /* scrollbar for party list */
  if ($('#party-list').length > 0 ) {
    $('#party-list').perfectScrollbar();
  }


});
