<template>
    <div :v-if="!isFetching">
        <div class="icon" @click="toggleNotificationDropdown()" width="100%" height="100%">
            <a>
                <img src="/images/Notification_image.png" style="cursor: pointer;" class="dropbtn" alt="none" width="100%" height="100%"/>
                <span class="txt" v-if="this.notificationsCount > 0">{{ this.notificationsCount }}</span>
                <span class="caret"></span>
            </a>
            <ul class="dropdown-menu dropdown-menu-right dropdown-menu-notifications" id="notificationsMenu">
                <li v-for="notification in notifications">
                    <a @click="readNotification(notification.notificationId)" href="" class="d-flex">
                        <notification :notification="notification"></notification>
                    </a>
                    <div class="divider"></div>
                </li>
                <li>
                    <div class="text-center notifications-read">
                        <a @click="readAllNotifications()" style="cursor: pointer;" v-if="this.notificationsCount > 0">
                            <strong>Read all notifications</strong>
                            <i class="fa fa-angle-right"></i>
                        </a>
                        <div class="divider"></div>
                        <a href="notifications.html" v-if="this.notifications.length > 0">
                            <strong>See All Alerts</strong>
                            <i class="fa fa-angle-right"></i>
                        </a>
                        <div v-else>No notifications</div>
                    </div>
                </li>
            </ul>
        </div>
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
            read_notification_route: { type: String, required: true },
            read_notifications_route: { type: String, required: true }
        },
        data() {
            return {
                notifications: [],
                notificationsCount: 0,
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
                this.notifications.unshift(this.createNotification(notification));
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
                if (!notification.read_at)
                    this.notificationsCount++;

                var notificationBar = {
                    style: notification.read_at ? 'color: rgb(101, 103, 107);'
                                                : 'color: #000000;',
                    mark: notification.read_at ? 'fa fa-check fa-fw;'
                                               : 'fa fa-exclamation-circle fa-fw',
                    notificationId: notification.id,
                    time: new Date(notification.created_date),
                    isRead: notification.read_at ? true : false,
                    description: this.createDescription(notification),
                };
                return notificationBar;
            },
            createDescription(notification) {
                let followerName = notification.fromUserName;
                let followerAvatar = notification.fromUserAvatar;
                let notificationType = notification.notifiable_type;
                if (notificationType.includes('UserFollowed'))
                {
                    return '<image src=' + followerAvatar + '></image> ' + followerName + ' is now following you.';
                }
                else if(notificationType.includes('NewMeme'))
                {
                    return 'User you are following ' + followerName + ' <image scr=' + followerAvatar + '></image> has posted a new meme.';
                }
            },
            readNotification(notificationId) {
                $.ajax({
                    type: 'POST',
                    headers: {
                        'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content')
                    },
                    url: this.read_notification_route,
                    data: { notificationId: notificationId },
                    success: function(url) {
                        window.location = url;
                    },
                    error: function($message) {
                        //[TODO]: show toast message
                    }
                });
            },
            readAllNotifications() {
                 var vm = this;
                 $.ajax({
                    type: 'GET',
                    url: this.read_notifications_route,
                    dataType: 'json',
                    success: function(xml, textStatus, xhr) {
                        if (xhr.status == 200)
                        {
                            vm.notifications.forEach(notification => {
                                if (!notification.isRead)
                                {
                                    notification.style = 'color: rgb(101, 103, 107);';
                                    notification.mark = 'fa fa-check fa-fw;';
                                }
                            });
                            vm.notificationsCount = 0;
                        }
                    },
                    error: function(xml, textStatus, xhr) {
                        if (xhr.status == 500) 
                        {
                            //[TODO]: handle this; integrate toast for better user error experience
                        }
                        else if (xhr.status == 401)
                        {
                            window.location.href = '/login';
                        }
                    }
                });
            },
            toggleNotificationDropdown() {
                $('#notificationsMenu').toggle('show');
            },
            isUndefined(type) {
                return typeof type === 'undefined';
            }
        }
    }
</script>