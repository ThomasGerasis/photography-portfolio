 <?php
    $settings = get_option('basic_settings');
    ?>
 <div class="contact_wrap container position-relative mb-50p mt-40p">
     <?php if (!$GLOBALS['is_mobile']) { ?>
         <div class="position-absolute camera-lens" style="right: -6%; top: -2%;">
             <img alt="lens" src="<?php echo get_stylesheet_directory_uri() . '/assets/images/lensdivider.svg' ?>" width="355" height="460" class="d-block img-fluid" loading="lazy">
         </div>
     <?php } ?>
     <div class="wrapper img">
         <div class="row container__main m-auto position-relative">
             <div class="col-12 col-md-6 p-md-5 p-4">
                 <p class="w-100 d-block heading_title">Contact</p>
                 <h3 class="mb-10p">Got Some Questions ? More than happy to help you !</h3>
                 <a class="mt-10p mb-10p" href=mailto:“<?= $settings['email'] ?? ''; ?>”><?= $settings['email'] ?? ''; ?></a>
                 <ul class="social mt-20p">
                     <li>
                         <a href="<?= $settings['facebook'] ?? ''; ?>" aria-label="Facebook" target="_blank" title="Facebook">
                             <i class="fab fa-facebook"></i>
                         </a>
                     </li>
                     <li>
                         <a href="<?= $settings['instagram'] ?? ''; ?>" aria-label="Instagram" target="_blank" title="Instagram">
                             <i class="fab fa-instagram"></i>
                         </a>
                     </li>

                     <li>
                         <a href="<?= $settings['airbnb'] ?? ''; ?>" aria-label="Airbnb" target="_blank" title="Airbnb">
                             <i class="fab fa-airbnb"></i>
                         </a>
                     </li>

                     <?php if (!empty($settings['whatsapp']) && $settings['whatsapp']) { ?>
                         <li>
                             <a href="https://wa.me/<?= $settings['whatsapp']; ?>" aria-label="Whatsapp" target="_blank" title="Whatsapp">
                                 <i class="fab fa-whatsapp"></i>
                             </a>
                         </li>
                     <?php } ?>
                 </ul>
             </div>
             <div class="contact-wrap col-12 col-md-6 p-md-5 p-4">
                 <form method="POST" id="contactForm" name="contactForm" class="contactForm color-dark" novalidate="novalidate">
                     <div class="row">
                         <div class="col-md-6">
                             <div class="form-group">
                                 <input type="text" required class="form-control" name="name" id="name" placeholder="Your Name*">
                             </div>
                         </div>
                         <div class="col-md-6">
                             <div class="form-group">
                                 <input type="email" required class="form-control" name="email" id="email" placeholder="Your Email*">
                             </div>
                         </div>
                         <?php
                            if (!empty($args['packages'])) { ?>
                             <div class="col-md-12">
                                 <div class="form-group">
                                     <select name="service" id="service" class="form-select form-select-md">
                                         <option value="" disabled selected>Select a service</option>
                                         <?php foreach ($args['packages'] as $id => $package) { ?>
                                             <option value="<?= $id ?>">
                                                 <?= $package['title'] ?>
                                             </option>
                                         <?php } ?>
                                     </select>
                                 </div>
                             </div>
                         <?php } ?>
                         <div class="col-md-12">
                             <div class="form-group">
                                 <textarea name="message" class="form-control" id="message" cols="30" rows="10" placeholder="Message"></textarea>
                             </div>
                         </div>
                         <div class="loader" style="display: none;margin-bottom: 25px;margin-left: auto;margin-right: auto;"></div>

                         <div id="recaptcha" class="g-recaptcha col-12" data-sitekey="6LfORqslAAAAAO_VAaiMqqHSSV_Mi22qaNt7D1w7"></div>
                         <input type="hidden" id="g-recaptcha-response">

                         <div class="col-md-12">
                             <div class="form-group">
                                 <input type="submit" value="SUBMIT MESSAGE" class="btn w-100  submit-btn mt-15">
                                 <div class="submitting"></div>
                             </div>
                         </div>
                         <div id="form-message-success" class="mb-4 w-100 d-block text-center text-success"></div>
                     </div>
                 </form>
             </div>
         </div>
     </div>
 </div>