  // Adding modal
  $(document).ready(function() {

    $('#add').on('submit', function() {
        var id = $('/suppliers').val();
        var formAction = $('#add').attr('action');
        $('#add').attr('action', formAction + id);
    });
    /**
    * for showing Add item popup
    */
    $(document).on('click', "#add-item", function() {
        $(this).addClass('add-item-trigger-clicked'); //useful for identifying which trigger was clicked and consequently grab data from the correct row and not the wrong one.

        var options = {
            'backdrop': 'static'
        };
        $('#add-modal').modal(options)
        })

        // on modal hide
        $('#add-modal').on('hide.bs.modal', function() {
        $('.add-item-trigger-clicked').removeClass('add-item-trigger-clicked')
        $("#add-form").trigger("reset");
        })
    })


//edit modal

$(document).ready(function() {

    $('#editsearch').on('submit', function() {
        var id = $('/suppliers/'+'#modal-input-id').val();
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
            var id = el.data('item-id');
            var companyName =el.data("item-name");
            var address =el.data("item-address");
            var contact =el.data("item-contact");
            var status =el.data("item-status");

    
        // var description = row.children("item-email").text();
    
            // fill the data in the input fields
            $("#editID").val(id);
            $("#editCompanyName").val(companyName);
            $("#editAddress").val(address);
            $("#editContact").val(contact);
            $("#editStatus").val(status);
    
        })
    
        // on modal hide
        $('#edit-modal').on('hide.bs.modal', function() {
            $('.edit-item-trigger-clicked').removeClass('edit-item-trigger-clicked')
            $("#edit-form").trigger("reset");
        })
    })


//delete
$('.delete-user').click(function(e){
    e.preventDefault() // Don't post the form, unless confirmed
    if (confirm('Are you sure?')) {
        // Post the form
        $(e.target).closest('form').submit() // Post the surrounding form
    }
});