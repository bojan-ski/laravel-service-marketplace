@props([
'project',
'averageClientRate',
'numberOfReceivedRatings'
])

<section class="mb-5">
    <p>
        <span class="font-semibold">
            {{ $project->client->name }} - average rating:
        </span>
        <span class="font-bold">
            {{ round($averageClientRate) }} ({{ $numberOfReceivedRatings }})
        </span>
    </p>
</section>