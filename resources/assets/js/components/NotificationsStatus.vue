<template>
    <div :v-if="!isFetching">
        <li class="dropdown">
            <div class="float-right icon dropdown">
                <a href="#" data-target="#notificationsMenu" data-toggle="dropdown" role="button" aria-expanded="false">
                    <img src="/images/Notification_image.png" alt="none" width="100%" height="100%"/>
                    <span class="txt" v-if="this.notifications.length > 0">{{ this.notifications.length }}</span>
                    <span class="caret"></span>
                </a>
                <ul class="dropdown-menu dropdown-menu-right dropdown-menu-notifications" id="notificationsMenu" role="menu">
                    <li v-for="notification in notifications">
                        <a v-on:click="readNotification(notification.notificationId)" class="d-flex">
                            <notification :notification="notification"></notification>
                        </a>
                        <div class="divider"></div>
                    </li>
                    <li>
                        <div class="text-center see-all-notifications">
                            <a href="notifications.html" v-if="this.notifications.length > 0">
                                <strong>See All Alerts</strong>
                                <i class="fa fa-angle-right"></i>
                            </a>
                            <div v-else>No notifications</div>
                        </div>
                    </li>
                </ul>
            </div>
        </li>
    </div>
</template>

<script>
    import Notification from './Notification'
    import VueTimeago from 'vue-timeago'

     Vue.use(VueTimeago, {
        name: 'timeago',
        locale: 'en-US'
    });

    export default {
        props: ['user_id', 'notification_id'],
        data() {
            return {
                notifications: [],
                isFetching: true
            }
        },
        created() {
            if (Laravel.userId)
            {
                this.fetchNotifications();
                this.isFetching = false;
            }
        },
        mounted() {
            Echo.channel('memebook-channel.' + this.user_id)
            .listen('NewNotification', (notification) => {
                if (notification.notificationType.includes("UserFollowed"))
                {
                    console.log('Upada');
                    let notif = {
                        description: 'User: ' + notification.fromUserName + ' is now following you.',
                        notificationId: this.notification_id,
                        time: new Date(notification.created_at)
                    };
                    this.notifications.push(notif);
                }
            });
        },
        methods: {
            async fetchNotifications() {
                await $.ajax('/user/notifications').done(data => {
                    data.forEach(notification => 
                    {
                        this.notifications.push({
                            description: 'User: ' + notification.data.follower_name + ' is now following you.',
                            notificationId: notification.id,
                            time: new Date(notification.created_at)
                        });
                        console.log(new Date(notification.created_at));
                    });
                });
            },
            readNotification(notificationId){
                $.ajax({
                    type: 'POST',
                    url: '/user/notification/read',
                    data: notificationId,
                    contentType: 'application/json',
                    headers: {
                        'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content')
                    },
                })
                .done((followerId) => {
                    window.location = '/users/' + followerId;
                })
            }
        }
    }
</script>