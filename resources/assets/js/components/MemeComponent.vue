<template>
  <div class="row">
    <article class="article-style">
      <div class="row meme">
        <a href="Show meme route">
          <picture>
            <div class="col-md-8">
              <img
                class="meme-img"
                :src="'../images/memes/' + this.meme.image"
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
    user: Object,
  },
};
</script>
