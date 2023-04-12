<!DOCTYPE html>
<html lang="zxx" class="js">
@include('layouts.components.head')
<body class="nk-body bg-lighter npc-default has-sidebar {{ Session::get('theme') }}" theme="{{ (Session::get('theme') == 'dark-mode') ? 'dark' : ''}}">
    <div class="nk-app-root">
        <div class="nk-main ">
            @include('layouts.components.sidebar')
            <div class="nk-wrap ">
                @include('layouts.components.header')
                <div class="nk-content">
                    <div class="container-fluid">
                        <div class="nk-content-inner">
                            <div class="nk-content-body">
                                <div class="nk-block-head nk-block-head-sm">
                                    <div class="nk-block-between">
                                        <div class="nk-block-head-content">
                                            <h3 class="nk-block-title page-title letter-space-1">@stack('subtitle')</h3>
                                            <div class="nk-block-des text-soft">
                                                <p class="letter-space-1 ff-mono">@stack('description')</p>
                                            </div>
                                        </div>
                                        <div class="nk-block-head-content">
                                            @stack('tools')
                                        </div>
                                    </div>
                                </div>
                                @include('layouts.components.alert')
                                @yield('content')
                            </div>
                        </div>
                    </div>
                </div>
                @include('layouts.components.footer')
            </div>
        </div>
    </div>
    @include('layouts.components.script')
</body>
</html>
