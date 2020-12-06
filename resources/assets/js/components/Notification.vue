<template>
    <div>
        <i :class="notification.mark"></i>
        <span :style="notification.style">
           <strong v-html="notification.description">
               {{ notification.description }}
            </strong>
        </span>
        <span class="pull-right text-muted small"><timeago :datetime="notification.time" :auto-update="60"></timeago></span>
    </div>
</template>

<script>

export default {
    props: ['notification']
}

</script>
