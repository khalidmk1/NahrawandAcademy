@extends('Layouts.master')

@section('content')
    <style>
        .select2-search__field {
            color: #000 !important;
        }
    </style>
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Mange Contenu Page</h1>
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
            <div class="row">
                <div class="card card-default col-12">
                    <div class="card-header row">
                        <div class="col-6">
                            <h3 class="card-title">Crée Cotenu</h3>
                        </div>

                    </div>
                    <!-- /.card-header -->
                    <form action="{{ Route('dashboard.cours.store') }}" method="post" enctype="multipart/form-data">
                        @csrf

                        <div class="card-body">
                            <div class="form-group">
                                <label for="title">Titre</label>
                                <input type="text" value="{{ old('title') }}" class="form-control" name="title"
                                    id="title" placeholder="Entrez Titre ...">
                            </div>

                            <div class="row justify-content-around ">
                                <div class="form-group clearfix text-center col-4">
                                    <div class="icheck-primary d-inline">
                                        <input type="checkbox" name="iscoming" id="iscoming">
                                        <label for="iscoming">
                                            Coming Soon
                                        </label>
                                    </div>

                                </div>



                                <div class="form-group col-4 text-center">
                                    <!-- Bootstrap Switch -->
                                    <label for="boostrap-switch" class="mr-5">
                                        Affichage
                                    </label>
                                    <input type="checkbox" name="isActive" checked data-bootstrap-switch
                                        data-off-color="danger" data-on-color="success">
                                </div>
                                <!-- /.card -->
                            </div>


                            <!-- textarea -->
                            <div class="form-group">
                                <label>Description de Contenu</label>
                                <textarea class="form-control" name="description" rows="3" placeholder="Enter ...">{{ old('description') }}</textarea>
                            </div>


                            <div class="form-group">
                                <label for="tags">Mots Clé</label>
                                <input type="text" class="form-control" name="tags[]" id="tags-input" />
                            </div>

                            <div class="row">
                                <div class="col-6">
                                    <div class="form-group">
                                        <label>Catégorie</label>
                                        <select class="form-control select2" id="souscategory_goals" name="cotegoryId"
                                            style="width: 100%;">
                                            <option value="">Choisissez Votre Catégorie</option>
                                            @foreach ($CoursInfo['category'] as $category)
                                                <option value="{{ $category->id }}">
                                                    {{ $category->category_name }}
                                                </option>
                                            @endforeach
                                        </select>

                                    </div>
                                    <!-- /.form-group -->
                                </div>
                                <div class="col-6">

                                    <div class="form-group">
                                        <label for="goals_option">Objectifs</label>
                                        <select class="select3" name="gaols_id[]" multiple="multiple" id="goals_option"
                                            data-placeholder="Select a State" style="width: 100%;">

                                        </select>
                                    </div>
                                    <!-- /.form-group -->

                                </div>


                            </div>

                            <!-- select -->
                            <div class="form-group">
                                <label>Type De Cour</label>
                                <select class="form-control" name="coursType" id="cours_type">
                                    <option selected>Choisissez Votre Type de Cour</option>
                                    <option value="conference">Conférance Contenu</option>
                                    <option value="podcast">Podcast Contenu</option>
                                    <option value="formation">Formation Contenu</option>
                                </select>
                            </div>



                            {{-- conference section --}}


                            <section id="conference" class="p-3"
                                style="background-color: rgba(151, 120, 46, 0.46) ; border-radius:20px ">

                                <div class="position-relative"></div>

                                <div class="form-group">
                                    <label>Modirateur</label>
                                    <select class="form-control select2 " name="hostConference" style="width: 100%;">
                                        @foreach ($CoursInfo['HostConfrence'] as $hostConfrence)
                                            <option value="{{ $hostConfrence->user->id }}">
                                                {{ $hostConfrence->user->email }}</option>
                                        @endforeach

                                    </select>
                                </div>
                                <!-- /.form-group -->


                                <!-- textarea -->
                                <div class="form-group">
                                    <label>Description de Conférence</label>
                                    <textarea class="form-control" name="descriptionConference" rows="3" placeholder="Enter ..."></textarea>
                                </div>

                                <div class="form-group">
                                    <label for="coursImage">Image</label>
                                    <div class="custom-file">
                                        <input type="file" class="custom-file-input" name="introImageConfrence"
                                            id="coursImage">
                                        <label class="custom-file-label" for="customFile">Choisez image</label>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="flexImageConference">Flex Image</label>
                                    <div class="custom-file">
                                        <input type="file" class="custom-file-input" name="flexImageConference"
                                            id="flexImageConference">
                                        <label class="custom-file-label" for="flexImageConference">Choisez image</label>
                                    </div>
                                </div>


                                <div class="row align-items-center">
                                    <div class="col-md-8">

                                        <div class="form-group">
                                            {{-- <input type="file" class="filepond" name="introVideoConfrence"
                                                id="coursVideo"> --}}

                                            <label for="videoconference">Video</label>
                                            <input type="url" value="{{ old('videoconference') }}"
                                                class="form-control" name="videoconference" id="videoconference"
                                                placeholder="Entrez url video ...">
                                        </div>



                                    </div>
                                    <div class="col-md-4">

                                        <!-- time Picker -->
                                        <div class="form-group">
                                            <label for="coursDuration">Duration</label>
                                            <input type="time" class="form-control" id="coursDuration"
                                                name="coursDuration" value="00:00:00" step="1">
                                        </div>

                                    </div>

                                </div>


                            </section>

                            {{-- podcast section --}}

                            <section id="podcast" class="p-3"
                                style="background-color: rgba(176, 169, 83, 0.32) ; border-radius:20px ">

                                <div class="form-group">
                                    <label for="slug_acroche">Acroche</label>
                                    <input type="text" value="{{ old('slug') }}" class="form-control"
                                        name="slugAcroche" id="slug_acroche" placeholder="Entrez Acroche ...">
                                </div>

                                <div class="form-group">
                                    <label>Animateur</label>
                                    <select class="form-control select2 " name="hostPodcast" style="width: 100%;">
                                        @foreach ($CoursInfo['HostPodcast'] as $hostPodcast)
                                            <option value="{{ $hostPodcast->user->id }}">
                                                {{ $hostPodcast->user->email }}</option>
                                        @endforeach

                                    </select>
                                </div>
                                <!-- /.form-group -->


                                <!-- textarea -->
                                <div class="form-group">
                                    <label>Description de Podcast</label>
                                    <textarea class="form-control" name="descriptionPodcast" rows="3" placeholder="Enter ..."></textarea>
                                </div>

                                <div class="form-group">
                                    <label for="ImagePodcast">Image de Podcast</label>
                                    <div class="custom-file">
                                        <input type="file" class="custom-file-input" name="introImagePodcast"
                                            id="ImagePodcast">
                                        <label class="custom-file-label" for="ImagePodcast">Choisez image</label>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="flexImagePodcast">Flex Image</label>
                                    <div class="custom-file">
                                        <input type="file" class="custom-file-input" name="flexImagePodcast"
                                            id="flexImagePodcast">
                                        <label class="custom-file-label" for="flexImagePodcast">Choisez image</label>
                                    </div>
                                </div>


                                <div class="row align-items-center">
                                    <div class="col-md-8">

                                        <div class="form-group">
                                            <label for="videocpodcast">Video</label>
                                            <input type="url" value="{{ old('videocpodcast') }}"
                                                class="form-control" name="videocpodcast" id="videocpodcast"
                                                placeholder="Entrez url video ...">
                                        </div>



                                    </div>
                                    <div class="col-md-4">

                                        <!-- time Picker -->
                                        <div class="form-group">
                                            <label for="DurationPdcast">Duration de Podcast</label>
                                            <input type="time" class="form-control" id="DurationPdcast"
                                                name="DurationPdcast" value="00:00:00" step="1">
                                        </div>

                                    </div>

                                </div>



                            </section>



                            {{-- formation section --}}

                            <section id="formation" class="p-3"
                                style="background-color: rgba(208, 144, 16, 0.35) ; border-radius:20px ">


                                <div class="form-group">
                                    <label for="ImageFomation">Image de Fomation</label>
                                    <div class="custom-file">
                                        <input type="file" class="custom-file-input" name="introImageFormation"
                                            id="ImageFomation">
                                        <label class="custom-file-label" for="ImageFomation">Choisez image</label>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="flexImageFormation">Flex Image</label>
                                    <div class="custom-file">
                                        <input type="file" class="custom-file-input" name="flexImageFormation"
                                            id="flexImageFormation">
                                        <label class="custom-file-label" for="flexImageFormation">Choisez image</label>
                                    </div>
                                </div>



                                <div class="form-group clearfix">
                                    <div class="icheck-primary d-inline">
                                        <input type="checkbox" name="iscertify" id="certifier_formation">
                                        <label for="certifier_formation">
                                            Certifier
                                        </label>
                                    </div>

                                </div>

                                <!-- textarea -->
                                <div class="form-group" id="condition">
                                    <label>Conditions d’éligibilité</label>
                                    <textarea class="form-control" name="conditionformation" rows="3" placeholder="Enter ..."></textarea>
                                </div>


                                <div class="form-group">
                                    <label>Formateur</label>
                                    <select class="form-control select2 " name="hostFormation" style="width: 100%;">
                                        @foreach ($CoursInfo['HostFormateur'] as $hostFormation)
                                            <option value="{{ $hostFormation->user->id }}">
                                                {{ $hostFormation->user->email }}</option>
                                        @endforeach

                                    </select>
                                </div>
                                <!-- /.form-group -->


                                <div class="form-group">
                                    <label>Programme</label>
                                    <select class="form-control select2 " name="programId" style="width: 100%;">
                                        <option value="0">Choisez Program</option>
                                        @foreach ($CoursInfo['Programs'] as $program)
                                            <option value="{{ $program->id }}">
                                                {{ $program->title }}</option>
                                        @endforeach

                                    </select>
                                </div>
                                <!-- /.form-group -->




                                <div class="form-group">
                                    <label for="DocumentFomation">Documents de Fomation</label>
                                    <div class="custom-file">
                                        <input type="file" name="document" class="custom-file-input"
                                            id="DocumentFomation" multiple>
                                        <label class="custom-file-label" for="DocumentFomation">Choisez Documents</label>
                                    </div>
                                </div>





                            </section>

                        </div>

                        <button type="submit" class="btn btn-block btn-info w-25 mb-3 ml-3" style="float: right">Crée
                            Contnu</button>

                    </form>









                </div>





            </div>
        </div>
        </div>
    </section>

    <!-- jQuery -->
    <script src="{{ asset('plugins/jquery/jquery.min.js') }}"></script>

    {{-- <script src="https://unpkg.com/filepond@^4/dist/filepond.js"></script>

    <script>
        // Get a reference to the file input element
        const inputElement = document.getElementById('coursVideo');

        // Create a FilePond instance
        const pond = FilePond.create(inputElement);
        var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');

        FilePond.setOptions({
            server: {
                process: {
                    url: '/backoffice/upload/video',
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': CSRF_TOKEN
                    },
                    onload: (response) => response.key,
                    onerror: (response) => response.data,
                },
            },
           
        });
    </script> --}}



    <script>
        $(function() {
            $("input[data-bootstrap-switch]").each(function() {
                $(this).bootstrapSwitch('state', $(this).prop('checked'));
            })

            //Initialize Select2 Elements
            $('.select2').select2();
            $('.select3').select2();


            //Initialize Select2 Elements
            $('.select2bs4').select2({
                theme: 'bootstrap4'
            })

        })

        $(document).ready(function() {

            $('#condition').hide();

            $('#certifier_formation').on('change', function() {
                var certifier = $(this).val()
                if ($(this).is(':checked')) {
                    $('#condition').slideDown();
                    console.log(certifier);
                } else {
                    $('#condition').slideUp();
                }

            })

            //search live for goals

            $('#souscategory_goals').on('change', function() {
                var sousCategorieId = $(this).val();
                console.log(sousCategorieId);

                $.ajax({
                    url: '/backoffice/goals-bySouscategory/' +
                        sousCategorieId,
                    method: 'GET',
                    success: function(response) {
                        var goalsSelect = $('#goals_option');
                        goalsSelect.empty();

                        /* window.navigate("page.html"); */

                        console.log(response);

                        $.each(response.goals, function(index, goal) {
                            goalsSelect.append($('<option>', {
                                value: goal.id,
                                text: goal.goals
                            }));

                            console.log(goal.id);
                        });
                    },
                    error: function(xhr, status, error) {
                        console.error('Error fetching goals:', error);
                    }
                });
            });



            //tags
            var tagInputEle = $('#tags-input');
            tagInputEle.tagsinput();


        });
    </script>
    @push('scripts')
    @endpush
    <script>
        $(document).ready(function() {
            // Retrieve the selected value from local storage
            var selectedCoursType = localStorage.getItem('selectedCoursType');

            // If a value is found, show the corresponding section
            if (selectedCoursType) {
                $('#' + selectedCoursType).slideDown();
            }

            // Hide all sections initially
            $('#conference, #podcast, #formation').hide();

            // Handle change event for the select element
            $('#cours_type').on('change', function() {
                var typeCours = $(this).val();

                // Store the selected value in local storage
                localStorage.setItem('selectedCoursType', typeCours);

                // Hide all sections
                $('#conference, #podcast, #formation').slideUp();

                // Show the corresponding section based on the selected value
                $('#' + typeCours).slideDown();
            });
        });
    </script>
@endsection
