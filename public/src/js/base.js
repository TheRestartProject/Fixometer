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
});