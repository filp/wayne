<div id="wayne-debug" class="wayne-toolbar-outer">
<!-- You're seeing this toolbar because wayne is enabled.
     If you think this toolbar shouldn't have been visible for this request,
     please file an issue report @ https://github.com/filp/wayne -->
  @include('wayne::style')
  <div class="wayne-toolbar">
    <div class="wayne-logo wayne-widget">
      <a href="https://github.com/filp/wayne" class="wayne-branding wayne-widget-body" target="_blank">w</a>
    </div>

    @foreach($widgets as $widget)
      {{ $widget->render() }}
    @endforeach
  </div>
</div>