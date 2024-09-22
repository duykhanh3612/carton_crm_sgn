<style>
    :root {
        @foreach(get_options_keynum_data("config_color") as $key=>$opt)
        --{{@$key}}: {{ @$opt}};
        @endforeach
    }
</style>