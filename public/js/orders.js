//migrate orders
$(".delete-all").click(function(e) {
    e.preventDefault(); // Don't post the form, unless confirmed
    if (confirm("Are you sure?")) {
        // Post the form
        $(e.target)
            .closest("form")
            .submit(); // Post the surrounding form
    }
});

//delete recort
$(".delete-user").click(function(e) {
    e.preventDefault(); // Don't post the form, unless confirmed
    if (confirm("Are you sure?")) {
        // Post the form
        $(e.target)
            .closest("form")
            .submit(); // Post the surrounding form
    }
});

//edit modal orders
$(document).ready(function() {
    $("#editsearch").on("submit", function() {
        var id = $("/orders/" + "#modal-input-id").val();
        var formAction = $("#editsearch").attr("action");
        $("#editsearch").attr("action", formAction + id);
    });
    /**
     * for showing edit item popup
     */
    $(document).on("click", "#edit-item", function() {
        $(this).addClass("edit-item-trigger-clicked"); //useful for identifying which trigger was clicked and consequently grab data from the correct row and not the wrong one.

        var options = {
            backdrop: "static"
        };
        $("#edit-modal").modal(options);
    });

    // on modal show
    $("#edit-modal").on("show.bs.modal", function() {
        var el = $(".edit-item-trigger-clicked"); // See how its usefull right here?
        var row = el.closest(".data-row");

        // get the data
        var transac = el.data("item-transactorder");
        var id = el.data("item-id");
        var status = el.data("item-status");
        var shipped_date = el.data("item-shipped_date");
        var arriving_date = el.data("item-arriving_date");

        // var description = row.children("item-email").text();

        // fill the data in the input fields
        $("#editTransactionNoOrders").val(transac);
        $("#editUserID").val(id);
        $("#editStatusOrders").val(status);
        $("#editShipped").val(shipped_date);
        $("#editArriving").val(arriving_date);
    });

    // on modal hide
    $("#edit-modal").on("hide.bs.modal", function() {
        $(".edit-item-trigger-clicked").removeClass(
            "edit-item-trigger-clicked"
        );
        $("#edit-form").trigger("reset");
    });
});

//edit modal order reports
$(document).ready(function() {
    $("#editsearch").on("submit", function() {
        var id = $("/orders/" + "#modal-input-id").val();
        var formAction = $("#editsearch").attr("action");
        $("#editsearch").attr("action", formAction + id);
    });
    /**
     * for showing edit item popup
     */
    $(document).on("click", "#edit-item", function() {
        $(this).addClass("edit-item-trigger-clicked"); //useful for identifying which trigger was clicked and consequently grab data from the correct row and not the wrong one.

        var options = {
            backdrop: "static"
        };
        $("#edit-modal").modal(options);
    });

    // on modal show
    $("#edit-modal").on("show.bs.modal", function() {
        var el = $(".edit-item-trigger-clicked"); // See how its usefull right here?
        var row = el.closest(".data-row");

        // get the data
        var orderid = el.data("item-id");
        var transac = el.data("item-transact");
        var barcode = el.data("item-barcode");
        var quantity = el.data("item-quantity");
        var price = el.data("item-price");
        var discount = el.data("item-discount");

        // var description = row.children("item-email").text();

        // fill the data in the input fields
        $("#editOrderID").val(orderid);
        $("#editTransactionNo").val(transac);
        $("#editBarcode").val(barcode);
        $("#editQuantity").val(quantity);
        $("#editPrice").val(price);
        $("#editDiscount").val(discount);
    });

    // on modal hide
    $("#edit-modal").on("hide.bs.modal", function() {
        $(".edit-item-trigger-clicked").removeClass(
            "edit-item-trigger-clicked"
        );
        $("#edit-form").trigger("reset");
    });
});
