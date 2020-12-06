function ReportMeme(meme_id) {
    $("#reportModal").modal('show');

    jQuery(function($) {
        $('form[name="report_meme_form"').on('submit', (e) => {
            e.preventDefault();

            let form = e.currentTarget;
            let methodField = document.createElement('input');
            methodField.setAttribute('type', 'hidden');
            methodField.setAttribute('name', 'meme_id');
            methodField.setAttribute('value', meme_id);
            form.appendChild(methodField);

            let submitButton = $(":submit");
            e.currentTarget.submit();
        });
    });
}