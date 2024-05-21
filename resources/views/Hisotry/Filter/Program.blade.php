<div class="card">
    <div class="card-body">
        <table id="example1" class="table table-bordered table-striped example1">
            <thead>
                <tr>
                    <th>title</th>
                    <th>Description</th>
                    <th>Delete at</th>
                    <th>Restore</th>
                </tr>
            </thead>
            <tbody class="text-center">
                @foreach ($Programs as $Program)
                    <tr>
                        <td>{{$Program->title}}</td>
                        <td>{{ $Program->Description }}</td>

                        <td>{{ $Program->deleted_at }}</td>
                        <td class="text-center">
                            <form action="{{ Route('dashboard.program.restore', Crypt::encrypt($Program->id)) }}"
                                method="post" class="text-center">
                                @csrf
                                <button type="submit" class="btn btn-block btn-dark w-25 ">
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