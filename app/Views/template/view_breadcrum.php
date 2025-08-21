<!-- Breadcrumb Area -->

<div class="breadcrumb-area">
    <h1><?php echo isset($title) ? $title : ''; ?></h1>

    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="#"><i class='bx bx-home-alt'></i></a></li>
        <?php foreach ($breadcrumb as $label => $url) : ?>
            <?php
            $isAbsolute = (strpos($url, 'http://') === 0 || strpos($url, 'https://') === 0);
            $finalUrl = $isAbsolute ? $url : site_url($url);
            ?>
            <li class="breadcrumb-item active"><a href="<?php echo $finalUrl; ?>"><?php echo $label; ?></a></li>
        <?php endforeach; ?>
    </ol>
</div>

<!-- End Breadcrumb Area -->

<span id="messages"></span>

<div id="loader" class="loader" style="display: none;">
    <div class="spinner-border text-primary" role="status">
        <span class="sr-only">Loading...</span>
    </div>
</div>