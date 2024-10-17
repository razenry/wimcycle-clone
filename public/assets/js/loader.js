function showLoader(elementId, options = {}) {
    const element = document.getElementById(elementId);

    // Create the loader overlay if it doesn't exist
    let loaderOverlay = element.querySelector('.loader-overlay');
    if (!loaderOverlay) {
        loaderOverlay = document.createElement('div');
        loaderOverlay.className = 'loader-overlay';
        element.appendChild(loaderOverlay);
    }

    // Create the loader element if it doesn't exist
    let loader = loaderOverlay.querySelector('.modern-loader');
    if (!loader) {
        loader = document.createElement('div');
        loader.className = 'modern-loader';
        loaderOverlay.appendChild(loader);
    }

    // Apply dynamic size if provided, otherwise use default size
    const loaderSize = options.size || '40px';
    loader.style.width = loaderSize;
    loader.style.height = loaderSize;

    // Apply dynamic color if provided, otherwise use default orange
    const loaderColor = options.color || 'rgba(255, 140, 0, 1)';
    loader.style.borderTop = `5px solid ${loaderColor}`;

    // Show the loader
    loaderOverlay.style.display = 'flex';

    // Automatically hide loader after specified time, if provided
    if (options.autoHideTime) {
        setTimeout(() => hideLoader(elementId), options.autoHideTime);
    }
}

function hideLoader(elementId) {
    const element = document.getElementById(elementId);
    const loaderOverlay = element.querySelector('.loader-overlay');

    // Hide the loader overlay if it exists
    if (loaderOverlay) {
        loaderOverlay.style.display = 'none';
    }
}
