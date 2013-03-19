{{-- template used by the CompositeWidgetBuilder --}}
@section('widget')
<div class="wayne-widget" title="{{ $widget->part('title') }}" style="{{ $widget->part('style') }}">
  <div class="wayne-widget-body">  

  {{-- Render buttons/badgets defined for this widget --}}
  @section('buttons')
    @foreach($widget->part('buttons') as $button)
      <a class="wayne-button" href="{{ $button->href }}" target="{{ $button->target }}" {{ $button->color ? "style=\"background: {$button->color}\"" : ''}}>
        {{ $button->label }}<!--
      --></a>
    @endforeach
  @show

  @section('text')
    @if($widget->hasPart('text'))
    <span class="wayne-text">{{ $widget->part('text') }}</span>
    @endif
  @show

  </div>
</div>
@show
