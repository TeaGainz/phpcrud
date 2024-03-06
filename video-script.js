document.addEventListener('DOMContentLoaded', function () {
    var hoverVideo = document.getElementById('hoverVideo');

    hoverVideo.addEventListener('mouseover', function () {
        if (hoverVideo.paused) {
            hoverVideo.play();
        }
    });

    hoverVideo.addEventListener('mouseout', function () {
        hoverVideo.play();
    });
});
