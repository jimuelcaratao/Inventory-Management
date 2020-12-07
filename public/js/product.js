// Adding modal
$(document).ready(function() {
    $("#add").on("submit", function() {
        var id = $("/products").val();
        var formAction = $("#add").attr("action");
        $("#add").attr("action", formAction + id);
    });
    /**
     * for showing Add item popup
     */
    $(document).on("click", "#add-item", function() {
        $(this).addClass("add-item-trigger-clicked"); //useful for identifying which trigger was clicked and consequently grab data from the correct row and not the wrong one.

        var options = {
            backdrop: "static"
        };
        $("#add-modal").modal(options);
    });

    // on modal hide
    $("#add-modal").on("hide.bs.modal", function() {
        $(".add-item-trigger-clicked").removeClass("add-item-trigger-clicked");
        $("#add-form").trigger("reset");
    });
});

// search modal
$(document).ready(function() {
    $("#search").on("submit", function() {
        var id = $("/products").val();
        var formAction = $("#search").attr("action");
        $("#search").attr("action", formAction + id);
    });
    /**
     * for showing Add item popup
     */
    $(document).on("click", "#search-item", function() {
        $(this).addClass("add-item-trigger-clicked"); //useful for identifying which trigger was clicked and consequently grab data from the correct row and not the wrong one.

        var options = {
            backdrop: "static"
        };
        $("#search-modal").modal(options);
    });

    // on modal hide
    $("#search-modal").on("hide.bs.modal", function() {
        $(".search-item-trigger-clicked").removeClass(
            "search-item-trigger-clicked"
        );
        $("#search-form").trigger("reset");
    });
});

//edit modal

$(document).ready(function() {
    $("#editsearch").on("submit", function() {
        var id = $("/products/" + "#modal-input-id").val();
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
        var sku = el.data("item-sku");
        var barcode = el.data("item-barcode");
        var barcodeImg = el.data("item-barcode");
        var productname = el.data("item-productname");
        var description = el.data("item-description");
        var specs = el.data("item-specs");
        var category = el.data("item-category");
        var brand = el.data("item-brand");
        var stock = el.data("item-stock");
        var price = el.data("item-price");
        // var barcodeImg = { json_encode($barcode, JSON_HEX_TAG) };

        // var description = row.children("item-email").text();

        // fill the data in the input fields
        $("#editSKU").val(sku);
        $("#editBarcode").val(barcode);
        $("#barcodeImg").val(barcodeImg);
        $("#editProductName").val(productname);
        $("#editDescription").val(description);
        $("#editSpecs").val(specs);
        $("#editCategory").val(category);
        $("#editBrand").val(brand);
        $("#editStock").val(stock);
        $("#editPrice").val(price);

        $.ajax({
            type: "GET",
            url: `/ProductImages?Id=${barcode}`,

            success: function(response) {
                console.log(response.data);

                let htmls = "";
                x = null;
                $("#image-container").html(null);
                response.data.map(x => {
                    var photo_id = x.product_photo_id;
                    // console.log(photo_id);
                    let routeAsset = `http://127.0.0.1:8000/product_images/${x.barcode}_${x.photo}`;
                    $("#image-container").append(
                        `<img class='swiper-slide border my-4 mx-2 d-block w-50' src='${routeAsset}' alt='${x.photo}' />` +
                            `<form method='GET' action='/ProductImages/delete?Id=${x.product_photo_id}' >` +
                            `<div class='form-group'>` +
                            `<button class='btn btn-danger submit_btn'  type='submit'>X</button` +
                            `</div>` +
                            `</form>`
                    );
                });
            }
        });

        // $("#btn_sad").click(function(e) {
        //     e.preventDefault();
        //     $.ajax({
        //         type: "DELETE",
        //         url: `/product_photo/${x.product_photo_id}`,

        //         success: function(result) {
        //             alert("ok");
        //         }
        //     });
        // });
    });

    // $(".submit_btn").click(function(e) {
    //     e.preventDefault(); // Don't post the form, unless confirmed
    //     $.ajax({
    //         type: `GET`,
    //         url: `/ProductImages/delete?Id=${product_photo_id}`,

    //         success: function(response) {
    //             console.log(response.data);
    //             x = null;
    //         }
    //     });
    //     console.log("clik");
    // });

    // on modal hide
    $("#edit-modal").on("hide.bs.modal", function() {
        $(".edit-item-trigger-clicked").removeClass(
            "edit-item-trigger-clicked"
        );
        $("#edit-form").trigger("reset");
    });
});

//tooltip
$(document).ready(function() {
    $('[data-tooltip="tooltip"]').tooltip();
});

//delete
$(".delete-user").click(function(e) {
    e.preventDefault(); // Don't post the form, unless confirmed
    if (confirm("Are you sure?")) {
        // Post the form
        $(e.target)
            .closest("form")
            .submit(); // Post the surrounding form
    }
});

// $(".delete-photo").click(function(e) {
//     e.preventDefault(); // Don't post the form, unless confirmed
//     $.ajax({
//         type: `GET`,
//         url: `/ProductImages/delete?Id=${barcode}`,

//         success: function(response) {
//             console.log(response.data);
//             x = null;
//         }
//     });
// });

// this is the id of the form
// $("#idForm").submit(function(e) {
//     e.preventDefault(); // avoid to execute the actual submit of the form.

//     var form = $(this);
//     var url = form.attr(`/ProductImages/delete?Id=${barcode}`);

//     $.ajax({
//         type: `POST`,
//         url: url,
//         data: form.serialize(), // serializes the form's elements.
//         success: function(data) {
//             alert(data); // show response from the php script.
//         }
//     });
// });

$(document).on("click", "#btnGetItem", async () => {
    let response = await fetch("https://jsonplaceholder.typicode.com/todos/1");
    let result = await response.json();

    $("#title-sample").html(result.title);
});
