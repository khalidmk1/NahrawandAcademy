@foreach ($shorts as $cour)
    <div class="col ">

        <div class="card">
            <div class="position-relative">
                <img src="{{ asset('storage/upload/cour/image/' . $cour->image) }}" class="card-img-top about_img"
                    alt="Skyscrapers" />

            </div>
            {{-- <img src="thumbnail.jpg" class="card-img-top" alt="Thumbnail"> --}}
            <div class="card-body">
                <h5 class="card-title"> {{ $cour->title }}</h5>
                <p class="card-text">
                <h4>
                    @foreach ($cour->tags as $tag)
                        <span class="badge badge-info">{{ $tag }}</span>
                    @endforeach
                </h4>
                </p>
                <a href="{{ Route('dashboard.short.detail', Crypt::encrypt($cour->id)) }}"
                    class="btn btn-primary">Detail</a>
            </div>
        </div>

    </div>
@endforeach
