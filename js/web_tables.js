class Main
{
    mainProductId;
    retrieve(kitchenData,itemName)
    {
        $('#table-body').empty();
        // Iterate through the kitchen data and append rows to the table body
        for (let i = 0; i < kitchenData.length; i++) 
        {
            let item = kitchenData[i];
            var uqty=parseFloat(item.uqty);
            var pqty=parseFloat(item.pqty);
            let row = "<tr>" +
                            "<td>" + item.catename + "</td>" +
                            "<td>" + item.pid + "</td>" +
                            "<td>" + item.pname + "</td>" +
                            "<td>" + item.punit + "</td>" +
                            "<td class='right-align'>" + pqty.toFixed(2) + "</td>" +
                            "<td class='right-align'>" + uqty.toFixed(2) + "</td>" +
                            "<td>" + item.gdate + "</td>" +
                            "<td><button class='edit-btn btn btn-sm btn-primary' data-index='" + i + "'><i class='bx bx-edit-alt'></i></button>&nbsp;" +
                            "<button class='delete-btn btn btn-sm btn-danger' data-index='" + i + "'><i class='bx bx-trash'></i></button></td>" +
                        "</tr>";
            $('#table-body').append(row);
        }
        $('.delete-btn').on('click', (event) => 
        {
            let index = $(event.currentTarget).data('index');
            this.delete(kitchenData, index,itemName);
        });
        $('.edit-btn').on('click', (event) => {
            let index = $(event.currentTarget).data('index');
            this.edit(kitchenData, index,itemName);
        });
    }
    delete(kitchenData, index,itemName) 
    {
        kitchenData.splice(index, 1);
        localStorage.setItem(itemName, JSON.stringify(kitchenData));
        this.retrieve(kitchenData,itemName);
    }
    edit(kitchenData, index,itemName)
    {
        var row=kitchenData[index];
        var category=row.catename;
        var pname=row.pname;
        var saleUnit=row.sellunit;
        var totalqty=row.totalqty;
        var uqty=row.uqty;
        this.mainProductId = row.pid;
        $('#catename').val(category);
        var catenameElement = document.getElementById('catename');
        catenameElement.value = category;
        catenameElement.dispatchEvent(new Event('change'));
        
        setTimeout(function () 
        {
            $('#pid option').each(function() {
                // console.log($(this).text());
                if ($(this).text() === pname) {
                    $(this).prop('selected', true);
                    $('#pid').trigger('change');
                }
            });
        }, 500);
        $('#uqty').val(uqty);
        $('#addToList').hide();
        $('#updateItem').show();
    }
    addToList(kitchenData,itemName)
    {
            let catename=$('#catename').val();
            let pid=$('#pid').val();
            let pname = $('#pid option:selected').text();
            let sellunit=$('#sellunit').val();
            let totalqty=$('#sellqty').val();
            let uqty=$('#uqty').val();

            let gdate=$('#gdate').val();
            let input=['#pid','#sellqty','#sellunit','#uqty'];
            $('.input-field').css('border-color', '');
            switch (true) 
            {
                case !catename:
                    $('#catename').css('border-color', 'red');
                    break;
                case !pid:
                    $('#pid').css('border-color', 'red');
                    break;
                case !totalqty:
                    $('#pqty').css('border-color', 'red');
                    break;
                case !sellunit:
                    $('#punit').css('border-color', 'red');
                    break;
                case !uqty:
                    $('#uqty').css('border-color', 'red');
                    break;
                case !gdate:
                    $('#gdate').css('border-color', 'red');
                    break;
                default:
                    let newItem = {
                        catename: catename,
                        pid: pid,
                        pname: pname,
                        punit: sellunit,
                        pqty: totalqty,
                        uqty: uqty,
                        gdate: gdate
                    };
                let existingItemIndex = kitchenData.findIndex(item => item.pid === pid);

                if (existingItemIndex !== -1) {
                    kitchenData[existingItemIndex].uqty = Number(kitchenData[existingItemIndex].uqty) + Number(uqty);
                    kitchenData[existingItemIndex].gdate = gdate;
                } else {
                    kitchenData.push(newItem);
                }

                localStorage.setItem(itemName, JSON.stringify(kitchenData));
                for(var i=0; input.length>i; i++)
                {
                    $(input[i]).val('');
                }
                break;
            }
            $('#catename').focus();
            this.retrieve(kitchenData,itemName);
    }
    updateToList(kitchenData,itemName)
    {
        var mainProductId=this.mainProductId;
        console.log(mainProductId);
        let catename=$('#catename').val();
            let pid=$('#pid').val();
            let pname = $('#pid option:selected').text();
            let sellunit=$('#sellunit').val();
            let totalqty=$('#sellqty').val();
            let uqty=$('#uqty').val();

            let gdate=$('#gdate').val();
            let input=['#pid','#sellqty','#sellunit','#uqty'];
            $('.input-field').css('border-color', '');
            switch (true) 
            {
                case !catename:
                    $('#catename').css('border-color', 'red');
                    break;
                case !pid:
                    $('#pid').css('border-color', 'red');
                    break;
                case !totalqty:
                    $('#pqty').css('border-color', 'red');
                    break;
                case !sellunit:
                    $('#punit').css('border-color', 'red');
                    break;
                case !uqty:
                    $('#uqty').css('border-color', 'red');
                    break;
                case !gdate:
                    $('#gdate').css('border-color', 'red');
                    break;
                default:
                    let newItem = {
                        catename: catename,
                        pid: pid,
                        pname: pname,
                        punit: sellunit,
                        pqty: totalqty,
                        uqty: uqty,
                        gdate: gdate
                    };
                // let existingItemIndex = kitchenData[index];
                let existingItemIndex = kitchenData.findIndex(item => item.pid === mainProductId);

                if (existingItemIndex !== -1)
                {
                   kitchenData[existingItemIndex].uqty = uqty;
                   kitchenData[existingItemIndex].gdate = gdate;
                   kitchenData[existingItemIndex].pname = pname;
                   kitchenData[existingItemIndex].punit = sellunit;
                   kitchenData[existingItemIndex].catename = catename;
                   kitchenData[existingItemIndex].pid = pid;
                    kitchenData[existingItemIndex].pqty = totalqty;
                } else {
                    kitchenData.push(newItem);
                }
                localStorage.setItem(itemName, JSON.stringify(kitchenData));
                for(var i=0; input.length>i; i++)
                {
                    $(input[i]).val('');
                }
                break;
            }
            $('#addToList').show();
            $('#updateItem').hide();
            this.retrieve(kitchenData,itemName);
    }
    finalSubmit(kitchenData,itemName,cattype,description)
    {
        const vm=this;
        let log= $.ajax({
            url: 'ajax/store_all.php',
            method: 'POST',
            data: 
            {
                cattype:cattype,
                kitchenData: kitchenData,
                description:description,
            },
            success(response) 
            {
                alert('Added List To Stock');
                localStorage.removeItem(itemName);
                location.reload();
                vm.retrieve(kitchenData,itemName);
            },
            error(xhr, status, error) 
            {
                console.error(error);
            }
        });
        console.log(log);
    }
    clear(kitchenData,itemName)
    {
        // kitchenData='';
        localStorage.removeItem(itemName);
        location.reload();
        // this.retrieve(kitchenData,itemName);
    }
    inputClear(kitchenData,itemName)
    {
        let input=['#pid','#sellqty','#sellunit','#uqty'];
        for(var i=0; input.length>i; i++)
        {
            $(input[i]).val('');
        }
        $('#addToList').show();
            $('#updateItem').hide();
    }
}
