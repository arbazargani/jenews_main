<?php
echo '<?xml version="1.0" encoding="UTF-8"?>';
?>
<feed xmlns="http://www.w3.org/2005/Atom">

  <title>{{ env('APP_NAME') }}</title>
  <link rel="self" href="{{ route('Rss') }}"/>
  <updated><?php echo date('Y-m-d\TH:i:sP', strtotime($lastModified->updated_at)); ?></updated>
  <author>
    <name>{{ env('APP_NAME') }}</name>
  </author>
  <id>{{ env('APP_URL') . '/' }}</id>
  @yield('content')
</feed>
