<table class="table table-striped">
    <thead>
        <tr>
            <th scope="col">#</th>
            <th scope="col">Name</th>
            <th scope="col">Email</th>
            <th scope="col">Date</th>
            <th scope="col">Actions</th>
        </tr>
    </thead>
    <tbody id="users-list" name="users-list">
        @foreach($users as $user)
            <tr>
                <th scope="row">{{ $user->id }}</th>
                <td>{{ $user->name }}</td>
                <td>{{ $user->email }}</td>
                <td>{{ $user->created_at->format('d/m/y') }}</td>
                <td>
                    <div class="actions">
                        <button class="btn btn-success" data-toggle="modal" data-target="#edit-user-modal" onclick="edit(this)"
                            data-id="{{ $user->id }}" data-name="{{ $user->name }}" data-email="{{$user->email}}">
                            Edit
                        </button>
                        <button class="btn btn-danger ml-2" data-toggle="modal" data-target="#delete-user-modal" onclick="destroy(this)"
                            data-id="{{ $user->id }}">
                            Delete
                        </button>
                    </div>
                </td>
            </tr>
        @endforeach
    </tbody>
</table>

<div id="pagination">
    {{ $users->links() }}
</div>