@extends('layouts.master')
@section('title','Add Answer')
@section('parentPageTitle', 'Answer')
@section('css-link')
    @include('layouts.include.form.form_css')
@stop
@section('page-style')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
@stop
@section('content')
    <!-- BEGIN:content -->
    <div class="card m-b-30">
        <h4 class="card-header">@translate(Add Answer)</h4>
        <div class="card-body mx-3">
            <form action="{{ route('answer.store') }}" method="POST">
                @csrf
                <input type="hidden" name="exam_question_id" value="{{ $question->id }}">
                <input type="hidden" name="exam_type" value="{{$question->exam->exam_type}}">
                <div class="mb-4 d-flex align-items-center">
                    <div class="input-group">
                        <div class="input-group-prepend">
                        <span class="input-group-text input--icon--bg"
                        id="inputGroupPrepend">@translate(Answer)</span>
                        </div>

                        <input type="text"
                               class="form-control @error('answer') is-invalid fparsley-error parsley-error @enderror"
                               id="answer" placeholder="@translate(Answer)"
                               aria-describedby="inputGroupPrepend" name="answer">

                        @error('answer')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                    <div class="ml-5">
                        <button class="btn btn-success submitChoicesAnswer" type="submit">@translate(Add)</button>
                    </div>
                </div>
                <ul class="list-group mt-5" id="answers_list">
                    @foreach ($question->answers as $answer)
                        <li class="list-group-item mb-3 {{$answer->correct == 1 ? 'badge-success' : ''}}">
                            <span>{{$answer->answer}}</span>
                            <a href="{{route('answer.destroy',$answer->id)}}" class="float-right text-danger ml-4" style="font-size: 1.5em">
                                <i class="fa fa-trash-can"></i>
                            </a>
                            <a data-toggle="modal" data-target="#exampleModal{{$answer->id}}" class="float-right text-info ml-4 answer-url" style="font-size: 1.5em">
                                <i class="fa fa-pen" onclick="handleUpdateAnswer({{$answer->id}},'{{$answer->answer}}')"></i>
                            </a>
                            <a href="{{route('answer.makeCorrect',$answer->id)}}" class="float-right {{$answer->correct == 1 ? 'text-white' : ''}}" style="font-size: 1.5em">
                                <i class="fa fa-circle-check"></i>
                            </a>
                        </li>
                    @endforeach
                </ul>
            </form>
            <!-- Modal -->
            <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">@translate(Answer)</h5>
                        </div>
                        <div class="modal-body">
                            <input type="text" class="form-control" id="modalAnswerInput" placeholder="@translate(Answer)" aria-describedby="inputGroupPrepend">
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-primary" onclick="handleSubmitUpdateAnswer()">@translate(Submit)</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- END:content -->
@endsection
@section('js-link')
    @include('layouts.include.form.form_js')
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>
    <script>
        let currentAnswerId = null;

        function handleUpdateAnswer(id, answer) {
             currentAnswerId = id;
            $('#modalAnswerInput').val(answer);
            $('#exampleModal').modal('show');
        }

        function handleSubmitUpdateAnswer() {
            let answer = $('#modalAnswerInput').val();
            let url = "{{ route('answer.updateAnswer') }}";
            $.ajax({
                url: url,
                type: 'PUT',
                data: {
                    id: currentAnswerId,
                    answer: answer,
                    _token: '{{ csrf_token() }}'  // Include CSRF token
                },
                success: function(res) {
                    if(res.status === 200) {
                        Swal.fire('Success !', 'Answer Was Updated !', 'success').then(() => {
                            location.reload();
                        });
                    }
                },
                error: function(xhr, status, error) {
                    // Handle errors
                    console.error(error);
                    Swal.fire('Error', 'An error occurred', 'error');
                }
            });
        }
    </script>
    <script>
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $('.submitChoicesAnswer').on('click', function(e) {
            e.preventDefault()

            let answer = $('input[name="answer"]').val()
            let exam_type = $('input[name="exam_type"]').val()
            let exam_question_id = $('input[name="exam_question_id"]').val()
            let url = "{{ route('answer.store') }}"

            $.ajax({
                url: url,
                type: 'post',
                data: {
                    exam_type,
                    answer,
                    exam_question_id,
                    _token: $('input[name="_token"]').val(),
                },
                success: function(res){

                    if(res.status === 200)
                    {
                        $('#answers_list').append(`
                                          <li class="list-group-item mb-3 ${res.answer.correct == 1 ? 'correct--answer' : ''}">
                                                <span>${res.answer.answer}</span>
                                                <a href="/answer/delete/${res.answer.id}" class="float-right text-danger ml-4" style="font-size: 1.5em">
                                                      <i class="fa-regular fa-trash-can"></i>
                                                </a>
                                                <a data-toggle="modal" data-target="#exampleModal${res.answer.id}" class="float-right text-info ml-4" style="font-size: 1.5em">
                                                      <i class="fa-solid fa-pen" onclick="handleUpdateAnswer(${res.answer.id},'${res.answer.answer}')"></i>
                                                </a>
                                                <a href="/answer/makeCorrect/${res.answer.id}" class="float-right text-success" style="font-size: 1.5em">
                                                      <i class="fa-regular fa-circle-check"></i>
                                                </a>
                                          </li>

                                    `)
                        $('input[name="answer"]').val('')
                    }
                }
            });
        })
    </script>
@stop
