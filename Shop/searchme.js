
  $(document).ready(function() {

    $('#Search').keyup(function() {
      var txt = $(this).val();
      if (txt != '')
      {
          $.ajax({
              url: "actionfind.php",
              method: "post",
              data: {search:txt},
              dataType: "text",
              success: function(data)
              {
                  $('#result').html(data);
              }
          });
      }
      else {
          $('#result').html('');
          $.ajax({
              url: "actionfind.php",
              method: "post",
              data: {search:txt},
              dataType: "text",
              success: function(data)
              {
                  $('#result').html(data);
              }
          });
      }
  });



    $(".radiobtn").click(function() {
      var action = 'data';
      var brand = getFilterText('radiobuttons');
      var type = getFilterText('radiotype');

      $.ajax({
        url:'action.php',
        method:'POST',
        data:{action:action, brand:brand, type:type},
        success:function(response){
          $("#result").html(response);
        }
      })
    });

    function getFilterText(text_id) {
  
      var filterData = [];
      $('#'+text_id+':checked').each(function() {
        filterData.push($(this).val());
      });
      return filterData;
    }	
  })
  