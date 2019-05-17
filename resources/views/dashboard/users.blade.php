<div class="mb-12">
    <div class="mb-6">
        <div class="text-xl tracking-wide mb-1">Users</div>
        <div class="text-grey-dark text-sm tracking-wide">Manage users of the application</div>
    </div>
    <users-table :auth="{{ Auth::id() }}"></users-table>
</div>