   <!-- Update video Conference -->
   <div class="modal fade" id="update_video_{{ $video->id }}" tabindex="-1" role="dialog"
       aria-labelledby="exampleModalLabel" aria-hidden="true">
       <div class="modal-dialog" role="document">
           <div class="modal-content">
               <div class="modal-header">
                   <h5 class="modal-title" id="exampleModalLabel">Modifier video
                   </h5>
                   <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                       <span aria-hidden="true">&times;</span>
                   </button>
               </div>
               <form action="{{ Route('dashboard.update.video.formation', Crypt::encrypt($video->id)) }}" method="post"
                   enctype="multipart/form-data">
                   @method('patch')
                   @csrf
                   <div class="modal-body">



                       <!-- /.card-header -->



                       {{--   <input hidden type="text" name="confrenceId" value="{{ $Cour->CoursConference->id }}"> --}}

                       <div class="form-group">
                           <label for="titleVideo">Titre video</label>
                           <input type="text" value="{{ old('titleVideo', $video->title) }}" class="form-control"
                               name="titleVideo" id="titleVideo" placeholder="Entrez Titre ...">
                       </div>

                       <div class="form-group clearfix text-center col-4">
                           <div class="icheck-primary d-inline">
                               <input type="checkbox" name="iscoming" id="iscoming_{{ $video->id }}"
                                   {{ $video->iscoming == 1 ? 'checked' : '' }}>
                               <label for="iscoming_{{ $video->id }}">
                                   Coming Soon
                               </label>
                           </div>

                       </div>

                       <!-- textarea -->
                       <div class="form-group">
                           <label>Description de video</label>
                           <textarea class="form-control" name="descriptionVideo" rows="3" placeholder="Enter ...">{{ $video->description }}</textarea>
                       </div>

                       <div class="form-group">
                           <label for="imagevideo_{{ $video->id }}">Image</label>
                           <div class="custom-file">
                               <input type="file" class="custom-file-input" name="imagevideo"
                                   id="imagevideo_{{ $video->id }}">
                               <label class="custom-file-label" for="imagevideo_{{ $video->id }}">Choisez
                                   image</label>
                           </div>
                       </div>


                       <div class="form-group">
                           <label for="tags_video">Mots Clé</label>
                           <input type="text" class="form-control tags" value="{{ implode(',', $video->tags) }} "
                               name="videoTags[]" data-id="{{ $video->id }}" id="tags-input-{{ $video->id }}" />
                       </div>

                       <div class="form-group">
                           <label for="videocpodcast_{{ $video->id }}">Video</label>
                           <input type="url" value="{{ old('video', $video->video) }}" class="form-control"
                               name="video" id="videocpodcast_{{ $video->id }}"
                               placeholder="Entrez url video ...">
                       </div>







                   </div>
                   <div class="modal-footer">

                       <button type="submit" class="btn btn-block btn-warning w-50">Modifier Videos</button>
                   </div>
               </form>
           </div>
       </div>
   </div>
