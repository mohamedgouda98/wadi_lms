@php
    $primary_color = getColor('primary_color') ?? '#51be78';
    $secondary_color = getColor('secondary_color') ?? '#fff';
    $text_color = getColor('text_color') ?? '#000';
    $topbar = getColor('topbar') ?? '#fff';
    $primary_navbar = getColor('primary_navbar') ?? '#fff';
    $btn = getColor('btn') ?? '#28a745';
    $btn_hover = getColor('btn_hover') ?? '#2ecc71';
    $btn_color = getColor('btn_color') ?? '#fff';
    $btn_hover_color = getColor('btn_hover_color') ?? '#fff';
    $section_title = getColor('section_title') ?? '#51be78';
    $section_bg = getColor('section_bg') ?? '#EDF8F1';
    $footer_title = getColor('footer_title') ?? '#fff';
    $footer_link = getColor('footer_link') ?? '#fff';
    $footer_bg = getColor('footer_bg') ?? '#233d63';
@endphp

<style>

    /* PRIMARY COLOR */
    .count__title {
        color: {{ $primary_color }} !important;
    }

    /** topbar */
    .header-top{
        background-color: {{ $topbar }} !important;
    }

    /* SECONDARY COLOR */
    .header-menu-content{
        background-color: {{ $primary_navbar }} !important;
    }

    /** Section title **/
    .section__meta, .card__label-text, .section-divider{
        color: {{ $section_title }} !important;
        background-color: {{ $section_bg }} !important;
    }

    /* text color */
    a {
        color: {{ $text_color }} !important;
    }

    .cat__title a{
        color: {{ $primary_color }} !important;
    }

    .theme-btn{
        color: {{ $btn_color }} !important;
        border-color: {{ $btn }} !important;
        background-color: {{ $btn }} !important;
    }

    /* button color */
    .btn-success{
        background-color: {{ $btn }} !important;
        border-color: {{ $btn }} !important;
    }

    /* button hover color */
    .theme-btn:hover {
        background-color: {{ $btn_hover }} !important;
        color: {{ $btn_hover_color }} !important;
        border-color: {{ $btn }} !important;
    }

    /* footer background color */

    /* footer text color */

    /* footer title color */

    .footer-widget .widget-title{
        color: {{ $footer_title }} !important;
    }

    /* footer link color */
    .footer-widget .list-items li a{
        color: {{ $footer_link }} !important;
    }

    .footer-area{
        background-color: {{ $footer_bg }} !important;
    }


</style>