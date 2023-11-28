class Product
{
    constructor() 
    {
        this.initializeTabs();
    }
    initializeTabs()
    {
        $(function ()
        {
            $("#dynamic-table").DataTable({
                columnDefs: [
                    { "orderable": false, "targets": -1 }
                ],
                order: [[0, 'desc']]
            });
        });

        var app1 = new Vue({
            el:'#app',
            data:{
                stockList: [],
                categoys:[], 
                catName:'',
                product:'',
                unit:'',
                sellUnit:'',
                tax:0,
                cess:0
            },
            mounted() {
                this.fetchOptions();
            },
            methods:{
                fetchOptions()
                {
                    const vm = this;
                    $.ajax({
                        url: 'ajax/store_all.php',
                        method: 'POST',
                        data:{cat:'cat'},
                        success(response) 
                        {
                            vm.categoys = response;
                        },
                        error(xhr, status, error) 
                        {
                            console.error(error);
                        }
                    });

                    $('#addcate').on('click', function() 
                    {
                        app1.cateAdd();
                    }); 

                    $('input, select').on('focus', function() {
                        $(this).css('border-color', '');
                    });
                },
                catemodal()
                {
                    $('#Addcategory').modal('show');
                },
                cateAdd()
                {
                    var current=this;
                    var cat = $("#cat1").val().trim();
                    var typeCat = $("#typeCat").val().trim();
                    if(typeCat=='')
                    {
                        $('#catempty').html(`<span style='color:red'>Select Type..</span>`);
                        $("#catempty").fadeOut(1000);
                        return;
                    }
                    var pattern = /^[a-zA-Z\s]*$/;
                    if(cat!='' && pattern.test(cat))
                    {
                        $.ajax({
                            url: 'ajax/store_all.php',
                            type: "POST",
                            data: {
                                addcat : cat,
                                typeCat : typeCat,
                            },
                            success: function(data) 
                            {
                                $('#catempty').html(`<span style='color:red'>${data}</span>`);
                                $("#catempty").fadeOut(1000, function() 
                                {
                                    location.reload();
                                });
                            }
                        });
                    }else
                    {
                        $('#catempty').html(`<span style='color:red'>Not Valid..</span>`);
                        $("#catempty").fadeOut(1000);
                    }
                },
                insertProduct()
                {
                    var catName=this.catName;
                    var  product=this.product;
                    var unit=this.unit;
                    var sellUnit=this.sellUnit;
                    var tax=this.tax;
                    var cess=this.cess;
                    if(catName!='' && product!='' && unit!='' && sellUnit!='')
                    {
                        $.ajax({
                            url: 'ajax/store_all.php',
                            type: "POST",
                            data: {
                                catName : catName,
                                product : product,
                                unit : unit,
                                sellUnit :sellUnit,
                                tax:tax,
                                cess:cess,
                                insert:"Insert",
                            },
                            success: function(data) 
                            {
                                if(data==1)
                                {
                                    alert("Product Already Added");
                                }else
                                {
                                    alert("Product Added");
                                    location.reload();
                                }
                            }
                        });
                    }else
                    {
                        if(!catName) 
                        {
                            $('#cat12').css('border-color', 'red');
                        }
                        if(!product) 
                        {
                            $('input[name="p1"]').css('border-color', 'red');
                        }

                        if(!unit) 
                        {
                            $('#unit').css('border-color', 'red');
                        }

                        if(!sellUnit)
                        {
                            $('#sellUnit').css('border-color', 'red');
                        }

                        if(tax=='')
                        {
                            $('input[name="tax"]').css('border-color', 'red');
                        }

                        if(cess=='')
                        {
                            $('input[name="tax"]').css('border-color', 'red');
                        }
                    }
                },
                editItem() 
                {
                    console.log('running');
                    // var tar = e.currentTarget;
                    // var chil = tar.parentElement.parentElement.children;
                    // var form = $("#category input");
                    // console.log(form);
                    // form[0].value = (chil[1].innerHTML);
                    // form[1].value = (chil[0].innerHTML);
                    // var cat=chil[2].innerHTML;
                    // $('#editcat').val(cat);
                    // $('#unitchange').val(chil[3].innerHTML);
                }

            }
        });
    }
}

class Purchase
{
    constructor() 
    {
        this.initializeTabs();
    }
    initializeTabs()
    {
        $(function ()
        {
            // $("#example1").DataTable({
            //     columnDefs: [
            //         { "orderable": false, "targets": -1 }
            //     ]
            //     // order: [[0, 'desc']]
            // });
        });

        var app = new Vue({
            el: '#app',
            data: {
                category: [],
                options: [],
                vens: [],
                selectedOption: '',
                categoryOption:'',
                unit: '',
                sellunit: '',
                qty: '',
                price:null,
                stockList: [],
                nextId: 1,
                editMode: false,
                index: null,
                // totamt:null,
                vendorName: '',
                vendorNameError: false,
                pamt:null,
                insideqty:'',
                sellprice:'',
                exp:'',
                tax:'',
                cess:'',
                gamt:null,
                totaltax:null,
                totalcess:null,
                disctax:null,
                // other:null,
                disc:0,
                totalofprice:0,
                // grandTotal:0
            },
            mounted() {
                this.fetchOptions();
                this.retrieveData();
            },
            methods: {
                fetchOptions() 
                {
                    const vm = this;
                    $.ajax({
                        url: 'ajax/store_all.php',
                        method: 'POST',
                        data:{cat:'category'},
                        success(response) {
                            vm.category = response;
                        },
                        error(xhr, status, error) {
                            console.error(error);
                        }
                    });

                    $.ajax({
                        url: 'ajax/store_all.php',
                        method: 'POST',
                        data:{ven:'ven'},
                        success(response) {
                            vm.vens = response;
                        },
                        error(xhr, status, error) {
                            console.error(error);
                        }
                    });

                    $('input, select').on('focus', function() {
                        $(this).css('border-color', '');
                    });

                    $('#price, #disc, #qty').on('input',function(e)
                    {
                        var price=parseFloat($('#price').val());
                        var disc=$('#disc').val();
                        var qty=parseFloat($('#qty').val());

                        var amt=price*qty;
                        var total=amt-disc;
                        if(disc >amt)
                        {
                            vm.disc=amt;
                            vm.totalofprice=0;
                        }else if(disc <= amt)
                        {
                            vm.totalofprice=total;
                        }else
                        {
                            $('#disc').val(0)
                            vm.totalofprice=total;
                        }
                    });
                },
                categoryChange()
                {
                    const vm1 = this;
                    vm1.unit='';
                    vm1.sellunit='';
                    var categoryOption=this.categoryOption;
                    let log=$.ajax({
                        url: 'ajax/store_all.php',
                        method: 'POST',
                        data:{opt:'opt',categoryOption:categoryOption},
                        success(response) {
                            vm1.options = response;
                        },
                        error(xhr, status, error) {
                            console.error(error);
                        }
                    });
                },
                productChange()
                {
                    const vm2 = this;
                    vm2.unit='';
                    vm2.sellunit='';
                    vm2.tax='';
                    vm2.cess='';
                    const selectedItem = this.options.find(option => option.pid === this.selectedOption);
                    const category=this.categoryOption;
                    $.ajax({
                        url: 'ajax/store_all.php',
                        method: 'POST',
                        data:{selectedpname:selectedItem.pname,categoryName:category},
                        success(response) 
                        {
                            vm2.unit = response[0].unit;
                            vm2.sellunit = response[0].sellunit;
                            vm2.tax = response[0].tax;
                            vm2.cess = response[0].cess;
                        },
                        error(xhr, status, error) {
                            console.error(error);
                        }
                    });
                },
                addItem()
                {
                    const vm2 = this;
                    const selectedItem = this.options.find(option => option.pid === this.selectedOption);
                    const category=this.categoryOption;
                    if(selectedItem && category) 
                    {
                        if(this.unit && this.exp && this.qty && this.qty > 0 && this.insideqty > 0 && this.price > 0)
                        {
                            var checkname=selectedItem.pname;
                            var checkprice=this.price;

                            let baseval=this.price*this.qty;
                            let disc=parseFloat(vm2.disc);
                            let totalofprice=this.totalofprice;

                            let taxper = (totalofprice*this.tax)/100;
                            let cessamt = (totalofprice*this.cess)/100;
                            let tot=totalofprice+taxper+cessamt;

                            let total1 = parseFloat(tot.toFixed(2));
                            let basevalue = parseFloat(baseval.toFixed(2));
                            let taxAmt = parseFloat(taxper.toFixed(2));
                            let cessAmt = parseFloat(cessamt.toFixed(2));
                            const newItem = {
                                    id: vm2.nextId++,
                                    name: selectedItem.pname,
                                    pid: selectedItem.pid,
                                    cat:vm2.categoryOption,
                                    purunit: vm2.unit,
                                    sellunit: vm2.sellunit,
                                    qty: vm2.qty,
                                    insideqty: vm2.insideqty,
                                    pric:vm2.price,
                                    baseamt:baseval,
                                    disc:disc,
                                    totalofprice:totalofprice,
                                    tax:taxAmt,
                                    cessAmt:cessAmt,
                                    amt:total1,
                                    exp:this.exp,
                                    taxper:vm2.tax,
                                    cessper:vm2.cess
                                };
                                vm2.stockList.push(newItem);
                                vm2.saveData();
                                // vm2.selectedOption = '';
                                // vm2.categoryOption='';
                                vm2.unit = '';
                                vm2.sellunit = '';
                                vm2.qty = '';
                                vm2.insideqty= '';
                                vm2.sellunit = '';
                                vm2.price = '';
                                // vm2.categoryOption='';
                                this.tax='';
                                this.cess='';
                                this.amt='';
                                this.exp='';
                                this.disc=0;
                                this.totalofprice=0;
                        }else
                        {
                            if(!this.unit)
                            {
                                $('#unit').css('border-color', 'red');
                            }
                            if (!this.qty || this.qty <= 0)
                            {
                                $('#qty').css('border-color', 'red');
                            }
                            if (!this.price || this.price <= 0)
                            {
                                $('#price').css('border-color', 'red');
                            }
                            if(!this.insideqty) 
                            {
                                $('#insideqty').css('border-color', 'red'); 
                            } 
                            if(!this.exp)
                            {
                                $('#exp').css('border-color', 'red');
                            }
                        }
                    }
                },
                retrieveData() 
                {
                    const data = localStorage.getItem('stockListData');
                    if (data)
                    {
                        this.stockList = JSON.parse(data);
                        var totamt=this.stockList.reduce((amt, item) => amt + item.amt, 0)
                        $('#totamt').val(totamt);
                        $("#totamt1").val(totamt);
                        this.totaltax=this.stockList.reduce((tax,item) =>tax + item.tax, 0)
                        this.totaltax = parseFloat(this.totaltax.toFixed(2));
                        
                        this.totalcess=this.stockList.reduce((cessAmt,item) =>cessAmt + item.cessAmt, 0);
                        this.totalcess = parseFloat(this.totalcess.toFixed(2));

                        this.disctax = parseFloat(this.stockList.reduce((disc, item) => disc + item.disc, 0));
                        // this.disctax = parseFloat(this.disctax.toFixed(2));
                        this.gamt=this.stockList.reduce((baseamt,item) =>baseamt + item.baseamt, 0);
                        this.gamt = parseFloat(this.gamt.toFixed(2));
                    }
                },
                clearData() 
                {
                    this.stockList = [];
                    this.saveData();
                    this.vendorName='';
                    localStorage.removeItem('stockListData');
                },
                submitData()
                {
                    const vendorName = $('#ven').val();
                    const paymentmode = $('#paymentmode').val();
                    const venItem = this.vens.find(ven => ven.slno === this.vendorName);
                    // const category=this.categoryOption;
                    const purchasedDate = $('input[name="purdate"]').val();
                    const totamt = $('input[name="totamt"]').val(); //net amt
                    const discamt = $('input[name="disc-amt"]').val();
                    const gamount = $('input[name="g-amt"]').val();
                    const taxamount = $('input[name="tax-amt"]').val();
                    const cessamount = $('input[name="cess-amt"]').val();
                    const otheramt = $('input[name="other-amt"]').val();
                    const pamt = $('input[name="pamt"]').val();
                    const remark = $('input[name="remark"]').val();
                    const bill = $('input[name="billno"]').val();
                    if(vendorName && purchasedDate && paymentmode && this.stockList.length > 0 && totamt)
                    {
                        const vm = this;
                        let log= $.ajax({
                            url: 'ajax/store_all.php',
                            method: 'POST',
                            data: {
                            vendorName: venItem.vendor,
                            venId: venItem.slno,
                            purchasedDate: purchasedDate,
                            remark:remark,
                            billNo:bill,
                            paymentmode:paymentmode,
                            totamt:totamt,
                            taxamount:taxamount,
                            discamt:discamt,
                            gamount:gamount,
                            pamt:pamt,
                            cessamount:cessamount,
                            otheramt:otheramt,
                            stockList: vm.stockList
                            },
                            success(response) 
                            {
                                console.log(response);
                                alert("Product Added To Stock");
                                localStorage.removeItem('stockListData');
                                location.reload();
                            },
                            error(xhr, status, error) 
                            {
                                console.error(error);
                            }
                        });
                    }else
                    {
                        if(!vendorName) 
                        {
                            $('#ven').css('border-color', 'red');
                        }
                        if (!totamt) 
                        {
                            $('input[name="totamt"]').css('border-color', 'red');
                        }
                        // if (!pamt) 
                        // {
                        //     $('input[name="pamt"]').css('border-color', 'red');
                        // }
                        if (!purchasedDate) 
                        {
                            $('#purdate').css('border-color', 'red');
                        }
                        if (this.stockList.length === 0) 
                        {
                            $('.form-control[name="unit"]').addClass('error');
                            $('.form-control[name="qty"]').addClass('error');
                        }
                        if (!paymentmode) 
                        {
                            $('select[name="paymentmode"]').css('border-color', 'red');
                        }
                    }
                },
                saveData()
                {
                    localStorage.setItem('stockListData', JSON.stringify(this.stockList));
                    var other=$('#other-amt').val();
                    var total=this.stockList.reduce((amt, item) => amt + item.amt, 0)+other;
                    $("#totamt").val(total);
                    $("#totamt1").val(total);
                    this.totaltax=this.stockList.reduce((tax,item) =>tax + item.tax, 0);
                    this.totaltax = parseFloat(this.totaltax.toFixed(2));

                    this.totalcess=this.stockList.reduce((cessAmt,item) =>cessAmt + item.cessAmt, 0);
                    this.totalcess = parseFloat(this.totalcess.toFixed(2));

                    this.disctax = parseFloat(this.stockList.reduce((disc, item) => disc + item.disc, 0));
                    this.gamt=this.stockList.reduce((baseamt,item) =>baseamt + item.baseamt, 0);
                    this.gamt = parseFloat(this.gamt.toFixed(2));
                },
                deleteItem(index) 
                {
                    this.stockList.splice(index, 1);
                    this.saveData();
                },
                editItem(item, index) 
                {
                    // this.selectedOption = item.id;
                    this.categoryOption = item.cat;
                    this.categoryChange();
                    this.unit = item.purunit;
                    this.sellunit = item.sellunit;
                    this.qty = item.qty;
                    this.insideqty=item.insideqty;
                    this.price=item.pric;
                    this.disc=item.disc;
                    this.totalofprice=item.totalofprice;
                    this.exp=item.exp;
                    this.selectedOption=item.pid;
                    this.index =index;
                    this.tax=item.taxper;
                    this.cess=item.cessper;
                    this.editMode = true;
                },
                updateItem(index)
                {
                    this.editMode = false;
                    this.stockList.splice(index, 1);
                    this.saveData();
                    this.addItem();
                }
            }
        });
    }
}

class Kitchen
{
    constructor() 
    {
        this.initializeTabs();
    }
    initializeTabs()
    {
        var app = new Vue({
            el: '#app',
            data: {
                options: [],
                categorys:[],
                kitchenstock:[],
                kitchenstock1:[],
                kitchenstock_all:[],
                selectedOption: '',
                categoryOption:'',
                productQty: '',
                productUnit: '',
                closingStock: '',
                selectedIndex: null,
                pid:null,
                editMode: false
            },
            mounted() {
                this.fetchOptions();
                this.stockbyDate();
            },
            methods: {
                fetchOptions()
                {
                    var yourDateValue = new Date();
                    var formattedDate = yourDateValue.toISOString().substr(0, 10)
                    $('#fdate').val(formattedDate);
                    $('#tdate').val(formattedDate);

                    $('input').on('focus',function()
                    {
                        $(this).css('border-color','');
                    });
                    const vm = this;
                    let log1= $.ajax({
                        url: 'ajax/store_all.php',
                        method: 'POST',
                        data:{kitcencat:"kitcencat"},
                        success(response) {
                            vm.categorys = response;
                        },
                        error(xhr, status, error) {
                            console.error(error);
                        }
                    });
                    // var fdate="none";
                    // let log= $.ajax({
                    //     url: 'ajax/store_all.php',
                    //     method: 'POST',
                    //     data:{kitchenallStock:"kitchen_allStock",fdate:fdate},
                    //     success(response) 
                    //     {
                    //         console.log(response);
                    //         vm.kitchenstock = response;
                    //     },
                    //     error(xhr, status, error) {
                    //         console.error(error);
                    //     }
                    // });
                    var fdate="none";
                    let log2= $.ajax({
                        url: 'ajax/store_all.php',
                        method: 'POST',
                        data:{kitchenallStock1:"kitchen_allStock",fdate1:fdate},
                        success(response) 
                        {
                            // console.log(response);
                            vm.kitchenstock1 = response;
                        },
                        error(xhr, status, error) {
                            console.error(error);
                        }
                    });
                    let log5= $.ajax({
                        url: 'ajax/store_all.php',
                        method: 'POST',
                        data:{kitchenstock_all:"kitchenstock_all"},
                        success(response) 
                        {
                            // console.log(response);
                            vm.kitchenstock_all = response;
                        },
                        error(xhr, status, error) {
                            console.error(error);
                        }
                    });
                },
                categoryChange()
                {
                    const vm=this;
                    var category=this.categoryOption;
                    // console.log(category);
                    let log= $.ajax({
                        url: 'ajax/store_all.php',
                        method: 'POST',
                        data:{kit:category},
                        success(response) {
                            vm.options = response;
                        },
                        error(xhr, status, error) {
                            console.error(error);
                        }
                    });
                },
                stockbyDate()
                {
                    const vm=this;
                    var fdate=$('#fdate').val();
                    var tdate=$('#tdate').val();
                    if(fdate=='')
                    {
                        $('#fdate').css('border-color', 'red');
                        return;
                    }
                    if(tdate=='')
                    {
                        $('#tdate').css('border-color','red');
                        return;
                    }
                    let log= $.ajax({
                        url: 'ajax/store_all.php',
                        method: 'POST',
                        data:{kitchenallStock:"kitchen_allStock",fdate:fdate,tdate:tdate},
                        success(response) 
                        {
                            vm.kitchenstock = response;
                        },
                        error(xhr, status, error) {
                            console.error(error);
                        }
                    });
                },
                handleIssued(index) 
                {
                    this.selectedIndex = index;
                    this.closingStock = parseFloat(this.kitchenstock[index].cloasing);
                    this.pid = parseFloat(this.kitchenstock[index].pid);
                    $('#issuedModal').modal('show');
                },
                handleReturn(index) 
                {
                    this.selectedIndex = index;
                    this.closingStock = parseFloat(this.kitchenstock[index].cloasing);
                    this.pid = parseFloat(this.kitchenstock[index].pid);
                    $('#returnModal').modal('show');
                },
                handleIssuedConfirm()
                {
                    var close=this.closingStock;
                    var issued=$('#issued').val();
                    var pid=$('#pid').val();
                    if(isNaN(issued)) 
                    {
                        return;
                    }
                    let log=$.ajax({
                        url: 'ajax/store_all.php',
                        method: 'POST',
                        data: {
                            use_pid: pid,
                            use_issued: issued,
                        },
                        success: function(response) 
                        {
                            console.log(log);
                        },
                        error: function(xhr, status, error) 
                        {
                            console.error(error);
                        }
                    });
                    $('#issuedModal').modal('hide');
                    this.closingStock='',
                    this.selectedIndex=null,
                    this.pid=null,
                    $('#issued').val('')
                    this.stockbyDate()
                },
                handleReturnConfirm()
                {
                    var close=this.closingStock;
                    var issued=$('#return').val();
                    var pid=$('#pid').val();
                    if(isNaN(issued)) 
                    {
                        return;
                    }
                    let log=$.ajax({
                        url: 'ajax/store_all.php',
                        method: 'POST',
                        data: {
                            return_pid: pid,
                            return_retur: issued,
                        },
                        success: function(response) 
                        {
                            console.log(log);
                        },
                        error: function(xhr, status, error) 
                        {
                            console.error(error);
                        }
                    });
                    $('#returnModal').modal('hide');
                    this.closingStock='',
                    this.selectedIndex=null,
                    this.pid=null,
                    $('#return').val('')
                    this.stockbyDate()
                }
        
            }
        });
    }
}

class Assets_Product
{
    constructor() 
    {
        this.initializeTabs();
    }
    initializeTabs()
    {

        let pro=$.ajax({
            url:'ajax/store_all.php',
            type:'POST',
            data:{assetsdata:'get'},
            dataType:'JSON',
            success:function(response)
            {
                console.log(response);
            }
        });
        // console.log(pro);
        
        $('#sub').on('click',function()
        {
            var product = $('#product').val();
            if(product=='')
            {
                $('#product').css('border-color','red');
                return;
            }
            let log=$.ajax({
                url:'ajax/store_all.php',
                type:'POST',
                data:{assetsProduct:product},
                success:function(response)
                {
                    console.log(response);
                    alert(response);
                    location.reload();
                }
            });
            console.log(log);
        });
        $('input').on('focus', function() {
            $(this).css('border-color', '');
        });
    }
}

class Asset_purchase
{
    constructor() 
    {
        this.initializeTabs();
    }
    initializeTabs()
    {
        var app = new Vue({
            el: '#app',
            data: {
                products: [],
                nextId: 1,
                stockList:[],
                totamt:null,
            },
            mounted() {
                this.fetchOptions();
                this.retrieveData();
            },
            methods: {
                fetchOptions() 
                {
                    $('input , select').on('focus',function()
                    {
                        $(this).css('border-color','');
                    });

                    const vm = this;
                    let pro=$.ajax({
                        url:'ajax/store_all.php',
                        type:'POST',
                        data:{assetsdata:'get'},
                        dataType:'JSON',
                        success:function(response)
                        {
                            vm.products = response;
                        }
                    });

                    $('#price, #qty').on('input',function()
                    {
                        var price=$('#price').val();
                        var total=$('#total').val();
                        var qty=$('#qty').val();
                        var amt=price*qty;
                        $('#total').val(amt);
                    });
                },
                addItem()
                {
                    const vm2=this;
                    var product=$('#pid').val();
                    var qty=$('#qty').val();
                    var amount=$('#price').val();
                    var total=$('#total').val();
                    var inputs=['#pid','#qty','#price'];
                    for(var i=0; i <= inputs.length; i++)
                    {
                        if($(inputs[i]).val()=='')
                        {
                            $(inputs[i]).css('border-color','red');
                            return;
                        }
                    }
                    amount=parseFloat(amount);
                    const assetPurchase = 
                    {
                        id: vm2.nextId++,
                        product: product,
                        qty: qty,
                        price:amount,
                        total:total,
                    };
                    vm2.stockList.push(assetPurchase);
                    vm2.saveData();
                    $('#pid').val('');
                    $('#qty').val('');
                    $('#price').val('');
                    $('#total').val('');
                },
                saveData()
                {
                    localStorage.setItem('assetsData', JSON.stringify(this.stockList));
                    this.totamt = this.stockList.reduce((total, item) => total + parseFloat(item.total), 0);
                },
                retrieveData()
                {
                    const data = localStorage.getItem('assetsData');
                    if (data)
                    {
                        this.stockList = JSON.parse(data);
                        this.totamt = this.stockList.reduce((total, item) => total + parseFloat(item.total), 0);
                    }
                },
                clearData()
                {
                    this.stockList = [];
                    this.saveData();
                    localStorage.removeItem('assetsData');
                },
                submitData()
                {
                    const totamt = $('#totamt').val();
                    const date = $('#date').val();
                    const remark = $('#remark').val();
                    var inputs=['#totamt','#date'];

                    if(this.stockList.length > 0)
                    {
                        for(var i=0; i <= inputs.length; i++)
                        {
                            if(i==0 && totamt==0)
                            {
                                $(inputs[i]).css('border-color','red');
                                return;
                            }
    
                            if($(inputs[i]).val()=='')
                            {
                                $(inputs[i]).css('border-color','red');
                                return;
                            }
                        }

                        const vm = this;
                        let log= $.ajax({
                            url: 'ajax/store_all.php',
                            method: 'POST',
                            data: {
                                assetsSubmitData: totamt,
                                assetsdate: date,
                                assetremark:remark,
                                assets_stockList: vm.stockList
                            },
                            success(response) 
                            {
                                console.log(response);
                                alert(response);
                                vm.clearData();
                            },
                            error(xhr, status, error) 
                            {
                                console.error(error);
                            }
                        });
                        console.log(log);

                    }else
                    {
                        return;
                    }
                },
                deleteItem(index) 
                {
                    this.stockList.splice(index, 1);
                    this.saveData();
                },
            }
        });
    }
}

class Beaverages
{
    constructor() 
    {
        this.initializeTabs();
    }
    initializeTabs()
    {
        var app= new Vue({
            el:'#app',
            data:{
                options:[],
                selectedOption:'',
            },
            methods:{
                fetchOptions()
                {
                    const vm=this;
                    let log=$.ajax({
                        url: 'ajax/store_all.php',
                        method: 'POST',
                        data:{bev:"bev"},
                        success(response) 
                        {
                            vm.options = response;
                        },
                        error(xhr, status, error) {
                            console.error(error);
                        }
                    });
                }
            },
            mounted()
            {
                this.fetchOptions();
            }
        });
    }
}

class Stock
{
    constructor()
    {
        this.stockData()
    }
    stockData()
    {
        var app= new Vue({
            el:'#app',
            data:{
                catName:'',
                categoys:[],
                stockList:[],
            },
            methods:
            {
                fetchCategory()
                {
                    const vm = this;
                    $.ajax({
                        url: 'ajax/store_all.php',
                        method: 'POST',
                        data:{cat:'cat'},
                        success(response) 
                        {
                            vm.categoys = response;
                        },
                        error(xhr, status, error) {
                            console.error(error);
                        }
                    });
                },
                fetchStock()
                {
                    const vm = this;
                    var catName=this.catName;
                    $.ajax({
                        url: 'ajax/store_all.php',
                        method: 'POST',
                        data:{stock:'stock',catName1:catName},
                        success(response) 
                        {
                            // console.log(response)
                            vm.stockList = response;
                        },
                        error(xhr, status, error)
                        {
                            console.error(error);
                        }
                    });
                },
                isLessThan10Days(expDate) {
                    const today = new Date();
                    const expiration = new Date(expDate);
                    const timeDifference = expiration.getTime() - today.getTime();
                    const daysDifference = timeDifference / (1000 * 3600 * 24);
                    return daysDifference < 10;
                },
                calculateTotalQty(item) 
                {
                    const qty = parseFloat(item.qty);
                    const totalQty = parseFloat(item.total_qty);
                    const valu=qty + totalQty;
                    return valu.toFixed(2);
                },
            },
            mounted()
            {
                this.fetchCategory()
                this.fetchStock()
            }
        });
    }
}

class Wastage
{
    constructor()
    {
        this.fetchWastage()
    }
    fetchWastage()
    {
        var app= new Vue({
            el:'#app',
            data:{
                catName:'',
                categoys:[],
                stockList:[],
            },
            methods:
            {
                fetchCategory()
                {
                    const vm = this;
                    $.ajax({
                        url: 'ajax/store_all.php',
                        method: 'POST',
                        data:{cat:'cat'},
                        success(response) 
                        {
                            vm.categoys = response;
                        },
                        error(xhr, status, error) {
                            console.error(error);
                        }
                    });
                },
                fetchStock()
                {
                    const vm = this;
                    var catName=this.catName;
                    // alert(catName);
                    let log=$.ajax({
                        url: 'ajax/store_all.php',
                        method: 'POST',
                        data:{wastageStock:'stock',WastagecatName1:catName},
                        success(response) 
                        {
                            vm.stockList = response;
                        },
                        error(xhr, status, error) 
                        {
                            console.error(error);
                        }
                    });
                    console.log(log);
                }
            },
            mounted()
            {
                this.fetchCategory()
                this.fetchStock()
            }
        });
    }
}

class Vendor
{
    constructor()
    {
        this.fetchVendors()
    }
    fetchVendors()
    {
        var app=new Vue({
            el:'#app',
            data:{
                stockList: [],
                editMode: false,
                vendor: '',
                gst: '',
                id:'',
                mobile: '',
                fssi: '',
                adds: '',
                gstNameError:false,
                mobileNameerror:false
            },
            mounted(){
                this.fetchData();
            },
            methods:{
                fetchData()
                {
                    const vm=this;
                    let log= $.ajax({
                        url: 'ajax/store_all.php',
                        method: 'POST',
                        data:{fetch_vendors:'vendors'},
                        success(response) {
                            vm.stockList=response;
                        },
                        error(xhr, status, error) {
                            console.error(error);
                        }
                    });
                },
                validateMobile()
                {
                    mobile=this.mobile;
                    const regex = /[^\d]/g;
                    if (regex.test(this.mobile)) 
                    {
                        this.mobile = this.mobile.replace(regex, '');
                    }
                },
                validateFssi()
                {
                    fssi=this.fssi;
                    const regex = /[^\d]/g;
                    if (regex.test(this.fssi)) 
                    {
                        this.fssi = this.fssi.replace(regex, '');
                    }
                },
                addItem() 
                {
                    var vendor=this.vendor;
                    var mobile=this.mobile;
                    var gst=this.gst;
                    var fssi=this.fssi;
                    var adds=this.adds;
                    const vm=this;
                    if (vendor && mobile && adds) 
                    {
                        if(gst!='')
                        {
                            const gstinRegex=/^[0-9]{2}[A-Z]{5}[0-9]{4}[A-Z]{1}[0-9A-Z]{1}[Z]{1}[0-9A-Z]{1}$/;
                            // console.log(gst)
                            // const urr = "29GGGGG1314R9Z6";
                            // console.log(urr)
                            if(!gstinRegex.test(gst))
                            {
                                $('input[name="gst"]').css('border-color', 'red');
                                setTimeout(function() 
                                {
                                    $('input[name="gst"]').css('border-color', '');
                                }, 5000);
                                console.log('GST Is Not Valid');
                                return;
                            }
                        }
                        if(fssi!='')
                        {
                            if(fssi.length != 14)
                            {
                                $('input[name="fssi"]').css('border-color', 'red');
                                setTimeout(function() 
                                {
                                    $('input[name="fssi"]').css('border-color', '');
                                }, 5000);
                                console.log('FSSI Number Not Valid');
                                return;
                            }       
                        }

                        if(mobile.length != 10)
                        {
                            $('input[name="mobile"]').css('border-color', 'red');
                            setTimeout(function() 
                            {
                                $('input[name="mobile"]').css('border-color', '');
                            }, 5000);
                            console.log('Mobile Number Not Valid');
                            return;
                        }
                        // console.log('Mobile Number Valid');
                        this.mobileNameerror=false;
                        let log=$.ajax({
                            url:'ajax/vendor_reg.php',
                            type: 'POST',
                            data:{
                                vendor:vendor,
                                mobile:mobile,
                                gst:gst,
                                fssi:fssi,
                                adds:adds,
                                insert:'insert'
                            },
                            success : function(response)
                            {
                                switch(true)
                                {
                                    case response==3:
                                        alert('Mobile Alredy Exists');
                                        break;
                                    case response==2:
                                        alert('Name Already Exists');
                                        break;
                                    case response==1:
                                        alert('Vendor Already Exists');
                                        break;
                                    case response==0:
                                        alert("Vendor Registered Successfully");
                                        window.location="vendor_registration.php"
                                    default:
                                        break;
                                }
                            },
                            error(xhr, status, error) {
                                console.error(error);
                            }
                        });
                    } else{
                        $('.form-control').removeClass('error');
                        if (!vendor) 
                        {
                            $('input[name="vendor"]').addClass('error');
                        }
                        if (!mobile) 
                        {
                            $('input[name="mobile"]').addClass('error');
                        }
                        if (!adds) 
                        {
                            $('input[name="adds"]').addClass('error');
                        }
                        setTimeout(function() 
                        {
                            $('.form-control').removeClass('error');
                        }, 5000);

                    }
                },
                updateItem() 
                {
                    id=this.id;
                    vendor=this.vendor;
                    mobile=this.mobile;
                    gst=this.gst;
                    fssi=this.fssi;
                    adds=this.adds;
                    if (vendor && mobile && adds) 
                    {
                        if(gst!='')
                        {
                            const gstinRegex=/^[0-9]{2}[A-Z]{5}[0-9]{4}[A-Z]{1}[0-9A-Z]{1}[Z]{1}[0-9A-Z]{1}$/;
                            console.log(gst)
                            const urr = "29GGGGG1314R9Z6";
                            console.log(urr)
                            if(!gstinRegex.test(gst))
                            {
                                $('input[name="gst"]').css('border-color', 'red');
                                setTimeout(function() 
                                {
                                    $('input[name="gst"]').css('border-color', '');
                                }, 5000);
                                console.log('GST Is Not Valid');
                                return;
                            }
                        }
                        if(fssi!='')
                        {
                            if(fssi.length != 14)
                            {
                                $('input[name="fssi"]').css('border-color', 'red');
                                setTimeout(function() 
                                {
                                    $('input[name="fssi"]').css('border-color', '');
                                }, 5000);
                                console.log('FSSI Number Not Valid');
                                return;
                            }       
                        }

                        if(mobile.length != 10)
                        {
                            $('input[name="mobile"]').css('border-color', 'red');
                            setTimeout(function() 
                            {
                                $('input[name="mobile"]').css('border-color', '');
                            }, 5000);
                            console.log('Mobile Number Not Valid');
                            return;
                        }
                        let log=$.ajax({
                            url:'ajax/vendor_reg.php',
                            type: 'POST',
                            data:{
                                vendor:vendor,
                                mobile:mobile,
                                gst:gst,
                                id:id,
                                fssi:fssi,
                                adds:adds,
                                insert:'update'
                            },
                            success : function(response)
                            {
                                switch(true)
                                {
                                    case response==3:
                                        alert('Mobile Alredy Exists');
                                        break;
                                    case response==2:
                                        alert('Name Already Exists');
                                        break;
                                    case response==1:
                                        alert('Vendor Already Exists');
                                        break;
                                    case response==0:
                                        alert("Vendor Updated Successfully");
                                        window.location="vendor_registration.php"
                                    default:
                                        break;
                                }
                            },
                            error(xhr, status, error) {
                                console.error(error);
                            }
                        });
                        // console.log(log)

                    }else 
                    {
                        $('.form-control').removeClass('error');
                        if (!vendor) 
                        {
                            $('input[name="vendor"]').addClass('error');
                        }
                        if (!mobile) 
                        {
                            $('input[name="mobile"]').addClass('error');
                        }
                        if (!adds) 
                        {
                            $('input[name="adds"]').addClass('error');
                        }
                        setTimeout(function() 
                        {
                            $('.form-control').removeClass('error');
                        }, 5000);
                    }
                },
                EditItem(item, index)
                {
                    this.editMode=true;
                    this.id= item.id;
                    this.vendor = item.name;
                    this.gst = item.gst;
                    this.mobile = item.mobile;
                    this.fssi = item.fssi;
                    this.adds = item.adds;
                },
                validateVendorName() 
                {
                    const regex = /[^\p{L}\s]/u;
                    if (regex.test(this.vendor)) 
                    {
                        this.vendor = this.vendor.replace(regex, '');
                    }
                },
            }
        });
    }
}

class Stock_table
{
    constructor()
    {
        this.stockData()
    }
    stockData()
    {
        var app= new Vue({
            el:'#app',
            data:{
                catName:'',
                categoys:[],
                stockList:[],
                closingStock: '',
                selectedIndex: null,
                pid:null,
            },
            methods:
            {
                fetchCategory()
                {
                    var currentDate = new Date();
                    var formattedDate = currentDate.toISOString().split('T')[0];
                    $("#fdate").val(formattedDate);
                    $("#tdate").val(formattedDate);
                    const vm = this;
                    $.ajax({
                        url: 'ajax/store_all.php',
                        method: 'POST',
                        data:{cat:'cat'},
                        success(response) 
                        {
                            vm.categoys = response;
                        },
                        error(xhr, status, error) {
                            console.error(error);
                        }
                    });
                },
                fetchStock()
                {
                    const vm = this;
                    var catName=this.catName;
                    var fdate=$("#fdate").val();
                    var tdate=$("#tdate").val();
                    let log=$.ajax({
                        url: 'ajax/store_all.php',
                        method: 'POST',
                        data:{stockOpening:'stock',catName1:catName,fdate:fdate,tdate:tdate},
                        success(response) 
                        {
                            // console.log(response);
                            vm.stockList = response;
                        },
                        error(xhr, status, error)
                        {
                            console.error(error);
                        }
                    });
                    // console.log(log);
                },
                search()
                {
                    this.fetchStock();
                },
                handlewastage(index)
                {
                    this.selectedIndex = index;
                    this.closingStock = parseFloat(this.stockList[index].cloasing);
                    this.pid = parseFloat(this.stockList[index].pid);
                    $('#wastageModal').modal('show');
                },
                handlewastageConfirm()
                {
                    var close=this.closingStock;
                    var wastage=$('#wastage').val();
                    var pid=$('#pid').val();
                    var resone='Not Added';
                    if(isNaN(wastage)) 
                    {
                        return;
                    }
                    let log=$.ajax({
                        url: 'ajax/store_all.php',
                        method: 'POST',
                        data: {
                            wastage_pid: pid,
                            wastage_qty: wastage,
                            wastage_reson: resone,
                        },
                        success: function(response) 
                        {
                            console.log(log);
                        },
                        error: function(xhr, status, error) 
                        {
                            console.error(error);
                        }
                    });
                    $('#wastageModal').modal('hide');
                    this.closingStock='',
                    this.selectedIndex=null,
                    this.pid=null,
                    $('#wastage').val('')
                    this.fetchStock();
                }
            },
            mounted()
            {
                this.fetchCategory();
                this.fetchStock();
            }
        });
    }
    searchdata()
    {
        // alert('running');
    }
}
