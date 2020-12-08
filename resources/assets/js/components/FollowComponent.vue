<template>
    <div :v-if="!isFetching">

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
    </div>
</template>

<script>
    export default {
        props: {
            user: Object,
            auth_user: Object,
            follow_route: String,
            unfollow_route: String,
        },
        data() {
            return {
                isFollowing: false,
                isFetching: true,
                csrfToken: $('meta[name="csrf-token"]').attr("content")
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
                    data: {user_id: this.user.id},
                    headers: {
                        "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
                    },
                    error: function (xhr, error) {
                        if (xhr.status == 401) window.location.href = "/login";
                        else if (xhr.status == 404) window.history.back();
                        else if (xhr.status == 500) console.log(xhr);
                        else console.log(error);
                    },
                }).done(following => this.isFollowing = JSON.parse(following.data));
            }
        },
    }
</script>
