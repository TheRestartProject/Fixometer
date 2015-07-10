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
                                            '<a href="' + deleteTarget + '" class="btn btn-primary"><i class="fa fa-trash"></i> Delete</a>' +
                                            '<a href="#" class="btn btn-default ctrl-box-close">Cancel</a>' + 
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
    
    
    
    /*** Add Devices to Party - Ajax Page for Hosts ***//*
    $('button.add-info-btn').click(function(e){
        e.preventDefault();
        
        var party = $(this).data('party'),
            partydata,
            categories; 
            
        
        // get party info 
        $.ajax({
            async: false,
            url: '/ajax/party_data',
            data: {id: party},
            dataType: "json",
            success: function(r){
                partydata = r;
            }
        });
        
        $.ajax({
            async: false,
            url: '/ajax/category_list',
            data: {id: party},
            dataType: "json",
            success: function(r){
                categories = r;
            }
        });
        
        
            
        // build page 
        var page =  '<div class="wrap-device-input container-fluid">' +
                        '<div class="device-input container">' +
                            '<header class="device-input-header row">' +
                                '<div class="col-md-1"></div>' +
                                '<div class="col-md-4">' + partydata.event_date + '<br />' + partydata.location + '</div>' +
                                '<div class="col-md-6"></div>' +
                                '<div class="col-md-1"><button class="btn btn-default close"><i class="fa fa-times"></i></div>' +
                            '</header>' +
                        '</div>' +
                    '<div>';
        $('body').append(page);
        $('.wrap-device-input .close').click(function(e){
            $('.wrap-device-input').remove();
        });
    });
    */
    
    
});