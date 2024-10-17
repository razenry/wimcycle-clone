<style>
    /* Loader container styling */
    .loader-overlay {
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background-color: rgba(0, 0, 0, 0.2);
        /* Reduced darkness */
        display: flex;
        justify-content: center;
        align-items: center;
        z-index: 9999;
    }

    /* Modern, elegant loader styling */
    .modern-loader {
        width: 60px;
        height: 60px;
        border: 8px solid rgba(255, 166, 0, 0.3);
        /* Transparent orange border */
        border-top: 8px solid rgba(255, 166, 0, 1);
        /* Solid orange-gold border */
        border-radius: 50%;
        animation: spin 1.2s cubic-bezier(0.4, 0.0, 0.2, 1) infinite;
        /* Smoother animation */
    }

    /* Smooth spinning animation */
    @keyframes spin {
        0% {
            transform: rotate(0deg);
        }

        100% {
            transform: rotate(360deg);
        }
    }
</style>

<div id="loader-overlay" class="loader-overlay">
    <div class="modern-loader"></div>
</div>

<script>
    // Show loader before the page starts unloading
    window.addEventListener('beforeunload', function() {
        document.getElementById('loader-overlay').style.display = 'flex';
    });

    // Hide loader once the page has fully loaded
    window.addEventListener('load', function() {
        document.getElementById('loader-overlay').style.display = 'none';
    });
</script>