// $(document).ready(function(){
//
// });

$('#submit').click(function(){
    let fault=$('#fault').val();
    let formData=$('#commentContent').val();
    if(formData === ''){
        formData.val('');
    }
    else{
        $.ajax({
            url: '/fault/'+fault+'/comment/add',
            method:'POST',
            data:{
                'comment':formData
            },
            async:true,
            success:function (data){
                $('#commentContent').val('');
                let result= JSON.parse(data);
                $.each(result,function(id,data){
                        document.getElementById("commentsCount").innerHTML ="Comments ("+data[0]+")";
                        $('#commentFields').prepend(
                            '<p>' +
                            '<b>'+data[1]+' '+data[2]+'</b>' +
                            '<small class="text-secondary ml-4">'+data[3]+'</small>' +
                            '<br>'+data[4]+
                            '</p>'
                        );
                });
            }

        })
    }
});

