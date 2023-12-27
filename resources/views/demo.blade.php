@extends('layouts.master')
@section('title','Page List')

@section('page-style')
    <script src="http://editor.unlayer.com/embed.js"></script>

@endsection

@section('content')
  <button id="save_html_btn" class="btn btn-primary">Save HTML</button>
  {{-- <button id="save_json_btn" class="btn btn-primary">Save JSON</button> --}}
  {{-- <button id="load_json_btn" class="btn btn-primary">Load JSON</button> --}}

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

        // const loadJsonBtn = document.getElementById('load_json_btn');
        // const saveJsonBtn = document.getElementById('save_json_btn');
        const saveHTMLBtn = document.getElementById('save_html_btn');

        saveHTMLBtn.addEventListener('click',e => {
        editor.exportHtml(
            d => console.log(d.html)
            );
        });

        // saveJsonBtn.addEventListener('click',e => {
        // editor.saveDesign(d => console.log(d));
        // });

        // loadDesignBtn.addEventListener('click',e => {
        // editor.exportHtml(d => console.log(d.html));
        // });

    </script>
@endsection
