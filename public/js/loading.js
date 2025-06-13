document.addEventListener('DOMContentLoaded', function () {
    // if on conversation.show page -> form: no loading
    const conversationForm = document.getElementById('message-form');
    if (conversationForm) return;

    // display loading on form submission
    document.querySelectorAll('form').forEach(form => {
        form.addEventListener('submit', function () {
            document.getElementById('loading').classList.remove('hidden');
        });
    });

    // display loading on page navigation
    document.querySelectorAll('a').forEach(link => {
        const href = link.getAttribute('href');

        if (!href.startsWith('#')) {
            link.addEventListener('click', function () {
                document.getElementById('loading').classList.remove('hidden');
            });
        }
    });
});