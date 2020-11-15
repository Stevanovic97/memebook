<template>
  <div :v-if="!isFetching">
    <div class="profile">
      <div class="row">
        <div>
          <div id="basic-info row">
            <h1>
              Username: <i>{{ this.user.name }}</i>
              <avatar class="avatar-photo"
                      :username="this.user.name"
                      :src="'../images/user-profile-images/' + this.user.avatar"
                      :size=75
                      :inline="true">
              </avatar>
            </h1>
          </div>
          <td>
            <div>
              <i><h4> {{ this.memesCount }} memes {{ this.user.followers }} Followers  {{ this.user.following }} Following </h4></i>
            </div>
            <form v-if="this.auth_user !== null && this.auth_user.id != user.id && !this.isFollowing"
                 :action="this.follow_route" method="POST" enctype="multipart/form-data">
                <input type="hidden" name="_token" v-bind:value="csrfToken">
                <input type="hidden" id="user_id" name="user_id" :value="this.user.id">
                <button
                  :id="'follow-user-' + this.user.id"
                  class="btn btn-success"
                  type="submit"
                >
                  <i class="fa fa-btn fa-user" id="followUser">Follow</i>
                </button>
            </form>
            <form v-else-if="this.auth_user !== null && this.auth_user.id != user.id"
                 :action="this.unfollow_route" method="POST" enctype="multipart/form-data">
                 <input type="hidden" name="_token" v-bind:value="csrfToken">
                 <input type="hidden" id="user_id" name="user_id" :value="this.user.id">
                <button 
                  :id="'delete-follow-' + this.user.id"
                  class="btn btn-danger"
                  type="submit"
                >
                  <i class="fa fa-btn fa-trash" id="unfollowUser">Unfollow</i>
                </button>
            </form>
          </td>
          <a v-if="this.auth_user !== null && this.user.id == this.auth_user.id" href="">Edit Profile</a>
          <div>
            <div v-if="this.memes.data.length > 0">
              <div v-for="meme in this.memes.data">
                <meme-component :meme="meme" 
                                :user="auth_user"
                                :memeimage="images_source + meme.image"
                                :single_meme_route="'/meme/single/' + meme.id"
                                :user_route="'/users/' + meme.user_id">
                </meme-component>
              </div>
            </div>
            <div v-else>
                <div class="no-memes-text">
                    <h3>There are currently no uploaded memes.</h3>
                </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import MemeComponent from "./MemeComponent";
import Avatar from 'vue-avatar';

export default {
  components: {
    Avatar
  },
  props: {
    memes: {
      Default: null,
    },
    user: Object,
    auth_user: Object,
    follow_route: String,
    unfollow_route: String,
    images_source: String
  },
  computed: {
    memesCount: function() {
        return this.memes.data.length > 0 ? this.memes.data.length : 0
    }
  },
  data() {
    return {
      isFollowing: false,
      isFetching: true,
      csrfToken: $('meta[name="csrf-token"]').attr("content"),
    }
  },
  mounted() {
    this.IsFollowingCheck();
    this.isFetching = false;
  },
  methods: {
    async IsFollowingCheck() {
      await $.ajax({
          url: "/user/follows",
          type: "POST",
          data: { user_id: this.user.id },
          headers: {
            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
          },
          error: function (xhr, error) {
              if (xhr.status == 401) window.location.href = "/login";
              else if (xhr.status == 500) console.log(xhr);
              else console.log(error);
          },
      }).done(following => this.isFollowing = JSON.parse(following));
    }
  },
};
</script>

