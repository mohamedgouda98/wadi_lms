<div class="card-body">
    <form action="{{ route('student.enroll.courses.modal.store', $id) }}" method="post" enctype="multipart/form-data">
        @csrf

        @forelse (course() as $course)
            <div class="form-check">
                <input type="checkbox" 
                        name="course_id[]" 
                        value="{{ $course->id }}" 
                        class="form-check-input" 
                        id="exampleCheck-{{ $course->id }}"
                        
                        @foreach ($enrollments as $enrollment)
                            @if ($enrollment->course_id == $course->id)
                                checked
                            @endif
                        @endforeach
                        
                        >
                <label class="form-check-label" for="exampleCheck-{{ $course->id }}">{{ $course->title }}</label>
            </div>
        @empty
            
        @endforelse
        
          
        <div class="float-right">
            <button class="btn btn-primary float-right" type="submit">@translate(Save)</button>
        </div>

    </form>
</div>