  <!-- /.tab-pane -->
  <div class="tab-pane" id="timeline">


      <!-- /.card-header -->
      <form action="{{ Route('dashboard.update.conference') }}" method="post" enctype="multipart/form-data">
          @method('patch')
          @csrf

          <div class="card-body">

              <input type="text" value="{{ $Cour->id }}" name="CoursId" hidden>
              <div class="form-group">
                  <label for="title">Ttile</label>
                  <input type="text" value="{{ old('title', $Cour->title) }}" class="form-control" name="title"
                      id="title" placeholder="Entrez Titre ...">
              </div>

              <div class="row">
                  <div class="form-group clearfix col-6">
                      <div class="icheck-primary d-inline">
                          <input type="checkbox" name="iscoming" id="iscoming"
                              {{ $Cour->isComing == 1 ? 'checked' : '' }}>
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
                      <input type="checkbox" name="isActive" id="boostrap-switch" checked data-value=""
                          data-bootstrap-switch data-off-color="danger" data-on-color="success">
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
                          <label>SubCtegory</label>
                          <select class="form-control select2" id="souscategory_goals" name="cotegoryId"
                              style="width: 100%;">
                              <option>Choose SubCategory</option>
                              @foreach ($souscategory as $souscategory)
                                  <option value="{{ $souscategory->category->id }}"
                                      {{ $Cour->category->id == $souscategory->category->id ? 'selected' : '' }}>
                                      {{ $souscategory->category->category_name }}
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


              <section id="conference" class="p-3"
                  style="background-color: rgba(151, 120, 46, 0.46) ; border-radius:20px ">

                  <div class="position-relative"></div>

                  <div class="form-group">
                      <label>Modirateur</label>
                      <select class="form-control select2" name="hostConference" style="width: 100%;">
                          @foreach ($HostConfrence as $Host)
                              @if (isset($coursCoference->user->email) && $Host->user->email == $coursCoference->user->email)
                                  <option value="{{ $coursCoference->user->id }}">{{ $coursCoference->user->email }}
                                  </option>
                              @else
                                  <option value="{{ $Host->user->id }}">{{ $Host->user->email }}</option>
                              @endif
                          @endforeach
                      </select>
                  </div>

                  <!-- /.form-group -->





                  <!-- textarea -->
                  <div class="form-group">
                      <label>Description</label>
                      <textarea class="form-control" name="descriptionConference" rows="6" placeholder="Enter ...">{{ $coursCoference->description }}</textarea>
                  </div>

                  <div class="form-group">
                      <label for="coursImage">Image</label>
                      <div class="custom-file">
                          <input type="file" class="custom-file-input" name="image" id="coursImage">
                          <label class="custom-file-label" for="coursImage">Choisez image</label>
                      </div>
                  </div>


                  <div class="row">
                      <div class="col-md-8">

                          <div class="form-group">
                              <label for="videoconference">Video</label>
                              <input type="url" value="{{ old('video', $coursCoference->video) }}"
                                  class="form-control" name="video" id="videoconference"
                                  placeholder="Entrez url video ...">
                          </div>



                      </div>
                      <div class="col-md-4">


                          <div class="form-group">
                              <label for="videoduration_{{ $coursCoference->id }}">Duration</label>
                              <input type="time" class="form-control"
                                  id="videoduration_{{ $coursCoference->id }}" data-id="{{ $coursCoference->id }}"
                                  name="coursDuration" value="{{ old('coursDuration', $coursCoference->duration) }}"
                                  step="1">
                          </div>

                      </div>

                  </div>


              </section>



          </div>

          <button type="submit" class="btn btn-block btn-warning w-25 " style="float: right">Update</button>

      </form>


  </div>
  <!-- /.tab-pane -->
