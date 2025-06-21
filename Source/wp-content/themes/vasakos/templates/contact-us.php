<div class="contact_wrap position-relative">
    <span class="position-absolute lens camera-lens">
        <img width="50" height="50" alt="lens" src="<?php echo get_stylesheet_directory_uri() . '/assets/images/camera.svg'; ?>">
    </span>
    <div class="wrapper img" style="background: #F5F5F5;">
        <div class="row position-relative">
            <div class="contact-wrap col-12 col-md-8 p-md-5 p-4">
                <h3 class="mb-4">Get in touch</h3>
                <form method="POST" id="contactForm" name="contactForm" class="contactForm color-dark" novalidate="novalidate">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="label" for="name">Full Name</label>
                                <input type="text" class="form-control" name="name" id="name" placeholder="Name">
                                <div data-lastpass-icon-root="true" style="position: relative !important; height: 0px !important; width: 0px !important; float: left !important;"></div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="label" for="email">Email Address</label>
                                <input type="email" class="form-control" name="email" id="email" placeholder="Email">
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label class="label" for="subject">Subject</label>
                                <input type="text" class="form-control" name="subject" id="subject" placeholder="Subject">
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label class="label" for="#">Message</label>
                                <textarea name="message" class="form-control" id="message" cols="30" rows="10" placeholder="Message"></textarea>
                            </div>
                        </div>
                        <div class="g-recaptcha" data-sitekey="6LfORqslAAAAAO_VAaiMqqHSSV_Mi22qaNt7D1w7"></div>

                        <div class="col-md-12">
                            <div class="form-group">
                                <input type="submit" value="Send Message" class="btn alime-btn btn-2 mt-15">
                                <div class="submitting"></div>
                            </div>
                        </div>
                        <div id="form-message-success" class="mb-4"></div>
                    </div>
                </form>
            </div>
            <div class="col-12 col-md-4 p-md-5 p-4">
                <h3 class="mb-4">Find me on social</h3>
                <div class="rounded-10 socials_contact">
                    <ul class="">
                        <li>
                            <a href="#">
                                <i class="fab fa-facebook" aria-hidden="true"></i>
                                <span> - Facebook</span>
                            </a>
                        </li>
                        <li>
                            <a href="#">
                                <i class="fab fa-instagram" aria-hidden="true"></i>
                                <span> - Instagram</span>
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>