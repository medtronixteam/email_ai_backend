<!doctype html>
<html lang="en">
<!-- [Head] start -->
@include('admin.components.head')
<style>
    img.loading-overlay-img{
        animation: rotateHorizontal 2s infinite linear;
    }

    @keyframes rotateHorizontal {
        0% {
            transform: rotateY(0deg);
        }
        50% {
            transform: rotateY(180deg);
        }
        100% {
            transform: rotateY(360deg);
        }
    }



        </style>

<body data-pc-preset="preset-2" data-pc-sidebar-caption="true" data-pc-layout="vertical" data-pc-direction="ltr"
    data-pc-theme_contrast="" data-pc-theme="dark">
    <!-- [ Pre-loader ] start -->

    <div class="loader-bg" style="background: linear-gradient(150deg, rgba(255, 255, 255, 0.03) 0%, rgba(255, 255, 255, 0.01) 100%);
    backdrop-filter: blur(10px);
    -webkit-backdrop-filter: blur(10px);height: 100vh ">
        <div class="h-100 d-flex justify-content-center align-items-center">
            <img src="{{ url('logo/single.png') }}" width="150" class="loading-overlay-img" alt="">
        </div>
        {{-- <div class="loader-track">
            <div class="loader-fill"></div>
        </div> --}}
    </div><!-- [ Pre-loader ] End -->
    <!-- [ Sidebar Menu ] start -->
    @include('admin.components.aside')
    @include('admin.components.header')
    <!-- [ Sidebar Menu ] end -->
    <!-- [ Header Topbar ] start -->

    <!-- [ Main Content ] start -->
    <div class="pc-container">
        <div class="pc-content">
            <!-- [ Main Content ] start -->
            @yield('content')
            <!-- [ Main Content ] end -->
        </div>
    </div><!-- [ Main Content ] end -->
    @include('admin.components.footer')
   </body><!-- [Body] end -->
@include('admin.components.scripts')
</html>
