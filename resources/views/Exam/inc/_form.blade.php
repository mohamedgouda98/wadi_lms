@csrf
{{-- Course Title --}}
<div class="form-group row">
    <label class="col-lg-3 col-form-label" for="val-title">
        @translate(Exam Name) <span class="text-danger">*</span></label>
    <div class="col-lg-9">
        <input type="text" required
               value="{{ old('name', isset($exam) ? $exam->name : null) }}"
               class="form-control @error('name') is-invalid @enderror"
               id="val-title" name="name" placeholder="@translate(Enter Exam Name)" aria-required="true" autofocus>
        @error('name') <span class="invalid-feedback" role="alert"> <strong>{{ $message }}</strong> </span> @enderror
    </div>
</div>

{{-- Slug --}}
<div class="form-group row">
    <label class="col-lg-3 col-form-label" for="val-slug">
        @translate(Slug) <span class="text-danger">*</span></label>
    <div class="col-lg-9">
        <input type="text"
               required value="{{ old('slug', isset($exam) ? $exam->slug : null) }}"
               class="form-control @error('slug') is-invalid @enderror"
               id="val-slug" name="slug" aria-required="true">
        <span id="error_email"></span>
        @error('slug') <span class="invalid-feedback" role="alert"> <strong>{{ $message }}</strong> </span> @enderror
    </div>
</div>

{{-- Degree --}}
<div class="form-group row">
    <label class="col-lg-3 col-form-label" for="val-degree">
        @translate(Degree) <span class="text-danger">*</span></label>
    <div class="col-lg-9">
        <input type="number"
               required value="{{ old('degree', isset($exam) ? $exam->degree : null) }}"
               class="form-control @error('degree') is-invalid @enderror"
               id="val-degree" name="degree" aria-required="true">
        <span id="error_email"></span>
        @error('degree') <span class="invalid-feedback" role="alert"> <strong>{{ $message }}</strong> </span> @enderror
    </div>
</div>

{{-- SuccessDegree --}}
<div class="form-group row">
    <label class="col-lg-3 col-form-label" for="val-success_degree">
        @translate(Success Degree) <span class="text-danger">*</span></label>
    <div class="col-lg-9">
        <input type="number"
               required value="{{ old('success_degree', isset($exam) ? $exam->success_degree : null) }}"
               class="form-control @error('success_degree') is-invalid @enderror"
               id="val-success_degree" name="success_degree" aria-required="true">
        <span id="error_email"></span>
        @error('success_degree') <span class="invalid-feedback" role="alert"> <strong>{{ $message }}</strong> </span> @enderror
    </div>
</div>

{{-- FailerDegree --}}
<div class="form-group row">
    <label class="col-lg-3 col-form-label" for="val-failer_degree">
        @translate(Failer Degree) <span class="text-danger">*</span></label>
    <div class="col-lg-9">
        <input type="number"
               required value="{{ old('failer_degree', isset($exam) ? $exam->failer_degree : null) }}"
               class="form-control @error('failer_degree') is-invalid @enderror"
               id="val-failer_degree" name="failer_degree" aria-required="true">
        <span id="error_email"></span>
        @error('failer_degree') <span class="invalid-feedback" role="alert"> <strong>{{ $message }}</strong> </span> @enderror
    </div>
</div>

{{-- LimitQuestions --}}
<div class="form-group row">
    <label class="col-lg-3 col-form-label" for="val-limit_questions">
        @translate(Limit Questions) <span class="text-danger">*</span></label>
    <div class="col-lg-9">
        <input type="number"
               required value="{{ old('limit_questions', isset($exam) ? $exam->limit_questions : null) }}"
               class="form-control @error('limit_questions') is-invalid @enderror"
               id="val-limit_questions" name="limit_questions" aria-required="true">
        <span id="error_email"></span>
        @error('limit_questions') <span class="invalid-feedback" role="alert"> <strong>{{ $message }}</strong> </span> @enderror
    </div>
</div>


{{-- Active --}}
<div class="form-group row">
    <label class="col-lg-3 col-form-label" for="">
        @translate(Active)</label>
    <div class="col-lg-9">
        <div class="switchery-list">
            <input type="checkbox" name="active" class="js-switch-success" id="val-active" {{ old('active') || (isset($exam) ? $exam->active : '') ? 'checked' : '' }}/>
            @error('active') <span class="invalid-feedback" role="alert"> <strong>{{ $message }}</strong> </span> @enderror
        </div>
    </div>
</div>

{{-- Close --}}
<div class="form-group row">
    <label class="col-lg-3 col-form-label" for="">
        @translate(Close)</label>
    <div class="col-lg-9">
        <div class="switchery-list">
            <input type="checkbox"   name="close" class="js-switch-success" id="val-close" {{ old('close') || (isset($exam) ? $exam->close : '') ? 'checked' : '' }}/>
            @error('close') <span class="invalid-feedback" role="alert"> <strong>{{ $message }}</strong> </span> @enderror
        </div>
    </div>
</div>

{{-- Close --}}
<div class="form-group row">
    <label class="col-lg-3 col-form-label" for="specific_class">
        @translate(Specific Class)</label>
    <div class="col-lg-9">
        <div class="switchery-list">
            <input type="checkbox"   name="specific_class" class="js-switch-success" id="specific_class" {{ old('specific_class') || (isset($exam) ? $exam->specific_class : '') ? 'checked' : '' }}/>
            @error('specific_class') <span class="invalid-feedback" role="alert"> <strong>{{ $message }}</strong> </span> @enderror
        </div>
    </div>
</div>

<div class="form-group row" id="class_select">
    <label class="col-lg-3 col-form-label" for="class">@translate(Class)</label>
    <select class="form-select form-control" id="class" name="class_id">
        <option value="">@translate(Select Class)</option>
        @foreach($classes as $class)
            <option value="{{ $class->id }}" {{ old('class_id') || (isset($exam) ? $exam->class_id : null) == $class->id }}>{{ $class->title }}</option>
        @endforeach
    </select>

    <label class="col-lg-3 col-form-label" for="class">@translate(Class)</label>
    <select class="form-select form-control" id="class_content" name="class_content_id">
        <option value="">@translate(Select Class Content)</option>

    </select>
</div>

