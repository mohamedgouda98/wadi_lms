<div>
    <div class="breadcrumb-section hero-section pb-60" style="background-image: url('{{asset('new_assets/images/breadcrumb.jpg')}}');">
        <div class="container">
            <div class="row">
                <div class="col-lg-6">
                    <h2 class="title">@translate(About) {{$count}} @translate(results)</h2>
                    <nav aria-label="breadcrumb" class="mt-20">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('homepage') }}">@translate(Home)</a></li>
                            <li class="breadcrumb-item active text-capitalize" aria-current="page">@translate(Searching for course)</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </div>
</div>