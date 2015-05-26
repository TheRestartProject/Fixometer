<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        
        <title><?php echo $title; ?> | Fix-O-Meter</title>
    
        <!-- Latest compiled and minified CSS -->
        <link rel="stylesheet" href="http://fonts.googleapis.com/css?family=Open+Sans:300italic,400|Patua+One">
        <link rel="stylesheet" href="/dist/css/main.css">
        <link rel="stylesheet" href="/components/fontawesome/css/font-awesome.min.css">
        <link rel="stylesheet" href="/components/bootstrap-select/dist/css/bootstrap-select.min.css">
        <link rel="stylesheet" href="/components/bootstrap-sortable/Contents/bootstrap-sortable.css">
        <link rel="stylesheet" href="/components/eonasdan-bootstrap-datetimepicker/build/css/bootstrap-datetimepicker.min.css">
        <link rel="stylesheet" href="/components/summernote/dist/summernote.css">
        <link rel="stylesheet" href="/components/bootstrap-fileinput/css/fileinput.min.css">
        
        <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
        <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
        <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
        <![endif]-->
        <?php
        if(isset($gmaps) && $gmaps == true) {
        ?>
        <script src="https://maps.googleapis.com/maps/api/js?v=3.exp&signed_in=true"></script>
        <?php
        }
        ?>
        <?php
        if(isset($js) && isset($js['head']) && !empty($js['head'])){
            foreach($js['head'] as $script){
        ?>
        <script src="<?php echo $script; ?>"></script>
        <?php
            }
        }
        ?>
        
    </head>
    <body>
    
    
    