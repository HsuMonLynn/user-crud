
$(document).ready(function($){
    getUser();
});

// get all users 
function getUser(){
    let url = '/all-users'
    fetch(url).then(response=>response.text())
    .then(html => {
        document.querySelector('#user-list-table').innerHTML = html;
    });
}

// search users
function search(){
 let url = '/all-users?search='+ $('#search').val()
    fetch(url).then(response=>response.text())
    .then(html => {
        document.querySelector('#user-list-table').innerHTML = html;
    });
}
// create user
function store(){
    
    var name = $("#create-name").val();
    var email = $("#create-email").val();
    var formData = { name, email };
    
    $.ajax({
        type:'POST',
        url:'/',
        headers: {'X-CSRF-TOKEN': $('meta[name="csrf_token"]').attr('content')},
        data:formData,
        dataType: 'json',
        success:function(data){ 
            $('#create-user-modal').modal('hide');
            $(document.body).removeClass("modal-open");
            $(".modal-backdrop").remove();
            $('#create-name').val('');
            $('#create-email').val('');
            getUser();                     
        },
        error: function (response) {
            if(response.responseJSON.errors.name) {
                $('#create-name').addClass('is-invalid');
                $('#create-name-error').text(response.responseJSON.errors.name);
            }

            if(response.responseJSON.errors.email) {
                $('#create-email').addClass('is-invalid');
                $('#create-email-error').text(response.responseJSON.errors.email);
            }
        }    

    })
}
// edit user
function edit(el){
    var dataId = $(el).attr('data-id');
    $("#edit-id").val(dataId);
    var dataName = $(el).attr('data-name');
    $("#edit-name").val(dataName);
    var dataEmail = $(el).attr('data-email');
    $("#edit-email").val(dataEmail);  
}
// update user
function update(){
    var id = $("#edit-id").val();
    var name = $("#edit-name").val();
    var email = $("#edit-email").val();
    var formData = { name, email };

    $.ajax({
        type:'PUT',
        url: '/' + id,    
        headers: {'X-CSRF-TOKEN': $('meta[name="csrf_token"]').attr('content')},
        data:formData,
        dataType: 'json',
        success:function(data){ 
            $('#edit-user-modal').modal('hide');
            $(document.body).removeClass("modal-open");
            $(".modal-backdrop").remove();
            getUser();                     
        },
        error: function (response) {
            if(response.responseJSON.errors.name) {
                $('#edit-name').addClass('is-invalid');
                $('#edit-name-error').text(response.responseJSON.errors.name);
            }

            if(response.responseJSON.errors.email) {
                $('#edit-email').addClass('is-invalid');
                $('#edit-email-error').text(response.responseJSON.errors.email);
            }
        }  
    })
}
//delete user
function destroy(el){
    var id = $(el).attr('data-id');
    $("#delete-id").val(id);
     
}
function deleteUser(){
    var id = $("#delete-id").val();
    $.ajax({
        type:'DELETE',
        url:'/'+ id,
        headers: {'X-CSRF-TOKEN': $('meta[name="csrf_token"]').attr('content')},
        success:function(data){
            getUser();
            $('#delete-user-modal').modal('hide');
            $(document.body).removeClass("modal-open");
            $(".modal-backdrop").remove();
        }
    })
}

// pagination 
$(document).on('click', '#pagination a', function(event){
    event.preventDefault(); 
    var page = $(this).attr('href').split('page=')[1];
   fetchUser(page);
   });
function fetchUser(page){
    $.ajax({
        url:"/all-users?page="+page,
        success:function(data)
        {
            $('#user-list-table').html(data);
        }
    });
}
