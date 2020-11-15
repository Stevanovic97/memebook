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
                        <a @click="readNotification(notification.notificationId)" class="d-flex">
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
        props: {
            user_id: String,
            notification_id: String,
            all_notifications_route: { type: String, required: true },
            read_notification_route: { type: String, required: true }
        },
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
                this.notifications.push(this.createNotification(notification));
            });
        },
        methods: {
            async fetchNotifications() {
                await $.ajax(this.all_notifications_route).done(data => {
                    data.forEach(notification => 
                    {
                        this.notifications.push(this.createNotification(notification));
                    });
                });
            },
            createNotification(notification) {
                var notification = {
                    notificationId: notification.id,
                    time: new Date(notification.created_at),
                    description: this.createDescription(notification)
                };
                return notification;
            },
            createDescription(notification) {
                let followerName = this.isUndefined(notification.data) ? notification.fromUserName
                                                                       : notification.data.follower_name;
                let notificationType = this.isUndefined(notification.type) ? notification.notificationType
                                                                           : notification.type;
                if (notificationType.includes("UserFollowed"))
                {
                    return 'User: ' + followerName + ' is now following you.';
                }
                else if(notificationType.includes("NewMeme"))
                {
                    return 'User you are following ' + followerName + ' has posted a new meme.';
                }
            },
            readNotification(notificationId) {
                $.ajax({
                    type: 'POST',
                    url: this.read_notification_route,
                    data: notificationId,
                    contentType: 'application/json',
                    headers: {
                        'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content')
                    },
                })
                .done((url) => {
                    window.location = url;
                })
            },
            isUndefined(type) {
                return typeof type === 'undefined';
            }
        }
    }
</script>