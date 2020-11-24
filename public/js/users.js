//edit modal

$(document).ready(function() {

    $('#editsearch').on('submit', function() {
        var id = $('/users/'+'#modal-input-id').val();
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
            var name = el.data('item-name');
            var email =el.data("item-email");
            var is_admin =el.data("item-is_admin");
            // var password =el.data("item-password");
            var created_at = el.data('item-created_at');
            var updated_at = el.data('item-updated_at');
            var firstname =el.data("item-firstname");
            var middlename =el.data("item-middlename");
            var lastname =el.data("item-lastname");
            var contact =el.data("item-contact");
            var address =el.data("item-address");

        // var description = row.children("item-email").text();
        
            if (is_admin == 1) {
                $("#editAccountType").val('Admin');
            } else {
                $("#editAccountType").val('User');
            }
            // fill the data in the input fields
            $("#editUserID").val(id);
            $("#editUsername").val(name);
            $("#editEmail").val(email);
            // $("#editPassword").val(password);
            $("#editCreated").val(created_at);
            $("#editUpdated").val(updated_at);
            $("#editFirstname").val(firstname);
            $("#editMiddlename").val(middlename);
            $("#editLastname").val(lastname);
            $("#editContact").val(contact);
            $("#editAddress").val(address);
    
        })
    
        // on modal hide
        $('#edit-modal').on('hide.bs.modal', function() {
            $('.edit-item-trigger-clicked').removeClass('edit-item-trigger-clicked')
            $("#edit-form").trigger("reset");
        })
    })