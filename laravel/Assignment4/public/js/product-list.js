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
    const productTable = $("#product-list").DataTable({
        sDom: "lrtip"
    });

    $("#search-click").click(function() {
        productTable
            .columns(1)
            .search($("#search-name").val())
            .columns(2)
            .search($("#search-email").val())
            .draw();
    });
});

/**
 * To show product detail
 * @param {Object} productInfo productinfo
 * @returns void
 */
function showproductDetail(productInfo) {
    $("#product-detail #product-name").text(productInfo.name);
    if (productInfo.type == "0") {
        $("#product-detail #product-type").text("Admin");
    } else if(productInfo.type == "1") {
        $("#product-detail #product-type").text("product");
    } else {
      $("#product-detail #product-type").text("Visitor");
    }
    $("#product-detail #product-email").text(productInfo.email);
    $("#product-detail #product-phone").text(productInfo.phone);
    $("#product-detail #product-dob").text(moment(productInfo.dob).format("YYYY/MM/DD"));
    $("#product-detail #product-address").text(productInfo.address);
    $("#product-detail #product-profile").attr(
        "src",
        "/profile/" + productInfo.id + "/" + productInfo.profile
    );
    $("#product-detail #product-created-at").text(
        moment(productInfo.created_at).format("YYYY/MM/DD")
    );
    $("#product-detail #product-created-product").text(productInfo.created_product);
    $("#product-detail #product-updated-at").text(
        moment(productInfo.updated_at).format("YYYY/MM/DD")
    );
    $("#product-detail #product-updated-product").text(productInfo.updated_product);
}

/**
 * To show product delete confirm
 * @param {Object} productInfo productInfo
 * @returns void
 */
function showDeleteConfirm(productInfo) {
    $("#product-delete #product-id").text(productInfo.id);
    $("#product-delete #product-name").text(productInfo.productName);
    $("#product-delete #product-price").text(productInfo.price);
}

/**
 * To delete product by id
 * @returns void
 */
async function deleteproductById(csrf_token) {
    await $.ajax({
        url: "/product/delete/" + $("#product-delete #product-id").text(),
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
