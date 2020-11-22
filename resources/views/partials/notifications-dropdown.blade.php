@if(isset($notification_id))
    <notifications-status user_id="{{ auth()->user()->id }}"
                          notification_id="{{ $notification_id }}"
                          all_notifications_route="{{ route('notifications') }}"
                          read_notification_route="{{ route('read.notification') }}">
    </notifications-status>
@else
    <notifications-status user_id = "{{ auth()->user()->id }}"
                          notification_id = ""
                          all_notifications_route="{{ route('notifications') }}"
                          read_notification_route="{{ route('read.notification') }}">
    </notifications-status>
@endif