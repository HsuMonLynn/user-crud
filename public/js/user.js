jQuery(document).ready(function($){

    $('#btn-create').click(function(e){
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': jQuery('meta[name="csrf-token"]').attr('content')
            }
        });
        e.preventDefault();
        var name = $("#name").val();
        var email = $("#email").val();
        var formData = { name, email };
        
        $.ajax({
            type:'POST',
            url:'userCreate',
            data: formData,
            dataType: 'json',
            success:function(data){
                
                $("#create-user-modal").remove();
                $("#create-user-modal").find('input').val('');
                setInterval('location.reload()', 3000); 
            
            }    
         });
         
    });
    });