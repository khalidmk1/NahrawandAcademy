  <!-- /.tab-pane -->
  <div class="tab-pane" id="timeline">


      <!-- /.card-header -->
      <form action="{{ Route('dashboard.short.update', Crypt::encrypt($short->id)) }}" method="post"
          enctype="multipart/form-data">
          @method('patch')
          @csrf

          <div class="card-body">

              <div class="form-group">
                  <label for="title">Titre</label>
                  <input type="text" value="{{ old('title', $short->title) }}" class="form-control" name="title"
                      id="title" placeholder="Entrez Titre ...">
              </div>



              <div class="form-group">
                  <label for="tags">Mots Clé</label>

                  <input type="text" class="form-control" value="{{ implode(',', $short->tags) }}" name="tags[]"
                      id="tags-input" />

              </div>


              <div class="form-group">
                  <label>Formateur</label>
                  <select class="form-control select2" name="host" style="width: 100%;">
                      @foreach ($HostFromateur as $Host)
                          @if (isset($short->user->email) && $Host->user->email == $short->user->email)
                              <option value="{{ $Host->user->id }}">{{ $Host->user->email }}
                              </option>
                          @else
                              <option value="{{ $Host->user->id }}">{{ $Host->user->email }}</option>
                          @endif
                      @endforeach
                  </select>
              </div>

              <!-- /.form-group -->


              <div class="row">
                <div class="col-6">
                  <div class="form-group">
                      <label>SousCategorie</label>
                      <select class="form-control select2" id="souscategory_goals" name="cotegoryId"
                          style="width: 100%;">
                          <option value="">Choisissez Votre Sous-Catégorie</option>
                          @foreach ($souscategory as $souscategory)
                              <option value="{{ $souscategory->category->id }}"
                                  {{ old('cotegoryId') == $souscategory->category->id ? 'selected' : '' }}>
                                  {{ $souscategory->category->category_name }}
                              </option>
                          @endforeach
                      </select>

                  </div>
                  <!-- /.form-group -->





                </div>
                <div class="col-6">


                    <div class="form-group">
                    <label for="goals_option">Objectifs</label>
                    <select class="select3" name="goal[]" multiple="multiple" id="goals_option" data-placeholder="Select a State" style="width: 100%;">
                        @php
                            $uniqueGoals = $goals->unique('goals'); 
                        @endphp
                        @foreach ($uniqueGoals as $goal)
                            @php
                                $selected = $CoursGols->contains('goal_id', $goal->id) ? 'selected' : '';
                            @endphp
                            <option {{ $selected }} value="{{ $goal->id }}">{{ $goal->goals }}</option>
                        @endforeach
                    </select>
                </div>



                </div>




            </div>


              <div class="form-group">
                  <label for="coursImage">Image</label>
                  <div class="custom-file">
                      <input type="file" class="custom-file-input" name="image" id="coursImage">
                      <label class="custom-file-label" for="customFile">Choisez image</label>
                  </div>
              </div>

              <div class="form-group">
                  <label for="coursImageflex">Image flex</label>
                  <div class="custom-file">
                      <input type="file" class="custom-file-input" name="coursImageflex" id="coursImageflex">
                      <label class="custom-file-label" for="coursImageflex">Choisez image</label>
                  </div>
              </div>


              <div class="form-group">
                  <label for="videocpodcast">Video</label>
                  <input type="url" value="{{ old('video', $short->video) }}" class="form-control" name="video"
                      id="videocpodcast" placeholder="Entrez url video ...">
              </div>

            



          </div>

          <button type="submit" class="btn btn-block btn-warning w-25 " style="float: right">Modifier
              Contnu</button>

      </form>


  </div>
  <!-- /.tab-pane -->
