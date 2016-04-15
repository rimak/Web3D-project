 $(document).ready(function(){
    var $start = $('#start');
    var $appear = $('#appear');

    $start.click(function(){
      $start.css("visibility", "hidden");
      $appear.css("visibility", "visible");
    });
  });