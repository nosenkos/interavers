<section class="partners">
    <div class="container">
        <div class="text-center">
            <?php if (get_field('partners_title', 'options')): ?>
                <div class="under_line"><?= get_field('partners_title', 'options'); ?></div>
            <?php endif;
            if (have_rows('partners', 'options')):?>
                <div class="row">
                    <div class="slider flex">
                        <?php
                        while (have_rows('partners', 'options')):
                            the_row(); ?>
                            <div class="img_height col-flex-item">
                                <img src="<?php echo get_sub_field('image_partners'); ?>" alt="">
                            </div>
                        <?php endwhile; ?>
                    </div>
                    <a href="#" class="next-block arrows">
                        <img src="<?php echo get_template_directory_uri() ?>/assets/images/Nextphone.png" alt="">
                    </a>
                    <a href="#" class="prev-block arrows">
                        <img src="<?php echo get_template_directory_uri() ?>/assets/images/Prevphone.png" alt="">
                    </a>
                </div>
                <?php
            endif; ?>
        </div>
    </div>
</section>