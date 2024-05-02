<div class="row post clearfix">
    <div class="col mb-4 ">

        <!-- Card -->
        <div class="card card-image ui_delete"
            style="background-image: url('{{ asset('storage/upload/cour/video/image/' . $video->image) }}');">
            <form action="{{ Route('dashboard.delete.video.fomation', Crypt::encrypt($video->id)) }}" method="post"
                class="delete_video">
                @csrf
                <button type="button" class="btn btn-sm btn-danger position-absolute" style="right: 6px; top: 4px;">
                    <i class="fa fa-trash" aria-hidden="true"></i>
                </button>
            </form>
            <button data-toggle="modal" data-target="#exampleModal_{{ $video->id }}"
                class="btn  btn-secondary position-absolute"><i class="fa fa-question" aria-hidden="true"></i></button>


            <!-- Content -->
            <div class="text-white text-center d-flex align-items-center justify-content-center rgba-black-strong py-5 px-4 m-3 "
                style="border-radius: 20px ; background: #343a4057">
                <div>
                    <div class="row " style="max-width: 359px;">

                        <div class="col-12">
                            <h3 class="card-title pt-2 "><strong>{{ $video->title }}</strong></h3>
                        </div>
                        <div class="col-12 ">
                            <p class="">{{ $video->description }}.</p>
                        </div>

                    </div>
                </div>
            </div>

        </div>
        <!-- Card -->
    </div>
    <div class="col-8">
        <div class="row">
            @include('Cours.create.fomation.CardVideoQuiz')
        </div>
    </div>
</div>




<!-- jQuery -->
<script src="{{ asset('plugins/jquery/jquery.min.js') }}"></script>

<script>
    $(document).ready(function() {

        //delete video
        $('.delete_video').on('click', function(e) {
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
                    $form.closest('.ui_delete').parent('.col.mb-4').remove();


                },
                error: function(request, error) {
                    console.log(arguments);
                    console.log(error);

                },
            })

        })
    })
</script>
