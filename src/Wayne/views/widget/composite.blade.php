{{-- template used by the CompositeWidgetBuilder --}}
<div class="wayne-widget" title="{{ $widget->part('title') }}" style="{{ $widget->part('style') }}">
  <div class="wayne-widget-body">  

  {{-- Render buttons/badgets defined for this widget --}}
  @foreach($widget->part('buttons') as $button)
    @if(!empty($button->href))
    {{-- Does it have an href property? It's a clickable thing! --}}
    <a class="wayne-button" href="{{ $button->href }}" target="{{ $button->target }}" {{ $button->color ? "style=\"background: {$button->color}\"" : ''}}>
      {{ $button->label }}<!--
    --></a>
    @else
    {{-- Does it NOT have an href property? It's a stinkin' badge! --}}
    <span class="wayne-button" {{ $button->color ? "style=\"background: {$button->color}\"" : ''}}>
      {{ $button->label }}<!--
    --></span>
    @endif
  @endforeach

  @if($widget->hasPart('text'))
  <span class="wayne-text">{{ $widget->part('text') }}</span>
  @endif
  
  </div>
</div>
