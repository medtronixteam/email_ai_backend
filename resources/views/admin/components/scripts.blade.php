<script src="{{url('assets/js/plugins/apexcharts.min.js')}}"></script>
<script src="{{url('assets/js/pages/dashboard-default.js')}}"></script>
<!-- Required Js -->
<script src="{{url('assets/js/plugins/popper.min.js')}}"></script>
<script src="{{url('assets/js/plugins/simplebar.min.js')}}"></script>
<script src="{{url('assets/js/plugins/bootstrap.min.js')}}"></script>
<script src="{{url('assets/js/fonts/custom-font.js')}}"></script>
<script src="{{url('assets/js/pcoded.js')}}"></script>
<script src="{{url('assets/js/plugins/feather.min.js')}}"></script>
@stack('js')
<script>
     layout_change('dark');
    change_box_container('false');

    layout_caption_change('true');

    layout_rtl_change('false');

    preset_change('preset-1');

    main_layout_change('vertical');
</script>
    @include('flashy::message')
