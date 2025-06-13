export async function receivedMessage() {
    const uri = window.location.href.split('/');
    const conversation = uri[uri.length - 1];
    
    try {
        const response = await fetch(`/conversations/${conversation}`);

        if (!response.ok) {
            throw new Error('Network error!');
        }
    } catch (error) {
        throw new Error('Network error!');
    }
}