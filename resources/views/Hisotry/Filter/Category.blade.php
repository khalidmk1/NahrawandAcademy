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
                @foreach ($Category as $category)
                    <tr>
                        <td>{{$category->domain->domain}}</td>
                        <td>{{ $category->category_name }}</td>

                        <td>{{ $category->deleted_at }}</td>
                        <td class="text-center">
                            <form action="{{ Route('dashboard.restore.category', Crypt::encrypt($category->id)) }}"
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