


@foreach ($questions as $Question)
    <div class="col-3 Question_formation">
        <div class="card Qusetion_Quiz" style="width: 18rem;" >
            <div class="card-header">
                {{ $Question->Question }}
            </div>
            <form action="{{ Route('dashboard.delete.Question', Crypt::encrypt($Question->id)) }}" method="post" 
                class="delete_Question">
                @csrf
                @method('Delete')
                <button type="submit" class="btn btn-sm btn-danger position-absolute" style="right: 6px; top: 4px;">
                    <i class="fa fa-trash" aria-hidden="true"></i>
                </button>
            </form>
            <ul class="list-group list-group-flush">
                @foreach ($Question->QuestionAnswers as $Answer)
                    <li class="list-group-item">{{ $Answer->Answer }}</li>
                @endforeach

            </ul>
        </div>
    </div>
@endforeach

<script>
    $(document).ready(function() {

        //delete QSM
        $('.delete_Question').submit(function(e) {
            e.preventDefault();
            var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
            var $form = $(this);

            $.ajax({
                url: $(this).attr('action'),
                method: $(this).attr('method'),
                processData: false,
                contentType: false,
                headers: {
                    'X-CSRF-TOKEN': CSRF_TOKEN
                },
                success: function(response) {

                    console.log(response);

                    if (response.message) {

                        var errorMessage =
                            '<div class="alert alert-success alert-dismissible fade show ml-1" role="alert">';
                        errorMessage += '<i class="icon fas fa-check"></i> ';
                        errorMessage += response.message;
                        errorMessage +=
                            '<button type="button" class="close" data-dismiss="alert" aria-label="Close">';
                        errorMessage +=
                            '<span aria-hidden="true">&times;</span></button></div>';

                        $('#message_containe').html(errorMessage);

                        $('html, body').animate({
                            scrollTop: "0px"
                        }, 800);

                    }

                    $form.closest('.Question_formation').remove();

                },
                error: function(request, error) {
                    console.log(arguments);
                    console.log(error);

                },
            })

        })
    })
</script>
