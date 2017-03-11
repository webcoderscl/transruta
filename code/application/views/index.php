<?php

    $tbls = json_decode(_TABLES);
    $tbl = json_decode(_TABLE);


?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="robots" content="noindex, nofollow">
    <title>TRANSRuta(CL) • <?php if(isset($page_title)) echo $page_title; ?></title>

    <link href='http://fonts.googleapis.com/css?family=Roboto:300,400,500,700,900' rel='stylesheet' type='text/css'>
    <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css">

    <!-- Vendor styles -->
    <link rel="stylesheet" href="<?php echo base_url();?>template/codemakers/vendor/fontawesome/css/font-awesome.css"/>
    <link rel="stylesheet" href="<?php echo base_url();?>template/codemakers/vendor/animate.css/animate.css"/>
    <link rel="stylesheet" href="<?php echo base_url();?>template/codemakers/vendor/bootstrap/css/bootstrap.css"/>
    <link rel="stylesheet" href="<?php echo base_url();?>template/codemakers/vendor/toastr/toastr.min.css"/>
    <link rel="stylesheet" href="<?php echo base_url();?>template/codemakers/vendor/datatables/datatables.min.css"/>

    <!-- App styles -->
    <!-- For Datepicker -->
    <link rel="stylesheet" href="<?php echo base_url();?>template/jquery-ui-1.12.0/jquery-ui.css">
    <link rel="stylesheet" href="<?php echo base_url();?>template/datepicker/css/datepicker.css"/>

    <!-- <script src="<?php echo base_url();?>template/datepicker/js/bootstrap-datepicker.js"></script> -->

    <link rel="stylesheet" href="<?php echo base_url();?>template/codemakers/styles/pe-icons/pe-icon-7-stroke.css"/>
    <link rel="stylesheet" href="<?php echo base_url();?>template/codemakers/styles/pe-icons/helper.css"/>
    <link rel="stylesheet" href="<?php echo base_url();?>template/codemakers/styles/stroke-icons/style.css"/>
    <link rel="stylesheet" href="<?php echo base_url();?>template/codemakers/styles/style.css">

    <link href='https://fonts.googleapis.com/css?family=Open+Sans:400,300,700' rel='stylesheet' type='text/css'>

    <!-- Favicon -->
    <link rel="shortcut icon" href="<?php echo base_url();?>/favicon.ico?nocache=">
    <link rel="icon" type="image/x-icon" href="<?php echo base_url();?>/favicon.ico?nocache=" />

    <!-- JQUERY -->
    <script src="<?php echo base_url();?>template/codemakers/vendor/jquery/dist/jquery.min.js"></script>
    <!-- For Datepicker -->
    <script src="<?php echo base_url();?>template/jquery-ui-1.12.0/jquery-ui.min.js"></script>
    <!-- BORDEAR INPUT DE VALIDACION DE CAMPOS -->
    <style type="text/css">
        .valid_error{
            box-shadow: 0 0 4px #CC0000; margin: 3px;
            border: 2px solid;
            border-color: red;

        }
    </style>


    <?php $usr = $this->session->userdata('login_type'); ?>
    <script type="text/javascript">
        <?php echo 'usrtype = "'.$usr.'";'; ?>
        setInterval(
        function (){


                $.ajax({
                  url: window.location.pathname+'?'+usrtype.toString()+'/actualizaMatchs',                  //the script to call to get data
                  data: "",                        //you can insert url argumnets here to pass to api.php
                                                   //for example "id=5&parent=6"
                  dataType: 'json',                //data format
                  success: function(data)          //on recieve of reply
                  {

                    //--------------------------------------------------------------------
                    // 3) Update html content
                    //--------------------------------------------------------------------

                      console.log(data.total);
                      console.log(data);
                      //$(document).find("input[name='distancia']").val(data);
                      if (data.total > 0){
                        //alert("Tiene match pendientes por resolver.");
                        //alert("actualizando... total match de registros encontrados:" + data.total + ", msg: "+data.msg);
                      }


                        //$.each( data, function( id, val ) {
                          //items.push( "<li id='" + id + "'>" + data[id]['Muser']  +"</li>" );
                        //});

                        //$('#output').html(items.join("")); //Set output element html
                    //}

                    //recommend reading up on jquery selectors they are awesome
                    // http://api.jquery.com/category/selectors/
                  }
                });


        },1*60*1000);
    </script>

</head>
<body>

<!-- Wrapper-->
<div class="wrapper">

    <?php include 'header.php'; ?>
    <?php include 'menu.php';   ?>



    <!-- Main content-->
    <section class="content">
            <div class="container-fluid">

                <?php include $this->session->userdata('login_type').'/'.$page_name.'.php';?>
            </div>
    </section>
    <!-- End main content-->

</div>
<!-- End wrapper-->

<!-- Vendor scripts -->
<script src="<?php echo base_url();?>template/codemakers/vendor/pacejs/pace.min.js"></script>
<script src="<?php echo base_url();?>template/codemakers/vendor/bootstrap/js/bootstrap.min.js"></script>
<script src="<?php echo base_url();?>template/codemakers/vendor/toastr/toastr.min.js"></script>
<script src="<?php echo base_url();?>template/codemakers/vendor/sparkline/index.js"></script>
<script src="<?php echo base_url();?>template/codemakers/vendor/flot/jquery.flot.min.js"></script>
<script src="<?php echo base_url();?>template/codemakers/vendor/flot/jquery.flot.resize.min.js"></script>
<script src="<?php echo base_url();?>template/codemakers/vendor/flot/jquery.flot.spline.js"></script>
<script src="<?php echo base_url();?>template/codemakers/vendor/datatables/datatables.min.js"></script>



<!-- App scripts -->
<script src="<?php echo base_url();?>template/codemakers/scripts/luna.js"></script>

<!-- Scripts -->
<script>
    $(document).ready(function () {

        $('#tableExample1').DataTable({
            "dom": 't'
        });

        $('#tableExample2').DataTable({
            "dom": "<'row'<'col-sm-6'l><'col-sm-6'f>>t<'row'<'col-sm-6'i><'col-sm-6'p>>",
            "lengthMenu": [ [6, 25, 50, -1], [6, 25, 50, "All"] ],
            "iDisplayLength": 6,
        });

        $('#tableExample3').DataTable({
            dom: "<'row'<'col-sm-4'l><'col-sm-4 text-center'B><'col-sm-4'f>>tp",
            "lengthMenu": [ [10, 25, 50, -1], [10, 25, 50, "All"] ],
            buttons: [
                {extend: 'copy',className: 'btn-sm'},
                {extend: 'csv',title: 'ExampleFile', className: 'btn-sm'},
                {extend: 'pdf', title: 'ExampleFile', className: 'btn-sm'},
                {extend: 'print',className: 'btn-sm'}
            ]
        });
        $('#tableExample4').DataTable({
            dom: "<'row'<'col-sm-4'l><'col-sm-4 text-center'B><'col-sm-4'f>>tp",
            "lengthMenu": [ [10, 25, 50, -1], [10, 25, 50, "All"] ],
            buttons: [
                {extend: 'copy',className: 'btn-sm'},
                {extend: 'csv',title: 'ExampleFile', className: 'btn-sm'},
                {extend: 'pdf', title: 'ExampleFile', className: 'btn-sm'},
                {extend: 'print',className: 'btn-sm'}
            ]
        });

    });
</script>
<script>

    function modalChange(url, nameform, data_title, data_text, idrow, mode){

        var form = $(document).find("form[name='"+nameform+"']");
        $("#modal_text").text(data_text);
        $("#modal_title").text(data_title);
        form.attr("action",url);
        //alert("doc: "+document.chofer_cu.action);
        if(mode== 2)
        {
          if( idrow > 0 ) llenarDatosPerfil(idrow);
          if (idrow == '0') limpiarDatosPerfil();
        }else{
          if( idrow > 0 ) llenarDatos(idrow);
          if (idrow == '0') limpiarDatos();
        }

    }

    //SET DATEPICKER
    $(document).ready(function() {


        $( "#datepicker" ).datepicker({
            dateFormat: 'yy/mm/dd',
            changeMonth: true,
            numberOfMonths: 1,
            minDate: '0'  //deshabilitar fechas anteriores
         }).datepicker("setDate", "0"); //fecha actual

         $( "#datepicker_1" ).datepicker({
             dateFormat: 'yy/mm/dd',
             changeMonth: true,
             numberOfMonths: 1,
             minDate: '0',  //deshabilitar fechas anteriores
             onSelect:function(dateText,inst){
               var dateSelected = new Date(dateText);
               $('#datepicker_2').datepicker('option','minDate',dateSelected);
               $('#datepicker_2').datepicker('option','maxDate', '');
               $('#datepicker_2').datepicker('refresh');
             }
          }).datepicker("setDate", "0"); //fecha actual

        $( "#datepicker_2" ).datepicker({
            dateFormat: 'yy/mm/dd',
            changeMonth: true,
            numberOfMonths: 1,
            minDate: '0', //deshabilitar fechas anteriores
            onSelect:function(dateText,inst){
              var dateSelected = new Date(dateText);
              $('#datepicker_1').datepicker('option','minDate',0);
              $('#datepicker_1').datepicker('option','maxDate', dateSelected);
              $('#datepicker_1').datepicker('refresh');
            }
         }).datepicker("setDate", ""); //fecha actual

         $.datepicker.regional['es'] = {

            monthNames: ['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto',
              'Septiembre', 'Octubre', 'Noviembre', 'Diciembre'
            ],
            monthNamesShort: ['Ene', 'Feb', 'Mar', 'Abr', 'May', 'Jun', 'Jul', 'Ago', 'Sep', 'Oct', 'Nov', 'Dic'],
            dayNames: ['lunes', 'martes', 'miércoles', 'jueves', 'viernes', 'sábado', 'domingo'],
            dayNamesShort: ['lu', 'ma', 'mi', 'ju', 'vi', 'sa', 'do'],
            dayNamesMin: ['lu', 'ma', 'mi', 'ju', 'vi', 'sa', 'do'],
            dateFormat: 'yy/mm/dd',
            isRTL: false,
            showMonthAfterYear: false,
            yearSuffix: ''
            };
            $.datepicker.setDefaults($.datepicker.regional['es']);

    });



    $(document).ready(function () {

        // Sparkline charts
        var sparklineCharts = function () {
            $(".sparkline").sparkline([20, 34, 43, 43, 35, 44, 32, 44, 52, 45], {
                type: 'line',
                lineColor: '#FFFFFF',
                lineWidth: 3,
                fillColor: '#404652',
                height: 47,
                width: '100%'
            });

            $(".sparkline7").sparkline([10, 34, 13, 33, 35, 24, 32, 24, 52, 35], {
                type: 'line',
                lineColor: '#FFFFFF',
                lineWidth: 3,
                fillColor: '#f7af3e',
                height: 75,
                width: '100%'
            });

            $(".sparkline1").sparkline([0, 6, 8, 3, 2, 4, 3, 4, 9, 5, 3, 4, 4, 5, 1, 6, 7, 15, 6, 4, 0], {
                type: 'line',
                lineColor: '#2978BB',
                lineWidth: 3,
                fillColor: '#2978BB',
                height: 170,
                width: '100%'
            });

            $(".sparkline3").sparkline([-8, 2, 4, 3, 5, 4, 3, 5, 5, 6, 3, 9, 7, 3, 5, 6, 9, 5, 6, 7, 2, 3, 9, 6, 6, 7, 8, 10, 15, 16, 17, 15], {

                type: 'line',
                lineColor: '#fff',
                lineWidth: 3,
                fillColor: '#393D47',
                height: 70,
                width: '100%'
            });

            $(".sparkline5").sparkline([0, 6, 8, 3, 2, 4, 3, 4, 9, 5, 3, 4, 4, 5], {
                type: 'line',
                lineColor: '#f7af3e',
                lineWidth: 2,
                fillColor: '#2F323B',
                height: 20,
                width: '100%'
            });
            $(".sparkline6").sparkline([0, 1, 4, 2, 2, 4, 1, 4, 3, 2, 3, 4, 4, 2, 4, 2, 1, 3], {
                type: 'bar',
                barColor: '#f7af3e',
                height: 20,
                width: '100%'
            });

            $(".sparkline8").sparkline([4, 2], {
                type: 'pie',
                sliceColors: ['#f7af3e', '#404652']
            });
            $(".sparkline9").sparkline([3, 2], {
                type: 'pie',
                sliceColors: ['#f7af3e', '#404652']
            });
            $(".sparkline10").sparkline([4, 1], {
                type: 'pie',
                sliceColors: ['#f7af3e', '#404652']
            });
            $(".sparkline11").sparkline([1, 3], {
                type: 'pie',
                sliceColors: ['#f7af3e', '#404652']
            });
            $(".sparkline12").sparkline([3, 5], {
                type: 'pie',
                sliceColors: ['#f7af3e', '#404652']
            });
            $(".sparkline13").sparkline([6, 2], {
                type: 'pie',
                sliceColors: ['#f7af3e', '#404652']
            });
        };

        var sparkResize;

        // Resize sparkline charts on window resize
        $(window).resize(function () {
            clearTimeout(sparkResize);
            sparkResize = setTimeout(sparklineCharts, 100);
        });

        // Run sparkline
        sparklineCharts();


        // Flot charts data and options
        var data1 = [ [0, 16], [1, 24], [2, 11], [3, 7], [4, 10], [5, 15], [6, 24], [7, 30] ];
        var data2 = [ [0, 26], [1, 44], [2, 31], [3, 27], [4, 36], [5, 46], [6, 56], [7, 66] ];

        var chartUsersOptions = {
            series: {
                splines: {
                    show: true,
                    tension: 0.4,
                    lineWidth: 1,
                    fill: 1

                }

            },
            grid: {
                tickColor: "#404652",
                borderWidth: 0,
                borderColor: '#404652',
                color: '#404652'
            },
            colors: [ "#f7af3e","#DE9536"]
        };

        $.plot($("#flot-line-chart"), [data2, data1], chartUsersOptions);


        // Run toastr notification with Welcome message
        setTimeout(function(){
            toastr.options = {
                "positionClass": "toast-top-right",
                "closeButton": true,
                "progressBar": true,
                "showEasing": "swing",
                "timeOut": "1000"
            };
            toastr.warning('<strong>Welcome to LUNA v.1.1</strong> <br/><small>Premium admin theme with Dark UI style. </small>');
        },1600)



    });

    // VALIDACION DE CAMPOS
    function validateField(selector){
        var valid = true;
        if ($(selector).is("SELECT")){
            if($(selector).val() == -1){
                valid = false;
                $(selector).addClass("valid_error");
            }else{
                $(selector).removeClass("valid_error");
            }
            //alert("is select!");
        }else if($(selector).is("INPUT")){
            if($(selector).val() == ""){
                valid = false;
                $(selector).addClass("valid_error");
            }else{
                $(selector).removeClass("valid_error");
            }
        }else if($(selector).is("TEXTAREA")){
            if($(selector).val() == ""){
                valid = false;
                $(selector).addClass("valid_error");
            }else{
                $(selector).removeClass("valid_error");
            }
        }

        return valid;
    }

    function validateFields(){
        var valid = true;
        $(".validation").each(function(){
            valid = validateField(this);
            //alert($(this).attr("name") + "--> "+$(this).val());
        });

        if(valid){
            $("#form_data").submit();
            $("#error_msg").hide();
        }
        else{
            $("#error_msg").show();
        }
        return valid;
    }


	//alert(algo);





</script>




</body>
</html>
