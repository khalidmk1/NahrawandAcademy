  <!-- /.tab-pane -->
  <div class="tab-pane" id="timeline">


      <!-- /.card-header -->
      <form action="{{ Route('dashboard.short.update', Crypt::encrypt($short->id)) }}" method="post"
          enctype="multipart/form-data">
          @method('patch')
          @csrf

          <div class="card-body">

              <div class="form-group">
                  <label for="title">Title</label>
                  <input type="text" value="{{ old('title', $short->title) }}" class="form-control" name="title"
                      id="title" placeholder="Enter Titre ...">
              </div>



              <div class="form-group">
                  <label for="tags">Tags</label>

                  <input type="text" class="form-control" value="{{ implode(',', $short->tags) }}" name="tags[]"
                      id="tags-input" />

              </div>


              <div class="form-group">
                  <label>Formateur</label>
                  <select class="form-control select2" name="host" style="width: 100%;">
                      @foreach ($HostFromateur as $Host)
                          @if (isset($short->user->email) && $Host->user->email == $short->user->email)
                              <option selected value="{{ $short->user->id }}">{{ $short->user->email }}
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
                      <label>Category</label>
                      <select class="form-control select2" id="souscategory_goals" name="cotegoryId"
                          style="width: 100%;">
                          <option value="">Choose Category</option>
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
                      <label class="custom-file-label" for="customFile">Choose image</label>
                  </div>
              </div>

              <div class="form-group">
                  <label for="coursImageflex">Image flex</label>
                  <div class="custom-file">
                      <input type="file" class="custom-file-input" name="coursImageflex" id="coursImageflex">
                      <label class="custom-file-label" for="coursImageflex">Choose image</label>
                  </div>
              </div>


              <div class="form-group">
                  <label for="videocpodcast">Video</label>
                  <input type="url" value="{{ old('video', $short->video) }}" class="form-control" name="video"
                      id="videocpodcast" placeholder="Entrez url video ...">
              </div>

            



          </div>

          <button type="submit" class="btn btn-block btn-warning w-25 " style="float: right">Update
              Contnu</button>

      </form>


  </div>
  <!-- /.tab-pane -->
