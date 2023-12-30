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
                categoys1:[],
                categoysType:[],
                catTypeName:'',
                catName:'',
                product:'',
                unit:'',
                sellUnit:'',
                tax:0,
                cess:0,
                catName1:'',
                prc:'',
                prc1:'',
                itmnam:'',
                catType:''
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
                        data:{catTypeName:'cat'},
                        success(response) 
                        {
                            vm.categoysType = response.slice().sort((a, b) => a.catType.localeCompare(b.catType));
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

                    var enterKeyPressTimestamp = 0;
                    $("#cess").on("keydown", function (e) {
                        if (e.key === "Enter" || e.keyCode === 13) {
                            e.preventDefault();
                            var currentTime = Date.now();
                            var timeElapsed = currentTime - enterKeyPressTimestamp;
                            if (timeElapsed < 500) {
                                vm.insertProduct();
                            }
                            enterKeyPressTimestamp = currentTime;
                        }
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
                    const vm=this;
                    var catName=this.catName;
                    var  product=this.product;
                    var unit=this.unit;
                    var sellUnit=this.sellUnit;
                    var tax=this.tax;
                    var cess=this.cess;
                    var catType=this.catTypeName;
                    // console.log(catType);
                    // console.log(this.prc);
                    // return;
                    if(catName!='' && product!='' && unit!='' && sellUnit!='' && catType!='')
                    {
                        let log=$.ajax({
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
                                catTypeinsert:catType,
                                prc:vm.prc,
                                prc1:vm.prc1,
                                itemcode:vm.itmnam,
                            },
                            success: function(data) 
                            {
                                console.log(data);
                                if(data==1)
                                {
                                    alert("Product Already Added");
                                }else
                                {
                                    alert("Product Added");
                                    // location.reload();
                                }
                            }
                        });
                        // console.log(log);
                    }else
                    {
                        if(!catName) 
                        {
                            $('#cat12').css('border-color', 'red');
                        }
                        if(!catType) 
                        {
                            $('#catType').css('border-color', 'red');
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
                editItem(pid) 
                {
                    $('#category').modal('show');
                    
                    var tar = pid.currentTarget;
                    var chil = tar.parentElement.parentElement.children;
                    var form = $("#category input");
                    var catType=chil[1].innerHTML;
                    this.categoryFetchByEdit(catType)
                    form[0].value = (chil[2].innerHTML);
                    form[1].value = (chil[0].innerHTML);
                    form[2].value = (chil[6].innerHTML);
                    form[3].value = (chil[7].innerHTML);
                    form[4].value = (chil[1].innerHTML);

                    this.catName1=chil[3].innerHTML;
                },
                categoryFetchByEdit(catType)
                {
                    const vm=this;
                    $.ajax({
                        url: 'ajax/store_all.php',
                        method: 'POST',
                        data:{cateByEdit:catType},
                        success(response) 
                        {
                            vm.categoys1 = response.slice().sort((a, b) => a.CategoryName.localeCompare(b.CategoryName));
                        },
                        error(xhr, status, error) 
                        {
                            console.error(error);
                        }
                    });
                },
                CategoryChange()
                {
                    var catName=this.catName;
                    // console.log(catName);
                },
                catTypeChange()
                {
                    const vm=this;
                    var catType=this.catTypeName;
                    let log=$.ajax({
                        url: 'ajax/store_all.php',
                        method: 'POST',
                        data:{cat:'cat',catTypeitem:catType},
                        success(response) 
                        {
                            vm.categoys = response.slice().sort((a, b) => a.CategoryName.localeCompare(b.CategoryName));
                        },
                        error(xhr, status, error) 
                        {
                            console.error(error);
                        }
                    });
                    if(catType=='Bevarages')
                    {
                        $('#bevcat').show();
                    }else
                    {
                        $('#bevcat').hide();
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
                editnextId:1,
                editMode: false,
                index: null,
                // totamt:null,
                vendorName: '',
                vendorNameError: false,
                pamt:0,
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
                // grandTotal:0;'
                billEdit:false,
                editbillno:null,
                stockListdelete:[],
                editid:''
            },
            mounted() {
                this.fetchOptions();
                this.retrieveData();
            },
            methods: {
                fetchOptions() 
                {
                    const vm = this;
                    var yourDateValue = new Date();
                    var formattedDate = yourDateValue.toISOString().substr(0, 10)
                    $('#purdate').val(formattedDate);

                    yourDateValue.setMonth(yourDateValue.getMonth() + 2);
                    var formattedDate1 = yourDateValue.toISOString().substr(0, 10);
                    vm.exp=formattedDate1;

                    $.ajax({
                        url: 'ajax/store_all.php',
                        method: 'POST',
                        data:{cat:'category'},
                        success(response) {
                            // vm.category = response;
                            vm.category = response.slice().sort((a, b) => a.CategoryName.localeCompare(b.CategoryName));
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
                            vm.vens = response.slice().sort((a, b) => a.vendor.localeCompare(b.vendor));
                            // vm.vens = response;
                        },
                        error(xhr, status, error)
                        {
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
                            vm.disc=amt.toFixed(2);
                            vm.totalofprice=0;
                        }else if(disc <= amt)
                        {
                            vm.totalofprice=total.toFixed(2);
                        }else
                        {
                            $('#disc').val(0)
                            vm.totalofprice=total.toFixed(2);
                        }
                    });

                    let log= $('#pamt,#totamt').on('input', function()
                    {
                        var pamt = parseFloat($('#pamt').val());
                        var totamt = parseFloat($('#totamt').val());
                        if (!isNaN(pamt) && !isNaN(totamt) && pamt > totamt) 
                        {
                            vm.pamt=totamt.toFixed(2);
                        }
                    });

                    const urlParams = new URLSearchParams(window.location.search);
                    const statuscancel = urlParams.get('pur_bill');
                    if(statuscancel !== null && statuscancel !== undefined) 
                    {
                        vm.billEdit=true;
                        vm.editbillno=statuscancel;
                        // $('#purdate').prop('readonly', true);
                        let log=$.ajax({
                            url: 'ajax/store_all.php',
                            method: 'POST',
                            data:{editid:statuscancel},
                            dataType:'JSON',
                            success(response) 
                            {
                                // console.log(response);
                                vm.vendorName = response[0].slno;
                                $('#purdate').val(response[0].purchase_date);
                                $('#bill').val(response[0].bill);
                                vm.editid=response[0].bill;
                                // vm.gamt=parseFloat(response[0].gamt);
                                // vm.disctax=parseFloat(response[0].disc);
                                // vm.totaltax=parseFloat(response[0].tax);
                                // vm.totalcess=parseFloat(response[0].cessamount);
                                vm.pamt=parseFloat(response[0].pamt);

                                // var totamt=parseFloat(response[0].totalamt);
                                $('#other-amt').val(parseFloat(response[0].otheramt))
                                // $('#totamt').val(parseFloat(totamt))
                                // $('#totamt1').val(parseFloat(totamt))
                                $('#paymentmode').val(response[0].paymentMode)
                                $('#remark').val(response[0].remark)
                            },
                            error(xhr, status, error) 
                            {
                                console.error(error);
                            }
                        });
                        // console.log(log);

                        $.ajax({
                            url: 'ajax/store_all.php',
                            method: 'POST',
                            data:{editfetchstock:statuscancel},
                            dataType:'JSON',
                            success(response) 
                            {
                                console.log(response);
                                vm.stockList=[];
                                response.forEach(item => {
                                    const newItem = {
                                        id: vm.nextId++,
                                        name:item.pname,
                                        pid: item.pid,
                                        cat:item.category,
                                        purunit:item.unit,
                                        sellunit:item.sellunit,
                                        qty:item.qty,
                                        insideqty:item.perCaseQty,
                                        pric:item.price,
                                        baseamt: parseFloat(item.bamt).toFixed(2),
                                        disc:item.disc,
                                        totalofprice:item.total,
                                        tax:item.tax,
                                        cessAmt:item.cess,
                                        amt:item.total,
                                        exp:item.exp,
                                        taxper:item.taxper,
                                        cessper:item.cessper,
                                        stockid:item.id
                                    };
                                    vm.stockList.push(newItem);
                                });
                                vm.saveData();
                            },
                            error(xhr, status, error) 
                            {
                                console.error(error);
                            }
                        });
                    }

                    var enterKeyPressTimestamp = 0;
                    $("#disc").on("keydown", function (e) {
                        if (e.key === "Enter" || e.keyCode === 13) {
                            e.preventDefault();
                            var currentTime = Date.now();
                            var timeElapsed = currentTime - enterKeyPressTimestamp;
                            if (timeElapsed < 500) {
                                vm.addItem();
                            }
                            enterKeyPressTimestamp = currentTime;
                        }
                    });

                    $(document).on("keydown", function (e) 
                    {
                        if (e.altKey && (e.key === "z" || e.keyCode === 90)) {
                            e.preventDefault();
                            window.location='store_purchase_product.php';
                        }else if (e.altKey && (e.key === "c" || e.keyCode === 67)) 
                        {
                            e.preventDefault();
                            vm.clearData();
                        }else if(e.altKey && (e.key === 's' || e.keyCode === 83)) 
                        {
                            e.preventDefault();
                            var bill=this.billEdit;
                            if(bill=true)
                            {
                                vm.finalUpdateData();
                            }else
                            {
                                vm.submitData();
                            }
                        }
                    });

                    $('#bill').on('input',function()
                    {
                        var vendor =$('#ven').val();
                        var venName = $('#ven :selected').text();
                        if(vendor=='')
                        {
                            alert('Please Select Vendor Name First');
                            $('#bill').val('');
                            return;
                        }
                    });

                    $('#ven').on('change',function()
                    {
                        var bill= $('#bill').val();
                        var vendor =$('#ven').val();
                        var venName = $('#ven :selected').text();
                        $('#bill').val('');
                        if(vendor=='')
                        {
                            alert('Please Select Vendor Name First');
                            return;
                        }
                    });
                    $('#bill').on('change',function()
                    {
                        var edit=vm.billEdit;
                        var editid=vm.editid;
                        var bill= $('#bill').val();
                        var vendor =$('#ven').val();
                        var venName = $('#ven :selected').text();
                        if(vendor=='')
                        {
                            alert('Please Select Vendor Name First');
                            $('#bill').val('');
                            return;
                        }
                        if(bill=='')
                        {
                            alert('Please Add Bill No');
                            return;
                        }
                        let log=$.ajax({
                                url: 'ajax/store_all.php',
                                method: 'POST',
                                data:{checkStoreBill:'checkStoreBill',
                                        stobill_bill:bill,
                                        store_vendor:vendor,
                                        store_venName:venName,
                                        store_editid:editid
                                    },
                                // dataType:'JSON',
                                success(response) 
                                {
                                    console.log(response);
                                    if(response==0)
                                    {
                                        alert('Bill No is Existed')
                                        $('#bill').val('');
                                        return;
                                    }
                                }
                            });
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
                            // vm.options = response.slice().sort((a, b) => a.pname.localeCompare(b.pname));

                            // vm1.insideqty='';
                            // $('#insideqty').prop('readonly', false);
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

                            if(vm2.unit==vm2.sellunit)
                            {
                                vm2.insideqty=1;
                                $('#insideqty').prop('readonly', true);
                            }else
                            {
                                $('#insideqty').prop('readonly', false);
                            }
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
                            var checkprice=parseFloat(this.price);

                            let baseval=this.price*parseFloat(this.qty);
                            let disc=parseFloat(vm2.disc);
                            let totalofprice=parseFloat(this.totalofprice);

                            let taxper = (totalofprice*parseFloat(this.tax))/100;
                            let cessamt = (totalofprice*parseFloat(this.cess))/100;
                            let tot=totalofprice+taxper+cessamt;
                            let total1 = tot.toFixed(2);
                            let basevalue =baseval.toFixed(2);
                            let taxAmt =taxper.toFixed(2);
                            let cessAmt =cessamt.toFixed(2);
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
                                    cessper:vm2.cess,
                                   
                                };
                                vm2.stockList.push(newItem);
                                vm2.saveData();
                                // vm2.selectedOption = '';
                                // vm2.categoryOption='';
                                // vm2.unit = '';
                                // vm2.sellunit = '';
                                vm2.qty = '';
                                vm2.insideqty= '';
                                vm2.sellunit = '';
                                vm2.price = '';
                                // vm2.categoryOption='';
                                this.tax='';
                                this.cess='';
                                this.amt='';
                                // this.exp='';
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
                        var other=parseFloat($('#other-amt').val());
                        if (isNaN(other))
                        {
                            other=0;
                        }
                        var totamt=this.stockList.reduce((amt, item) => amt + parseFloat(item.amt), 0)+other;
                        $('#totamt').val(totamt.toFixed(2));
                        $("#totamt1").val(totamt.toFixed(2));
                        var taxtamt = this.stockList.reduce((tax, item) => tax + parseFloat(item.tax), 0);
                        this.totaltax=taxtamt.toFixed(2);
                        
                        var totalcess=this.stockList.reduce((cessAmt,item) =>cessAmt + parseFloat(item.cessAmt), 0);
                        this.totalcess = totalcess.toFixed(2);

                        this.disctax = this.stockList.reduce((disc, item) => disc + parseFloat(item.disc), 0);
                        this.disctax = this.disctax.toFixed(2);
                        this.gamt=this.stockList.reduce((baseamt,item) =>baseamt + parseFloat(item.baseamt), 0);
                        this.gamt =this.gamt.toFixed(2);
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
                            vendorNameId: venItem.slno,
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
                finalUpdateData()
                {
                    const vm1 = this;
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
                    var editbill=this.editbillno;
                   
                    var lenstock=this.stockListdelete.length;
                    if(lenstock==0)
                    {
                        const newItem={
                                id: vm1.editnextId++,
                                deletepid:0,
                                stockId:0,
                            }
                        vm1.stockListdelete.push(newItem);
                    }
                    if(vendorName && purchasedDate && paymentmode && this.stockList.length > 0 && totamt)
                    {
                        const vm = this;
                        let log= $.ajax({
                            url: 'ajax/store_all.php',
                            method: 'POST',
                            data: {
                            edit_vendorName: venItem.vendor,
                            edit_venId: venItem.slno,
                            edit_purchasedDate: purchasedDate,
                            edit_remark:remark,
                            edit_billNo:bill,
                            edit_paymentmode:paymentmode,
                            edit_totamt:totamt,
                            edit_taxamount:taxamount,
                            edit_discamt:discamt,
                            edit_gamount:gamount,
                            edit_pamt:pamt,
                            edit_cessamount:cessamount,
                            edit_otheramt:otheramt,
                            edit_stockList: vm.stockList,
                            edit_deletestock:vm.stockListdelete,
                            editbill:editbill
                            },
                            success(response) 
                            {
                                console.log(response);
                                alert("Product Added To Stock");
                                localStorage.removeItem('stockListData');
                                localStorage.removeItem('stockListData');
                                window.location="purchaseRecords.php";
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
                    var other=parseFloat($('#other-amt').val());
                    if (isNaN(other))
                    {
                        other=0;
                    }
                    var totamt=this.stockList.reduce((amt, item) => amt + parseFloat(item.amt), 0)+other;
                    $('#totamt').val(totamt.toFixed(2));
                    $("#totamt1").val(totamt.toFixed(2));
                    var taxtamt = this.stockList.reduce((tax, item) => tax + parseFloat(item.tax), 0);
                    this.totaltax=taxtamt.toFixed(2);
                    
                    var totalcess=this.stockList.reduce((cessAmt,item) =>cessAmt + parseFloat(item.cessAmt), 0);
                    this.totalcess = totalcess.toFixed(2);

                    this.disctax = this.stockList.reduce((disc, item) => disc + parseFloat(item.disc), 0);
                    this.disctax = this.disctax.toFixed(2);
                    
                    this.gamt=this.stockList.reduce((baseamt,item) =>baseamt + parseFloat(item.baseamt), 0);
                    this.gamt =this.gamt.toFixed(2);
                },
                deleteItem(index) 
                {
                    const vm=this;
                    var bill=this.billEdit;
                    if(bill=true)
                    {
                        var pid=this.stockList[index].pid;
                        var stockId=this.stockList[index].stockid;
                        const newItem={
                            id: vm.editnextId++,
                            deletepid:pid,
                            stockId:stockId
                        }
                        vm.stockListdelete.push(newItem);
                    }
                    console.log(vm.stockListdelete[0].deletepid)
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
                    // this.insideqty=item.insideqty;

                    if(this.unit==this.sellunit)
                    {
                        this.insideqty=1;
                        $('#insideqty').prop('readonly', true);
                    }else
                    {
                        $('#insideqty').prop('readonly', false);
                    }

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
                kitchenpurchase:[],
                selectedOption: '',
                categoryOption:'',
                productQty: '',
                productUnit: '',
                closingStock: '',
                selectedIndex: null,
                pid:null,
                editMode: false,
                editbillno:null
            },
            mounted() {
                this.fetchOptions();
                this.stockbyDate();
                this.kitchenHistory();
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
                    const urlParams = new URLSearchParams(window.location.search);
                    const statuscancel = urlParams.get('stock');
                    if(statuscancel !== null && statuscancel !== undefined) 
                    {
                        vm.editbillno=statuscancel;
                        $.ajax({
                            url: 'ajax/store_all.php',
                            method: 'POST',
                            data:{kitchenstockEdit:statuscancel},
                            dataType:'JSON',
                            success(response) 
                            {
                                // vm.vendorName = response[0].slno;
                                // $('#purdate').val(response[0].purchase_date);
                                // $('#bill').val(response[0].id);
                            }
                        });
                    }
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
                        success(response) 
                        {
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
                    if (new Date(tdate) < new Date(fdate)) {
                        alert("Please Select Valid Date");
                        return; // Stop further execution if the condition is not met
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
                kitchenHistory()
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
                    if (new Date(tdate) < new Date(fdate)) {
                        alert("Please Select Valid Date");
                        return; // Stop further execution if the condition is not met
                    }
                    let log= $.ajax({
                        url: 'ajax/store_all.php',
                        method: 'POST',
                        data:{kitchenHistory:"kitchenHistory",fdate:fdate,tdate:tdate},
                        success(response) 
                        {
                            vm.kitchenpurchase= response;
                        },
                        error(xhr, status, error) 
                        {
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
                    if(issued==0)
                    {
                        return;
                    }
                    let log=$.ajax({
                        url: 'ajax/store_all.php',
                        method: 'POST',
                        data: {
                            issuType:'kit',
                            use_pid: pid,
                            use_issued: issued,
                        },
                        success: function(response) 
                        {
                            console.log(response);
                        },
                        error: function(xhr, status, error) 
                        {
                            console.error(error);
                        }
                    });
                    this.stockbyDate();
                    $('#issuedModal').modal('hide');
                    this.closingStock='';
                    this.selectedIndex=null;
                    this.pid=null;
                    $('#issued').val('');
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
                            console.log(response);
                        },
                        error: function(xhr, status, error) 
                        {
                            console.error(error);
                        }
                    });
                    this.stockbyDate()
                    
                    $('#returnModal').modal('hide');
                    
                    this.closingStock='';
                    
                    this.selectedIndex=null;
                    
                    this.pid=null;
                    
                    $('#return').val('');
                    
                },
                handleEdit(index)
                {
                    var stock_id=this.kitchenpurchase[index].stock_id;
                    window.location="store_kitchen_given.php?stock="+stock_id;
                },
                formatNumber(number) {
                    // Assuming you want toFixed with 2 decimal places
                    return parseFloat(number).toFixed(2);
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
        // let pro=$.ajax({
        //     url:'ajax/store_all.php',
        //     type:'POST',
        //     data:{assetsdata:'get'},
        //     dataType:'JSON',
        //     success:function(response)
        //     {
        //         // console.log(response);
        //     }
        // });

        $('#sub').on('click',function()
        {
            var product = $('#product').val();
            var check='insert';
            if(product=='')
            {
                $('#product').css('border-color','red');
                return;
            }
            let log=$.ajax({
                url:'ajax/store_all.php',
                type:'POST',
                data:{assetsProduct:product,check:check},
                success:function(response)
                {
                    alert(response);
                    // location.reload();
                    var product = $('#product').val('');
                }
            });
            // console.log(log);
        });

        $('input').on('focus', function() 
        {
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
                productName:''
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

                    var yourDateValue = new Date();
                    var formattedDate = yourDateValue.toISOString().substr(0, 10)
                    $('#date').val(formattedDate);
                },
                addItem()
                {
                    const vm2=this;
                    const productItem = this.products.find(cate => cate.id === this.productName);
                    var product=$('#pid').val();
                    var qty=$('#qty').val();
                    var amount=parseFloat($('#price').val());
                    var total=parseFloat($('#total').val());
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
                    if(qty !=0 && amount !=0)
                    {
                        const assetPurchase = 
                        {
                            id: vm2.nextId++,
                            product: productItem.product,
                            productid: productItem.id,
                            qty: qty,
                            price:amount.toFixed(2),
                            total:total.toFixed(2),
                        };
                        vm2.stockList.push(assetPurchase);
                        vm2.saveData();
                        $('#pid').val('');
                        $('#qty').val('');
                        $('#price').val('');
                        $('#total').val('');
                    }
                },
                saveData()
                {
                    localStorage.setItem('assetsData', JSON.stringify(this.stockList));
                    this.totamt = this.stockList.reduce((total, item) => total + parseFloat(item.total), 0).toFixed(2);
                },
                retrieveData()
                {
                    const data = localStorage.getItem('assetsData');
                    if (data)
                    {
                        this.stockList = JSON.parse(data);
                        this.totamt = this.stockList.reduce((total, item) => total + parseFloat(item.total), 0).toFixed(2);
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
                categorys:[],
                bevstock:[],
                bevhis:[],
                selectedOption:'',
                categoryOption:'',
                productQty: '',
                productUnit: '',
                closingStock: '',
                selectedIndex: null,
                pid:null,
                editMode: false,
                editbillno:null
            },
            methods:{
                fetchOptions()
                {
                    var yourDateValue = new Date();
                    var formattedDate = yourDateValue.toISOString().substr(0, 10)
                    $('#fdate').val(formattedDate);
                    $('#tdate').val(formattedDate);

                    const vm = this;
                    let log1= $.ajax({
                        url: 'ajax/store_all.php',
                        method: 'POST',
                        data:{bevcat:"bevcat"},
                        success(response) {
                            vm.categorys = response;
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
                    if (new Date(tdate) < new Date(fdate)) {
                        alert("Please Select Valid Date");
                        return; // Stop further execution if the condition is not met
                    }
                    let log= $.ajax({
                        url: 'ajax/store_all.php',
                        method: 'POST',
                        data:{kitchenallStock:"bevStock",fdate:fdate,tdate:tdate},
                        success(response)
                        {
                            vm.bevstock = response;
                        },
                        error(xhr, status, error) {
                            console.error(error);
                        }
                    });
                    console.log(log);
                },
                beveragesHis()
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
                    if (new Date(tdate) < new Date(fdate)) {
                        alert("Please Select Valid Date");
                        return; // Stop further execution if the condition is not met
                    }
                    let log= $.ajax({
                        url: 'ajax/store_all.php',
                        method: 'POST',
                        data:{kitchenHistory:"bevhist",fdate:fdate,tdate:tdate},
                        success(response) 
                        {
                            vm.bevhis= response;
                        },
                        error(xhr, status, error) 
                        {
                            console.error(error);
                        }
                    });
                },
                handleIssued(index) 
                {
                    this.selectedIndex = index;
                    this.closingStock = parseFloat(this.bevstock[index].cloasing);
                    this.pid = parseFloat(this.bevstock[index].pid);
                    $('#issuedModal').modal('show');
                },
                handleReturn(index) 
                {
                    this.selectedIndex = index;
                    this.closingStock = parseFloat(this.bevstock[index].cloasing);
                    this.pid = parseFloat(this.bevstock[index].pid);
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
                    if(issued==0)
                    {
                        return;
                    }
                    let log=$.ajax({
                        url: 'ajax/store_all.php',
                        method: 'POST',
                        data: {
                            issuType:'bev',
                            use_pid: pid,
                            use_issued: issued,
                        },
                        success: function(response) 
                        {
                            console.log(response);
                        },
                        error: function(xhr, status, error) 
                        {
                            console.error(error);
                        }
                    });
                    this.stockbyDate();
                    $('#issuedModal').modal('hide');
                    this.closingStock='';
                    this.selectedIndex=null;
                    this.pid=null;
                    $('#issued').val('');
                    
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
                            console.log(response);
                        },
                        error: function(xhr, status, error) 
                        {
                            console.error(error);
                        }
                    });
                    this.stockbyDate()
                    
                    $('#returnModal').modal('hide');
                    
                    this.closingStock='';
                    
                    this.selectedIndex=null;
                    
                    this.pid=null;
                    
                    $('#return').val('');
                    
                },
                handleEdit(index)
                {
                    var stock_id=this.kitchenpurchase[index].stock_id;
                    window.location="store_kitchen_given.php?stock="+stock_id;
                },
                formatNumber(number) {
                    // Assuming you want toFixed with 2 decimal places
                    return parseFloat(number).toFixed(2);
                },
            },
            mounted()
            {
                this.fetchOptions();
                this.stockbyDate();
                this.beveragesHis();
            }
        });
    }
}

class parcelMaterial
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
                categorys:[],
                material:[],
                materialhis:[],
                selectedOption:'',
                categoryOption:'',
                productQty: '',
                productUnit: '',
                closingStock: '',
                selectedIndex: null,
                pid:null,
                editMode: false,
                editbillno:null
            },
            methods:{
                fetchOptions()
                {
                    var yourDateValue = new Date();
                    var formattedDate = yourDateValue.toISOString().substr(0, 10)
                    $('#fdate').val(formattedDate);
                    $('#tdate').val(formattedDate);

                    const vm = this;
                    let log1= $.ajax({
                        url: 'ajax/store_all.php',
                        method: 'POST',
                        data:{parcelcat:"parcelcat"},
                        success(response) {
                            vm.categorys = response;
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
                    if (new Date(tdate) < new Date(fdate)) {
                        alert("Please Select Valid Date");
                        return; // Stop further execution if the condition is not met
                    }
                    let log= $.ajax({
                        url: 'ajax/store_all.php',
                        method: 'POST',
                        data:{kitchenallStock:"material",fdate:fdate,tdate:tdate},
                        success(response)
                        {
                            vm.material = response;
                        },
                        error(xhr, status, error) {
                            console.error(error);
                        }
                    });
                },
                materialHistoru()
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
                    if (new Date(tdate) < new Date(fdate)) {
                        alert("Please Select Valid Date");
                        return; // Stop further execution if the condition is not met
                    }
                    let log= $.ajax({
                        url: 'ajax/store_all.php',
                        method: 'POST',
                        data:{kitchenHistory:"parcelhis",fdate:fdate,tdate:tdate},
                        success(response) 
                        {
                            vm.materialhis= response;
                        },
                        error(xhr, status, error) 
                        {
                            console.error(error);
                        }
                    });
                },
                handleIssued(index) 
                {
                    this.selectedIndex = index;
                    this.closingStock = parseFloat(this.material[index].cloasing);
                    this.pid = parseFloat(this.material[index].pid);
                    $('#issuedModal').modal('show');
                },
                handleReturn(index) 
                {
                    this.selectedIndex = index;
                    this.closingStock = parseFloat(this.material[index].cloasing);
                    this.pid = parseFloat(this.material[index].pid);
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
                    if(issued==0)
                    {
                        return;
                    }
                    let log=$.ajax({
                        url: 'ajax/store_all.php',
                        method: 'POST',
                        data: {
                            issuType:'parcel',
                            use_pid: pid,
                            use_issued: issued,
                        },
                        success: function(response) 
                        {
                            console.log(response);
                        },
                        error: function(xhr, status, error) 
                        {
                            console.error(error);
                        }
                    });
                    this.stockbyDate();
                    $('#issuedModal').modal('hide');
                    this.closingStock='';
                    this.selectedIndex=null;
                    this.pid=null;
                    $('#issued').val('');
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
                            console.log(response);
                        },
                        error: function(xhr, status, error) 
                        {
                            console.error(error);
                        }
                    });
                    
                    $('#returnModal').modal('hide');
                    
                    this.closingStock='';
                    
                    this.selectedIndex=null;
                    
                    this.pid=null;
                    
                    $('#return').val('');
                    
                    this.stockbyDate()
                },
                handleEdit(index)
                {
                    var stock_id=this.kitchenpurchase[index].stock_id;
                    window.location="store_kitchen_given.php?stock="+stock_id;
                },
                formatNumber(number) {
                    // Assuming you want toFixed with 2 decimal places
                    return parseFloat(number).toFixed(2);
                },
            },
            mounted()
            {
                this.fetchOptions();
                this.stockbyDate();
                this.materialHistoru();
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
                    let log=$.ajax({
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
                    var id=this.id;
                    var vendor=this.vendor;
                    var mobile=this.mobile;
                    var gst=this.gst;
                    var fssi=this.fssi;
                    var adds=this.adds;
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
                        data:{catStoreStock:'cat'},
                        success(response) 
                        {
                            // vm.categoys = response;
                            vm.categoys = response.slice().sort((a, b) => a.CategoryName.localeCompare(b.CategoryName));
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
                    if (new Date(tdate) < new Date(fdate)) {
                        alert("Please Select Valid Date");
                        return; // Stop further execution if the condition is not met
                    }
                    let log=$.ajax({
                        url: 'ajax/store_all.php',
                        method: 'POST',
                        data:{stockOpening:'stock',catName1:catName,fdate:fdate,tdate:tdate},
                        success(response) 
                        {
                            console.log(response);
                            vm.stockList = response.slice().sort((a, b) => a.name.localeCompare(b.name));
                        },
                        error(xhr, status, error)
                        {
                            console.error(error);
                        }
                    });
                    // console.log(log);
                },
                // sortstocklist() 
                // {
                //     console.log(this.stockList);
                //     // Sort the stockList array by item.name alphabetically
                //     return this.stockList.slice().sort((a, b) => a.name.localeCompare(b.name));
                //   },
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
