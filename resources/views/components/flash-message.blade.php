@if (session('success'))
    <div 
        x-data="{show: true}" x-init="setTimeout(() => show = false, 3000)" x-show="show"
        class="position-absolute top-0 start-50 translate-middle-x bg-success py-2 px-5 text-white rounded"
    >
        {{ session('success') }}
    </div>
@endif