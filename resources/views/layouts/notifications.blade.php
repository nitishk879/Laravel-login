@if(Session::has('success') || Session::has('status'))
    @php $message = Session::get('success') ?? Session::get('status'); $type="success"; $alertTitle="Congratulation" @endphp
    <x-alert :type="$type" :message="$message" :alertTitle="$alertTitle" />
@elseif(Session::has('warning'))
    @php $message = Session::get('warning'); $type="warning"; $alertTitle="Ah" @endphp
    <x-alert :type="$type" :message="$message" :alertTitle="$alertTitle"/>
@elseif(Session::has('error'))
    @php $message = Session::get('error'); $type="danger"; $alertTitle="Oops" @endphp
    <x-alert :type="$type" :message="$message" :alertTitle="$alertTitle" />
@else
    @php $message=""; $type=""; $alertTitle=""; @endphp
@endif
