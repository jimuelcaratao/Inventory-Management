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

//delete
$(".print-invoice").click(function(e) {
    e.preventDefault(); // Don't post the form, unless confirmed
    if (confirm("Are you sure you want to print?")) {
        // Post the form
        $(e.target)
            .closest("form")
            .submit(); // Post the surrounding form
    }
});
