// The plugin function for adding a new filtering routine
$.fn.dataTableExt.afnFiltering.push(function(oSettings, aData, iDataIndex) {
    if (!$("#dateStart").val() && !$("#dateEnd").val()) {
        return true;
    }
    var dateStart = moment($("#dateStart").val(), "YYYY-MM-DD").valueOf();
    var dateEnd = moment($("#dateEnd").val(), "YYYY-MM-DD").valueOf();
    var evalDate = moment(aData[8], "YYYY/MM/DD").valueOf();
    if (evalDate >= dateStart && evalDate <= dateEnd) {
        return true;
    } else {
        return false;
    }
});
/**
 * To set data table
 */
$(document).ready(function() {
    const customerTable = $("#customer-list").DataTable({
        sDom: "lrtip"
    });

    $("#search-click").click(function() {
        customerTable
            .columns(1)
            .search($("#search-name").val())
            .columns(2)
            .search($("#search-email").val())
            .draw();
    });
});

/**
 * To show customer detail
 * @param {Object} customerInfo customerinfo
 * @returns void
 */
function showcustomerDetail(customerInfo) {
    $("#customer-detail #customer-name").text(customerInfo.name);
    if (customerInfo.type == "0") {
        $("#customer-detail #customer-type").text("Admin");
    } else if(customerInfo.type == "1") {
        $("#customer-detail #customer-type").text("customer");
    } else {
      $("#customer-detail #customer-type").text("Visitor");
    }
    $("#customer-detail #customer-email").text(customerInfo.email);
    $("#customer-detail #customer-phone").text(customerInfo.phone);
    $("#customer-detail #customer-dob").text(moment(customerInfo.dob).format("YYYY/MM/DD"));
    $("#customer-detail #customer-address").text(customerInfo.address);
    $("#customer-detail #customer-profile").attr(
        "src",
        "/profile/" + customerInfo.id + "/" + customerInfo.profile
    );
    $("#customer-detail #customer-created-at").text(
        moment(customerInfo.created_at).format("YYYY/MM/DD")
    );
    $("#customer-detail #customer-created-customer").text(customerInfo.created_customer);
    $("#customer-detail #customer-updated-at").text(
        moment(customerInfo.updated_at).format("YYYY/MM/DD")
    );
    $("#customer-detail #customer-updated-customer").text(customerInfo.updated_customer);
}

/**
 * To show customer delete confirm
 * @param {Object} customerInfo customerInfo
 * @returns void
 */
function showDeleteConfirm(customerInfo) {
    $("#customer-delete #customer-id").text(customerInfo.id);
    $("#customer-delete #customer-name").text(customerInfo.customerName);
    $("#customer-delete #customer-address").text(customerInfo.address);
    $("#customer-delete #customer-email").text(customerInfo.email);
    $("#customer-delete #customer-phone").text(customerInfo.phone);
}

/**
 * To delete customer by id
 * @returns void
 */
async function deleteCustomerById(csrf_token) {
    await $.ajax({
        url: "/customer/delete/" + $("#customer-delete #customer-id").text(),
        type: "DELETE",
        data: {
            _token: csrf_token
        },
        dataType: "text",
        success: function(result) {
            console.log(result);
            location.reload();
        }
    });
}
