<div class="card">
    <div class="card-body">
        <table id="example1" class="table table-bordered table-striped example1">
            <thead>
                <tr>
                    <th>Domain</th>
                    <th>Category</th>
                    <th>Delete at</th>
                    <th>Restore</th>
                </tr>
            </thead>
            <tbody class="text-center">
                @foreach ($Objectives as $Objective)
                    <tr>
                        <td>{{$Objective->souscategory->souscategory_name}}</td>
                        <td>{{ $Objective->goals }}</td>

                        <td>{{ $Objective->deleted_at }}</td>
                        <td class="text-center">
                            <form action="{{ Route('dashboard.goal.restore', Crypt::encrypt($Objective->id)) }}"
                                method="post" >
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