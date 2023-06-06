
            <?php 
            require_once("header.php");
            ?>

            <!-- Content Wrapper. Contains page content -->
            <div class="content-wrapper">
            <section class="content col-md-4" id="show_cat">
                
            </section>
 <section class="content col-md-8">
    <!-- SELECT2 EXAMPLE -->
    <div class="box box-default">
        <div class="row" >
            <div class="col-md-12">
            <form class="form-horizontal" id="addform" action="item_insert.php" method="POST" >
                <div class="box-body">
                    <div class="row">
                        <div class="form-group col-md-6 ">
                            <label for="inputPassword3" class="col-sm-4 control-label">Menu Name</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" name="itm" id="itm" placeholder="Item Name" v-model="itmnam" autocomplete="off" >
                                <input type="text" id="cat" name="category" style="display:none" />
                            </div>
                        </div>
                        
                         <div class="form-group col-md-5">
                            <label for="inputEmail3" class="col-sm-5 control-label">Menu Price</label>
                            <div class="col-sm-5">
                                <input type="number" id="prize" class="form-control" name="prc" min="1" placeholder="Price" v-model="prc"  >
                            </div>
                        </div>
                       
                    <div class="form-group col-md-1">
                        <button type="button" id="menusubmit" class="btn btn-primary">Submit</button>
                    </div>
                </div>
             </div>
             </form>
         </div>
      </div>
<!-- /.box -->

<!-- Table -->
   <div class="box">
    <!-- /.box-header -->
    <div class="box-body " id="menulist" style="height:450px; overflow-x:auto">
  
    </div>
    <!-- /.box-body -->

  
</div>
</section>
</div>

<div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
            <div class="modal-header">
                    <h3 class="modal-title text-center" id="exampleModalLongTitle">Add Category</h3>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
            </div>
            <div class="box-body">
                    <div class="form-group col-md-12">
                        <label for="inputPassword3" class="col-sm-4 control-label">Category Name</label>
                        <div class="col-sm-6">
                            <input type="text" class="form-control" id="cat_name" name="cat_name" placeholder="Category Name" required>
                        </div>
                    </div>
            </div>
                <div class="modal-footer">
                    <button type="button"  class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary" id="save_cat">Save</button>
                </div>
        </div>
    </div>
</div>

    <?php require_once("footer.php"); ?>
    <script>
    
        $(function () {
            $("#example1").DataTable();
            $('#example2').DataTable({
                "paging": true,
                "lengthChange": false,
                "searching": false,
                "ordering": true,
                "info": true,
                "autoWidth": false
            });
        });
    </script>
    <script>
    $(document).ready(function(){        
        $('#show_cat').load('category_ajax.php');
        // $('.selected-item').first().css("background-color","red");
         $('#menulist').text("select Category");

        // add categories
        $('#save_cat').click(function(){
            var category = $('#cat_name').val();
            var log = $.ajax({
                type:"post",
                url: "add_menu_php.php",
                data :{ action : "add_category",
                    cat_name : category},
                success: function(result){
                 $('.close').click();
                 //alert(result);
                  $('#show_cat').load('category_ajax.php');
                }
            });
            console.log(log);
        });

        // add menu
        $('#menusubmit').click(function(){
            var category = $('#cat').val();
            var item = $('#itm').val();
            var prize = $('#prize').val();
            // empty all fields
            $('#itm').val('');$('#prize').val('');
            var log = $.ajax({
                type:"post",
                url: "item_insert.php",
                data :{ action : "menusubmit",
                    category : category,
                    item : item,
                    prc : prize},
                success: function(result){
                    $('#menulist').load('menulist.php?category='+category);
                }
            });
            console.log(log);
        });
    });


    </script>

    </body>
</html>
