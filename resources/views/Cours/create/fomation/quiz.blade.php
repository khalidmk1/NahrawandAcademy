@extends('Layouts.master')

@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Create Quiz</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <section class="content">
        <div class="container-fluid">
            @include('Layouts.errorshandler')
            <div class="row">

                <div class="card card-default col-12">
                    <div class="card-header row">
                        <div class="col-6">
                            <h3 class="card-title">Create Quiz </h3>
                        </div>
                        <div class="col-6">
                            <a href="{{ Route('dashboard.create.video.fomation', Crypt::encrypt($coursFormationId->id)) }}"
                                style="float: inline-end" class="btn btn-block btn-info w-25">Create Video</a>
                        </div>
                    </div>
                    <!-- /.card-header -->

                    <div class="card-body">




                        <ul class="nav nav-tabs mb-3 justify-content-between" id="myTab" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab"
                                    aria-controls="home" aria-selected="true">QSM</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" id="profile-tab" data-toggle="tab" href="#profile" role="tab"
                                    aria-controls="profile" aria-selected="false">Question</a>
                            </li>



                        </ul>
                        <div class="tab-content" id="myTabContent">
                            <div class="tab-pane fade show active" id="home" role="tabpanel"
                                aria-labelledby="home-tab">

                                <form action="{{ Route('dashboard.store.formation.quiz') }}" id="create_quiz"
                                    method="post">
                                    @csrf

                                    <input type="text" hidden name="courId" value="{{ $courId }}">

                                    <div class="form-group question">
                                        <label for="Question">Question</label>
                                        <input type="text" class="form-control question_text " name="Question"
                                            id="Question" placeholder="Enter Question ...">
                                    </div>

                                    <div class="form-group">
                                        <label for="RightAwnser">The correct answer</label>
                                        <input type="text" value="{{ old('RightAwnser') }}" class="form-control"
                                            name="RightAwnser" id="RightAwnser" placeholder="Enter The correct answer ...">
                                    </div>

                                    @if ($checkCountRate)
                                        <div class="d-flex justify-content-around  align-items-center" id="addsection">

                                            <div class="form-group row">
                                                <label for="Rate">Sccess Rate</label>
                                                <input type="text" value="{{ $checkCountRate->rateSeccess }}"
                                                    class="form-control" name="Rate" id="Rate"
                                                    placeholder="Enter Rate Sccess ...">
                                            </div>
                                            <div class="form-group row">
                                                <label for="count">How many to send?</label>
                                                <input type="text" value="{{ $checkCountRate->Answercount }}"
                                                    class="form-control" name="count" id="count"
                                                    placeholder="Enter ...">
                                            </div>
                                        </div>
                                    @else
                                        <div class="d-flex justify-content-around  align-items-center" id="addsection">

                                            <div class="form-group row">
                                                <label for="Rate">Sccess Rate </label>
                                                <input type="text" value="{{ old('Rate') }}" class="form-control"
                                                    name="Rate" id="Rate" placeholder="Entrez Rate ...">
                                            </div>
                                            <div class="form-group row">
                                                <label for="count">How many to send?</label>
                                                <input type="text" value="{{ old('count') }}" class="form-control"
                                                    name="count" id="count"
                                                    placeholder="Enter ...">
                                            </div>
                                        </div>
                                    @endif



                                    <div id="container">


                                        <button id="addBtn" type="button" class="btn btn-primary">Add
                                            Response</button>
                                    </div>


                                    <div class="row">
                                        <div class="col-12">
                                            <button type="submit" class="btn btn-block btn-info w-25 mt-2"
                                                style="float: right">Create QSM</button>
                                        </div>


                                    </div>

                                </form>

                                <div class="col-12 ">
                                    <div class="row mt-4">
                                        @include('Cours.create.fomation.cardQuiz')
                                    </div>
                                </div>


                            </div>



                            <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
                                <form action="{{ Route('dashboard.store.formation.question') }}" id="create_Question"
                                    method="post">
                                    @csrf
                                    <input type="text" hidden name="courId" value="{{ $courId }}">

                                    <div class="form-group Question">
                                        <label for="Question">Question</label>
                                        <input type="text" class="form-control question_text " name="Question[]"
                                            required id="Question" placeholder="Entrez Question ...">
                                    </div>

                                    <div id="containerQuestion">


                                        <button id="addQuestion" type="button" class="btn btn-primary">Add
                                            Question</button>
                                    </div>
                                    <div class="row">
                                        <div class="col-12">
                                            <button type="submit" class="btn btn-block btn-info w-25 mt-2"
                                                style="float: right">Create Questions</button>
                                        </div>

                                        <div class="col-12">
                                            <div class="row mt-5 ContentQuestion">




                                            </div>
                                        </div>

                                    </div>

                                </form>


                            </div>

                        </div>

                    </div>
                </div>
            </div>


        </div>
    </section>



    <!-- jQuery -->
    <script src="{{ asset('plugins/jquery/jquery.min.js') }}"></script>

    <script>
        $(document).ready(function() {

            let index = $('.reponse').length;

            function addAnswer() {
                index++;
                let newAnswer = `

            <div class="form-group reponse">
                            <label for="awnser_${index}" class="answer_label">The response ${index}</label>
                           <div class="position-relative">
                            <input name="awnser[]" type="text" class="form-control response" required id="Awnser_${index}"
                                aria-label="Text input with checkbox">

                            <i class="fa fa-trash position-absolute removeBtn" 
                            style="right: 12px; color: red; bottom: 12px; z-index: 1000;"
                            aria-hidden="true"></i>
                            </div>
                        </div>

            
            `;
                $('#addBtn').remove();

                $('#container').append(newAnswer);
            }

            $(document).on('click', '#addBtn', function() {
                addAnswer();
                let addButton =
                    `  <button id="addBtn" type="button" class="btn btn-primary">Add Response</button>
                          `;
                $('#container').append(addButton);
            });

            $(document).on('click', '.removeBtn', function() {
                $(this).closest('.reponse').remove();
                index--;

                $('.reponse').each(function(index) {
                    $(this).find('.answer_label').text(`Réponse ${index + 1}`);
                });
            });


            //Question type



            let Question = $('.Question').length;

            function addQuestion() {
                Question++;
                let newQuestion = `
        <div class="form-group response">
            <label for="Question_${Question}" class="Question_label">Question ${Question}</label>
            <div class="position-relative">
                <input name="Question[]" type="text" class="form-control Question" id="Question_${Question}" aria-label="Text input with checkbox" required>
                <i class="fa fa-trash position-absolute removeQuestion" style="right: 12px; color: red; bottom: 12px; z-index: 1000;" aria-hidden="true"></i>
            </div>
        </div>
    `;
                $('#addQuestion').remove();
                $('#containerQuestion').append(newQuestion);
            }

            $(document).on('click', '#addQuestion', function() {
                addQuestion();
                let addButton =
                    `<button id="addQuestion" type="button" class="btn btn-primary">Add Question</button>`;
                $('#containerQuestion').append(addButton);
            });

            $(document).on('click', '.removeQuestion', function() {
                $(this).closest('.form-group').remove();
                Question--;

                $('.Question').each(function(index) {
                    $(this).closest('.form-group').find('.Question_label').text(
                        `Question ${index + 1}`);
                });
            });


            $('#create_Question').submit(function(e) {

                e.preventDefault();
                var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
                var formData = new FormData(this);
                /*  var $form = $(this); */

                $.ajax({
                    url: $(this).attr('action'),
                    method: $(this).attr('method'),
                    data: formData,
                    processData: false,
                    contentType: false,
                    headers: {
                        'X-CSRF-TOKEN': CSRF_TOKEN
                    },
                    success: function(response) {

                        console.log(response);

                        /* $('.Question').remove(); */

                        $('.ContentQuestion').html(response)

                        $('#create_quiz')[0].reset();

                        $('body,html').animate({
                            scrollTop: $('body').height()
                        }, 800);


                        /*  $form.closest('.ui_delete').parent('.col.mb-4').remove(); */


                    },
                    error: function(xhr, textStatus, errorThrown) {

                        $('html, body').animate({
                            scrollTop: "0px"
                        }, 800);

                        console.log(xhr);
                        console.log(textStatus);
                        console.log(errorThrown);


                        var errors = xhr.responseJSON.errors;
                        var errorMessages = '';


                        $.each(errors, function(field, messages) {
                            $.each(messages, function(key, message) {
                                errorMessages +=
                                    '<div class="alert alert-warning alert-dismissible fade show ml-1" role="alert">';
                                errorMessages +=
                                    '<i class="icon fas fa-exclamation-triangle"></i> ' +
                                    message;
                                errorMessages +=
                                    '<button type="button" class="close" data-dismiss="alert" aria-label="Close">';
                                errorMessages +=
                                    '<span aria-hidden="true">&times;</span></button></div>';
                            });
                        });

                        $('#message_containe').html(errorMessages);
                    },
                })

            })






        });
    </script>
@endsection
