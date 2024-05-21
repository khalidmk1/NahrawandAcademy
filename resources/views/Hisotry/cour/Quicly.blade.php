<div class="card">
    <div class="card-body">
        <table id="example1" class="table table-bordered table-striped example1">
            <thead>
                <tr>
                    <th>Image</th>
                    <th>Ttile</th>
                    <th>Delete at</th>
                    <th>Restore</th>
                </tr>
            </thead>
            <tbody class="text-center">
                @foreach ($shorts as $short)
                    <tr>
                        <td>
                            <img src="{{ asset('storage/upload/cour/image/' . $short->image) }}"
                                    class="img-thumbnail" style="height: 173px" alt="Content" />
                        </td>
                        <td>{{ $short->title }}</td>

                        <td>{{ $short->deleted_at }}</td>
                        <td>
                            <form action="{{ Route('dashboard.short.restore', Crypt::encrypt($short->id)) }}"
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
