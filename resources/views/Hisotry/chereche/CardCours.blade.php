<div class="row">
{{--     @foreach ($cours as $cour)
        <div class="col-md-4">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">{{ $cour->title }}</h5>
                    <p class="card-text">{{ $cour->description }}</p>
                </div>
                <div class="card-footer">
                    <form action="{{ Route('dashboard.restore.cour', Crypt::encrypt($cour->id)) }}" method="post">
                        @csrf
                        <button type="submit" class="btn btn-block btn-dark w-25" style="float: right">
                            <i class="fa fa-undo" aria-hidden="true"></i>
                        </button>
                    </form>
                </div>
            </div>
        </div>
    @endforeach --}}

    @foreach ($shorts as $cour)
        <div class="col-md-4">
            <div class="card">
              
                <div class="card-body">
                    <h5 class="card-title">{{ $cour->title }}</h5>
                </div>
                <div class="card-footer">
                    <form action="{{ Route('dashboard.short.restore', Crypt::encrypt($cour->id)) }}" method="post">
                        @csrf
                        <button type="submit" class="btn btn-block btn-dark w-25" style="float: right">
                            <i class="fa fa-undo" aria-hidden="true"></i>
                        </button>
                    </form>
                </div>
            </div>
        </div>
    @endforeach

</div>
<div class="row">


</div>
