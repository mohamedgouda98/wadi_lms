@extends('layouts.master')
@section('title','Color Setup')
@section('parentPageTitle', 'All')

@section('css-link')
<link rel="stylesheet" href="{{ asset('assets\plugins\colorpicker\bootstrap-colorpicker.css') }}">
@stop

@section('page-style')

@stop
@section('content')
    <div class="row">
        <div class="col-md-10 offset-md-1 px-5">
            <div class="card m-2">
                <div class="card-header">
                    <h3>@translate(Color Setup)</h3>
                </div>
                <div class="card-body mx-5">
                    <form method="post" action="{{ route('color.update') }}" enctype="multipart/form-data">
                    @csrf

                        <!--Primary color-->
                        <div class="card m-b-30">
                            <div class="card-header">
                                <h5 class="card-title">Primary color</h5>
                            </div>
                            <div class="card-body">
                                <div id="initial-color1" class="input-group initial-color" title="Using input value">

                                <input type="text" 
                                       class="form-control input-lg" 
                                       value="{{ getColor('primary_color') ?? '#51be78' }}" 
                                       name="primary_color"/>

                                <span class="input-group-append">
                                    <span class="input-group-text colorpicker-input-addon"><i></i></span>
                                </span>
                                </div>
                            </div>
                        </div>

                        <!--Secondary color-->
                        <div class="card m-b-30">
                            <div class="card-header">
                                <h5 class="card-title">Secondary color</h5>
                            </div>
                            <div class="card-body">
                                <div id="initial-color2" class="input-group initial-color" title="Using input value">

                                <input type="text" 
                                       class="form-control input-lg" 
                                       value="{{ getColor('secondary_color') ?? '#fff' }}" 
                                       name="secondary_color"/>

                                <span class="input-group-append">
                                    <span class="input-group-text colorpicker-input-addon"><i></i></span>
                                </span>
                                </div>
                            </div>
                        </div>

                        <!--Text color-->
                        <div class="card m-b-30">
                            <div class="card-header">
                                <h5 class="card-title">Text color</h5>
                            </div>
                            <div class="card-body">
                                <div id="initial-color3" class="input-group initial-color" title="Using input value">

                                <input type="text" 
                                       class="form-control input-lg" 
                                       value="{{ getColor('text_color') ?? '#000' }}" 
                                       name="text_color"/>

                                <span class="input-group-append">
                                    <span class="input-group-text colorpicker-input-addon"><i></i></span>
                                </span>
                                </div>
                            </div>
                        </div>

                        <!--Topbar color-->
                        <div class="card m-b-30">
                            <div class="card-header">
                                <h5 class="card-title">Topbar color</h5>
                            </div>
                            <div class="card-body">
                                <div id="initial-color4" class="input-group initial-color" title="Using input value">

                                <input type="text" 
                                       class="form-control input-lg" 
                                       value="{{ getColor('topbar') ?? '#fff' }}" 
                                       name="topbar"/>

                                <span class="input-group-append">
                                    <span class="input-group-text colorpicker-input-addon"><i></i></span>
                                </span>
                                </div>
                            </div>
                        </div>

                        <!--Primary Navbar color-->
                        <div class="card m-b-30">
                            <div class="card-header">
                                <h5 class="card-title">Primary navbar color</h5>
                            </div>
                            <div class="card-body">
                                <div id="initial-color5" class="input-group initial-color" title="Using input value">

                                <input type="text" 
                                       class="form-control input-lg" 
                                       value="{{ getColor('primary_navbar') ?? '#fff' }}" 
                                       name="primary_navbar"/>

                                <span class="input-group-append">
                                    <span class="input-group-text colorpicker-input-addon"><i></i></span>
                                </span>
                                </div>
                            </div>
                        </div>

                        <!--Button color-->
                        <div class="card m-b-30">
                            <div class="card-header">
                                <h5 class="card-title">Button color</h5>
                            </div>
                            <div class="card-body">
                                <div id="initial-color6" class="input-group initial-color" title="Using input value">

                                <input type="text" 
                                       class="form-control input-lg" 
                                       value="{{ getColor('btn') ?? '#28a745' }}" 
                                       name="btn"/>

                                <span class="input-group-append">
                                    <span class="input-group-text colorpicker-input-addon"><i></i></span>
                                </span>
                                </div>
                            </div>
                        </div>

                        <!--Button hover-->
                        <div class="card m-b-30">
                            <div class="card-header">
                                <h5 class="card-title">Button hover color</h5>
                            </div>
                            <div class="card-body">
                                <div id="initial-color8" class="input-group initial-color" title="Using input value">

                                <input type="text" 
                                       class="form-control input-lg" 
                                       value="{{ getColor('btn_hover') ?? '#2ecc71' }}" 
                                       name="btn_hover"/>

                                <span class="input-group-append">
                                    <span class="input-group-text colorpicker-input-addon"><i></i></span>
                                </span>
                                </div>
                            </div>
                        </div>

                        <!--Button text color-->
                        <div class="card m-b-30">
                            <div class="card-header">
                                <h5 class="card-title">Button text color</h5>
                            </div>
                            <div class="card-body">
                                <div id="initial-color9" class="input-group initial-color" title="Using input value">

                                <input type="text" 
                                       class="form-control input-lg" 
                                       value="{{ getColor('btn_color') ?? '#fff' }}" 
                                       name="btn_color"/>

                                <span class="input-group-append">
                                    <span class="input-group-text colorpicker-input-addon"><i></i></span>
                                </span>
                                </div>
                            </div>
                        </div>

                        <!--Button hover color-->
                        <div class="card m-b-30">
                            <div class="card-header">
                                <h5 class="card-title">Button hover color</h5>
                            </div>
                            <div class="card-body">
                                <div id="initial-color10" class="input-group initial-color" title="Using input value">

                                <input type="text" 
                                       class="form-control input-lg" 
                                       value="{{ getColor('btn_hover_color') ?? '#fff' }}" 
                                       name="btn_hover_color"/>

                                <span class="input-group-append">
                                    <span class="input-group-text colorpicker-input-addon"><i></i></span>
                                </span>
                                </div>
                            </div>
                        </div>

                        <!--Section title color-->
                        <div class="card m-b-30">
                            <div class="card-header">
                                <h5 class="card-title">Section title color</h5>
                            </div>
                            <div class="card-body">
                                <div id="initial-color11" class="input-group initial-color" title="Using input value">

                                <input type="text" 
                                       class="form-control input-lg" 
                                       value="{{ getColor('section_title') ?? '#51be78' }}" 
                                       name="section_title"/>

                                <span class="input-group-append">
                                    <span class="input-group-text colorpicker-input-addon"><i></i></span>
                                </span>
                                </div>
                            </div>
                        </div>

                        <!--Section Background color-->
                        <div class="card m-b-30">
                            <div class="card-header">
                                <h5 class="card-title">Section Background color</h5>
                            </div>
                            <div class="card-body">
                                <div id="initial-color12" class="input-group initial-color" title="Using input value">

                                <input type="text" 
                                       class="form-control input-lg" 
                                       value="{{ getColor('section_bg') ?? '#EDF8F1' }}" 
                                       name="section_bg"/>

                                <span class="input-group-append">
                                    <span class="input-group-text colorpicker-input-addon"><i></i></span>
                                </span>
                                </div>
                            </div>
                        </div>

                        <!--Footer title color-->
                        <div class="card m-b-30">
                            <div class="card-header">
                                <h5 class="card-title">Footer title color</h5>
                            </div>
                            <div class="card-body">
                                <div id="initial-color13" class="input-group initial-color" title="Using input value">

                                <input type="text" 
                                       class="form-control input-lg" 
                                       value="{{ getColor('footer_title') ?? '#fff' }}" 
                                       name="footer_title"/>

                                <span class="input-group-append">
                                    <span class="input-group-text colorpicker-input-addon"><i></i></span>
                                </span>
                                </div>
                            </div>
                        </div>

                        <!--Footer link color-->
                        <div class="card m-b-30">
                            <div class="card-header">
                                <h5 class="card-title">Footer link color</h5>
                            </div>
                            <div class="card-body">
                                <div id="initial-color14" class="input-group initial-color" title="Using input value">

                                <input type="text" 
                                       class="form-control input-lg" 
                                       value="{{ getColor('footer_link') ?? '#fff' }}" 
                                       name="footer_link"/>

                                <span class="input-group-append">
                                    <span class="input-group-text colorpicker-input-addon"><i></i></span>
                                </span>
                                </div>
                            </div>
                        </div>

                        <!--Footer Background color-->
                        <div class="card m-b-30">
                            <div class="card-header">
                                <h5 class="card-title">Footer Background color</h5>
                            </div>
                            <div class="card-body">
                                <div id="initial-color15" class="input-group initial-color" title="Using input value">

                                <input type="text" 
                                       class="form-control input-lg" 
                                       value="{{ getColor('footer_bg') ?? '#233d63' }}" 
                                       name="footer_bg"/>

                                <span class="input-group-append">
                                    <span class="input-group-text colorpicker-input-addon"><i></i></span>
                                </span>
                                </div>
                            </div>
                        </div>

                        <div class="m-2 float-right">
                            <button class="btn btn-primary" type="submit">@translate(Save)</button>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>


@endsection



@section('js-link')

@stop

@section('page-script')

<!-- Color Picker js -->
    <script src="{{ asset('assets/plugins/colorpicker/bootstrap-colorpicker.js') }}"></script>
    <script>
        /*
        ----------------------------------------
            : Custom - Form Colorpicker js :
        ----------------------------------------
        */
        "use strict";
        $(document).ready(function() {
            /* -- Form - Color Picker -- */
            $('.initial-color').colorpicker({
                format: 'auto'
            });
        });
    </script>
@stop