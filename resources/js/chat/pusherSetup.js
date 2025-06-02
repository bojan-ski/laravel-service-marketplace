// pusher setup
export function initializePusher(csrfToken) {
    return new window.Pusher(window.Echo.options.key, {
        cluster: window.Echo.options.cluster,
        encrypted: true,
        authEndpoint: '/broadcasting/auth',
        auth: { headers: { 'X-CSRF-TOKEN': csrfToken } }
    });
}

// channel setup
export function subscribeToChannel(pusher, chatHash, eventHandlers = {}) {
    const channel = pusher.subscribe(`private-chat.${chatHash}`);

    for (const eventName in eventHandlers) {
        channel.bind(eventName, eventHandlers[eventName]);
    }

    return channel;
}