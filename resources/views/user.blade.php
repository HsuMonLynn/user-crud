<x-layout>
    
    <article>
        <div class="container mt-5">
            <div class="row">
                <div class="col-6">
                    <button id="btn-add" name="btn-add" class="btn btn-primary" data-toggle="modal" data-target="#create-user-modal">Create</button>
                </div>
                <div class="col-6">
                    <div class="input-group mb-3">
                        <input type="search" class="form-control" placeholder="Search..." />
                        <div class="input-group-append">
                            <button class="btn btn-primary" type="button">Search</button>
                        </div>
                    </div>
                </div>
                <div class="col-12 mt-3">
                    <table class="table table-striped" id="user-list-table">
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
                                <th scope="row">{{$user->id}}</th>
                                <td>{{$user->name}}</td>
                                <td>{{$user->email}}</td>
                                <td>{{$user->created_at}}</td>
                                <td>
                                    <div class="actions">
                                        <button
                                            class="btn btn-success"
                                            data-toggle="modal"
                                            data-target="#edit-user-modal"
                                            value="{{$user->id}}"
                                        >
                                            Edit
                                        </button>
                                        <button
                                            class="btn btn-danger ml-2"
                                            data-toggle="modal"
                                            data-target="#delete-user-modal"
                                            value="{{$user->id}}"
                                        >
                                            Delete
                                        </button>
                                    </div>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                <!-- Pagination -->
                <div class="row justify-content-start no-gutters px-3 pagination">
                    @isset($users)
                    {{ $users->appends(request()->query())->links('pagination::bootstrap-4') }}
                    @endisset
                </div>
                {{-- <div class="pagination">{{ $users->links() }}</div> --}}
                {{-- <nav class="mt-5">
                    <ul class="pagination">
                        <li class="page-item disabled">
                            <a class="page-link">Previous</a>
                        </li>
                        <li class="page-item"><a class="page-link" href="#">1</a></li>
                        <li class="page-item active" aria-current="page">
                            <a class="page-link" href="#">2</a>
                        </li>
                        <li class="page-item"><a class="page-link" href="#">3</a></li>
                        <li class="page-item">
                            <a class="page-link" href="#">Next</a>
                        </li>
                    </ul>
                </nav>
            </div> --}}
            <!-- .col-12 -->
            
        </div>
        
    </div>
    
    <!-- Create User Modal-->
    <div class="modal fade" id="create-user-modal">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Create User</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form>
                        <div class="form-group">
                            <label class="col-form-label">Name:</label>
                            <input type="text" class="form-control" id="name" name="name"  
                                @error('name')is-invalid @enderror/>
                                @error('name')
                                    <div class="invalid-feedback">
                                        The name is required.
                                    </div> 
                                @enderror
                        </div>
                        <div class="form-group">
                            <label class="col-form-label">Email:</label>
                            <input type="email" class="form-control" id="email" name="email" 
                            @error('email')
                            is-invalid @enderror/>
                            @error('email')
                                <div class="invalid-feedback">
                                    The email is required.
                                </div> 
                            @enderror
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-secondary" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary" id="btn-create" name="btn-create">Create</button>
                </div>
            </div>
        </div>
    </div>
    <!-- End: Create User Modal-->

    <!-- Edit User Modal-->
    <div class="modal fade" id="edit-user-modal">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Edit User</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form>
                        <div class="form-group">
                            <label class="col-form-label">Name:</label>
                            <input type="text" class="form-control is-invalid" />
                            <div class="invalid-feedback">
                                The name is required.
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-form-label">Email:</label>
                            <input type="email" class="form-control is-invalid" />
                            <div class="invalid-feedback">
                                The email is required.
                            </div>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-secondary" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary">Update</button>
                </div>
            </div>
        </div>
    </div>
    <!-- End: Edit User Modal-->

    <!-- Delete User Modal-->
    <div class="modal fade" id="delete-user-modal">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Confirm Delete</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p>Are you sure to delete a user?</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-secondary" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-danger">Delete</button>
                </div>
            </div>
        </div>
    </div>
    <!-- End: Delete User Modal-->

    <script
        src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js"
        integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj"
        crossorigin="anonymous"
    ></script>
    <script
        src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-fQybjgWLrvvRgtW6bFlB7jaZrFsaBXjsOMm/tB9LTS58ONXgqbR9W8oWht/amnpF"
        crossorigin="anonymous"
    ></script>       
    </article>

</x-layout>