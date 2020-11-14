@if(isset($notification_id))
    <notifications-status user_id = "{{ auth()->user()->id }}"
                          notification_id = "{!! $notification_id !!}">
    </notifications-status>
@else
    <notifications-status user_id = "{{ auth()->user()->id }}"
                          notification_id = "">
    </notifications-status>
@endif