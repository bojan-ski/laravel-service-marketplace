@props([
    'project',
    'divCss' => '',
    'paragraphCss' => ''
])

<div class="{{ $divCss }}">
    <p class="mr-2 {{ $paragraphCss }}">
        {{ strtoupper($project->budget_type) }}:
    </p>
    @if ($project->budget_type == 'fixed')
        <p class="{{ $paragraphCss }}">
            $ {{ $project->budget_amount }}
        </p>
    @else
        <p class="{{ $paragraphCss }}">
            $ {{ $project->hour_price }}
        </p>
    @endif
</div>
