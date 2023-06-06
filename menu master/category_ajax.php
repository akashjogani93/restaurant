
<style>
.selected-item1{
    font-size:12pt;
    background-color: #2f2519;
    color: #fff;
}
</style>


<div class="category-box box">
                             <div class="selected-item1 row">
                                   <div class="col-md-1">SN.</div>
                                   <div class="col-md-8">Category</div>
                                   <div class="col-md-1">Delete</div>
                           </div>
                        <div style="overflow-y:auto; max-height:450px;">
                            <?php
                                 require_once("dbcon.php");
                                 $i=1;
                                 $sql = "SELECT * FROM `item-categories`";
                                 $result = mysqli_query($conn, $sql);
                                 if (mysqli_num_rows($result) > 0) {
                                     // output data of each row
                                     while($row = mysqli_fetch_assoc($result)) {
                                 ?>
                                    <div class="selected-item row">
                                        <div class="col-md-1"><?php echo $i++; ?>.</div>
                                        <div class="col-md-9 name"><?php echo $row['category']; ?></div>
                                        <button class="btn-sm btn-danger " value="<?php echo $row['category']; ?>" ><i class="fa fa-fw fa-trash-o"></i></button>
                                    </div>
                                    
                                <?php  } }?>
                        </div>
                    </div>
                    <div class="bill_print">
                            <div class=" row">
                                   <button class="btn btn-sm col-md-8 btn-warning btn_add_category" data-toggle="modal" data-target="#exampleModalCenter"><h4>ADD CATEGORY</h4></button>
                            </div>
                    </div>


    
 <script>


    $(document).on("click",'.selected-item', function(){
        $('.selected-item').css({
                    "background-color":"#ededed",
                    "font-size":"11pt",
                    "color": "#333"
                });

        $(this).css({
                    "background-color":"lightgreen",
                    "font-size":"14pt",
                    "color": "#000"
                });
            var x = $(this).find(".name").text();
                    $('#cat').val(x);
                    $('#menulist').load('menulist.php?category='+ x);
      
    });


        // delete category
    $(document).on("click",'.selected-item .btn-danger', function(){
            var x = $(this).val();
            var cfm = confirm("Do you want delete.?");
            if(cfm == true)
            {
                var log = $.ajax({
                type:"post",
                url: "add_menu_php.php",
                data :{ action : "cat_delete",
                    cat_name : x },
                success: function(result){
                    $('#show_cat').load('category_ajax.php');
                    $('#menulist').load('menulist.php?category='+x);
                }
            });
            console.log(log);
            }
                
    });

    </script>