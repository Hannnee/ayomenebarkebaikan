@if (Session::has('status'))
    <div class="alert {{Session::get('alert')}} alert-icon alert-{{Session::get('status')}} alert-dismissible letter-space-1" role="alert">
        <em class="icon ni ni-alert-circle"></em>
        {{Session::get('messages')}}
        <button class="close" data-bs-dismiss="alert"></button>
    </div>
@endif
