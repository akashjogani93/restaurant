
<table id="table" class="table table-bordered table-striped">
            <thead class="custom-bg head">
                <tr>
                    <th style="width:12%;">Sl No</th>
                    <th style="width:50%;">Menu Name</th>
                    <th style="width:15%;">Menu Price</th>
                    <th style="width:15%;">Edit/Delete</th>
                </tr>
            </thead>
            <tbody>
                <?php
                require_once("dbcon.php");
                $cat=$_GET['category'];
                $sql = "SELECT * FROM `item` WHERE `item_cat`='$cat';";
                $result = mysqli_query($conn, $sql);
                if (mysqli_num_rows($result) > 0) {
                    // output data of each row
                    while($row = mysqli_fetch_assoc($result)) {
                ?>
                <tr>
                    <td style="width:10%;"><?php echo $row['slno']; ?></td>
                    <td style="width:50%; display: none;"><?php echo $row['item_cat']; ?></td>
                    <td style="width:50%;"><?php echo $row['itmnam']; ?></td>
                    <td style="width:15%;"><?php echo $row['prc']; ?></td>
                    <td style="width:15%;">
                        <button v-on:click="editItem($event);" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#myModal" ><i class="fa fa-fw fa-edit"></i></button>
                        <button class="btn btn-danger btn-sm"><i class="fa fa-fw fa-trash-o"></i></button></a>
                    </td>
                </tr>

                <?php    }
                }
            ?>
        </table>

          <!-- Modal -->
    <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="myModalLabel">Edit</h4>
                </div>
                    <div class="modal-body">
                        <div class="col-md-12">
                            <div class="box-body">
                                <div class="form-group col-md-12">
                                    <label for="inputEmail3" class="col-md-4 control-label">Sl No</label>
                                    <div class="col-md-4">
                                        <input type="number" id="menu_id" class="form-control" placeholder="Sl No" name="slno" readonly>
                                    </div>
                                </div>
                                <div class="form-group col-md-12" >
                                    <label for="inputPassword3" class="col-sm-4 control-label">Category</label>
                                    <div class="col-sm-6">
                                        <input type="text" id="menu_cat" class="form-control" name="itmnam" placeholder="Item Name" required>
                                    </div>
                                </div>

                                <div class="form-group col-md-12">
                                    <label for="inputPassword3" class="col-sm-4 control-label">Item Name</label>
                                    <div class="col-sm-6">
                                        <input type="text" id="menu_item" class="form-control" name="itmnam" placeholder="Item Name" required>
                                    </div>
                                </div>
                                <input type="hidden" name="qty" value="1" >
                                <div class="form-group col-md-12">
                                    <label for="inputEmail3" class="col-sm-4 control-label">Price</label>
                                    <div class="col-sm-6">
                                        <input type="number" id="menu_prize" step="0.01" class="form-control" name="prc" placeholder="Price" required>
                                    </div>
                                </div>
                                </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                      <button type="submit" id="update_menu" class="btn btn-primary">Update</button>
                        <button type="button" id="close" class="btn btn-default" data-dismiss="modal">Close</button>
                    </div>
            </div>
        </div>
    </div>




    <script>
          $(document).ready(function(){

			$("#table tbody").on('click', 'tr .btn-primary', function () {
				var currow=$(this).closest('tr');
				var id=currow.find('td:eq(0)').html();
                var cat=currow.find('td:eq(1)').html();
				var name=currow.find('td:eq(2)').html();
				var price=currow.find('td:eq(3)').html();
				$('#menu_id').val(id);
		   		$('#menu_cat').val(cat);
				$('#menu_item').val(name);
				$('#menu_prize').val(price);
			});

             // update Menu
             $('#update_menu').click(function(){
                var item_id = $('#menu_id').val();
                var category = $('#menu_cat').val();
                var item = $('#menu_item').val();
                var prize = $('#menu_prize').val();
                // empty all fields
                $('#menu_id').val('');$('#menu_cat').val('');$('#menu_item').val('');$('#menu_prize').val('');
                var log = $.ajax({
                    type:"post",
                    url: "item_insert.php",
                    data :{ action : "menuupdate",
                            item_id : item_id,
                            category : category,
                            item : item,
                            prc : prize},
                    success: function(result){
                        document.getElementById('close').click();
                        setInterval(function(){  $('#menulist').load('menulist.php?category='+category); }, 800);
                    }
                });
                console.log(log);
            });
    

            // delete category
            $("#table tbody").on('click', 'tr .btn-danger', function(){
                    var currow=$(this).closest('tr');
                    var id=currow.find('td:eq(0)').html();
                    var cat=currow.find('td:eq(1)').html();
                    var cfm = confirm("Do you want delete.?");
                    if(cfm == true)
                    {
                        var log = $.ajax({
                        type:"post",
                        url: "item_insert.php",
                        data :{ action : "menu_delete",
                            cat_name : cat,
                            menu_id : id}, 
                            success: function(result){
                                $('#menulist').load('menulist.php?category='+cat);
                            }
                        });
                        console.log(log);
                    }
            });
        });
 </script>