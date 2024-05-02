@foreach ($Qsms as $Qsm)
    <div class="col-3">
        <div class="card QSM_Quiz" style="width: 18rem;" data-id="{{$Qsm->id}}">
            <div class="card-header">
                {{ $Qsm->Question->question }}
            </div>
            <form action="{{ Route('dashboard.delete.Qsm', Crypt::encrypt($Qsm->Question->id)) }}" method="post">
                @csrf
                @method('Delete')
                <button type="submit" class="btn btn-sm btn-danger position-absolute" style="right: 6px; top: 4px;">
                    <i class="fa fa-trash" aria-hidden="true"></i>
                </button>
            </form>
            <ul class="list-group list-group-flush">
                @foreach ($Qsm->Question->Answers as $Answer)
                    <li class="list-group-item">{{ $Answer->Answer }}</li>
                @endforeach

            </ul>
        </div>
    </div>
@endforeach



<!-- jQuery -->
<script src="{{ asset('plugins/jquery/jquery.min.js') }}"></script>
{{-- <script>
    $(document).ready(function() {

        //delete QSM
        $('.delete_Qsm').on('click', function(e) {
            e.preventDefault();
            var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');

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
                            '<div class="alert alert-danger alert-dismissible fade show ml-1" role="alert">';
                        errorMessage += '<i class="icon fas fa-exclamation-triangle"></i> ';
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

                    $('.QSM_Quiz').remove()

                },
                error: function(request, error) {
                    console.log(arguments);
                    console.log(error);

                },
            })

        })
    })
</script>
 --}}