<template>
    <div class="row">
    <div class="profile-view">
          <b><h5>User profile:</h5> </b>
          <a :href="this.user_route">
          </a>
        </div>
        <article class="article-style">
            <div class="row meme">
                <a :href="single_meme_route">
                    <picture>
                        <div class="col-md-8">
                            <img
                                class="meme-img"
                                :src="this.memeimage"
                                alt="images/ImageNotFound.jpg"
                            />
                        </div>
                    </picture>
                </a>
                <br>
                <h2>{{ this.meme.title }}</h2>
                <br/>
                <h4>{{ this.meme.body }}</h4>
            </div>
            <div> <form><h4>Category: <a :href="this.show_memes_category_route"> {{this.meme.category.name}} </a><button class="btn btn-primary">Subscribe</button></h4>
            </form></div>

            <meme-options
                :meme="this.meme"
                :user="this.user"
                :username="this.meme.username"
                :user_route="this.user_route"
                :delete_meme_route="this.delete_meme_route"
                :edit_meme_route="this.edit_meme_route"
            ></meme-options>
        </article>
        <br/>
    </div>
</template>

<script>
    import MemeOptions from "./MemeOptions";

    export default {

        props: {
            meme: Object,
            memeimage: String,
            user: Object,
            single_meme_route: String,
            user_route: String,
            delete_meme_route: String,
            edit_meme_route: String,
            show_memes_category_route: String
        },
    };
</script>
