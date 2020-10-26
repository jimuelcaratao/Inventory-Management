 // Adding modal
 $(document).ready(function() {

    $('#add').on('submit', function() {
        var id = $('/products').val();
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

 // search modal
 $(document).ready(function() {

  $('#search').on('submit', function() {
      var id = $('/products').val();
      var formAction = $('#search').attr('action');
      $('#search').attr('action', formAction + id);
  });
  /**
  * for showing Add item popup
  */
  $(document).on('click', "#search-item", function() {
      $(this).addClass('add-item-trigger-clicked'); //useful for identifying which trigger was clicked and consequently grab data from the correct row and not the wrong one.

      var options = {
          'backdrop': 'static'
      };
      $('#search-modal').modal(options)
      })

      // on modal hide
      $('#search-modal').on('hide.bs.modal', function() {
      $('.search-item-trigger-clicked').removeClass('search-item-trigger-clicked')
      $("#search-form").trigger("reset");
      })
})


//edit modal

$(document).ready(function() {

    $('#editsearch').on('submit', function() {
        var id = $('/products/'+'#modal-input-id').val();
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
          var sku = el.data('item-sku');
          var barcode =el.data("item-barcode");
          var productname =el.data("item-productname");
          var description =el.data("item-description");
          var category =el.data("item-category");
          var brand =el.data("item-brand");
          var stock =el.data("item-stock");
          var price =el.data("item-price");
          // bakla ako

        // var description = row.children("item-email").text();

          // fill the data in the input fields
          $("#editSKU").val(sku);
          $("#editBarcode").val(barcode);
          $("#editProductName").val(productname);
          $("#editDescription").val(description);
          $("#editCategory").val(category);
          $("#editBrand").val(brand);
          $("#editStock").val(stock);
          $("#editPrice").val(price);
        })

        // on modal hide
        $('#edit-modal').on('hide.bs.modal', function() {
          $('.edit-item-trigger-clicked').removeClass('edit-item-trigger-clicked')
          $("#edit-form").trigger("reset");
        })
    })
    
    //tooltip
    $(document).ready(function(){
      $('[data-tooltip="tooltip"]').tooltip();
    });

    //delete
    $('.delete-user').click(function(e){
      e.preventDefault() // Don't post the form, unless confirmed
      if (confirm('Are you sure?')) {
          // Post the form
          $(e.target).closest('form').submit() // Post the surrounding form
      }
    });