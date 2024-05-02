@foreach ($video->QuizSeccesseVideo as $Quiz)

    <div class="col-6 ">

        <div class="card QSM_Quiz" >
            <div class="card-header">
                {{ $Quiz->question->question }}
            </div>
           
            <form action="{{ Route('dashboard.delete.Qsm', Crypt::encrypt($Quiz->question->id)) }}"
                                method="post">
                                @csrf
                                @method('Delete')
                                <button type="submit" class="btn btn-sm btn-danger position-absolute"
                                    style="right: 6px; top: 4px;">
                                    <i class="fa fa-trash" aria-hidden="true"></i>
                                </button>
                            </form>
            <ul class="list-group list-group-flush">
                @foreach ($Quiz->question->answervideo as $Answer)
                    <li class="list-group-item">{{ $Answer->Answer }}</li>
                @endforeach

            </ul>
        </div>

    </div>
@endforeach
