$(document).ready(function(){
    
    /** Dashboard Things **/
    /** maps for parties **/
    if ($('#dashboard').length > 0) {
        
    }
    
    
    /** startup datepickers **/
    $('.date').datetimepicker({
                icons: {
                    time: "fa fa-clock-o",
                    date: "fa fa-calendar",
                    up: "fa fa-arrow-up",
                    down: "fa fa-arrow-down"
                },
                format: 'DD/MM/YYYY',
                defaultDate: $(this).val()
            });
    $('.time').datetimepicker({
            icons: {
                time: "fa fa-clock-o",
                date: "fa fa-calendar",
                up: "fa fa-arrow-up",
                down: "fa fa-arrow-down"
            },
            format: 'HH:mm',
            defaultDate: $(this).val()
        
        });    
    
    /** Rich Text Editors **/
    $('.rte').summernote({
        height:     300,
        toolbar:    [
            ['style', ['bold', 'italic', 'underline', 'clear']],
            ['para', ['ul', 'ol', 'paragraph']],
        ]
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
    
    
    /** switch stat bars / host dashboard **/
    $('.switch-view').click(function(e){
        e.preventDefault();
        var target = $(this).data('target');
        
        $('.switch-view').removeClass('active');
        $(this).addClass('active');
        
        $('.bargroup').removeClass('show').addClass('hide');
        $(target).addClass('show');
        
    });
    
    
    /** Add Device Row in Party Management **/
    $('#add-device').click(function(e){
        e.preventDefault();
        
        var rows = $('#device-table > tbody > tr').length,
            categories = null,
            restarters = null,
            n = rows + 1;
             
        
        console.log('ROWS : ' + rows);
        
        $.ajax({
            async: false,
            url: '/ajax/category_list',
            data: {},
            dataType: "html",
            success: function(r){
                categories = r;
            }
        });
        
        
        $.ajax({
            async: false,
            url: '/ajax/restarters',
            data: {},
            dataType: "html",
            success: function(r){
                restarters = r;
            }
        });
        
        
        var tablerow = '<tr>' + 
                            '<td>' + n + '.</td>'+
                            '<td>' +
                                '<div class="form-group">' +
                                    '<select id="device-' + n + '[category]" name="device-' + n + '[category]" class="selectpicker form-control" data-live-search="true">' +
                                    categories + 
                                    '</select>' +
                                '</div>' +
                            '</td>' +            
                            '<td>' +
                                '<textarea class="form-control" id="device-' + n + '[problem]" name="device-' + n + '[problem]"></textarea>' +
                            '</td>' +
                            
                            
                            '<td>' +
                                '<textarea class="form-control" id="device-' + n + '[model]" name="device-' + n + '[model]"></textarea>' +
                            '</td>' +
                            
                            '<td>' +
                                
                                '<div class="form-group">' +
                                    '<div class="radio">' +                                            
                                        '<label>' +
                                            '<input type="radio" name="device-' + n + '[repair_status]" id="device-' + n + '[repair_status_1]" value="1" checked> Fixed' +
                                        '</label>' +
                                    '</div>' +
                                    '<div class="radio">' +
                                        '<label>' +
                                            '<input type="radio" class="repairable" data-target-details="#repairable-details-' + n + '" name="device-' + n + '[repair_status]" id="device-' + n + '[repair_status_2]" value="2"> Repairable' +
                                        '</label>' +
                                    '</div>' +
                                    '<div id="repairable-details-' + n + '" class="repairable-details">' +
                                        '<div class="checkbox">' +
                                            '<label>' +
                                                '<input type="checkbox" name="device-' + n + '[more_time_needed]" id="device-' + n + '[more_time_needed]" value="1"> More time needed' +
                                            '</label>' +
                                        '</div>' +
                                        '<div class="checkbox">' +
                                            '<label>' +
                                                '<input type="checkbox" name="device-' + n + '[professional_help]" id="device-' + n + '[professional_help]" value="1"> Professional help' +
                                            '</label>' +
                                        '</div>' +
                                        '<div class="checkbox">' +
                                            '<label>' +
                                                '<input type="checkbox" name="device-' + n + '[do_it_yourself]" id="device-' + n + '[do_it_yourself]" value="1"> Do it yourself' +
                                            '</label>' +
                                        '</div>' +
                                    '</div>' +
                                    '<div class="radio">' +
                                        '<label>' +
                                            '<input type="radio" name="device-' + n + '[repair_status]" id="device-' + n + '[repair_status_3]" value="3"> End of lifecycle' +
                                        '</label>' +
                                    '</div>' +
                                '</div>' +
                            '</td>' +
                            '<td>' +
                                '<div class="form-group">' +
                                    '<div class="radio">' +
                                        '<label>' +
                                            '<input type="radio" name="device-' + n + '[spare_parts]" id="spare_parts_1" value="1"> Yes' +
                                        '</label>' +
                                    '</div>' +
                                    '<div class="radio">' +
                                        '<label>' +
                                            '<input type="radio" name="device-' + n + '[spare_parts]" id="spare_parts_2" value="2" checked> No' +
                                        '</label>' +
                                    '</div>' +
                                '</div>' +
                            '</td>' +
                            '<td>' +
                                '<div class="form-group">' + 
                                    '<select name="device-' + n + '[restarter]" id="device-' + n + '[restarter]"  class="selectpicker form-control" data-live-search="true" title="Choose Restarter...">' + 
                                        '<option></option>' + 
                                        restarters + 
                                    '</select>' + 
                                '</div>' + 
                            
                            '</td>' +
                        '</tr>';
        
        $('#device-table tbody').append(tablerow);
        
        $('.selectpicker').selectpicker();
        
        console.log(categories);
        
    });
    
});