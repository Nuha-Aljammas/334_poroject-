jQuery("#search").keyup(function() {
  jQuery(".books_searched").remove();
  if (this.value.length > 0) {
    let query = this.value;
    jQuery.ajax({
      url: "/controller/ajax.php",
      method: "POST",
      data: {
        action: "search",
        string: query
      },
      success: function(data) {
        jQuery(".search-bar").append(data);
      },
      error: function() {
        console.log("FAILED:(");
      }


    });
  }


});
