
        <script>
            (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
                (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
                m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
            })(window,document,'script','https://www.google-analytics.com/analytics.js','ga');

            ga('create', '<?php echo GA_TRACKING_ID; ?>', 'auto');
            ga('send', 'pageview');
        </script>

        <script src="/components/bootstrap-select/dist/js/bootstrap-select.min.js"></script>
        <script src="/components/bootstrap-sortable/Scripts/bootstrap-sortable.js"></script>
        <script src="/components/eonasdan-bootstrap-datetimepicker/build/js/bootstrap-datetimepicker.min.js"></script>
        <script src="/components/summernote/dist/summernote.min.js"></script>
        <script src="/components/summernote-cleaner/summernote-cleaner.js"></script>
        <script src="/components/bootstrap-fileinput/js/fileinput.min.js"></script>
        <?php
        if(isset($js) && isset($js['foot']) && !empty($js['foot'])){
            foreach($js['foot'] as $script){
        ?>
        <script src="<?php echo $script; ?>"></script>
        <?php
            }
        }
        ?>

        <?php if(SYSTEM_STATUS == 'development') { ?>
        <script src="/dist/js/fixometer.js"></script>
        <?php } else { ?>
        <script src="/dist/js/script.min.js"></script>
        <?php } ?>

        <script>
            $(document).ready(function() {
                $('.fileinput').fileinput({
                    showCaption: false,
                    showUpload: false,
                    showRemove: false,
                    browseIcon:  '<i class="fa fa-folder-open"></i> &nbsp;',
                    browseLabel: 'Choose image...',
                    previewFileIcon: '<i class="fa fa-file"></i>',
                    browseIcon: '<i class="fa fa-folder-open"></i> &nbsp;',
                    browseClass: 'btn btn-primary',
                    removeIcon: '<i class="fa fa-trash"></i> ',
                    removeClass: 'btn btn-default',
                    cancelIcon: '<i class="fa fa-ban-circle"></i> ',
                    cancelClass: 'btn btn-default',
                    uploadIcon: '<i class="fa fa-upload"></i> ',

                });
            } );
        </script>

    </body>
</html>
