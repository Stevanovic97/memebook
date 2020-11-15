<template>
  <div class="row">
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
        <div>
          <h2>{{ this.meme.title }}</h2>
          <br />
          <h4>{{ this.meme.body }}</h4>
        </div>
      </div>
      <meme-options
        :meme="this.meme"
        :user="this.user"
        :username="this.meme.username"
        :user_route="this.user_route"
      ></meme-options>
    </article>
    <br />
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
    user_route: String
  },
};
</script>
