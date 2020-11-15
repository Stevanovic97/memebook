<template>
  <div class="control-panel container">
    <div class="row">
      <div class="profile-options">
        <h5 style="color: #666">
          Likes:
          <span :id="'votes-' + this.meme.id"> {{ this.meme.votes }} </span>
        </h5>
        <div class="row" style="color: whitesmoke">
          <h2>
            <a class="btn"
              :style="'background-color:' + this.meme.voted['upvoted']"
              :id="'meme_upvote-' + this.meme.id"
              @click="upvote()"
              href="#!"
              role="button">
              <i class="fas fa-arrow-circle-up" style="font-size: 2.5em"></i>
            </a>
          </h2>
          <h2>
            <a class="btn"
              :style="'background-color:' + this.meme.voted['downvoted']"
              :id="'meme_downvote-' + this.meme.id"
              @click="downvote()"
              href="#!"
              role="button">
              <i class="fas fa-arrow-circle-down" style="font-size: 2.5em"></i>
            </a>
          </h2>
        </div>
      </div>
      <div class="user-options row-fluid">
        <div class="profile-view">
          <b><h5>User profile:</h5> </b>
          <a :href="this.user_route">
            <span><h4>{{ this.username }}</h4></span>
          </a>
        </div>
        <div class="meme-options">
          <a
            v-if="this.user !== null"
            id="delete_meme_button"
            class="btn"
            href=""
            >Edit Meme</a>
          <a
            v-if="this.user !== null && this.user.id == this.meme.user_id"
            class="btn btn-danger"
            :href="'/meme/delete/' + this.meme.id">
            Delete Meme
          </a>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  props: {
    meme: Object,
    username: String,
    user: Object,
    user_route: String
  },
  methods: {
    upvote() {
      $.ajax({
        headers: {
          "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
        },
        url: "/meme/vote",
        data: { meme_id: this.meme.id, vote: 1 },
        type: "POST",
        success: function (data) {
          var upvoteButton = $("#meme_upvote-" + data.meme_id);
          var downvoteButton = $("#meme_downvote-" + data.meme_id);
          switch (data.type) {
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
          $("#votes-" + data.meme_id).html(data.sum);
        },
        error: function (xhr) {
          if ((xhr.status = 401)) window.location.href = "/login";
        },
      });
    },
    downvote() {
      $.ajax({
        headers: {
          "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
        },
        url: "/meme/vote",
        data: { meme_id: this.meme.id, vote: -1 },
        type: "POST",
        success: function (data) {
          var upvoteButton = $("#meme_upvote-" + data.meme_id);
          var downvoteButton = $("#meme_downvote-" + data.meme_id);
          switch (data.type) {
            case "created": {
              downvoteButton.css("background-color", "#99CCFF");
              break;
            }
            case "updated": {
              upvoteButton.css("background-color", "white");
              downvoteButton.css("background-color", " #99CCFF");
              break;
            }
            case "deleted": {
              downvoteButton.css("background-color", "white");
              break;
            }
          }
          $("#votes-" + data.meme_id).html(data.sum);
        },
        error: function (xhr) {
          if ((xhr.status = 401)) window.location.href = "/login";
        },
      });
    },
  },
};
</script>