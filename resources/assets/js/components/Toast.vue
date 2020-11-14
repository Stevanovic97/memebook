<template>
    <alert placement="top-right" duration="5000" :type="this.type" width="400px" dismissable>
        <span class="icon-ok-circled alert-icon-float-left"></span>
        <strong> {{ this.title }}</strong>
        <p> {{ this.message }} </p>
    </alert>
</template>

<script>
    import { alert } from 'vue-strap'

    export default {
        components: {
            alert
        },
        props: ['type', 'title', 'message'],
    }
</script>