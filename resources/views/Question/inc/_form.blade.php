@csrf
{{-- Course Title --}}
<div class="col form-group mb-4">
        <label for="question">@translate(Question) : </label>
        <textarea class="form-control questionInput  @error('question') is-invalid fparsley-error parsley-error @enderror" id="question"
                  name="question" rows="5"> {!! isset($examQuestion) ? $examQuestion->question : '' !!} </textarea>
        @error('question')
        <div class="invalid-feedback">
            {{ $message }}
        </div>
        @enderror
 </div>
<div class="row">
    <div class="col-6">
        {{-- Course Thumbnail --}}
        <div class="form-group row">
            <label class="col-md-6 form-group mb-4 col-form-label" for="val-img">
                @translate(Question Image) <span class="text-danger">*</span></label>
            <div class="col-lg-9">
                <input type="file"  value="{{ old('image') }}" class="form-control course_image @error('image') is-invalid @enderror" id="val-img" name="image">
                <img class="w-50 course_thumb_preview rounded shadow-sm d-none" src="" alt="#Course thumbnail">
                @error('image') <span class="invalid-feedback" role="alert"> <strong>{{ $message }}</strong> </span> @enderror
            </div>
        </div>
    </div>
    <div class="col-6">
        {{-- Active --}}
        <div class="form-group row">
            <label class="col-md-6 mb-4 col-form-label" for="">
                @translate(Active)</label>
            <div class="col-lg-9">
                <div class="switchery-list">
                    <input type="checkbox" name="active" class="js-switch-success" id="val-active" {{ old('active') || (isset($examQuestion) ? $examQuestion->active : '') ? 'checked' : '' }}/>
                    @error('active') <span class="invalid-feedback" role="alert"> <strong>{{ $message }}</strong> </span> @enderror
                </div>
            </div>
        </div>
    </div>
</div>




