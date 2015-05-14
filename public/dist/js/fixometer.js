$(document).ready(function(){
    
    /** startup datepickers **/
    $('.date').datetimepicker({
                icons: {
                    time: "fa fa-clock-o",
                    date: "fa fa-calendar",
                    up: "fa fa-arrow-up",
                    down: "fa fa-arrow-down"
                },
                format: 'MM/DD/YYYY'
            });
    $('.time').datetimepicker({
            icons: {
                time: "fa fa-clock-o",
                date: "fa fa-calendar",
                up: "fa fa-arrow-up",
                down: "fa fa-arrow-down"
            },
            format: 'HH:mm'
        });    

    /** Rich Text Editors **/
    $('.rte').summernote({
        height:     300,
        toolbar:    [
            ['style', ['bold', 'italic', 'underline', 'clear']],
            ['para', ['ul', 'ol', 'paragraph']],
        ]
    });
    
});