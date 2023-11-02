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
                tax:'',
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
                    if(catName!='' && product!='' && unit!='' && sellUnit!='' && tax!='')
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
                        }else
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
                    }
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
                totamt:null,
                vendorName: '',
                vendorNameError: false,
                pamt:null,
                insideqty:'',
                sellprice:'',
                exp:'',
                tax:'',
                gamt:null,
                totaltax:null,
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
                        if (this.unit && this.qty && this.qty > 0 && this.insideqty > 0 && this.price > 0)
                        {
                            var checkname=selectedItem.pname;
                            var checkprice=this.price;

                            let tot=this.price*this.qty;
                            let taxper=this.tax/100;
                            let baseval=tot/(1+taxper);
                            let taxAmt1=tot-baseval;

                            let total1 = parseFloat(tot.toFixed(2));
                            let basevalue = parseFloat(baseval.toFixed(2));
                            let taxAmt = parseFloat(taxAmt1.toFixed(2));

                            const newItem = {
                                    id: vm2.nextId++,
                                    cat:vm2.categoryOption,
                                    name: selectedItem.pname,
                                    purunit: vm2.unit,
                                    sellunit: vm2.sellunit,
                                    qty: vm2.qty,
                                    insideqty: vm2.insideqty,
                                    pric:vm2.price,
                                    total:tot,
                                    tax:taxAmt,
                                    amt:basevalue,
                                    exp:this.exp,
                                };
                                // console.log(newItem);
                                vm2.stockList.push(newItem);
                                vm2.saveData();
                                vm2.selectedOption = '';
                                vm2.categoryOption='';
                                vm2.unit = '';
                                vm2.sellunit = '';
                                vm2.qty = '';
                                vm2.insideqty= '';
                                vm2.sellunit = '';
                                vm2.price = '';
                                vm2.categoryOption='';
                                this.tax='';
                                this.amt='';
                                this.exp='';
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
                        }
                    }
                },
                retrieveData() 
                {
                    const data = localStorage.getItem('stockListData');
                    
                    if (data) {
                        this.stockList = JSON.parse(data);
                        this.totamt=this.stockList.reduce((total, item) => total + item.total, 0)
                        this.totaltax=this.stockList.reduce((tax,item) =>tax + item.tax, 0)
                        this.totaltax = parseFloat(this.totaltax.toFixed(2));

                        this.gamt=this.stockList.reduce((amt,item) =>amt + item.amt, 0);
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
                    const venItem = this.vens.find(ven => ven.slno === this.vendorName);
                    const category=this.categoryOption;
                    const purchasedDate = $('input[name="purdate"]').val();
                    const totamt = $('input[name="totamt"]').val();
                    const gamount = $('input[name="g-amt"]').val();
                    const taxamount = $('input[name="tax-amt"]').val();
                    const pamt = $('input[name="pamt"]').val();
                    const remark = $('input[name="remark"]').val();
                    const bill = $('input[name="billno"]').val();
                    if (vendorName && purchasedDate && this.stockList.length > 0 && totamt && pamt) 
                    {
                        const vm = this;
                        let log= $.ajax({
                            url: 'ajax/store_all.php',
                            method: 'POST',
                            data: {
                            vendorName: venItem.vendor,
                            venId: venItem.slno,
                            purchasedDate: purchasedDate,
                            totamt:totamt,
                            pamt:pamt,
                            remark:remark,
                            billNo:bill,
                            gamount:gamount,
                            taxamount:taxamount,
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
                            $('input[name="purdate"]').addClass('error');
                        }
                        if (this.stockList.length === 0) 
                        {
                            $('.form-control[name="unit"]').addClass('error');
                            $('.form-control[name="qty"]').addClass('error');
                        }
                    }
                },
                saveData()
                {
                    localStorage.setItem('stockListData', JSON.stringify(this.stockList));
                    this.totamt=this.stockList.reduce((total, item) => total + item.total, 0);
                    this.totaltax=this.stockList.reduce((tax,item) =>tax + item.tax, 0);
                    this.totaltax = parseFloat(this.totaltax.toFixed(2));

                    this.gamt=this.stockList.reduce((amt,item) =>amt + item.amt, 0);
                    this.gamt = parseFloat(this.gamt.toFixed(2));
                },
                deleteItem(index) {
                    this.stockList.splice(index, 1);
                    this.saveData();
                },
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
                selectedOption: '',
                productQty: '',
                productUnit: '',
                editMode: false
            },
            mounted() {
                this.fetchOptions();
            },
            methods: {
                fetchOptions()
                {
                    const vm = this;
                   let log= $.ajax({
                        url: 'ajax/store_all.php',
                        method: 'POST',
                        data:{kit:"kit"},
                        success(response) {
                            vm.options = response;
                        },
                        error(xhr, status, error) {
                            console.error(error);
                        }
                    });
                },
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
        console.log(pro);
        
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
                },
                addItem()
                {
                    const vm2=this;
                    var product=$('#pid').val();
                    var qty=$('#qty').val();
                    var amount=$('#price').val();
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
                    const assetPurchase = {
                        id: vm2.nextId++,
                        product: product,
                        qty: qty,
                        total:amount,
                    };
                    vm2.stockList.push(assetPurchase);
                    vm2.saveData();
                    $('#pid').val('');
                    $('#qty').val('');
                    $('#price').val('');
                },
                saveData()
                {
                    localStorage.setItem('assetsData', JSON.stringify(this.stockList));
                    this.totamt=this.stockList.reduce((total, item) => total + item.total, 0);
                },
                retrieveData()
                {
                    const data = localStorage.getItem('assetsData');
                    if (data) 
                    {
                        this.stockList = JSON.parse(data);
                        this.totamt=this.stockList.reduce((total, item) => total + item.total, 0)
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
                            console.log(response)
                            vm.stockList = response;
                        },
                        error(xhr, status, error) {
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
                    $.ajax({
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
                    vendor=this.vendor;
                    mobile=this.mobile;
                    gst=this.gst;
                    fssi=this.fssi;
                    adds=this.adds;
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
