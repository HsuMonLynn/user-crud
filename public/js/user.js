
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

    axios.post('/', myformData)
    .then(response => {
        $('#create-user-modal').modal('hide');
        $(document.body).removeClass("modal-open");
        $(".modal-backdrop").remove();
        getUser();
    })
    .catch(error => {
        if (error.response) {
            let errors = error.response.data.errors;
                    
            if(errors.hasOwnProperty('name')) {
                $('#create-name').addClass('is-invalid')
                $('#create-name-error').text(errors.name[0])
            }

            if(errors.hasOwnProperty('email')) {
                $('#create-email').addClass('is-invalid')
                $('#create-email-error').text(errors.email[0])
            }

            if(errors.hasOwnProperty('image')) {
                $('#create-image').addClass('is-invalid')
                $('#create-image-error').text(errors.image[0])
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
    
    axios.post('users/'+id, myformData)
    .then(response => {
        $('#edit-user-modal').modal('hide');
        $(document.body).removeClass("modal-open");
        $(".modal-backdrop").remove();
        getUser();
    })
    .catch(error => {
        if (error.response) {
            let errors = error.response.data.errors;
                    
            if(errors.hasOwnProperty('name')) {
                $('#edit-name').addClass('is-invalid')
                $('#edit-name-error').text(errors.name[0])
            }

            if(errors.hasOwnProperty('email')) {
                $('#edit-email').addClass('is-invalid')
                $('#edit-email-error').text(errors.email[0])
            }

            if(errors.hasOwnProperty('image')) {
                $('#edit-image').addClass('is-invalid')
                $('#edit-image-error').text(errors.image[0])
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

    axios.delete('/'+id )
    .then(response => {
        $('#delete-user-modal').modal('hide');
        $(document.body).removeClass("modal-open");
        $(".modal-backdrop").remove();
        getUser();
    })

}

// pagination 
$(document).on('click', '#pagination a', function(event){
    event.preventDefault(); 
    var page = $(this).attr('href').split('page=')[1];
   fetchUser(page);
   });
function fetchUser(page){

    let url = '/all-users?page='+page
    fetch(url).then(response=>response.text())
    .then(html => {
        document.querySelector('#user-list-table').innerHTML = html;
    });
    
}
