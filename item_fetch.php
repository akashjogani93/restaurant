<?php include('dbcon.php'); 
$cat = $_GET['x']; ?>


<table id="example1" class="table table-bordered table-striped">
    <thead>
        <tr>
            <th>Sl.No.</th>
            <th>Item Code</th>
            <!-- <th style="display:none;">Item Code</th> -->
            <!-- <th>Category</th> -->
            <th>Menu Name</th>
            <!-- <th>Quantity</th> -->
            <th>Price</th>
            <th>Ac Price</th>
            <th>Edit/Delete</th>
        </tr>
    </thead>
    <tbody>
        <?php
            if($cat=="All")
            {
                $sql = "SELECT * FROM item";
            }else
            {
                $sql = "SELECT * FROM `item` WHERE `item_cat`='$cat';";
            }
            $i=1;
            $result = mysqli_query($conn, $sql);
            if (mysqli_num_rows($result) > 0) {
               
                // output data of each row
                while($row = mysqli_fetch_assoc($result)) 
                {
                    ?>
                        <tr>
                            <!-- <td><?php echo $row['slno']; ?></td> -->
                            <td><?php echo $i; ?></td>
                            <td><?php echo $row['item_code']; ?></td>
                            <!-- <td><?php echo $row['item_cat']; ?></td> -->
                            <td><?php echo $row['itmnam']; ?></td>
                            <td><?php echo $row['prc']; ?></td>
                            <td><?php echo $row['prc2']; ?></td>
                            <td>
                                <button v-on:click="editItem($event)" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#myModal">
                                    Edit
                                </button>
                                <a href="ajax/addcate.php?del=<?php echo $row['slno'];?>" class="btn btn-danger btn-sm">Delete</a>
                            </td>
                        </tr>
                    <?php
                    $i=$i+1;
                }
            }
        ?>
        
    </tbody>
</table>

<script>
    

var app = new Vue({
    el: '#example1',
    data: {
        slno: 0,
        rows: {},
        itmnam: '',
        qty: 1,
        prc: '',
        shnam: '',
        attemptSubmit: false,
    },
    // computed: {
    //     missingItmnam: function() {
    //         return this.itmnam === '';
    //     },
    //     missingQty: function() {
    //         return this.qty === '';
    //     },
    //     missingPrc: function() {
    //         return this.prc === '';
    //     },
    //     missingShnam: function() {
    //         return this.shnam === '';
    //     },
    // },
    methods: {
        editItem : function(e) 
        {
            var tar = e.currentTarget;
            var chil = tar.parentElement.parentElement.children;
            var form = $("#editform input");
            console.log(form);
			form[0].value = (chil[0].innerHTML);
            // $('#cat12').val(chil[2].innerHTML);
            form[1].value = (chil[1].innerHTML);
			form[2].value = (chil[2].innerHTML);
			form[3].value = (chil[3].innerHTML);
			form[4].value = (chil[4].innerHTML);
			form[5].value = (chil[1].innerHTML);
        }
    }
});

$(function() {
        $("#example1").DataTable({
            columnDefs: [
            { targets: [5], orderable: false } // Disable sorting for columns 2 and 3
         ]
        });
    });
// console.log(app);
</script>