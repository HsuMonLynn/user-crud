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
                <td>{{ $user->created_at }}</td>
                <td>
                    <div class="actions">
                        <button class="btn btn-success" data-toggle="modal" data-target="#edit-user-modal"
                            value="{{ $user->id }}">
                            Edit
                        </button>
                        <button class="btn btn-danger ml-2" data-toggle="modal" data-target="#delete-user-modal"
                            value="{{ $user->id }}">
                            Delete
                        </button>
                    </div>
                </td>
            </tr>
        @endforeach
    </tbody>
</table>
