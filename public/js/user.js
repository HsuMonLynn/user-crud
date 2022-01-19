// jQuery(document).ready(function($){
//     $.ajaxSetup({
//             headers: {
//                 'X-CSRF-TOKEN': jQuery('meta[name="csrf-token"]').attr('content')
//             }
//         });
//     $('#btn-create').click(function(e){
        
//         e.preventDefault();
//         var name = $("#name").val();
//         var email = $("#email").val();
//         var formData = { name, email };
        
//         $.ajax({
//             type:'POST',
//             url:'userCreate',
//             data: formData,
//             dataType: 'json',
//             success:function(data){
                
//                 $("#create-user-modal").remove();
//                 $("#create-user-modal").find('input').val('');
//                 setInterval('location.reload()', 3000); 
            
//             }    
//          });
         
//     });
//     });
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

function store(){
    var name = $("#name").val();
    var email = $("#email").val();
    var formData = { name, email };
    $.ajax({
        type:'POST',
        url:'/userCreate',
        headers: {'X-CSRF-TOKEN': $('meta[name="csrf_token"]').attr('content')},
        data:formData,
        dataType: 'json',
        success:function(data){
                
             $("#create-user-modal").remove();
              getUser();          
                        
            }    

    })
}