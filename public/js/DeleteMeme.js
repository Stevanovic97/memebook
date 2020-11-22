jQuery(function($) {
    $('form[name="delete-meme-form"').on('submit', (e) => {
        e.preventDefault();

        let form = e.currentTarget;
        bootbox.confirm({title: "Delete this meme?",
            backdrop: true,
            message: "Are you sure you want to delete this meme? This cannot be undone.",
            buttons: {
                cancel: {
                    label: '<i class="fa fa-times"></i> Cancel'
                },
                confirm: {
                    label: '<i class="fa fa-check"></i> Confirm'
                }
            },
            callback: function (result) {
                if (result)
                {
                    form.submit();
                }
            }
        });
    });
});
