<!-- Modal -->
<div class="modal fade" id="exampleModal_{{ $video->id }}" tabindex="-1" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{ Route('dashboard.quiz.video') }}" id="create_quiz" method="post">
                @csrf
                <div class="modal-body">

                    <input type="text" hidden value="{{ $video->id }}" name="courvideoId">

                    <div class="form-group question">
                        <label for="Question">Question</label>
                        <input type="text" class="form-control question_text " name="Question" id="Question"
                            required placeholder="Entrez Question ...">
                    </div>

                    <div class="form-group">
                        <label for="RightAwnser">la bonne réponse</label>
                        <input type="text" value="{{ old('RightAwnser') }}" class="form-control" name="RightAwnser"
                            id="RightAwnser" placeholder="Entrez la bonne réponse ..." required>
                    </div>
                    {{-- 
                    <div class="d-flex justify-content-around  align-items-center" id="addsection">

                        <div class="form-group row">
                            <label for="Rate">Sccess Rate ?</label>
                            <input type="text" value="{{ old('Rate') }}" class="form-control" name="Rate"
                                id="Rate" placeholder="Entrez Rate ...">
                        </div>
                        <div class="form-group row">
                            <label for="count">Combien tu Veux Envoyer ?</label>
                            <input type="text" value="{{ old('count') }}" class="form-control" name="count"
                                id="count" placeholder="Entrez la bonne réponse ...">
                        </div>
                    </div> --}}

                    @if ($checkCountRate)
                        <div class="d-flex justify-content-around  align-items-center" id="addsection">

                            <div class="form-group row">
                                <label for="Rate">Sccess Rate ?</label>
                                <input type="text" value="{{ $checkCountRate->rateSeccess }}" class="form-control"
                                    name="Rate" id="Rate" placeholder="Entrez Rate ...">
                            </div>
                            <div class="form-group row">
                                <label for="count">Combien tu Veux Envoyer ?</label>
                                <input type="text" value="{{ $checkCountRate->Answercount }}" class="form-control"
                                    name="count" id="count" placeholder="Entrez la bonne réponse ...">
                            </div>
                        </div>
                    @else
                        <div class="d-flex justify-content-around  align-items-center" id="addsection">

                            <div class="form-group row">
                                <label for="Rate">Sccess Rate ?</label>
                                <input type="text" value="{{ old('Rate') }}" class="form-control" name="Rate"
                                    id="Rate" placeholder="Entrez Rate ...">
                            </div>
                            <div class="form-group row">
                                <label for="count">Combien tu Veux Envoyer ?</label>
                                <input type="text" value="{{ old('count') }}" class="form-control" name="count"
                                    id="count" placeholder="Entrez la bonne réponse ...">
                            </div>
                        </div>
                    @endif



                    <div id="container_{{ $video->id }}">


                        <button type="button" id="addBtn_{{ $video->id }}" class="btn btn-primary ">Ajouter
                            Réponse</button>
                    </div>


                    <div class="row">
                        <div class="col-12">

                        </div>


                    </div>


                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-block btn-info w-25 mt-2" style="float: right">Ajouter
                        QSM</button>
                </div>

            </form>
        </div>
    </div>
</div>

<!-- jQuery -->
<script src="{{ asset('plugins/jquery/jquery.min.js') }}"></script>

<script>
    $(document).ready(function() {
        let index = 0; // Initialize index to 0

        function addAnswer() {
            index++;
            let newAnswer = `
            <div class="form-group reponse">
                <label for="awnser_${index}" class="answer_label">la réponse ${index}</label>
                <div class="position-relative">
                    <input name="awnser[]" required type="text" class="form-control response" required id="Awnser_${index}" aria-label="Text input with checkbox">
                    <i class="fa fa-trash position-absolute removeBtn" style="right: 12px; color: red; bottom: 12px; z-index: 1000;" aria-hidden="true"></i>
                </div>
            </div>`;
            $('#addBtn_{{ $video->id }}').remove();
            $('#container_{{ $video->id }}').append(newAnswer);
        }

        $(document).on('click', '#addBtn_{{ $video->id }}', function() {
            addAnswer();
            let addButton =
                `<button type="button" id="addBtn_{{ $video->id }}" class="btn btn-primary addBtn">Ajouter Réponse</button>`;
            $('#container_{{ $video->id }}').append(addButton);
        });

        $(document).on('click', '.removeBtn', function() {
            $(this).closest('.reponse').remove();
            // No need to decrement index here
            $('.reponse').each(function(index) {
                // Update the label text for each response
                $(this).find('.answer_label').text(`Réponse ${index + 1}`);
            });
        });
    });
</script>
