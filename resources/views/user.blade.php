<x-layout>
    
    <article>
        <div class="container mt-5">
            <div class="row">
                <div class="col-6">
                    <button  name="btn-add" class="btn btn-primary" data-toggle="modal" data-target="#create-user-modal" onclick="create(event)">Create</button>
                </div>
                <div class="col-6">
                    <div class="input-group mb-3">
                        <input type="search" class="form-control" id="search" placeholder="Search..." />
                        <div class="input-group-append">
                            <button class="btn btn-primary" type="button" onclick="search()" >Search</button>
                        </div>
                    </div>
                </div>
                <div class="col-12 mt-3" id="user-list-table"></div>
            
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
                    <form id="form-data" enctype="multipart/form-data">
                        <div class="form-group">
                            <label class="col-form-label">Name:</label>
                            <input type="text" class="form-control" id="create-name" name=""/>
                            <div class="invalid-feedback" id="create-name-error">
                            </div> 
                        </div>
                        <div class="form-group">
                            <label class="col-form-label">Email:</label>
                            <input type="email" class="form-control" id="create-email" name=""/>
                            <div class="invalid-feedback" id="create-email-error">
                            </div>
                        </div>
                        <div class="form-group">
                            <img src=""
                                    alt="" width="100" height="100" class="mb-3 ml-3" id="create-preview-img">
                            <input type="file" name="" id="create-image"
                                class="form-control-file">
                                <div class="invalid-feedback" id="create-image-error">
                            </div>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-secondary" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary" onclick="store()">Create</button>
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
                    <form enctype="multipart/form-data" id="edit-form">
                    <input type="hidden" id="edit-id">
                    <input type="hidden" id="hidden-edit-img">
                        <div class="form-group">
                            <label class="col-form-label">Name:</label>
                            <input type="text" class="form-control" id="edit-name" name=""/>
                            <div class="invalid-feedback" id="edit-name-error">
                                
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-form-label">Email:</label>
                            <input type="email" class="form-control" id="edit-email" name=""/>
                            <div class="invalid-feedback" id="edit-email-error">
                               
                            </div>
                        </div>
                        <div class="form-group">
                            <img    src=" "
                                    alt="" 
                                    width="100" 
                                    height="100" 
                                    class="mb-3 ml-3" 
                                    id="edit-preview-img">
                            <input type="file" name="edit-photo" id="edit-image" name=""
                                class="form-control-file">
                            <div class="invalid-feedback" id="edit-image-error">
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-secondary" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary" onclick="update()">Update</button>
                </div>
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
                    <input type="hidden" id="delete-id">
                    <p>Are you sure to delete a user?</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-secondary" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-danger" onclick="deleteUser()">Delete</button>
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