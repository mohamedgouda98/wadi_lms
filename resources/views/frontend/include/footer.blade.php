@if(!request()->is('student/*'))

    <!-- ================================
           Start FOOTER AREA
  ================================= -->
    <section style="background-color: #9fe870 !important;" class="footer-area section-bg-2 padding-top-100px padding-bottom-40px {{ request()->is('student/*') ? 'student-dashboard' : '' }}">
        <div class="container">
            <div class="row">
                <div class="{{ request()->is('student/*') ? 'col-lg-3 offset-md-2' : 'col-lg-4' }} column-td-half">
                    <div class="footer-widget">
                        <a href="{{route('homepage')}}">
                            <img src="{{ filePath(getSystemSetting('footer_logo')->value) }}"
                                 alt="{{getSystemSetting('type_name')->value}}" class="footer__logo img-fluid w-50">
                        </a>
                        <ul class="list-items footer-address">
                            <li>
                                <a href="tel:{{getSystemSetting('type_number')->value}}" style="color:#063f12 !important">{{getSystemSetting('type_number')->value}}</a>
                            </li>
                            <li><a href="mailto:{{getSystemSetting('type_mail')->value}}"
                                   class="mail" style="color:#063f12 !important">{{getSystemSetting('type_mail')->value}}</a></li>
                            <li style="color:#063f12 !important">{{getSystemSetting('type_address')->value}}</li>
                        </ul>
                        <h3 class="widget-title font-size-17 mt-4" style="color:#063f12 !important">@translate(We are on)</h3>
                        <ul class="social-profile">
                            @if(getSystemSetting('type_fb')->value != null)
                                <li><a href="{{getSystemSetting('type_fb')->value}}" target="_blank"><i
                                            class="fa fa-facebook"></i></a></li>
                            @endif
                            @if(getSystemSetting('type_tw')->value != null)
                                <li><a href="{{getSystemSetting('type_tw')->value}}" target="_blank"><i
                                            class="fa fa-twitter"></i></a></li>
                            @endif
                            @if(getSystemSetting('type_google')->value != null)
                                <li><a href="{{getSystemSetting('type_google')->value}}" target="_blank"><i
                                            class="fa fa-google"></i></a></li>
                            @endif
                            @if(getSystemSetting('type_instagram')->value != null)
                                    <li><a href="{{getSystemSetting('type_instagram')->value}}" target="_blank"><i
                                                class="fa fa-instagram"></i></a></li>
                            @endif
                        </ul>
                    </div><!-- end footer-widget -->
                </div><!-- end col-lg-4 -->
                <div class="{{ request()->is('student/*') ? 'col-lg-3' : 'col-lg-4' }} column-td-half">
                    <div class="footer-widget">
                        <h3 class="widget-title" style="color:#063f12 !important">@translate(Company)</h3>
                        <span class="section-divider" style="color:#063f12 !important"></span>
                        <ul class="list-items" style="color:#063f12 !important">
                            @foreach(\App\Models\Page::where('active',1)->get() as $item)
                                <li><a href="{{route('pages',$item->slug)}}" style="color:#063f12 !important">{{$item->title}}</a></li>
                            @endforeach
                        </ul>
                    </div><!-- end footer-widget -->
                </div><!-- end col-lg-4 -->
                <div class="{{ request()->is('student/*') ? 'col-lg-3' : 'col-lg-4' }} column-td-half">
                    <div class="footer-widget">
                        <h3 class="widget-title" style="color:#063f12 !important">@translate(Courses)</h3>
                        <span class="section-divider"></span>
                        <ul class="list-items">
                            @foreach(\App\Models\Category::Published()->where('top', 1)->get() as $item)
                                <li><a href="{{route('course.category',$item->slug)}}" style="color:#063f12 !important">{{$item->name}}</a></li>
                            @endforeach
                        </ul>
                    </div><!-- end footer-widget -->
                </div><!-- end col-lg-4 -->

            </div><!-- end row -->
            <div class="copyright-content">
                <div class="row align-items-center">
                    <div class="col-lg-12" style="text-align: center">
                        <p class="copy__desc" style="color:#063f12 !important">&copy; {{date('Y')}} {{getSystemSetting('type_footer')->value}}</p>
{{--                        <p class="copy__desc" style="color:#063f12 !important">Developed By <a href="https://unlimited-software.com" target="_blank">Unlimited Software House</a></p>--}}
                    </div><!-- end col-lg-9 -->
{{--                    <div class="col-lg-2">--}}
{{--                        <div class="sort-ordering">--}}
{{--                            <form id="ru-currency" method="post" action="{{route('frontend.currencies.change')}}">--}}
{{--                                @csrf--}}
{{--                                <select class="sort-ordering-select selectpicker" data-live-search="true" tabindex="-98" name="id" onchange="currencyChange()">--}}
{{--                                    @foreach(\App\Models\Currency::where('is_published',true)->get() as $item)--}}
{{--                                        <option  value="{{$item->id}}" {{defaultCurrency() == $item->code ? 'selected' : null}}> {{Str::ucfirst($item->symbol.' '.$item->code)}}</option>--}}
{{--                                    @endforeach--}}
{{--                                </select>--}}
{{--                            </form>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                    <div class="col-lg-2">--}}
{{--                        <div class="sort-ordering my-2">--}}
{{--                            <form id="ru-lang" method="post" action="{{route('frontend.languages.change')}}">--}}
{{--                                @csrf--}}
{{--                                <select class="sort-ordering-select  selectpicker" tabindex="-98" name="code" data-live-search="true" onchange="languageChange()">--}}
{{--                                    @foreach(\App\Models\Language::all() as $language)--}}
{{--                                        <option  value="{{$language->code}}"  {{(\Illuminate\Support\Facades\Session::get('locale') == $language->code ? 'selected' : env('DEFAULT_LANGUAGE') == $language->code ) ? 'selected' : null }}>{{$language->name}}</option>--}}
{{--                                    @endforeach--}}
{{--                                </select>--}}
{{--                            </form>--}}
{{--                        </div>--}}
{{--                    </div>--}}
                </div><!-- end row -->
            </div><!-- end copyright-content -->
        </div><!-- end container -->
    </section><!-- end footer-area -->
    <!-- ================================
              END FOOTER AREA
    ================================= -->
@endif
