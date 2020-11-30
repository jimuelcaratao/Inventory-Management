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

//edit modal

$(document).ready(function() {

$('#editsearch').on('submit', function() {
    var id = $('/invoices/'+'#modal-input-id').val();
    var formAction = $('#editsearch').attr('action');
    $('#editsearch').attr('action', formAction + id);
});
    /**
* for showing edit item popup
    */
    $(document).on('click', "#edit-item", function() {
    $(this).addClass('edit-item-trigger-clicked'); //useful for identifying which trigger was clicked and consequently grab data from the correct row and not the wrong one.

        var options = {
        'backdrop': 'static'
        };
        $('#edit-modal').modal(options)
    })

    // on modal show
    $('#edit-modal').on('show.bs.modal', function() {
        var el = $(".edit-item-trigger-clicked"); // See how its usefull right here? 
        var row = el.closest(".data-row");

        // get the data
        var transac = el.data('item-id');
        var userid = el.data('item-user');
        var status =el.data("item-status");
        var ship =el.data("item-shipped");
        var arrive =el.data("item-arrived");


    // var description = row.children("item-email").text();

        // fill the data in the input fields
        $("#editTransactionNo").val(transac);
        $("#editUserID").val(userid);
        $("#editStatus").val(status);
        $("#editShippedDate").val(ship);
        $("#editArrivedDate").val(arrive);

    })

    // on modal hide
    $('#edit-modal').on('hide.bs.modal', function() {
        $('.edit-item-trigger-clicked').removeClass('edit-item-trigger-clicked')
        $("#edit-form").trigger("reset");
    })
})