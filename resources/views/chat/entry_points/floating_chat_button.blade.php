<!-- 
    FLOATING CHAT BUTTON
    Add this to your main layout file before </body>
    This will show a floating chat button on all pages
-->

@auth('nurse_middle')
<div id="floatingChatButton" 
     onclick="window.location.href='{{ Auth::user()->role === 1 ? route("nurse.chat.index") : route("healthcare.chat.index") }}'"
     style="position: fixed; bottom: 25px; right: 25px; width: 65px; height: 65px; 
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); 
            border-radius: 50%; display: flex; align-items: center; justify-content: center; 
            color: white; font-size: 26px; cursor: pointer; box-shadow: 0 4px 15px rgba(102, 126, 234, 0.4); 
            z-index: 9999; transition: all 0.3s ease;"
     onmouseover="this.style.transform='scale(1.1)'" 
     onmouseout="this.style.transform='scale(1)'">
    <i class="fas fa-comment-dots"></i>
    <span id="floatingChatBadge" 
          style="position: absolute; top: -5px; right: -5px; background: #ff4757; color: white; 
                 font-size: 11px; font-weight: bold; padding: 4px 8px; border-radius: 12px; 
                 display: none; border: 2px solid #fff;">0</span>
</div>

<script>
(function() {
    function updateFloatingBadge() {
        fetch('{{ Auth::user()->role === 1 ? route("nurse.chat.unread_count") : route("healthcare.chat.unread_count") }}')
            .then(response => response.json())
            .then(data => {
                const badge = document.getElementById('floatingChatBadge');
                if (data.unread_count > 0) {
                    badge.textContent = data.unread_count > 99 ? '99+' : data.unread_count;
                    badge.style.display = 'block';
                } else {
                    badge.style.display = 'none';
                }
            })
            .catch(err => console.error('Chat badge error:', err));
    }
    
    // Update every 30 seconds
    updateFloatingBadge();
    setInterval(updateFloatingBadge, 30000);
})();
</script>
@endauth
