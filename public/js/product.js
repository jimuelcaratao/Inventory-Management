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
