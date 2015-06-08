    
    
    <script src="/components/jquery/dist/jquery.min.js"></script>
    <script src="/components/moment/min/moment.min.js"></script>
    <script src="/components/bootstrap/dist/js/bootstrap.min.js"></script>
    <script src="/components/bootstrap-select/dist/js/bootstrap-select.min.js"></script>
    <script src="/components/bootstrap-sortable/Scripts/bootstrap-sortable.js"></script>
    <script src="/components/eonasdan-bootstrap-datetimepicker/build/js/bootstrap-datetimepicker.min.js"></script>
    <script src="/components/summernote/dist/summernote.min.js"></script>
    <script src="/components/bootstrap-fileinput/js/fileinput.min.js"></script>
    
    
    <script src="/dist/js/script.min.js"></script>
    <?php if($charts){ ?> 
    <script>
        // generate legends for the charts
        if (legends) {
            $('#devicesYears').after(legends.devicesYears);
        }
    </script>
    <?php } ?>
    </body>
</html>