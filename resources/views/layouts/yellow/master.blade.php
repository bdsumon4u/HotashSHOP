<!DOCTYPE html>
<html lang="en" dir="ltr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <meta name="format-detection" content="telephone=no">
    <title>{{ $company->name }} - @yield('title')</title>
    <link rel="icon" type="image/png" href="{{ asset($logo->favicon) }}"><!-- fonts -->
    <!-- css -->
    @include('googletagmanager::head')
    @include('facebook-pixel::head')
    @include('layouts.yellow.css')
    <!-- js -->
    <!-- font - fontawesome -->
    <link rel="stylesheet" href="{{ asset('strokya/vendor/fontawesome-5.6.1/css/all.min.css') }}"><!-- font - stroyka -->
    <link rel="stylesheet" href="{{ asset('strokya/fonts/stroyka/stroyka.css') }}">
    @include('layouts.yellow.color')
    <style>
        .topbar__item {
            flex: none;
        }
        .page-header__container {
            padding-bottom: 12px;
        }
        .products-list__item {
            justify-content: space-between;
        }
        @media (max-width: 479px) {
            /* .products-list[data-layout=grid-5-full] .products-list__item {
                width: 46%;
                margin: 8px 6px;
            } */
        }
        @media (max-width: 575px) {
            .mobile-header__search {
                top: 55px;
            }
            .mobile-header__search-form .aa-input-icon {
                display: none;
            }
            .mobile-header__search-form .aa-hint, .mobile-header__search-form .aa-input {
                padding-right: 15px !important;
            }
            .block-products-carousel[data-layout=grid-4] .product-card .product-card__buttons .btn {
                height: auto;
            }
        }
        .product-card:before,
        .owl-carousel {
            z-index: 0;
        }
        .block-products-carousel[data-layout^=grid-] .product-card .product-card__info,
        .products-list[data-layout^=grid-] .product-card .product-card__info {
            padding: 0 14px;
        }
        .block-products-carousel[data-layout^=grid-] .product-card .product-card__actions,
        .products-list[data-layout^=grid-] .product-card .product-card__actions {
            padding: 0 14px 14px 14px;
        }
        .product-card__badges-list {
            flex-direction: row;
        }
        .product-card__name {
            overflow: hidden;
            text-overflow: ellipsis;
            white-space: nowrap;
        }
        .product-card__buttons {
            margin-right: -12px !important;
            margin-bottom: -12px !important;
            margin-left: -12px !important;
        }
        .product-card__buttons .btn {
            height: auto !important;
            font-size: 20px !important;
            padding: 0.25rem 0.15rem !important;
            border-radius: 0 !important;
            display: block;
            width: 100%;
        }
        .aa-input-container {
            width: 100%;
        }
        .algolia-autocomplete {
            width: 100%;
            display: flex !important;
        }
        #aa-search-input {
            box-shadow: none;
        }
        .indicator__area {
            padding: 0 8px;
        }
        .mobile-header__search.mobile-header__search--opened {
            height: 100%;
            display: flex;
            align-items: center;
        }
        .mobile-header__search-form {
            width: 100%;
        }
        .mobile-header__search-form .aa-input-container {
            display: flex;
        }
        .mobile-header__search-form .aa-input-search {
            box-shadow: none;
        }
        .mobile-header__search-form .aa-hint,
        .mobile-header__search-form .aa-input {
            height: 54px;
            padding-right: 32px;
        }
        .mobile-header__search-form .aa-input-icon {
            right: 62px;
        }
        .mobile-header__search-form .aa-dropdown-menu {
            background-color: #f7f8f9;
            z-index: 9999 !important;
        }
        .aa-input-container input {
            font-size: 15px;

        }
        .toast {
            position: absolute;
            top: 10%;
            right: 10%;
            z-index: 9999;
        }
        .header-fixed .site__body {
            padding-top: 11rem;
        }
        @media (max-width: 991px) {
            .header-fixed .site__header {
                position: fixed;
                width: 100%;
                z-index: 9999;
            }
            .header-fixed .site__body {
                padding-top: 85px;
            }
            .header-fixed .mobilemenu__body {
                top: 85px;
            }
        }



        /** StickyNav **/
        .site-header.sticky {
            position: fixed;
            top: 0;
            min-width: 100%;
        }
        .site-header.sticky .site-header__middle {
            height: 65px;
        }
        /*.site-header.sticky .site-header__nav-panel,*/
        .site-header.sticky .site-header__topbar {
            display: none;
        }
        ::placeholder {
            color: #777 !important;
        }
    </style>
    @stack('styles')
    @livewireStyles
    <link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Noto+Sans+Bengali:wght@100..900&display=swap" rel="stylesheet">
</head>

<body class="header-fixed" style="margin: 0; padding: 0;">
    @include('googletagmanager::body')
    @include('facebook-pixel::body')
    <!-- quickview-modal -->
    <div id="quickview-modal" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-xl">
            <div class="modal-content"></div>
        </div>
    </div><!-- quickview-modal / end -->
    <!-- mobilemenu -->
    <div class="mobilemenu">
        <div class="mobilemenu__backdrop"></div>
        <div class="mobilemenu__body">
            <div class="mobilemenu__header">
                <div class="mobilemenu__title">Menu</div>
                <button type="button" class="mobilemenu__close">
                    <svg width="20px" height="20px">
                        <use xlink:href="{{ asset('strokya/images/sprite.svg#cross-20') }}"></use>
                    </svg>
                </button>
            </div>
            <div class="mobilemenu__content">
                <ul class="mobile-links mobile-links--level--0" data-collapse data-collapse-opened-class="mobile-links__item--open">
                    @include('partials.mobile-menu-categories')
                    @include('partials.header.menu.mobile')
                </ul>
            </div>
        </div>
    </div><!-- mobilemenu / end -->
    <!-- site -->
    <div class="site">
        <!-- mobile site__header -->
        @include('partials.header.mobile')
        <!-- mobile site__header / end -->
        <!-- desktop site__header -->
        @include('partials.header.desktop')
        <!-- desktop site__header / end -->
        <!-- site__body -->
        <div class="site__body">
            <div class="container">
                <x-alert-box class="row mt-2" />
            </div>
            @yield('content')
        </div>
        <!-- site__body / end -->
        <!-- site__footer -->
        @include('partials.footer')
        <!-- site__footer / end -->
    </div><!-- site / end -->
    @livewireScripts
    @include('layouts.yellow.js')
    <script>
        $(window).on('notify', function (ev) {
            $.notify(ev.detail.message, {
                type: ev.detail.type ?? 'info',
            });
        });
        $(window).on('dataLayer', function (ev) {
            window.dataLayer.push(ev.detail);
        });
        $(document).ready(function () {
            // $(document).on('change', '.option-picker', function (ev) {
            //     var options = [];
            //     $(document).find('.option-picker:checked').each((_, item) => options.push(item.value));
                
            //     $.get({
            //         url: '',
            //         data: {options},
            //         success: function(data) {
            //             $('.product__content').data('id', data.dataId);
            //             $('.product__content').data('max', data.dataMax);
            //             $('.product__info').remove();
            //             $('.xzoom-container').after(data.content);
            //         },
            //         dataType: 'json',
            //     });
            // });

            function onScroll() {
                $('input, textarea').blur();
                var scrollTop = $(this).scrollTop()
                if (scrollTop > 32) {
                    $('.site__header.position-fixed .topbar').hide();
                } else {
                    $('.site__header.position-fixed .topbar').show();
                }
                if (scrollTop > 200) {
                    // $('.site-header').addClass('sticky');
                    // $('.site-header__phone').removeClass('d-none');
                    $('.departments').removeClass('departments--opened departments--fixed');
                    $('.departments__body').attr('style', '');
                } else {
                    // $('.site-header').removeClass('sticky');
                    // $('.site-header__phone').addClass('d-none');
                    if ($('.departments').data('departments-fixed-by') != '')
                        $('.departments').addClass('departments--opened departments--fixed');
                    $('.departments--opened.departments--fixed .departments__body').css('min-height', '458px');
                }
            }

            $(window).on('scroll', onScroll);
            onScroll();
        });
    </script>
    @stack('scripts')
    @php
        $phone = preg_replace('/[^\d]/', '', $company->whatsapp ?? '');
        if (strlen($phone) == 11) {
            $phone = '88' . $phone;
        }
    @endphp
    @if($phone)
    <a
        href="https://api.whatsapp.com/send?phone={{$phone}}" target="_blank"
        style="position:fixed;width:60px;height:60px;bottom:40px;right:40px;background-color:#25d366;color:#FFF;border-radius:50px;text-align:center;font-size:30px;box-shadow: 2px 2px 3px #999;z-index:100;"
    >
        <i class="fab fa-whatsapp" style="margin-top: 1rem;"></i>
    </a>
    @endif
</body>

</html>
