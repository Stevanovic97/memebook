<template>
    <div>
        <i class="fa fa-exclamation-circle fa-fw"></i> {{ notification.description }}
        <span class="pull-right text-muted small"><timeago :datetime="notification.time" :auto-update="60"></timeago></span>
    </div>
</template>

<script>

export default {
    props: ['notification']
}

</script>
