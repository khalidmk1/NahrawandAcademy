@extends('Layouts.master')

@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>View All Event</h1>
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
                        <div class="col-4">
                            <h3 class="card-title">View Content</h3>
                        </div>
                        <div class="col-8">
                            <button type="button" style="float: right" class="btn btn-primary" data-toggle="modal"
                                data-target="#exampleModal">
                                <i class="fa fa-filter" aria-hidden="true"></i>
                            </button>

                        </div>
                    </div>
                    <!-- /.card-header -->

                    <div class="card-body">


                        <div class="row row-cols-1 row-cols-md-3  event_conatine" id="resultcours">
                            @foreach ($events as $event)
                                <div class="col ">

                                    <div class="card">
                                        <div class="position-relative">
                                            <img src="{{ asset('storage/upload/event/' . $event->image) }}"
                                                class="card-img-top about_img" alt="Skyscrapers" />

                                        </div>
                                        {{-- <img src="thumbnail.jpg" class="card-img-top" alt="Thumbnail"> --}}
                                        <div class="card-body">
                                            <h5 class="card-title"> {{ $event->title }}</h5>
                                            <p class="card-text">
                                                {{$event->description}}
                                            </p>
                                            <a href="{{ Route('dashboard.event.show', Crypt::encrypt($event->id)) }}"
                                                class="btn btn-primary">Detail</a>
                                        </div>
                                    </div>

                                </div>
                            @endforeach


                        </div>



                        <div class="card-footer">
                            <nav aria-label="Contacts Page Navigation">
                                <ul class="pagination justify-content-center m-0">
                                    <li class="page-item ">{{ $events->links() }}</li>

                                </ul>
                            </nav>
                        </div>



                    </div>
                </div>


            </div>
    </section>
@endsection
