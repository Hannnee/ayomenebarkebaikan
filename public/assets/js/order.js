$(document).ready(function() {

    /**
     * GENERATE CODE FOR INVOICE
     * @param {*} length
     * @returns
     */
    const makecode = (length) => {
        let result = '';
        const characters = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789';
        const charactersLength = characters.length;
        let counter = 0;
        while (counter < length) {
          result += characters.charAt(Math.floor(Math.random() * charactersLength));
          counter += 1;
        }
        return result;
    }

    const invoicecode = makecode(16);

    /**
     * check if customer is not selected
    */
    $(".checkbox").attr("disabled", "disabled").off('click');

    /**
    * validate input customer
    * @param {*} input
    * @returns
    */
    function validateInput(input) {
        return input ? input.trim() !== '' : false;
    }

    /**
     * set message and event in all element
    */
    $('body').on('click', '#item-list', function() {
        let cust_id = validateInput($('#select-customer').val());
        if (!cust_id) {
            $('#message').html('<span class="badge badge-dim bg-danger badge-md">Please fill the customer infromation first !</span>')
        }
    })

    /**
     * get data customer if selected
    */
    $('body').on('change', '#select-customer', function() {
        $('#message').html('');
        $("#item-list *").removeAttr("disabled");
        const param = $(this).val();
        $.ajax({
            type: "get",
            url: "customer/get-customer/"+param,
            dataType: "json",
            success: function (value) {
                $('#customer-id').text(`#${value.id}`);
                $('#customer-address').val(value.address);
                $('#order-date').val(new Date().toISOString().substring(0, 10));
            }
        });
    });

    /**
    * function remove index if checkbox is uncheck
    * @param {*} tmp
    * @param {*} id
    * @returns
    */
    const removeIndex = (tmp, id) => {
        const itemIndex = tmp.findIndex(item => item.id === id);
        if (itemIndex > -1) {
            tmp.splice(itemIndex, 1);
        }
        return tmp;
    }

    /**
    * convert string rupiah to integer
    * @param {*} str
    * @returns
    */
    const tointeger = (str) => {
        let tointeger = str.replace(/[Rp.\s]/g, '');
        return tointeger;
    }

    /**
    * convert integer to rupiah
    * @param {*} int
    * @returns
    */
    const tolocale = (int) => {
        let tolocale = 'Rp ' +int.toLocaleString('id-ID');
        return tolocale;
    }

    /**
    * function add index if checkbox is checked
    * @param {*} obj
    * @param {*} id
    * @returns
    */
    const pushkey = (obj, id) => {
        const price = obj.closest('tr').find('.price').text();
        const name = obj.closest('tr').find('.name').text();
        const qty   = obj.closest('tr').find('.qty').val();
        const total = (tointeger(price) * parseInt(qty));
        const item = {
            id : id,
            name : name,
            price : price,
            qty : qty,
            disc : 0,
            subtotal : tolocale(total),
            number : total
        };
        arr.push(item);
        return item;
    }

    /**
     * event if checkbox is checked, add to array
    */
    const arr = [];
    $('body').on('change', '.checkbox', function() {
        $('#submit-message').html('');
        const cid = $(this).attr('id');
        if ($(this).is(':checked')) {
            const el = pushkey($(this), cid);
            pushelement(el);
        } else {
            removeIndex(arr, cid);
            removeelement(cid);
        }
        console.log(arr);
    });

    /**
     * event if qty is changed or clicked will remove id checkbox
    */
    $('body').on('click', '.number-spinner-btn', function() {
        const qid = $(this).closest('tr').find('[id]').attr('id');
        const check = $(this).closest('tr').find('input[type="checkbox"]');
        if (check.is(':checked')) {
            check.prop('checked', false);
            removeIndex(arr, qid);
            removeelement(qid);
        }
    });

    /**
     * render all element
     * @param {*} el
     */
    const pushelement = (el) => {
        $('.parent-items').append(
            `
                <div class="row border rounded p-1 mb-2" id="elment${el.id}">
                    <div class="d-flex flex-sm-row flex-column justify-content-between">
                        <div>
                            <span class="sub-text">`+el.name+`</span>
                            <span>${el.price}</span>
                        </div>
                        <div>
                            <span class="sub-text text-end">Total</span>
                            <span class="text-success el-total${el.id}">${el.subtotal}</span>
                        </div>
                    </div>
                    <div class="col-12">
                        <span class="badge bg-outline-info el-qty">x ${el.qty}</span>
                        <span class="badge bg-outline-warning cursor-pointer letter-space-1 el-discount${el.id}" data-bs-toggle="modal" data-bs-target="#modaldiscount${el.id}">Set discount</span>
                    </div>
                </div>
                <div class="modal fade" tabindex="-1" id="modaldiscount${el.id}">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title">Discount</h5>
                                <p class="text-primary">#${el.id}</p>
                            </div>
                            <div class="modal-body">
                                <div class="form-control-wrap">
                                    <div class="form-group">
                                        <label class="form-label">Item discount</label>
                                        <div class="form-control-wrap">
                                            <select class="form-select js-select2 set-discount${el.id}" data-search="off">
                                                ${generateOptions(0, 100)}
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer bg-light">
                                <a class="btn btn-primary rounded get-discount${el.id}" data-bs-dismiss="modal" aria-label="Close">
                                    Set discount
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            `
        );

        /**
         * if discount is set and generate new data
        */
        $('body').on('click', `.get-discount${el.id}`, function() {
            let discount    = $(`.set-discount${el.id}`).val();
            let result      = setdiscount(el, discount);
            $(`.el-total${el.id}`).text(result.total);
            $(`.el-discount${el.id}`).html(result.discount);
            const key = arr.findIndex(item => item.id === el.id);
            if (key > -1) {
                arr[key].disc = discount;
                arr[key].subtotal = result.total;
            }
        });

        $('.js-select2').select2();
    }

    /**
     *
     * @param {*} start
     * @param {*} end
     * @returns
     */
    const generateOptions = (start, end) => {
        let options = '';
        for (let i = start; i <= end; i++) {
            options += `<option value="${i}">${i}</option>`;
        }
        return options;
    }

    /**
     *
     * @param {*} id
     */
    const removeelement = (id) => {
        $('#elment'+id).remove();
    }

    /**
     *
     * @param {*} el
     * @param {*} val
     * @returns
     */
    const setdiscount = (el, val) => {
        const discount = (el.number * parseInt(val)) / 100;
        const result = {
            discount : `Discount ${val} % <span class="text-danger">&nbsp- ${tolocale(discount)}</span>`,
            subtotal : el.number,
            total    : tolocale(el.number - discount)
        }
        return result;
    }

    /**
     * GENERATE INVOICE
     */
    $('body').on('click', '#generate-invoice', function () {
        if(arr.length > 0) {
            const totalInvoice = countSubtotal(arr);
            $('#ic-id').val(invoicecode);
            $('#ic-item').val(arr.length);
            $('#ic-subtotal').val(tolocale(totalInvoice));
            $('#ic-total').val(tolocale(totalInvoice));
            $('#createinvoice').modal('show');
        } else {
            $('#submit-message').html('<span class="badge badge-dim bg-danger badge-md"> Please select some items </div>')
        }
    });

    $('body').on('change', '#ic-discount', function () {
        const totalInvoice = countSubtotal(arr);
        const disc  = (totalInvoice * $(this).val() / 100).toFixed(2);
        const total = (totalInvoice - disc).toFixed(2);
        $('#ic-discount-message').html(`<span class="text-danger">- ${tolocale(disc)}</span>`);
        $('#ic-total').val(tolocale(total));
    });

    /**
     *
     * @param {*} array
     * @returns
     */
    const countSubtotal = (array) => {
        var subtotal = 0;
        array.forEach(item => {
            const mins = item.number * parseInt(item.disc) / 100;
            subtotal += item.number - mins;
        });
        return subtotal;
    }

    $('body').on('click', '#submit-btn-order', function () {

        $(this).attr("disabled", 'disabled');
        $(this).prop("disabled", true);
        $(this).html("Please wait, your data is being created . . . ");

        $.ajaxSetup({
            headers: {
              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        const totalInvoice = countSubtotal(arr);
        const mins  = totalInvoice * $('#ic-discount').val() / 100;
        const total = totalInvoice - mins;

        $.ajax({
            type: "post",
            url: "order",
            dataType: "json",
            data: {
                customer : {
                    id : $('#select-customer').val(),
                    address : $('#customer-address').val(),
                },
                order : {
                    code : invoicecode,
                    date : $('#order-date').val() ? $('#order-date').val() : new Date().toISOString().substring(0, 10),
                    discount : $('#ic-discount').val(),
                    subtotal : totalInvoice.toFixed(2),
                    mins : mins.toFixed(2),
                    total : total.toFixed(2),
                    items : arr
                }
            },
            dataType: "json",
            success: function (response) {
                window.location.href = 'order';
            },
            error: function (response) {
                $('#submit-btn-order').prop("disabled", false);
                $('#submit-btn-order').html("Ops, something went wrong, please try again");
            }
        });
    });
});
