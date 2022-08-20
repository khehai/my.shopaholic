      
<section class="py-5">
    <!--Section: Contact v.2-->

    <!--Section heading-->
    <h2 class="h1-responsive font-weight-bold text-center my-4">Contact us</h2>
    <!--Section description-->
    <p class="text-center w-responsive mx-auto mb-5">Do you have any questions? Please do not hesitate to
        contact us directly. Our team will come back to you within
        a matter of hours to help you.</p>

    <div class="row">

        <!--Grid column-->
        <div class="col-md-9 mb-md-0 mb-5">
            <form id="contact-form" name="contact-form" action="" method="POST">

                <!--Grid row-->
                <div class="row">

                    <!--Grid column-->
                    <div class="col-md-6">
                        <div class="md-form mb-0">
                            <label for="name" class="">Your name *</label>
                            <input type="text" id="name" name="name" class="form-control" placeholder="Enter your Name" required="required">
                            
                        </div>
                    </div>
                    <!--Grid column-->

                    <!--Grid column-->
                    <div class="col-md-6">
                        <div class="md-form mb-0">
                            <label for="email" class="">Your email *</label>
                            <input type="email" id="email" name="email" class="form-control" placeholder="Enter your  email" required="required">
                            
                        </div>
                    </div>
                    <!--Grid column-->

                </div>
                <!--Grid row-->

                <!--Grid row-->
                <div class="row">
                    <div class="col-md-12">
                        <div class="md-form mb-0">
                            <label for="subject" class="">Subject *</label>
                            <input type="text" id="subject" name="subject" class="form-control" placeholder="Enter your subject" required="required">
                        
                        </div>
                    </div>
                </div>
                <!--Grid row-->

                <!--Grid row-->
                <div class="row">

                    <!--Grid column-->
                    <div class="col-md-12">

                        <div class="md-form">
                            <label for="message">Your message *</label>
                            <textarea type="text" id="message" name="message" rows="5"
                                class="form-control md-textarea" placeholder="Enter your message" required="required"></textarea>
                        
                        </div>

                    </div>
                </div>
                <!--Grid row-->
                <div class="col-sm-12 text-center">
                    <button class="btn btn-primary" type="submit">Send message</button>
                </div>

            </form>
        </div>
    
        <!--Grid column-->
        <?php if (isset($address)):?>
        <div class="col-md-3 text-center">
            <ul class="list-unstyled mb-0">
                <li><i class="fas fa-map-marker-alt fa-2x"></i>
                    <p><?=$address['street']?>, <?=$address['city']?>, <?=$address['zip']?>, <?=$address['country']?></p>
                </li>

                <li><i class="fas fa-phone mt-4 fa-2x"></i>
                    <p><?=$address['phone']?></p>
                </li>

                <li><i class="fas fa-envelope mt-4 fa-2x"></i>
                    <p><?=$address['email']?></p>
                </li>
            </ul>
        </div>
        <?php endif?>
        <!--Grid column-->

    </div>


</section>

<section class="review">
    <?php if(isset($messages)):?>
    <div class="p-3 p-md-5">
        <p class="small text-muted mb-1">Based on <?php echo count($messages);?>
            customers</p>
        <h5 class="mb-4">How customers reviewed this store</h5>
        <div class="row">
            <?php foreach ($messages as $row):?>            
                <div class="col-lg-6">
                    <div class="d-flex mb-4"><img class="rounded-circle p-1 shadow-sm flex-grow-1 align-self-baseline" 
                    src="/images/user.png" alt="..." width="60" height="60">
                    <div class="ms-3">
                        <h3 class="h6 mb-0"><?=$row['name']?></h3>
                        <p class="text-gray small mb-0"><?=$row['created_at']?></p>
                        <p class="text-small text-muted"><?=$row['message']?></p>
                    </div>
                    </div>
                </div>
            <?php endforeach?>    
        </div>
    </div> 

    <?php endif?>
</section>
        
