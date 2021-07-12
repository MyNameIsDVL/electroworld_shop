<?php
$connect = mysqli_connect("localhost", "root", "", "adminpanel");
$connect->query("SET NAMES utf8 COLLATE utf8_polish_ci");

if (isset($_POST['action'])) {
    $sql = "SELECT * FROM tbl_shop_product WHERE brands !=''";

    if (isset($_POST['brand'])) {
        $brand = implode("','", $_POST['brand']);
        $sql .="AND brands IN('".$brand."')";
    }
    if (isset($_POST['type'])) {
        $type = implode("','", $_POST['type']);
        $sql .="AND type IN('".$type."')";
    }
    $result = $connect->query($sql);
    $output = '';

    if ($result->num_rows > 0)
    {
        while ($row = $result-> fetch_assoc()) {
            $output .= '<div class="col-md-3">
            <form method="post" class="collect">
             <div style="border:1px solid #333; background-color:#f1f1f1; border-radius:5px; padding:16px; box-shadow: 0 2px 5px 0 rgba(0,0,0,0.5), 0 2px 10px 0 rgba(0,0,0,0.5);" align="center">
              <img src="../images/'.$row["image"].'" class="img-responsive"/><br />
        
              <h4 class="text-info"><a class="hover" id="'.$row["id"].'">'.$row["name"].'</a></h4>
        
              <h4 class="area-info" id="target">'.$row["info"].'</h4>

              <h6 class="text-danger">Quantity:'.(($row["quan"] < 1 )?'lack of goods':''.$row["quan"].'').'</h6>
        
              <h4 class="text-danger" id="target">$ '.$row["price"].'</h4>
        
              <input type="number" min="1" max="'.$row["quan"].'" name="quantity" id="quantity '.$row["id"].'" value="" class="form-control" />
              <input type="hidden" name="hidden_name" value="'.$row["name"].'" />
              <input type="hidden" name="hidden_price" value="'.$row["price"].'" />
              <input type="hidden" name="hidden_id" value="'.$row["id"].'" />
              <input type="submit" name="add_to_cart" style="margin-top:5px;" class="btn btn-success" value="Add to Cart" '.(($row["quan"] == '0')?'disabled':"").'/> 
            </div>
            </form>
           </div>';
        }        
    }
    else {
        $output = "<h3>No products found!</h3>";
    }
    echo $output;
}
?>

<script>
$(document).ready(function(){
    $('.hover').popover({
        title:fetchData,
        html:true,
        placement:'left'
    });

    function fetchData(){
    var fetch_data = '';
    var element = $(this);
    var id = element.attr("id");
    $.ajax({
        url:"fetch.php",
        method:"POST",
        async:false,
        data:{id:id},
        success:function(data){
        fetch_data = data;
        }
    });
    return fetch_data;
    }
});
</script>