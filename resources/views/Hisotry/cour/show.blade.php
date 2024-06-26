<div class="card">
    <div class="card-body">
        <table id="example1" class="table table-bordered table-striped example1">
            <thead>
                <tr>
                    <th>Image</th>
                    <th>Ttile</th>
                    <th>Description</th>
                    <th>Delete at</th>
                    <th>Restore</th>
                </tr>
            </thead>
            <tbody class="text-center">
                @foreach ($cours as $cour)
                    <tr>
                        <td>
                            @if ($cour->cours_type == 'conference')
                                <img src="{{ asset('storage/upload/cour/image/' . $cour->CoursConference->image) }}"
                                    class="img-thumbnail" style="height: 173px" alt="Content" />
                            @elseif ($cour->cours_type == 'podcast')
                                <img src="{{ asset('storage/upload/cour/image/' . $cour->CoursPodcast->image) }}"
                                    class="img-thumbnail" style="height: 173px" alt="Content" />
                            @elseif($cour->cours_type == 'formation')
                                <img src="{{ asset('storage/upload/cour/image/' . $cour->CoursFormation->image) }}"
                                    class="img-thumbnail" style="height: 173px" alt="Content" />
                            @endif
                        </td>
                        <td>{{ $cour->title }}</td>

                        <td>{{ $cour->description }}</td>
                        <td>{{ $cour->deleted_at }}</td>
                        <td>
                            <form action="{{ Route('dashboard.restore.cour', Crypt::encrypt($cour->id)) }}"
                                method="post" style="position: relative; top: 62px; left: -32px">
                                @csrf
                                <button type="submit" class="btn btn-block btn-dark w-50" style="float: right">
                                    <i class="fa fa-undo" aria-hidden="true"></i>
                                </button>
                            </form>
                        </td>

                    </tr>
                @endforeach
                
            </tbody>
        </table>
    </div>
    <!-- /.card-body -->
</div>
<!-- /.card -->
