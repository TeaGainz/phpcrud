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

<section class="video-section">
    <div class="video-container">
        <video id="hoverVideo" class="hover-video" autoplay loop muted oncontextmenu="return false;">
            <source src="<?php echo $selected_video; ?>" type="video/mp4">
        </video>
    </div>
</section>

<script src="video-script.js"></script>

<?= template_footer() ?>