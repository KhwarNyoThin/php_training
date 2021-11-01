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
    const saleTable = $("#sale-list").DataTable({
        sDom: "lrtip"
    });

    $("#search-click").click(function() {
        saleTable
            .columns(1)
            .search($("#search-name").val())
            .columns(2)
            .search($("#search-email").val())
            .draw();
    });
});

/**
 * To show sale detail
 * @param {Object} saleInfo saleinfo
 * @returns void
 */
function showsaleDetail(saleInfo) {
    $("#sale-detail #sale-name").text(saleInfo.name);
    if (saleInfo.type == "0") {
        $("#sale-detail #sale-type").text("Admin");
    } else if(saleInfo.type == "1") {
        $("#sale-detail #sale-type").text("sale");
    } else {
      $("#sale-detail #sale-type").text("Visitor");
    }
    $("#sale-detail #sale-email").text(saleInfo.email);
    $("#sale-detail #sale-phone").text(saleInfo.phone);
    $("#sale-detail #sale-dob").text(moment(saleInfo.dob).format("YYYY/MM/DD"));
    $("#sale-detail #sale-address").text(saleInfo.address);
    $("#sale-detail #sale-profile").attr(
        "src",
        "/profile/" + saleInfo.id + "/" + saleInfo.profile
    );
    $("#sale-detail #sale-created-at").text(
        moment(saleInfo.created_at).format("YYYY/MM/DD")
    );
    $("#sale-detail #sale-created-sale").text(saleInfo.created_sale);
    $("#sale-detail #sale-updated-at").text(
        moment(saleInfo.updated_at).format("YYYY/MM/DD")
    );
    $("#sale-detail #sale-updated-sale").text(saleInfo.updated_sale);
}

/**
 * To show sale delete confirm
 * @param {Object} saleInfo saleInfo
 * @returns void
 */
function showDeleteConfirm(saleInfo) {
    $("#sale-delete #sale-id").text(saleInfo.id);
    $("#sale-delete #sale-customer-id").text(saleInfo.customerID);
    $("#sale-delete #sale-product-id").text(saleInfo.productID);
    $("#sale-delete #sale-ordered-date").text(saleInfo.ordered_date);
}

/**
 * To delete sale by id
 * @returns void
 */
async function deletesaleById(csrf_token) {
    await $.ajax({
        url: "/sale/delete/" + $("#sale-delete #sale-id").text(),
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
