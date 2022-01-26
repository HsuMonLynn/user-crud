
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
// create reset
function createReset() {
    $('#create-name').val('');
    $('#create-name').removeClass('is-invalid');
 
    $('#create-email').val('');
    $('#create-email').removeClass('is-invalid');

    $('#create-image').val('');
    $('#create-image').removeClass('is-invalid');
    
    $('#create-preview-img').removeAttr('src');
}

// create preview image
$('#create-image').change(function(){
           
    let reader = new FileReader();

    reader.onload = (e) => { 

      $('#create-preview-img').attr('src', e.target.result); 
    }

    reader.readAsDataURL(this.files[0]); 
  
});
// create user model
function create(e) {
    e.preventDefault();

    createReset();

    $('create-user-modal').modal('show');
}

// create user
function store(){

    var myformData = new FormData();        
    myformData.append('name', $("#create-name").val() || '');
    myformData.append('email', $("#create-email").val() || '');
    myformData.append('image', $('#create-image')[0].files[0] || '');
    
    $.ajax({
        type:'POST',
        url:'/',
        headers: {'X-CSRF-TOKEN': $('meta[name="csrf_token"]').attr('content')},
        dataType: 'json',
        cache:false,
        contentType: false,
        processData: false,
        data: myformData,
        success:function(data){ 
            $('#create-user-modal').modal('hide');
            $(document.body).removeClass("modal-open");
            $(".modal-backdrop").remove(); 
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

            if(response.responseJSON.errors.image) {
                $('#create-image').addClass('is-invalid');
                $('#create-image-error').text(response.responseJSON.errors.image);
            }
        }    

    })
}
// edit reset
function editReset() {
    $('#edit-name').val('');
    $('#edit-name').removeClass('is-invalid');
 
    $('#edit-email').val('');
    $('#edit-email').removeClass('is-invalid');

    $('#edit-image').val('');
    $('#edit-image').removeClass('is-invalid');
    
    $('#edit-preview-img').removeAttr('src');
}
// edit user
function edit(el){
    editReset();
    var dataId = $(el).attr('data-id');
    $("#edit-id").val(dataId);
    var dataName = $(el).attr('data-name');
    $("#edit-name").val(dataName);
    var dataEmail = $(el).attr('data-email');
    $("#edit-email").val(dataEmail); 
    var dataImgSrc = $(el).attr('data-img-src');
    $("#edit-preview-img").attr('src', dataImgSrc);
    var dataImage = $(el).attr('data-image');
    $("#hidden-edit-img").val(dataImage); 

}
// edit preview image
$('#edit-image').change(function(){
           
    let reader = new FileReader();

    reader.onload = (e) => { 

      $('#edit-preview-img').attr('src', e.target.result); 
    }

    reader.readAsDataURL(this.files[0]); 
  
});
// update user
function update(){
    var id = $("#edit-id").val();

    var myformData = new FormData();        
    myformData.append('name', $("#edit-name").val() || '');
    myformData.append('email', $("#edit-email").val() || '');
    myformData.append('image', $('#edit-image')[0].files[0] || '');
    myformData.append('_method', 'POST');
    
    $.ajax({
        type:'POST',
        url: 'users/' + id,    
        headers: {'X-CSRF-TOKEN': $('meta[name="csrf_token"]').attr('content') },
        dataType: 'json',
        cache:false,
        contentType: false,
        processData: false,
        data: myformData,
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

            if(response.responseJSON.errors.image) {
                $('#edit-image').addClass('is-invalid');
                $('#edit-image-error').text(response.responseJSON.errors.image);
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
