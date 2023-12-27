{{-- @extends('layouts.master')
@section('title','Page List')

@section('page-style')
    <script src="http://editor.unlayer.com/embed.js"></script>
@endsection

@section('content')
  <button id="save_html_btn" class="btn btn-primary">Save Page</button>

<div id="editor-container" style="height: 79vh;"></div>

@endsection

@section('js-link')
    
@endsection

@section('page-script')
    <script>

    class EmailEditor {
        constructor(id) {
            unlayer.init({
            id: id,
            displayMode: "web",
            appearance: {
                theme: 'dark',
            }
            });
        }

        loadDesign(design) {
            unlayer.loadDesign(design);
        }

        saveDesign(callback) {
            unlayer.saveDesign(callback);
        }
        exportHtml(callback) {
            unlayer.exportHtml(callback);
        }

    }

        const editor = new EmailEditor('editor-container');

        const saveHTMLBtn = document.getElementById('save_html_btn');

        saveHTMLBtn.addEventListener('click',e => {
        editor.exportHtml(
            d => {
                // Ajax

                console.log(d.design.body);

                var body = d.html;
                var json = d.design.body;

                $.post('{{ route('api.page.content.create') }}', 
                {_token:'{{ csrf_token() }}', 
                page_id: '{{ $id }}', 
                title: 'page 1', 
                body: body,
                json: json,
                },  
                function(data){
                    console.log(data);
                });

              }
            );
        });

    </script>
@endsection
 --}}


@extends('layouts.master')
@section('title','Page Content')
@section('content')
    <div class="card m-2">
        <div class="card-header">
            <div class="float-left">
                <h2 class="card-title">@translate(Page Content Create)</h2>
            </div>
            <div class="float-right">
                <div class="row">
                    <div class="col">
                        <a href="{{route('pages.content.index',$id)}}"
                           class="btn btn-primary">
                            <i class="la la-plus"></i>
                            @translate(Content List)
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <div class="card-body">
            <div class="card-body">
                <form action="{{route('pages.content.store',$id)}}" method="post" enctype="multipart/form-data">
                    @csrf
                    <input name="page_id" type="hidden" value="{{$id}}">
                    <div class="form-group">
                        <label>@translate(Content Title) <span class="text-danger">*</span></label>
                        <input placeholder="@translate(Enter Content Title)" class="form-control @error('title') is-invalid @enderror" type="text"
                               value="{{ old('title') }}" name="title">
                    </div>

                    <div class="form-group">
                        <label class="col-form-label" for="val-suggestions">
                            @translate(Content Description)</label>
                        <textarea required class="form-control summernote @error('body') is-invalid @enderror"
                                  name="body" rows="5" aria-required="true">{!! old('body') !!}</textarea>
                        @error('body') <span class="invalid-feedback"
                                             role="alert"> <strong>{{ $message }}</strong> </span> @enderror
                    </div>

                    <div class="float-right">
                        <button class="btn btn-primary float-right" type="submit">@translate(Save)</button>
                    </div>

                </form>
            </div>
        </div>
    </div>

@endsection


