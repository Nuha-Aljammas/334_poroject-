function check_them_all(){
  jQuery(".book-checkbox").each(function(ind,itm){
    if(jQuery(this).prop("checked")){
      jQuery(itm).prop("checked",false);
    }else{
      jQuery(itm).prop("checked",true);
    }
  })
}
