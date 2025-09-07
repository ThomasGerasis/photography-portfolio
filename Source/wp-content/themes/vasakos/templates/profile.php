<div id="profile-section" class="d-block mx-auto">
    <div class="wrapper">
        <div class="section-content-wrapper hero-content-wrapper profile_box">
            <div class="hentry-inner align-items-center justify-content-center d-flex flex-wrap">
                <div class="post-thumbnail position-relative w-40 w-sm-100">
                    <?php
                    $height = $GLOBALS['is_mobile'] ? '350' : '650';
                    $width = $GLOBALS['is_mobile'] ? '250' : '450';
                    ?>
                    <a href="" title="Profile">
                        <img width="<?php echo $width; ?>" height="<?php echo $height; ?>" src="<?php echo get_stylesheet_directory_uri() . '/assets/images/about-me.jpg'; ?>" class="rounded-10" alt="profile-photo" decoding="async" loading="lazy">
                    </a>
                </div>
                <div class="entry-container w-40 pl-20p p-sm-0p w-sm-100">
                    <header class="entry-header">
                        <h2 class="section-title entry-title">
                            Hi everyone!
                        </h2>
                    </header>
                    <div class="entry-content">
                        <p>My name is Vasileios Vasakos, I am 31 years old and I am a freelance photographer from Greece. My passion for photography started many years ago and it was triggered by my trips around the world.
                            Instagram has helped me advertise my work and achieve new collaborations. I have created many photographic projects in different countries ranging from landscape photography to portraits and art.
                            I quite often combine photography with hiking, which is one of my hobbies.
                        </p>
                        <p> What I love about my job is that I can create powerful stories through my photos! The old city is full of hidden gems which we will discover together and what’s best than an album full of instagrammable photos to keep as a souvenir from your trip?.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>