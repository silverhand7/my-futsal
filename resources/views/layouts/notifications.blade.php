@if ($notifications->count() != 0)
    @foreach ($notifications as $notification)
        <?php
            $data = json_decode($notification->data);
        ?>
        <div id="{{ $notification->id }}" class="px-2 notification-item">
            <a href="{{ $data->actionUrl }}">
                <div>{{ $data->message }}</div>
            </a>
        </div>
        @if (!$loop->last)
            <hr>
        @endif
    @endforeach
@endif