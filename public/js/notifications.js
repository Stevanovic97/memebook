var notifications = [];

const NOTIFICATION_TYPES = {
    follow: 'App\\Notifications\\UserFollowed'
};

$(document).ready(function () {
    // check if there's a logged in user
    if (Laravel.userId) {
        $.get('/user/notifications', function (data) {
            addNotifications(data, "#notificationsMenu");
        });
    }
});

function addNotifications(newNotifications, target) {
    newNotifications.forEach(notification => {
        notifications.push(notification);
    });
    // show only last 5 notifications
    //notifications.slice(0, 5);
    showNotifications(notifications, target);
}

function showNotifications(notifications, target) {
    const htmlTag = $(target);
    if (notifications.length) {
        var htmlElements = notifications.map(function (notification) {
            return makeNotification(notification);
        });
        $(target).append(htmlElements.join(''));
        $(target).addClass('has-notifications')
    } else {
        $(target).append('<li role="presentation" class="dropdown-header">No notifications</li>');
        $(target).removeClass('has-notifications');
    }
}

function makeNotification(notification) {
    var to = routeNotification(notification);
    var notificationText = makeNotificationText(notification);
    return '<li><a href="' + to + '">' + notificationText + '</a></li>';
}

// get the notification route based on it's type
function routeNotification(notification) {
    var to = '/' + notification.id;
    if (notification.type === NOTIFICATION_TYPES.follow) {
        to = 'user' + to;
    }
    return '/' + to;
}

// get the notification text based on it's type
function makeNotificationText(notification) {
    var text = '';
    if (notification.type === NOTIFICATION_TYPES.follow) {
        const name = notification.data.follower_name;
        text += '<strong>' + name + '</strong> followed you';
    }
    return text;
}
