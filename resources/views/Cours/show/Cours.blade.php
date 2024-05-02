@extends('Layouts.master')

@section('content')
    <style>
        .card-img-top {
            height: 180px;
            object-fit: cover;
        }
    </style>
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Voir Tout Les Contenus</h1>
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
            <div id="message_containe"></div>
            <div class="row">
                <div class="card card-default col-12">
                    <div class="card-header row">
                        <div class="col-6">
                            <h3 class="card-title">Voir les Contenu</h3>
                        </div>
                    </div>
                    <!-- /.card-header -->

                    <div class="card-body">


                        <div class="row row-cols-1 row-cols-md-3  event_conatine">
                            @foreach ($cours as $cour)
                                <div class="col ">

                                    <div class="card">
                                        <div class="position-relative">
                                            <h5 class="position-absolute badge {{$cour->isActive ? 'badge-success' : ''}} ">
                                                {{ $cour->isActive ? 'Active' : '' }}</h5>
                                            <h5 class="position-absolute badge {{$cour->isComing ? 'badge-warning' : ''}}" style="right: 0">
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
                            @endforeach


                        </div>



                        <div class="card-footer">
                            <nav aria-label="Contacts Page Navigation">
                                <ul class="pagination justify-content-center m-0">
                                    <li class="page-item ">{{ $cours->links() }}</li>

                                </ul>
                            </nav>
                        </div>



                    </div>
                </div>


            </div>
    </section>
@endsection
