<?php
include 'functions.php';
$video_link = 'video1.mp4';
?>

<?= template_header('Home') ?>

<section class="video-section">
    <div class="video-container">
        <video id="hoverVideo" class="hover-video" playsinline loop muted>
            <source src="<?php echo $video_link; ?>" type="video/mp4">
        </video>
    </div>

</section>

<script src="video-script.js"></script>

<?= template_footer() ?>