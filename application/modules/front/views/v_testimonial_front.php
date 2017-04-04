<div class="container-fluid" id="testimonial">
    <div class="container testimoni-container">
        <div class="testimonial">
            <div class="title-content">
                <h2>CLIENTS RECOMENDATION</h2>
                <hr><i class="fa fa-scissors" aria-hidden="true"></i>
            </div>
            <div class="customNavigation">
                <a class="prev"><i class="fa fa-chevron-circle-left" aria-hidden="true"></i></a>
                <a class="next"><i class="fa fa-chevron-circle-right" aria-hidden="true"></i></a>
            </div>
            <div id="testimoni">
                <?php foreach ($data_testimonial->result() as $r): ?>
                    <div class="item">
                        <div class="images-testimoni">
                            <?php echo '<img class="img-responsive" src="'.base_url().'/uploads/testimonial/'.$r->testimonial_photo.'" alt="...">' ?>
                        </div>
                        <div class="content-testimoni">
                            <i>" <?php echo $r->testimonial_desc?> "</i>
                            <hr>
                            <h4><?php echo  $r->testimonial_name ?></h4>
                        </div>
                    </div>
                <?php endforeach ?>
            </div>
        </div>
    </div>
</div>
