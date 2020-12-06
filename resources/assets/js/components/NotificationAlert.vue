<template>
    <alert v-model="showAlert" placement="top-right" duration="5000" type="success" width="400px" dismissable>
        <span class="icon-ok-circled alert-icon-float-left"></span>
        <strong> {{ title }}</strong>
        <p> {{ message }} </p>
    </alert>
</template>

<script>
    import { alert } from 'vue-strap'

    export default {
        components: {
            alert
        },
        props: ['user_id'],
        data() {
            return {
                showAlert: false,
                title: "",
                message: ""
            }
        },
        mounted() {
            Echo.channel('memebook-channel.' + this.user_id)
                .listen('NewNotification', (notification) => {
                    this.showAlert = true;
                    let notificationType = notification.notifiable_type;
                    if (notificationType.includes("UserFollowed"))
                    {
                        this.title = "New follower!";
                        this.message = "User " + notification.fromUserName + " is now following you.";
                    }
                    else if (notificationType.includes("NewMeme"))
                    {
                        this.title = "New meme!";
                        this.message = "User you are following " + notification.fromUserName + " has posted a new meme.";
                    }
                });
        }
    }
</script>