@if (session('status'))
  <push-notification status="{{ session('status') }}"></push-notification>
@endif