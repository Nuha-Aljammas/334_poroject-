  function fav(book){
    jQuery.ajax({
      url: "/controller/ajax.php",
      method:"POST",
      data:{
          book_id:book.id,
          action:"favourite"
      },
      //removing the book after clicking removed
      success:function(data){
        if(data == "removed")
          jQuery("#"+book.id).parent().parent().fadeOut();
      },
      error:function(){

      }
    });
  }

  function borrow(book){
    jQuery.ajax({
      url: "/controller/ajax.php",
      method:"POST",
      data:{
          book_id:book.id,
          action:"borrow"
      },
      success:function(data){
        console.log(data);
      },
      error:function(){

      }
    });
  }
