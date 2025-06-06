document.addEventListener('DOMContentLoaded', async function() {
    const notificationBadge = document.getElementById('message-notification-badge');
    
    if (!notificationBadge) return;
    
    async function updateUnreadMessageBadge() {                
        try {
            const response = await fetch('/check_for_new_messages');
            
            if (!response.ok) {
                throw new Error('Network error!');
            }
            
            const data = await response.json();         
            
            if (data.count > 0) {
                notificationBadge.classList.remove('hidden');
            } else {
                notificationBadge.classList.add('hidden');
            }
        } catch (error) {
            throw new Error('Network error!');
        }
    }
    
    await updateUnreadMessageBadge();
    
    // check if new message every 60s
    setInterval(updateUnreadMessageBadge, 60000);
});