<style>
    :root {
        --primary: {{$color->primary->background_color}};
    }
    ::placeholder {
        color: #ccc !important;
    }
    .topbar, .site-header .topbar {
        background-color: {{$color->topbar->background_color}} !important;
        color: {{$color->topbar->text_color}} !important;
    }
    .topbar:hover, .site-header .topbar:hover {
        background-color: {{$color->topbar->background_hover}} !important;
        color: {{$color->topbar->text_hover}} !important;
    }
    .topbar .topbar-link, .site-header .topbar .topbar-link {
        color: {{$color->topbar->text_color}} !important;
    }
    .topbar .topbar-link:hover, .site-header .topbar .topbar-link:hover {
        color: {{$color->topbar->text_hover}} !important;
    }
    .site-header, .mobile-header__panel {
        background-color: {{$color->header->background_color}} !important;
        color: {{$color->header->text_color}} !important;
    }
    .site-header:hover, .mobile-header__panel {
        background-color: {{$color->header->background_hover}} !important;
    }
    .site-header__phone-title, .site-header__phone-number {
        color: {{$color->header->text_color}} !important;
    }
    .site-header a:hover, .mobile-header__panel a:hover {
        color: {{$color->header->text_hover}} !important;
    }
    .site-header .site-header__search input {
        /* background-color: {{$color->search->background_color}} !important; */
        color: {{$color->search->text_color}} !important;
        border-color: {{$color->search->text_color}} !important;
    }
    /* .site-header .site-header__search input:focus {
        background-color: {{$color->search->background_hover}} !important;
        color: {{$color->search->text_hover}} !important;
    } */
    .site-header .site-header__search figure {
        background-color: {{$color->search->background_color}} !important;
        color: {{$color->search->text_color}} !important;
        border: 2px solid {{$color->search->text_color}} !important;
        border-left: none !important;
    }
    .site-header .site-header__search figure:hover {
        background-color: {{$color->search->background_hover}} !important;
        color: {{$color->search->text_hover}} !important;
    }
    .site-header .nav-panel {
        background-color: {{$color->navbar->background_color}} !important;
    }
    .nav-links__item>a span, .indicator .indicator__area {
        color: {{$color->navbar->text_color}} !important;
    }
    .mobile-header__menu-button {
        fill: {{$color->header->text_color}} !important;
    }
    .mobile-header__indicators .indicator__area {
        color: {{$color->header->text_color}} !important;
    }
    .nav-links__item:hover>a span, .indicator--trigger--click.indicator--opened .indicator__area, .indicator:hover .indicator__area {
        background: {{$color->navbar->background_hover}} !important;
        color: {{$color->navbar->text_hover}} !important;
    }
    .mobile-header__indicators .indicator--trigger--click.indicator--opened .indicator__area, .mobile-header__indicators .indicator:hover .indicator__area {
        background: {{$color->header->background_hover}} !important;
        color: {{$color->header->text_hover}} !important;
    }
    .indicator__value {
        background: {{$color->header->background_color}} !important;
        color: {{$color->header->text_color}} !important;
    }
    .mobile-header__indicators .indicator__value {
        background: {{$color->navbar->background_color}} !important;
        color: {{$color->navbar->text_color}} !important;
    }
    .departments {
        color: {{$color->category_menu->text_color}} !important;
    }
    .departments__body {
        background: {{$color->category_menu->background_color}} !important;
    }
    .departments__links>li:hover>a {
        background: {{$color->category_menu->background_hover}} !important;
        color: {{$color->category_menu->text_hover}} !important;
    }
    .departments__link-arrow, .departments__button-icon, .departments__button-arrow {
        fill: {{$color->category_menu->text_color}} !important;
    }
    .block-header__title, .block-header__arrow {
        background: {{$color->section->background_color}} !important;
    }
    .block-header__title:hover, .block-header__arrow:hover {
        background: {{$color->section->background_hover}} !important;
    }
    .block-header__title a, .block-header__arrow {
        color: {{$color->section->text_color}} !important;
        fill: {{$color->section->text_color}} !important;
    }
    .block-header__title a:hover, .block-header__arrow:hover {
        color: {{$color->section->text_hover}} !important;
        fill: {{$color->section->text_hover}} !important;
    }
    .block-header__divider {
        background: {{$color->section->background_color}} !important;
    }
    .block-header .btn-all {
        background: {{$color->section->background_color}} !important;
        color: {{$color->section->text_color}} !important;
    }
    .block-header .btn-all:hover {
        background: {{$color->section->background_hover}} !important;
        color: {{$color->section->text_hover}} !important;
    }
    .site-footer {
        background: {{$color->footer->background_color}} !important;
        color: {{$color->footer->text_color}} !important;
    }
    .site-footer:hover {
        background: {{$color->footer->background_hover}} !important;
    }
    .site-footer li:hover {
        color: {{$color->footer->text_hover}} !important;
    }
    .product-card:before {
        box-shadow: inset 0 0 0 1px {{$color->primary->text_color}} !important;
    }
    .product-card:hover:before {
        box-shadow: inset 0 0 0 2px {{$color->primary->text_color}} !important;
    }
    .product-card__badge--sale {
        background: {{$color->primary->background_color}} !important;
    }
    .product-card__badge--sale:hover {
        background: {{$color->primary->background_hover}} !important;
    }
    .btn-primary {
        background-color: {{$color->primary->background_color}} !important;
        border-color: {{$color->primary->background_color}} !important;
        color: {{$color->primary->text_color}} !important;
    }
    .btn-primary:hover {
        background-color: {{$color->primary->background_hover}} !important;
        border-color: {{$color->primary->background_hover}} !important;
        color: {{$color->primary->text_hover}} !important;
    }
    .btn-secondary {
        background-color: {{$color->secondary->background_color}} !important;
        border-color: {{$color->secondary->background_color}} !important;
        color: {{$color->secondary->text_color}} !important;
    }
    .btn-secondary:hover {
        background-color: {{$color->secondary->background_hover}} !important;
        border-color: {{$color->secondary->background_hover}} !important;
        color: {{$color->secondary->text_hover}} !important;
    }
</style>