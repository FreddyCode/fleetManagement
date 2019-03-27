<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="csrf-token" content="{{csrf_token()}}">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Fleet Management Portal">
    <meta name="author" content="Fleet Management Portal">
    <meta name="keyword" content="Fleet Management Portal">
    <link rel="shortcut icon" href="assets/img/enshikalogo.jpg">

    <title>Fleet Management Portal</title>
    <link href="assets/css/bootstrap.min.css" rel="stylesheet">
    <link href="assets/css/bootstrap-theme.css" rel="stylesheet">
    <link href="assets/css/elegant-icons-style.css" rel="stylesheet" />
    <link href="assets/css/font-awesome.min.css" rel="stylesheet" />
    <link href="assets/css/font-awesome.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="assets/css/owl.carousel.css" type="text/css">
    <link href="assets/css/jquery-jvectormap-1.2.2.css" rel="stylesheet">
    <link href="assets/css/widgets.css" rel="stylesheet">
    <link href="assets/css/style.css" rel="stylesheet">
    <link href="assets/css/style-responsive.css" rel="stylesheet" />
    <link href="assets/css/xcharts.min.css" rel=" stylesheet">
    <link href="assets/css/jquery-ui-1.10.4.min.css" rel="stylesheet">
    <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.6.3/css/bootstrap-select.min.css" />
</head>

<body>
<section id="container" class="">
    @include('layouts.header')
    @include('layouts.menu')
    <section id="main-content">
        <section class="wrapper">
            @yield('content')

        </section>
    </section>
</section>
<script src="assets/js/jquery.js"></script>
<script src="assets/js/jquery-1.8.3.min.js"></script>
<script src="assets/js/jquery-ui-1.10.4.min.js"></script>
<script src="assets/js/bootstrap-datepicker.js"></script>
<script src="assets/js/bootstrap.min.js"></script>
<script src="assets/js/jquery.scrollTo.min.js"></script>
<script src="assets/assets/jquery-knob/js/jquery.knob.js"></script>
<script src="assets/js/jquery.sparkline.js" type="text/javascript"></script>
<script src="assets/js/owl.carousel.js"></script>
<script src="assets/js/jquery.rateit.min.js"></script>
<script src="assets/js/jquery.customSelect.min.js"></script>
<script src="assets/js/scripts.js"></script>
<script src="assets/js/sparkline-chart.js"></script>
<script src="assets/js/jquery-jvectormap-1.2.2.min.js"></script>
<script src="assets/js/jquery-jvectormap-world-mill-en.js"></script>
<script src="assets/js/xcharts.min.js"></script>
<script src="assets/js/jquery.autosize.min.js"></script>
<script src="assets/js/jquery.placeholder.min.js"></script>
<script src="assets/js/gdp-data.js"></script>
<script src="assets/js/morris.min.js"></script>
<script src="assets/js/sparklines.js"></script>
<script src="assets/js/charts.js"></script>
<script src="assets/js/jquery.slimscroll.min.js"></script>
<script src="assets//js/sweetalert.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.6.3/js/bootstrap-select.min.js"></script>

@yield('script')
<script>
    $(document).ready(function(){
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
    });
    $(window).load(function(){
        $('.sidebar').addClass('hidden-phone')
    })
    //knob
    $(function() {
        $(".knob").knob({
            'draw': function() {
                $(this.i).val(this.cv + '%')
            }
        })
    });

    //carousel
    $(document).ready(function() {
        $("#owl-slider").owlCarousel({
            navigation: true,
            slideSpeed: 300,
            paginationSpeed: 400,
            singleItem: true

        });
    });

    //custom select box

    $(function() {
        $('select.styled').customSelect();
    });

    /* ---------- Map ---------- */
    $(function() {
        $('#map').vectorMap({
            map: 'world_mill_en',
            series: {
                regions: [{
                    values: gdpData,
                    scale: ['#000', '#000'],
                    normalizeFunction: 'polynomial'
                }]
            },
            backgroundColor: '#eef3f7',
            onLabelShow: function(e, el, code) {
                el.html(el.html() + ' (GDP - ' + gdpData[code] + ')');
            }
        });
    });
</script>

</body>

</html>
