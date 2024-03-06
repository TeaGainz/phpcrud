<?php
include 'functions.php';

$video = $_GET['video'] ?? '';

// Load the video based on the $video variable
switch ($video) {
    case 'create':
        $selected_video = 'video1.mp4';
        break;
    case 'delete':
        $selected_video = 'video2.mp4';
        break;
    case 'configure':
        $selected_video = 'video3.mp4';
        break;
    case 'search':
        $selected_video = 'video4.mp4';
        break;
    default:
        $selected_video = 'default.mp4';
        break;
}

?>

<?= template_header('Home') ?>
<style>
    .video-section {
    display: flex;
    justify-content: center;
    align-items: top;
    height: 100%;
    margin-top: 3%;
}

.video-container {
    position: relative;
    width: 100%;
    /* Adjust the width as needed */
}

.hover-video {
    
    width: 100%;
    height: auto;
    display: block;
    margin: 0 auto;
    opacity: 0.7;
    /* Adjust the opacity as needed */
    transition: opacity 0.3s ease;
}

.hover-video:hover {
    opacity: 1;
}

.hover-video:hover::after {
    content: "\25BA";
    /* Unicode character for the play button (▶) */
    font-size: 4em;
    position: absolute;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%);
    color: white;
    cursor: pointer;
    transition: opacity 0.3s ease;
}
</style>
<section class="video-section">
    <div class="video-container">
        <video id="hoverVideo" class="hover-video" autoplay loop muted>
            <source src="<?php echo $selected_video; ?>" type="video/mp4">
        </video>
    </div>
</section>

<script src="video-script.js"></script>

<?= template_footer() ?>