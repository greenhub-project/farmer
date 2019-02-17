<div class="mb-12">
  <div class="mb-6">
      <div class="text-xl tracking-wide mb-1">API Credentials</div>
      <div class="text-grey-dark text-sm tracking-wide">For more information, visit the documentation at <a class="text-grey-dark hover:underline no-underline" href="https://docs.greenhubproject.org">https://docs.greenhubproject.org</a></div>
  </div>
  <api-credentials-table :user="{{ auth()->user() }}" token="{{ auth()->user()->api_token }}"></api-credentials-table>
</div>