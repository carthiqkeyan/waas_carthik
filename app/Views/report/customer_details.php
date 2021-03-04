 <div class="collapse_multi">
  <?php $arr=$arr_customer[0];?>
            <h6>Customer/Account : <?php echo $arr['customer_name']; ?> </h6>
            <div class="row">
              <div class="col-lg-4 col-sm-4 col-xs-6 mb-3">
                <div class="grid_box_mobility">
                  <div class="row">
                    <div class="col-lg-6 col-sm-6 col-xs-12">
                      <h1><?php echo $arr['branch_count']; ?></h1>
                      <p class="">Total Branches</p>
                    </div>
                    <div class="col-lg-6 col-sm-6 col-xs-12 border-left">
                      <h1 class="orange"><?php echo $arr['branch_month']; ?></h1>
                      <p class="">New Branches</p>
                    </div>
                  </div>
                </div>
                <div class="grid_box_footer">
                  <div class="row">
                    <div class="col-lg-6 col-sm-6 col-xs-12">
                      <h3>Branches</h3>
                    </div>
                    <div class="col-lg-6 col-sm-6 col-xs-12">
                      <a class="link_url" href="<?php base_url(); ?>report/view_details/<?php echo $arr['customer_id']; ?>">View details</a>
                    </div>
                  </div>
                </div>
              </div>
              <div class="col-lg-4 col-sm-4 col-xs-6 mb-3">
                <div class="grid_box_mobility">
                  <div class="row">
                    <div class="col-lg-6 col-sm-6 col-xs-12">
                      <h1 id="total_hotspot"><?php echo $arr['brand_count']; ?></h1>
                      <p class="">Total Hotspots</p>
                    </div>
                    <div class="col-lg-6 col-sm-6 col-xs-12 border-left">
                      <h1 id="new_hotspot" class="orange"><?php echo $arr['brand_month']; ?></h1>
                      <p class="">New Hotspots</p>
                    </div>
                  </div>
                </div>
                <div class="grid_box_footer">
                  <div class="row">
                    <div class="col-lg-6 col-sm-6 col-xs-12">
                      <h3>Hotspots</h3>
                    </div>
                    <div class="col-lg-6 col-sm-6 col-xs-12">
                      <a class="link_url" href="<?php base_url(); ?>report/view_details/<?php echo $arr['customer_id']; ?>">View details</a>
                    </div>
                  </div>
                </div>
              </div>
              <div class="col-lg-4 col-sm-4 col-xs-6 mb-3">
                <div class="grid_box_mobility">
                  <div class="row">
                    <div class="col-lg-6 col-sm-6 col-xs-12">
                      <!-- <h1><?php echo $arr['user_count']; ?></h1> -->
                      <h1>0</h1>
                      <p class="">Total Users</p>
                    </div>
                    <div class="col-lg-6 col-sm-6 col-xs-12 border-left">
                      <!-- <h1 class="orange"><?php echo $arr['user_count']; ?></h1> -->
                      <h1 class="orange">0</h1>
                      <p class="">New Users</p>
                    </div>
                  </div>
                </div>
                <div class="grid_box_footer">
                  <div class="row">
                    <div class="col-lg-6 col-sm-6 col-xs-12">
                      <h3>Users</h3>
                    </div>
                    <div class="col-lg-6 col-sm-6 col-xs-12">
                      <a class="link_url" href="<?php base_url(); ?>report/view_details/<?php echo $arr['customer_id']; ?>">View details</a>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            </div>