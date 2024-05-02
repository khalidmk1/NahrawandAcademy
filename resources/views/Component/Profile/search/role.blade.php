@foreach ($filteredRoles as $role)
    <tr class="text-center">
        <td>{{ $role->role_name }} </td>

        @foreach ($permissions as $permission)
            <td class="text-center">
                <form>
                    @csrf
                    <div class="icheck-primary d-inline">

                        <input type="checkbox" class="checkbox make_permission" data-role = "{{ $role->id }}"
                            {!! $role->id == 1 || $role->role_name == 'Admin' ? 'disabled' : '' !!}
                            {{ isset($RolePermissioncheck[$role->id]) &&
                            $RolePermissioncheck[$role->id]->contains('permission_id', $permission->id) &&
                            $RolePermissioncheck[$role->id]->contains('confirmed', 1)
                                ? 'checked'
                                : '' }}
                            data-permission="{{ $permission->id }}"
                            id="checkboxPrimary_{{ $permission->id }}_{{ $role->id }}">
                        <label for="checkboxPrimary_{{ $permission->id }}_{{ $role->id }}">
                        </label>

                    </div>
                </form>
            </td>
        @endforeach

    </tr>
@endforeach

<!-- jQuery -->
<script src="{{ asset('plugins/jquery/jquery.min.js') }}"></script>

<script>
    $(document).ready(function() {

        $(".make_permission").change(function(e) {
            e.preventDefault()

            var role_id = $(this).attr("data-role");
            var permission_id = $(this).attr("data-permission");
            var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');

            $.ajax({
                url: '/backoffice/role-permission/' + role_id + '/' + permission_id,
                method: 'POST',
                processData: false,
                contentType: false,
                headers: {
                    'X-CSRF-TOKEN': CSRF_TOKEN
                },
                success: function(response) {
                    console.log(response);

                },
                error: function(error) {
                    console.log(error);
                }

            })

        });




    })
</script>
