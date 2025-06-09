@props([
'project',
'averageClientRate',
'clientNumberOfReceivedRatings'
])

<section class="mb-5">
    <p>
        <span class="font-semibold">
            {{ $project->client->name }} -
        </span>
        <span class="font-bold">
            {{ round($averageClientRate) }} ({{ $clientNumberOfReceivedRatings }})
        </span>
    </p>
</section>