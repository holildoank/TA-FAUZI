<div class="container-fluid title-container">
    <div class="container">
        <div class="title-single">
            <h2>OUR SERVICES</h2>
            <p>WO WE DO</p>
            <ol class="breadcrumb">
                <li><a href="<?php echo site_url() ?>">Home</a></li>
                <li class="active">Our Services</li>
            </ol>
        </div>
    </div>
</div>
<div class="container-fluid grey" id="services">
    <div class="container blank">
        <div class="row">
            <div class="col-md-6">
                <div class="title">
                    <h2>OUR SERVICES</h2>
                    <p>WO WE DO</p>
                    <hr><i class="" aria-hidden="true"></i>
                    <p class="content">
                        Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum. Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo.
                    </p>
                </div>
            </div>
            <div class="col-md-6">
              <div class="row">
              <?php
              $no =0;
              $norow=1;
              foreach ($jasa->result() as $r): ?>
              <?php if ($no % 2 == 0): $no++;?>
                    <div class="service">
                        <div class="col-md-6">
                            <div class="service-list">
                                <h3><?php echo @$r->service_name ?> <?php echo $no ?></h3>
                                <div class="content-caption">
                                    Rp. <?php echo @$r->service_harga ?> / <?php echo @$r->hitungan_jam ?> Jam
                                </div>
                            </div>
                            </a>
                        </div>
                    </div>
              <?php else: $no++?>
                <!-- <div class="row"> -->
                  <div class="col-md-6 space-up">
                    <div class="service-list">
                      <h3><?php echo @$r->service_name ?> <?php echo $no ?></h3>
                      <div class="content-caption">
                        Rp. <?php echo @$r->service_harga ?> / <?php echo @$r->hitungan_jam ?> Jam
                      </div>
                    </div>
                  </a>
                </div>
                </div>
              <?php endif; ?>
              <?php endforeach ?>

            </div>
        </div>
    </div>
</div>
<div class="container-fluid footer">
    <div class="container">
        <div class="row">
            <div class="col-md-6">
                <img src="<?php echo base_url() ?>/front/images/mustika2.png" alt="" />
            </div>
            <div class="col-md-6">
                <p class="right">
                    Copyright (c) 2017 Copyright Mustika Musik Kamal All Rights Reserved.
                </p>
            </div>
        </div>

    </div>
</div>
