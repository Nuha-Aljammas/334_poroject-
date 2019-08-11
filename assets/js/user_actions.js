function del_user(ele){
  jQuery.ajax({
    url: "/controller/ajax.php",
    method:"POST",
    data:{
        user_id:ele.id,
        action:"delete_user"
    },
    success:function(data){
      jQuery("#"+ele.id).parent().parent().parent().fadeOut();
    },
    error:function(){

    }
  });
}
