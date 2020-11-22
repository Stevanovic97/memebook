function upvote(meme_id, user_id)
{
    $.ajax({
        headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
        url: "/meme/vote",
        data: { meme_id: meme_id, user_id: user_id, vote: 1 },
        type: "POST",
        success: function(data){
            var upvoteButton = $('#meme_upvote-' + meme_id);
            var downvoteButton = $('#meme_downvote-' + meme_id);
            switch (data.type)
            {
                case "created":
                    upvoteButton.css("background-color", "#99CCFF");
                    break;
                case "updated":
                    upvoteButton.css("background-color", " #99CCFF");
                    downvoteButton.css("background-color", "white");
                    break;
                case "deleted":
                    upvoteButton.css("background-color", "white");
                    break;
            }    
            $('#votes-' + meme_id).html(data.sum); 
        },
        error: function(jqXHR, textStatus, errorThrown) {
            console.log(textStatus, errorThrown);
        }
    });
}

function downvote(meme_id, user_id)
{
    $.ajax({
        headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
        url: "/meme/vote",
        data: { meme_id: meme_id, user_id: user_id, vote: -1 },
        type: "POST",
        success: function(data){
            var upvoteButton = $('#meme_upvote-' + meme_id);
            var downvoteButton = $('#meme_downvote-' + meme_id);
            switch (data.type)
            {
                case "created":
                {
                    downvoteButton.css("background-color", "#99CCFF"); 
                    break;
                }
                case "updated":
                {
                    upvoteButton.css("background-color", "white");
                    downvoteButton.css("background-color", " #99CCFF"); 
                    break;
                }
                case "deleted":
                {
                    downvoteButton.css("background-color", "white"); 
                    break;
                }
            }
            $('#votes-' + meme_id).html(data.sum); 
        },
        error: function(jqXHR, textStatus, errorThrown) {
            console.log(textStatus, errorThrown);
        }
    });
}