@if(!empty($data['toastr']))
    @php
        $type     = "bg-" . \Illuminate\Support\Arr::get($data['toastr']->get('type'), 0, 'success');
        $message  = \Illuminate\Support\Arr::get($data['toastr']->get('message'), 0, '');
        $options  = $data['toastr']->get('options', []);
        $autohide = !empty($options['timeout']);
        $delay    = ($options['timeout'] ?? 60) * 1000;
        $title    = $options['title'] ?? '';
        $subtitle    = $options['subtitle'] ?? '';
        $position    = $options['position'] ?? 'topRight';
        $icon    = $options['icon'] ?? '';
        $image    = $options['image'] ?? '';
        $imageAlt    = $options['imageAlt'] ?? '';
    @endphp

    <script type="text/javascript">
        $(document).Toasts('create', {
            class: "{!!  $type !!}",
            title: "{!! $title !!}",
            autohide: true,
            position: "{!! $position !!}",
            delay: {!! $delay !!},
            subtitle: "{!! $subtitle !!}",
            body: "{!! $message !!}",
            icon: "{!! $icon !!}",
            image: "{!! $image !!}",
            imageAlt: "{!! $imageAlt !!}",
        })
    </script>
@endif