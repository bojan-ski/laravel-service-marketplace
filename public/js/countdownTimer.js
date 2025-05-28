document.addEventListener('DOMContentLoaded', function () {
    const timerContainer = document.getElementById('countdown-timer');

    // if no timerContainer
    if (!timerContainer) return;

    // get data deadline from blade component
    const deadlineString = timerContainer.dataset.deadline;
    // convert to milliseconds
    const deadline = new Date(deadlineString).getTime();

    // get variables
    const daysSpan = document.getElementById('days');
    const hoursSpan = document.getElementById('hours');
    const minutesSpan = document.getElementById('minutes');
    const secondsSpan = document.getElementById('seconds');
    const timer = document.getElementById('timer');
    const timesUpMessage = document.getElementById('times-up-message');
    const bidOption = document.getElementById('bid-option');

    // set interval
    let interval = null;

    // format data - time
    function formatTime(time) {
        return time < 10 ? '0' + time : '' + time;
    }

    // run func
    function updateCountdown() {
        // get current time in milliseconds
        const now = new Date().getTime();
        // difference/distance between deadline & now
        const distance = deadline - now;

        // if deadline reached
        if (distance < 0) {
            clearInterval(interval);

            // update blade component
            daysSpan.textContent = '00';
            hoursSpan.textContent = '00';
            minutesSpan.textContent = '00';
            secondsSpan.textContent = '00';

            // disable bid option
            bidOption.style.display = 'none';

            // hide timer
            timer.classList.add('hidden');

            // show times up message
            timesUpMessage.classList.remove('hidden');

            return;
        }

        // calc time components
        const days = Math.floor(distance / (1000 * 60 * 60 * 24));
        const hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
        const minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
        const seconds = Math.floor((distance % (1000 * 60)) / 1000);

        // update blade component
        daysSpan.textContent = formatTime(days);
        hoursSpan.textContent = formatTime(hours);
        minutesSpan.textContent = formatTime(minutes);
        secondsSpan.textContent = formatTime(seconds);
    }

    // initial call to run func
    updateCountdown();

    // update the countdown every one (1) second
    interval = setInterval(updateCountdown, 1000);
});
