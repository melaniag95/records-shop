$(document).ready(function(){
    //Check if admin pwd is correct
    $('#current_password').keyup(function(){
        var current_password = $('#current_password').val();
        //alert(current_password);
        $.ajax({
            type:'post',
            url:'/admin/check-current-password',
            data:{current_password:current_password},
            success:function(response){
                //alert(response)
                if(response == "false"){
                    $('#checkCurrentPwd').html("<strong style='color:red'>Current Password is incorrect!</strong>")
                } else if (response == "true"){
                    $('#checkCurrentPwd').html("<strong style='color:green'>Current Password is correct</strong>")
                }
            },
            error: function(){
                alert('Error!')
            }
        })
    })
})