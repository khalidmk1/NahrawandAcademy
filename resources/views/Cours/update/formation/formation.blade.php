<!-- /.card-header -->
<form action="{{ Route('dashboard.update.formation', Crypt::encrypt($Cour->id)) }}" method="post"
    enctype="multipart/form-data">
    @method('patch')
    @csrf

    <div class="card-body">

        <div class="form-group">
            <label for="title">Title</label>
            <input type="text" value="{{ old('title', $Cour->title) }}" class="form-control" name="title"
                id="title" placeholder="Enter Title ...">
        </div>

        <div class="row">
            <div class="form-group clearfix col-6">
                <div class="icheck-primary d-inline">
                    <input type="checkbox" name="iscoming" id="iscoming" {{ $Cour->isComing == 1 ? 'checked' : '' }}>
                    <label for="iscoming">
                        Coming Soon
                    </label>
                </div>

            </div>
            <div class="col-6">
                <!-- Bootstrap Switch -->
                <label for="boostrap-switch" class="mr-5">
                    Display
                </label>
                <input type="checkbox" name="isActive" id="boostrap-switch" {{$Cour->isActive == 1 ? 'checked' : '' }}  data-value="" data-bootstrap-switch
                    data-off-color="danger" >
            </div>
            <!-- /.card -->

        </div>


        <!-- textarea -->
        <div class="form-group">
            <label>Description</label>
            <textarea class="form-control" name="description" rows="3" placeholder="Enter ...">{{ old('description', $Cour->description) }}</textarea>
        </div>


        <div class="form-group">
            <label for="tags">Tags</label>

            <input type="text" class="form-control" value="{{ implode(',', $Cour->tags) }}" name="tags[]"
                id="tags-input" />

        </div>

        <div class="row">
            <div class="col-6">
                <div class="form-group">
                    <label>Category <span>({{$Cour->category->category_name}})</span></label>
                    <select class="form-control select2" id="souscategory_goals" name="cotegoryId" style="width: 100%;">
                        <option selected value="{{$Cour->category->id}}">Choise Votre Catégorie</option>
                        @foreach ($category as $category)
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
                    <label for="goals_option">Objectives</label>
                    <select class="select3" name="goal[]" multiple="multiple" id="goals_option"
                        data-placeholder="Select a State" style="width: 100%;">
                        @foreach ($CoursGols as $CoursGol)
                            <option selected value="{{ $CoursGol->goalcours->id }}">{{ $CoursGol->goalcours->goals }}
                            </option>
                        @endforeach

                    </select>
                </div>



                <!-- /.form-group -->

            </div>


        </div>



        <section id="formation" class="p-3" style="background-color: rgba(208, 144, 16, 0.35) ; border-radius:20px ">


            <div class="form-group">
                <label for="ImageFomation">Image</label>
                <div class="custom-file">
                    <input type="file" name="image" class="custom-file-input" id="ImageFomation">
                    <label class="custom-file-label" for="ImageFomation">Choose image</label>
                </div>
            </div>

            <div class="form-group">
                <label for="ImageFomationflex">Image flex</label>
                <div class="custom-file">
                    <input type="file" name="ImageFomationflex" class="custom-file-input" id="ImageFomationflex">
                    <label class="custom-file-label" for="ImageFomationflex">Choose image</label>
                </div>
            </div>

            @if ($coursFormation->condition == 'text')
            @else
                <!-- textarea -->
                <div class="form-group">
                    <label>Eligibility criteria</label>
                    <textarea class="form-control" name="conditionformation" rows="3" placeholder="Enter ...">{{ $coursFormation->condition }}</textarea>
                </div>
            @endif



            <div class="form-group">
                <label>Formateur</label>
                <select class="form-control select2" name="hostPodcast" style="width: 100%;">
                    @foreach ($HostFromateur as $Host)
                        @if (isset($coursFormation->user->email) || $Host->user->email == $coursFormation->user->email)
                            <option selected value="{{ $Host->user->id }}">{{ $Host->user->email }}</option>
                        @else
                            <option value="{{ $Host->user->id }}">{{ $Host->user->email }}</option>
                        @endif
                    @endforeach
                </select>
            </div>


            @if (!$programs)
                <div class="form-group">
                    <label>Program</label>
                    <select class="form-control select2" name="programId" style="width: 100%;">
                        @foreach ($programs as $program)
                            <option value="{{ $program->id }}"
                                {{ $coursFormation->program_id == $program->id ? 'selected' : '' }}>
                                {{ $program->title }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <!-- /.form-group -->
            @endif





            <div class="form-group">
                <label for="DocumentFomation">Document</label>
                <div class="custom-file">
                    <input type="file" name="document" class="custom-file-input" id="DocumentFomation" multiple>
                    <label class="custom-file-label" for="DocumentFomation">Choose Documents</label>
                </div>
            </div>





        </section>



    </div>

    <button type="submit" class="btn btn-block btn-warning w-25 " style="float: right">Modifier
        Contnu</button>

</form>



<!-- /.tab-pane -->
