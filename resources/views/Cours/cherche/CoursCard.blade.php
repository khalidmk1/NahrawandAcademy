<div class="col ">

    <div class="card">
        <div class="position-relative">
            <h5 class="position-absolute badge {{ $cour->isActive ? 'badge-success' : '' }} ">
                {{ $cour->isActive ? 'Active' : '' }}</h5>
            <h5 class="position-absolute badge {{ $cour->isComing ? 'badge-warning' : '' }}" style="right: 0">
                {{ $cour->isComing ? 'A Venir' : '' }}</h5>

            @if ($cour->cours_type == 'conference')
                <img src="{{ asset('storage/upload/cour/image/' . $cour->CoursConference->image) }}"
                    class="card-img-top about_img" alt="Skyscrapers" />
            @elseif ($cour->cours_type == 'podcast')
                <img src="{{ asset('storage/upload/cour/image/' . $cour->CoursPodcast->image) }}"
                    class="card-img-top about_img" alt="Skyscrapers" />
            @elseif($cour->cours_type == 'formation' && $cour->CoursFormation)
                <img src="{{ asset('storage/upload/cour/image/' . $cour->CoursFormation->image) }}"
                    class="card-img-top about_img" alt="Skyscrapers" />
            @endif

        </div>
        {{-- <img src="thumbnail.jpg" class="card-img-top" alt="Thumbnail"> --}}
        <div class="card-body">
            <h5 class="card-title"> {{ $cour->title }}</h5>
            <p class="card-text">{{ Str::limit($cour->description, '100', '...') }}...</p>
            <a href="{{ Route('dashboard.cours.show', Crypt::encrypt($cour->id)) }}"
                class="btn btn-primary">Detail</a>
        </div>
    </div>

</div>
