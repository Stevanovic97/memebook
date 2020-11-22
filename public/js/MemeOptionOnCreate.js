jQuery(function($) {
    $('.bxslider').bxSlider({
        pager: false,
        mode: 'fade',
        captions: true,
        responsive: true,
        slideWidth: 500,
        onSliderLoad: function() {
            $("#memeOption2").css("visibility", "visible");
            $("#image-spinner").remove();
        },
    });
});

jQuery(function($) {
    $("input[name='chooseMemeType']").on('change', function() {
        if ($("#image-spinner").length)
        {
            $("#image-spinner").remove();
        }
        var selectedValue = $(this).val();

        $("div.desc").hide();
        $("#memeOption" + selectedValue).show();
    });
});

jQuery(function($) {
    $('form[name="create-meme-form"').on('submit', (e) => {
        e.preventDefault();
        let selectedType = $("input[name='chooseMemeType']:checked").val();
        if (selectedType == 2)
        {
            let form = e.currentTarget;
            let image = $(".carouselImage:visible").children('img')[0].src;
            let title = $(form).find("input[name='title']").val();
            let body = $(form).find("input[name='body']").val();
            let category = $(form).find("select[name='category_id'] option:selected").val();
            let submitButton = $(form).find(":submit");
            let requestData = {
                image: image,
                title: title,
                body: body,
                category_id: category
            };
            let actionUrl = $('form[name="create-meme-form"').attr('action');
            //show spinner in button
            ShowSpinnerButton(submitButton);
            screenLoader_Global();

            $.ajax({
                type: "POST",
                url: actionUrl,
                data: requestData,
                dataType: 'JSON',
                headers: {
                    "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
                },
                success: function(response) {
                    window.location = response.url;
                },    
                error: function(xhr, ajaxOptions, thrownError) {
                    console.log(xhr.status);
                    console.log(thrownError);
                    console.log(xhr.responseText);
                }
            });

            remove_screenLoader_Global();
        }
        else if (selectedType == 1)
        {
            let submitButton = $(":submit");
            //show spinner in button
            ShowSpinnerButton(submitButton);
            screenLoader_Global();
            e.currentTarget.submit();
            remove_screenLoader_Global()
        }
    });
});

function ShowSpinnerButton(button) {
    var loadingText = '<i class="spinner-border spinner-border-sm fa-spin"></i> Processing...';
    if (button.html() !== loadingText) {
        button.data('original-text', button.html());
        button.html(loadingText);
      }
      setTimeout(function() {
        button.html(button.data('original-text'));
      }, 10000);
}

function screenLoader_Global() {
    $('<div class="loader-mask"><div class="loader"></div></div>').appendTo('body');
}

function remove_screenLoader_Global() {
    setTimeout(function() {
        $('.loader-mask').remove();
    }, 10000);
  }