@props(['project'])

<div id="countdown-timer" data-deadline="{{ \Carbon\Carbon::parse($project->deadline)->toIso8601String() }}"
    class="text-center mb-7 border w-max mx-auto p-5">

    {{-- Bid timer --}}
    <div id="timer">
        <h3 class="text-2xl font-semibold mb-2">
            Bidding Closes In:
        </h3>

        <div class="flex justify-center space-x-4">
            <p class="font-bold text-xl">
                <span id="days">00</span>
                <span class="block">Days</span>
            </p>
            <p class="font-bold text-xl">
                <span id="hours">00</span>
                <span class="block">Hours</span>
            </p>
            <p class="font-bold text-xl">
                <span id="minutes">00</span>
                <span class="block">Minutes</span>
            </p>
            <p class="font-bold text-xl">
                <span id="seconds">00</span>
                <span class="block">Seconds</span>
            </p>
        </div>
    </div>

    {{-- Bid close message --}}
    <div id="times-up-message" class="text-red-500 font-bold hidden">
        <h3 class="text-3xl font-semibold">
            Bidding has closed!
        </h3>        
    </div>
</div>