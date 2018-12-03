<?php 
  include 'Master/after_login_header.php';
  protect_page();
  // protect_page_admin();

    //getting all shopper posts
    $con=mysqli_connect('localhost','root','','buyfromabroad');
    $query_s_post="select * , sp.id as spostid, uc.id as user_id
      from shopper_post sp, user_customer uc
      where sp.c_id=uc.id
      order by sp.id desc 
      ";
    $result_s_post=mysqli_query($con,$query_s_post);


    //getting all traveller post
    $con=mysqli_connect('localhost','root','','buyfromabroad');
    $query_t_post="select *, uc.id as user_id, tp.id as tpostid
      from traveller_post tp, user_customer uc 
      where tp.t_id=uc.id
      order by tp.id desc 
      ";
    $result_t_post=mysqli_query($con,$query_t_post);

    if($_SESSION['level'] == 'shopper' || $_SESSION['level'] == 'traveller'){
      //getting user info
      $con=mysqli_connect('localhost','root','','buyfromabroad');
      $query_user_info="select * 
        from about_user 
        where user_id=".$_SESSION['id'];
      $result_user_info=mysqli_query($con,$query_user_info);
    }
    // print_r($user_info);
    // exit();
?>

<div class="wrapper">
  
  
  <?php 
   include 'Master/header.php';
   include 'Master/sidebar.php';
  ?>
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Dashboard
        <!-- <small>Control panel</small> -->
      </h1>
      <ol class="breadcrumb">
        <!-- <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li> -->
        <li class="active">Dashboard</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      <!-- Small boxes (Stat box) -->
      <div class="row">
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-aqua">
            <div class="inner">
              <?php
                $con=mysqli_connect('localhost','root','','buyfromabroad');
                $query="select count(id) as count_post 
                    from shopper_post";
                    
                $result=mysqli_query($con,$query);
                $count=mysqli_fetch_array($result, MYSQLI_ASSOC);
              ?>
              <h3><?php echo $count['count_post']?></h3>

              <p>Total Shopper Post</p>
            </div>
            <div class="icon">
              <i class="ion ion-bag"></i>
            </div>
            <a href="#" class="small-box-footer"> <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-green">
            <div class="inner">
              <?php
                $con=mysqli_connect('localhost','root','','buyfromabroad');
                $query="select count(id) as count_post 
                    from traveller_post";
                    
                $result=mysqli_query($con,$query);
                $count=mysqli_fetch_array($result, MYSQLI_ASSOC);
              ?>
              <h3><?php echo $count['count_post']?></h3>

              <p>Total Traveller Post</p>
            </div>
            <div class="icon">
              <i class="ion ion-bag"></i>
            </div>
            <a href="#" class="small-box-footer"> <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-yellow">
            <div class="inner">
              <h3>---</h3>

              <p>Not Yet Developed</p>
			  
            </div>
            <div class="icon">
              <i class="ion ion-person-add"></i>
            </div>
            <a href="#" class="small-box-footer"> <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-red">
            <div class="inner">
              <h3>---</h3>

              <p>Not Yet Developed</p>
            </div>
            <div class="icon">
              <i class="ion ion-pie-graph"></i>
            </div>
            <a href="#" class="small-box-footer"><i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <!-- ./col -->
      </div>
      <!-- /.row -->

      <!-- Main row -->
      <div class="row">
        
        <!-- Left col -->
        <div class="col-md-9">

          <?php
          if(isset($_GET['success'])){
          ?>
            <div class="alert alert-success">
              <strong>Done!</strong> Successfully your Post added!
            </div>
          <?php
          }
          ?>

          <div class="nav-tabs-custom">
            <ul class="nav nav-tabs">
              <li class="active" style="width: 50%; margin-right: 0px;"><a href="#activity" data-toggle="tab">Shopper's post</a></li>
              <li style="width: 50%; margin-right: 0px;"><a href="#timeline" data-toggle="tab">Traveller's post</a></li>
              <!-- <li><a href="#settings" data-toggle="tab">Settings</a></li> -->
            </ul>
            <div class="tab-content">
              <div class="active tab-pane" id="activity">
                <!-- Post -->

                <?php
                    if(mysqli_num_rows($result_s_post)>0){
                      while($s_post_info=mysqli_fetch_array($result_s_post, MYSQLI_ASSOC)){

                        $query_post_taken="select * 
                          from shopper_post 
                          where bidder_id != 0 
                          and id=".$s_post_info['spostid'];
                        $result_post_taken=mysqli_query($con,$query_post_taken);
                ?>
                        <div class="post">
                          <div style="margin: 20px">
                              <div class="user-block">
                                <img class="img-circle img-bordered-sm" src="../dist/img/user1-128x128.jpg" alt="user image">
                                    <span class="username">
                                      <a href="profile.php?user_id=<?php echo $s_post_info['user_id']?>"><?php echo $s_post_info['name']?></a>

                                      <?php if($_SESSION['level'] == 'traveller'){ ?>

                                        <div class="pull-right">
                                          <div class="box-header ">
                                            <div class="box-tools pull-right">

                                              <?php 
                                                if(mysqli_num_rows($result_post_taken)>0){
                                              ?>
                                                  <span class="label label-danger">Confirmed!!</span>
                                              <?php 
                                                }else{
                                              ?>
                                                 
                                                  <?php
                                                    $con=mysqli_connect('localhost','root','','buyfromabroad');
                                                    $query_s_post_bid="select * 
                                                      from s_post_bid 
                                                      where post_id = '".$s_post_info['spostid']."'
                                                      and t_id=".$_SESSION['id']
                                                      ;
                                                    $result_s_post_bid=mysqli_query($con,$query_s_post_bid);

                                                    if(mysqli_num_rows($result_s_post_bid) > 0){
                                                  ?>


                                                  <button type="button" class="btn btn-box-tool" style="color: green">Applied
                                                  </button>

                                                  <div class="btn-group pull-right">
                                                    <button type="button" class="btn btn-box-tool dropdown-toggle" data-toggle="dropdown">
                                                      <i class="fa fa-wrench"></i></button>
                                                      <ul class="dropdown-menu" role="menu">
                                                        <li>
                                                          <form action="Page_manager/bid_s_post_cancel.php" method="POST">
                                                            <input type="hidden" name="post_id" value="<?php echo $s_post_info['spostid']?>">

                                                            <input type="submit" class="btn btn-block btn-xs" onclick="return confirm('Are you sure want to cancel Bid in the post of <?php echo $s_post_info['name']?> ?')" value="Cancel Bid" />
                                                          </form>
                                                        </li>
                                                      </ul>
                                                  </div>

                                                  <?php
                                                    }else{
                                                  ?>

                                                  <div class="btn-group">
                                                    <button type="button" class="btn btn-box-tool dropdown-toggle" data-toggle="dropdown">
                                                      <i class="fa fa-wrench"></i></button>
                                                      <ul class="dropdown-menu" role="menu">
                                                        <li>
                                                          <form action="Page_manager/bid_s_post.php" method="POST">
                                                            <input type="hidden" name="post_id" value="<?php echo $s_post_info['spostid']?>">  

                                                            <?php
                                                              if(mysqli_num_rows($result_user_info) > 0){ 
                                                            ?>
                                                            <input type="submit" class="btn btn-block btn-xs" onclick="return confirm('Are you sure want to Bid in the post of <?php echo $s_post_info['name']?> ?')" value="Bid" />
                                                            <?php
                                                              }else{ 
                                                            ?>
                                                              <input type="button" name="post" class="btn btn-danger btn-block btn-xs" placeholder="Post" value="insert your Info first" disabled="disabled">
                                                            <?php
                                                              }
                                                            ?>

                                                          </form>
                                                        </li>
                                                      </ul>
                                                  </div>

                                                  <?php
                                                    }
                                                  ?>

                                              <?php } ?>
                                              
                                            </div>

                                            
                                          </div>
                                        </div>


                                      <?php } ?>

                                    </span>
                                <span class="description">Shared publicly - <?php echo $s_post_info['timestamp']?></span>
                              </div>
                              <strong><?php echo $s_post_info['title']?></strong>
                              <br>
                              <strong>Items :</strong> <?php echo $s_post_info['items']?>
                              <p>
                                <?php echo $s_post_info['description']?>
                              </p>

                              From: <strong><?php echo $s_post_info['choose_country']?></strong>
                               
                              <?php if($_SESSION['level'] == 'traveller'){ ?>


                                <?php 
                                  $con=mysqli_connect('localhost','root','','buyfromabroad');
                                  $query_count_comment="SELECT count(id) as count_comment FROM comments WHERE s_post_id =".$s_post_info['spostid'];
                          
                                  $result_count_comment=mysqli_query($con,$query_count_comment);
                                  $post_count_comment=mysqli_fetch_array($result_count_comment, MYSQLI_ASSOC)
                                ?>
                                <ul class="list-inline">
                                  <!-- <li><a href="#" class="link-black text-sm"><i class="fa fa-share margin-r-5"></i> Share</a></li>
                                  <li><a href="#" class="link-black text-sm"><i class="fa fa-thumbs-o-up margin-r-5"></i> Like</a>
                                  </li> -->
                                  <li class="pull-right">
                                    <a href="#" class="link-black text-sm"><i class="fa fa-comments-o margin-r-5"></i> Comments
                                      (<?php echo $post_count_comment['count_comment']?>)</a></li>
                                </ul>
                                <form action="Page_manager/s_post_comment.php" method="POST" data-parsley-validate>
                                  <input type="hidden" name="post_id" value="<?php echo $s_post_info['spostid']?>" >
                                  <input class="form-control" type="text" name="comment" placeholder="Type a comment" data-parsley-required minlength="10">
                                </form>
                              <?php } ?>

                              <?php
                                 $con=mysqli_connect('localhost','root','','buyfromabroad');
                                 $query_s_post_comment="SELECT *, sp.id as spostid, c.s_post_id as c_spostid, uc.id as user_id
                                    FROM shopper_post sp, user_customer uc, comments c 
                                    WHERE sp.id = c.s_post_id 
                                    and c.user_id = uc.id";
                                  
                                  $result_s_post_comment=mysqli_query($con,$query_s_post_comment);
                                  if(mysqli_num_rows($result_s_post_comment)>0){
                                    while($s_post_comment=mysqli_fetch_array($result_s_post_comment, MYSQLI_ASSOC)){
                                      if($s_post_info['spostid'] === $s_post_comment['c_spostid']){
                              ?>

                                  <div class="username" style="margin-top: 10px; background-color: #F0F0F0">
                                    <div style="margin: 15px;">
                                      <a href="profile.php?user_id=<?php echo $s_post_comment['user_id']?>"><?php echo $s_post_comment['name']?></a><br>
                                      <span style="font-size: 12px;">Shared on - <?php echo $s_post_comment['time']?></span>
                                      <p><?php echo $s_post_comment['comment']?></p>

                                      <!-- <form action="" method="POST" data-parsley-validate>
                                        <input type="hidden" name="post_id" value="<?php echo $s_post_info['spostid']?>" >
                                        <input class="form-control input-sm" type="text" name="comment" placeholder="Type a reply" data-parsley-required minlength="10">
                                      </form> -->
                                    </div> 
                                    <hr style="margin: 0;">
                                  </div>
                              <?php
                          }
                                      }
                                }
                            ?>
                          </div>
                        </div>

                <?php
                      
                          }
                    }
                ?>

              </div>
              <!-- /.tab-pane -->
              <div class="tab-pane" id="timeline">
                  
                <?php
                    if(mysqli_num_rows($result_t_post)>0){
                      while($t_post_info=mysqli_fetch_array($result_t_post, MYSQLI_ASSOC)){
                ?>

                  <ul class="timeline timeline-inverse">
                    <li>
                      <!-- <i class="fa fa-envelope bg-blue"></i> -->
                      <div class="timeline-item">
                        <span class="time"><i class="fa fa-clock-o"></i> <?php echo $t_post_info['timestamp']?></span>

                        <h3 class="timeline-header"><a href="profile.php?user_id=<?php echo $t_post_info['user_id']?>"><?php echo $t_post_info['name']?></a></h3>

                        <div class="timeline-body">
                          <strong><?php echo $t_post_info['title']?></strong><br>
                          <?php echo $t_post_info['description']?><br><br>

                          Going To: <strong><?php echo $t_post_info['going_country']?></strong><br>
                          Going Date: <strong><?php echo $t_post_info['going_date']?></strong>

                          <?php if($_SESSION['level'] == 'shopper'){ ?>

                              <?php 
                                $con=mysqli_connect('localhost','root','','buyfromabroad');
                                $query_count_comment="SELECT count(id) as count_comment FROM comments WHERE t_post_id =".$t_post_info['tpostid'];
                        
                                $result_count_comment=mysqli_query($con,$query_count_comment);
                                $post_count_comment=mysqli_fetch_array($result_count_comment, MYSQLI_ASSOC)
                              ?>
                              <ul class="list-inline">
                                <li class="pull-right">
                                  <a href="#" class="link-black text-sm"><i class="fa fa-comments-o margin-r-5"></i> Comments
                                    (<?php echo $post_count_comment['count_comment']?>)</a></li>
                              </ul>
                              <form action="Page_manager/t_post_comment.php" method="POST" data-parsley-validate>
                                <input type="hidden" name="post_id" value="<?php echo $t_post_info['tpostid']?>" >
                                <input class="form-control" type="text" name="comment" placeholder="Type a comment" data-parsley-required minlength="10">
                              </form>
                            <?php } ?>

                        </div>

                          <?php
                             $con=mysqli_connect('localhost','root','','buyfromabroad');
                             $query1="SELECT *, tp.id as tpostid, c.t_post_id as c_tpostid, uc.id as user_id
                             FROM traveller_post tp, user_customer uc, comments c WHERE tp.id = c.t_post_id and c.user_id = uc.id";
                          
                              $result1=mysqli_query($con,$query1);
                              if(mysqli_num_rows($result1)>0){
                                while($t_post_comment=mysqli_fetch_array($result1, MYSQLI_ASSOC)){
                                  if($t_post_info['tpostid'] === $t_post_comment['c_tpostid']){
                          ?>      
                    
                                  <div class="username" style="margin: 10px 10px 10px 30px;; background-color: #FFF">
                                    <div style="margin: 5px 10px 10px 15px;">
                                      <a href="profile.php?user_id=<?php echo $t_post_comment['user_id']?>"><?php echo $t_post_comment['name']?></a><br>
                                      <span style="font-size: 12px;">Shared on - <?php echo $t_post_comment['time']?></span>
                                      <p><?php echo $t_post_comment['comment']?></p>

                                    <!--  <form action="post_comment.php" method="POST" data-parsley-validate>
                                        <input type="hidden" name="post_id" value="<?php echo $s_post_info['spostid']?>" >
                                        <input class="form-control input-sm" type="text" name="comment" placeholder="Type a reply" data-parsley-required minlength="10">
                                      </form>-->
                                    </div>
                                    <hr style="margin: 0;">
                                  </div>
                          <?php
                                  }
                              }
                            
                          }
                          ?>

                        <div class="timeline-footer">
                         <!-- <a class="btn btn-primary btn-xs">Read more</a>
                          <a class="btn btn-danger btn-xs">Delete</a>-->
                        </div>
                      </div>
                    </li>
                  </ul>

                <?php
                      
                          }
                    }
                ?>
              </div>
              <!-- /.tab-pane -->

            
            </div>
            <!-- /.tab-content -->
          </div>
          <!-- /.nav-tabs-custom -->
        </div>

        <div class="col-md-3">

          <?php
            if($_SESSION['level'] =="shopper"){
          ?>

            <div class="box box-warning">
             
              <!-- /.box-header -->
              <div class="box-body">
                <form role="form" action="Page_manager/shopper_post_manager.php" method="post" data-parsley-validate>
                  <!-- text input -->
                  <div class="form-group">
                    <!-- <label>Text</label> -->
                    <input type="text" class="form-control" name="title" placeholder="Title ..." data-parsley-required>
                  </div>

                  <div class="form-group">
                    <!-- <label>Textarea</label> -->
                    <textarea class="form-control" rows="2" name="item" placeholder="Item ..." data-parsley-required></textarea>
                  </div>
                  
                  <!-- textarea -->
                  <div class="form-group">
                    <!-- <label>Textarea</label> -->
                    <textarea class="form-control" rows="3" name="desc" placeholder="Write your post ..." data-parsley-required></textarea>
                  </div>

                  <!-- select -->
                  <div class="form-group">

                    <select class="form-control" id="countries" name="countries" data-parsley-required>
                        <option value="Afghanistan">Afghanistan</option>
                        <option value="Åland_Islands">Åland Islands</option>
                        <option value="Albania">Albania</option>
                        <option value="Algeria">Algeria</option>
                        <option value="American_Samoa">American Samoa</option>
                        <option value="Andorra">Andorra</option>
                        <option value="Angola">Angola</option>
                        <option value="Anguilla">Anguilla</option>
                        <option value="Antarctica">Antarctica</option>
                        <option value="Antigua_And_Barbuda">Antigua and Barbuda</option>
                        <option value="Argentina">Argentina</option>
                        <option value="Armenia">Armenia</option>
                        <option value="Aruba">Aruba</option>
                        <option value="Australia">Australia</option>
                        <option value="Austria">Austria</option>
                        <option value="Azerbaijan">Azerbaijan</option>
                        <option value="Bahamas">Bahamas</option>
                        <option value="Bahrain">Bahrain</option>
                        <option value="Bangladesh">Bangladesh</option>
                        <option value="Barbados">Barbados</option>
                        <option value="Belarus">Belarus</option>
                        <option value="Belgium">Belgium</option>
                        <option value="Belize">Belize</option>
                        <option value="Benin">Benin</option>
                        <option value="Bermuda">Bermuda</option>
                        <option value="Bhutan">Bhutan</option>
                        <option value="Bolivia">Bolivia</option>
                        <option value="Bosnia_And_Herzegovina">Bosnia and Herzegovina</option>
                        <option value="Botswana">Botswana</option>
                        <option value="Bouvet_Island">Bouvet Island</option>
                        <option value="Brazil">Brazil</option>
                        <option value="British_Indian_Ocean_Territory">British Indian Ocean Territory</option>
                        <option value="Brunei_Darussalam">Brunei Darussalam</option>
                        <option value="Bulgaria">Bulgaria</option>
                        <option value="Burkina_Faso">Burkina Faso</option>
                        <option value="Burundi">Burundi</option>
                        <option value="Cambodia">Cambodia</option>
                        <option value="Cameroon">Cameroon</option>
                        <option value="Canada">Canada</option>
                        <option value="Cape_Verde">Cape Verde</option>
                        <option value="Cayman_Islands">Cayman Islands</option>
                        <option value="Central_African_Republic">Central African Republic</option>
                        <option value="Chad">Chad</option>
                        <option value="Chile">Chile</option>
                        <option value="China">China</option>
                        <option value="Christmas_Island">Christmas Island</option>
                        <option value="Cocos_(Keeling)_Islands">Cocos (Keeling) Islands</option>
                        <option value="Colombia">Colombia</option>
                        <option value="Comoros">Comoros</option>
                        <option value="Congo">Congo</option>
                        <option value="Congo,_The_Democratic_Republic_Of_The">Congo, The Democratic Republic of The</option>
                        <option value="Cook_Islands">Cook Islands</option>
                        <option value="Costa_Rica">Costa Rica</option>
                        <option value="Cote_D'ivoire">Cote D'ivoire</option>
                        <option value="Croatia">Croatia</option>
                        <option value="Cuba">Cuba</option>
                        <option value="Cyprus">Cyprus</option>
                        <option value="Czechia">Czechia</option>
                        <option value="Denmark">Denmark</option>
                        <option value="Djibouti">Djibouti</option>
                        <option value="Dominica">Dominica</option>
                        <option value="Dominican_Republic">Dominican Republic</option>
                        <option value="Ecuador">Ecuador</option>
                        <option value="Egypt">Egypt</option>
                        <option value="El_Salvador">El Salvador</option>
                        <option value="Equatorial_Guinea">Equatorial Guinea</option>
                        <option value="Eritrea">Eritrea</option>
                        <option value="Estonia">Estonia</option>
                        <option value="Ethiopia">Ethiopia</option>
                        <option value="Falkland_Islands_(Malvinas)">Falkland Islands (Malvinas)</option>
                        <option value="Faroe_Islands">Faroe Islands</option>
                        <option value="Fiji">Fiji</option>
                        <option value="Finland">Finland</option>
                        <option value="France">France</option>
                        <option value="French_Guiana">French Guiana</option>
                        <option value="French_Polynesia">French Polynesia</option>
                        <option value="French_Southern_Territories">French Southern Territories</option>
                        <option value="Gabon">Gabon</option>
                        <option value="Gambia">Gambia</option>
                        <option value="Georgia">Georgia</option>
                        <option value="Germany">Germany</option>
                        <option value="Ghana">Ghana</option>
                        <option value="Gibraltar">Gibraltar</option>
                        <option value="Greece">Greece</option>
                        <option value="Greenland">Greenland</option>
                        <option value="Grenada">Grenada</option>
                        <option value="Guadeloupe">Guadeloupe</option>
                        <option value="Guam">Guam</option>
                        <option value="Guatemala">Guatemala</option>
                        <option value="Guernsey">Guernsey</option>
                        <option value="Guinea">Guinea</option>
                        <option value="Guinea-bissau">Guinea-bissau</option>
                        <option value="Guyana">Guyana</option>
                        <option value="Haiti">Haiti</option>
                        <option value="Heard_Island_And_Mcdonald_Islands">Heard Island and Mcdonald Islands</option>
                        <option value="Holy_See_(Vatican_City_State)">Holy See (Vatican City State)</option>
                        <option value="Honduras">Honduras</option>
                        <option value="Hong_Kong">Hong Kong</option>
                        <option value="Hungary">Hungary</option>
                        <option value="Iceland">Iceland</option>
                        <option value="India">India</option>
                        <option value="Indonesia">Indonesia</option>
                        <option value="Iran,_Islamic_Republic_Of">Iran, Islamic Republic of</option>
                        <option value="Iraq">Iraq</option>
                        <option value="Ireland">Ireland</option>
                        <option value="Isle_Of_Man">Isle of Man</option>
                        <option value="Israel">Israel</option>
                        <option value="Italy">Italy</option>
                        <option value="Jamaica">Jamaica</option>
                        <option value="Japan">Japan</option>
                        <option value="Jersey">Jersey</option>
                        <option value="Jordan">Jordan</option>
                        <option value="Kazakhstan">Kazakhstan</option>
                        <option value="Kenya">Kenya</option>
                        <option value="Kiribati">Kiribati</option>
                        <option value="Korea,_Democratic_People's_Republic_Of">Korea, Democratic People's Republic of</option>
                        <option value="Korea,_Republic_Of">Korea, Republic of</option>
                        <option value="Kuwait">Kuwait</option>
                        <option value="Kyrgyzstan">Kyrgyzstan</option>
                        <option value="Lao_People's_Democratic_Republic">Lao People's Democratic Republic</option>
                        <option value="Latvia">Latvia</option>
                        <option value="Lebanon">Lebanon</option>
                        <option value="Lesotho">Lesotho</option>
                        <option value="Liberia">Liberia</option>
                        <option value="Libyan_Arab_Jamahiriya">Libyan Arab Jamahiriya</option>
                        <option value="Liechtenstein">Liechtenstein</option>
                        <option value="Lithuania">Lithuania</option>
                        <option value="Luxembourg">Luxembourg</option>
                        <option value="Macao">Macao</option>
                        <option value="Macedonia,_The_Former_Yugoslav_Republic_Of">Macedonia, The Former Yugoslav Republic of</option>
                        <option value="Madagascar">Madagascar</option>
                        <option value="Malawi">Malawi</option>
                        <option value="Malaysia">Malaysia</option>
                        <option value="Maldives">Maldives</option>
                        <option value="Mali">Mali</option>
                        <option value="Malta">Malta</option>
                        <option value="Marshall_Islands">Marshall Islands</option>
                        <option value="Martinique">Martinique</option>
                        <option value="Mauritania">Mauritania</option>
                        <option value="Mauritius">Mauritius</option>
                        <option value="Mayotte">Mayotte</option>
                        <option value="Mexico">Mexico</option>
                        <option value="Micronesia,_Federated_States_Of">Micronesia, Federated States of</option>
                        <option value="Moldova,_Republic_Of">Moldova, Republic of</option>
                        <option value="Monaco">Monaco</option>
                        <option value="Mongolia">Mongolia</option>
                        <option value="Montenegro">Montenegro</option>
                        <option value="Montserrat">Montserrat</option>
                        <option value="Morocco">Morocco</option>
                        <option value="Mozambique">Mozambique</option>
                        <option value="Myanmar">Myanmar</option>
                        <option value="Namibia">Namibia</option>
                        <option value="Nauru">Nauru</option>
                        <option value="Nepal">Nepal</option>
                        <option value="Netherlands">Netherlands</option>
                        <option value="Netherlands_Antilles">Netherlands Antilles</option>
                        <option value="New_Caledonia">New Caledonia</option>
                        <option value="New_Zealand">New Zealand</option>
                        <option value="Nicaragua">Nicaragua</option>
                        <option value="Niger">Niger</option>
                        <option value="Nigeria">Nigeria</option>
                        <option value="Niue">Niue</option>
                        <option value="Norfolk_Island">Norfolk Island</option>
                        <option value="Northern_Mariana_Islands">Northern Mariana Islands</option>
                        <option value="Norway">Norway</option>
                        <option value="Oman">Oman</option>
                        <option value="Pakistan">Pakistan</option>
                        <option value="Palau">Palau</option>
                        <option value="Palestinian_Territory,_Occupied">Palestinian Territory, Occupied</option>
                        <option value="Panama">Panama</option>
                        <option value="Papua_New_Guinea">Papua New Guinea</option>
                        <option value="Paraguay">Paraguay</option>
                        <option value="Peru">Peru</option>
                        <option value="Philippines">Philippines</option>
                        <option value="Pitcairn">Pitcairn</option>
                        <option value="Poland">Poland</option>
                        <option value="Portugal">Portugal</option>
                        <option value="Puerto_Rico">Puerto Rico</option>
                        <option value="Qatar">Qatar</option>
                        <option value="Reunion">Reunion</option>
                        <option value="Romania">Romania</option>
                        <option value="Russian_Federation">Russian Federation</option>
                        <option value="Rwanda">Rwanda</option>
                        <option value="Saint_Helena">Saint Helena</option>
                        <option value="Saint_Kitts_And_Nevis">Saint Kitts and Nevis</option>
                        <option value="Saint_Lucia">Saint Lucia</option>
                        <option value="Saint_Pierre_And_Miquelon">Saint Pierre and Miquelon</option>
                        <option value="Saint_Vincent_And_The_Grenadines">Saint Vincent and The Grenadines</option>
                        <option value="Samoa">Samoa</option>
                        <option value="San_Marino">San Marino</option>
                        <option value="Sao_Tome_And_Principe">Sao Tome and Principe</option>
                        <option value="Saudi_Arabia">Saudi Arabia</option>
                        <option value="Senegal">Senegal</option>
                        <option value="Serbia">Serbia</option>
                        <option value="Seychelles">Seychelles</option>
                        <option value="Sierra_Leone">Sierra Leone</option>
                        <option value="Singapore">Singapore</option>
                        <option value="Slovakia">Slovakia</option>
                        <option value="Slovenia">Slovenia</option>
                        <option value="Solomon_Islands">Solomon Islands</option>
                        <option value="Somalia">Somalia</option>
                        <option value="South_Africa">South Africa</option>
                        <option value="South_Georgia_And_The_South_Sandwich_Islands">South Georgia and The South Sandwich Islands</option>
                        <option value="Spain">Spain</option>
                        <option value="Sri_Lanka">Sri Lanka</option>
                        <option value="Sudan">Sudan</option>
                        <option value="Suriname">Suriname</option>
                        <option value="Svalbard_And_Jan_Mayen">Svalbard and Jan Mayen</option>
                        <option value="Swaziland">Swaziland</option>
                        <option value="Sweden">Sweden</option>
                        <option value="Switzerland">Switzerland</option>
                        <option value="Syrian_Arab_Republic">Syrian Arab Republic</option>
                        <option value="Taiwan,_Province_Of_China">Taiwan, Province of China</option>
                        <option value="Tajikistan">Tajikistan</option>
                        <option value="Tanzania,_United_Republic_Of">Tanzania, United Republic of</option>
                        <option value="Thailand">Thailand</option>
                        <option value="Timor-leste">Timor-leste</option>
                        <option value="Togo">Togo</option>
                        <option value="Tokelau">Tokelau</option>
                        <option value="Tonga">Tonga</option>
                        <option value="Trinidad_And_Tobago">Trinidad and Tobago</option>
                        <option value="Tunisia">Tunisia</option>
                        <option value="Turkey">Turkey</option>
                        <option value="Turkmenistan">Turkmenistan</option>
                        <option value="Turks_And_Caicos_Islands">Turks and Caicos Islands</option>
                        <option value="Tuvalu">Tuvalu</option>
                        <option value="Uganda">Uganda</option>
                        <option value="Ukraine">Ukraine</option>
                        <option value="United_Arab_Emirates">United Arab Emirates</option>
                        <option value="United_Kingdom">United Kingdom</option>
                        <option value="United_States">United States</option>
                        <option value="United_States_Minor_Outlying_Islands">United States Minor Outlying Islands</option>
                        <option value="Uruguay">Uruguay</option>
                        <option value="Uzbekistan">Uzbekistan</option>
                        <option value="Vanuatu">Vanuatu</option>
                        <option value="Venezuela">Venezuela</option>
                        <option value="Viet_Nam">Viet Nam</option>
                        <option value="Virgin_Islands,_British">Virgin Islands, British</option>
                        <option value="Virgin_Islands,_U.S.">Virgin Islands, U.S.</option>
                        <option value="Wallis_And_Futuna">Wallis and Futuna</option>
                        <option value="Western_Sahara">Western Sahara</option>
                        <option value="Yemen">Yemen</option>
                        <option value="Zambia">Zambia</option>
                        <option value="Zimbabwe">Zimbabwe</option>
                    </select>
                    
                  </div>

                  <?php
                    if(mysqli_num_rows($result_user_info) < 1){ 
                  ?>
                      <input class="btn btn-success btn-block"  placeholder="Insert Yout Info First" disabled="disabled">
                  <?php
                    }else{ 
                  ?>
                      <input type="submit" name="post" class="btn btn-success btn-block" onclick="return confirm('Are you sure want to add post?')" placeholder="Post">
                  <?php
                    }
                  ?>

                  
                
                </form>
              </div>
              <!-- /.box-body -->
            </div>

          <?php
            }else if($_SESSION['level'] =="traveller"){
          ?>

            <div class="box box-warning">
              <div class="box-header with-border">
                <h3 class="box-title">Post here</h3>
              </div>
              <!-- /.box-header -->
              <div class="box-body">
                <form role="form" action="Page_manager/traveller_post_manager.php" method="post" data-parsley-validate>
                  <!-- text input -->
                  <div class="form-group">
                    <!-- <label>Text</label> -->
                    <input type="text" class="form-control" name="title" placeholder="Title ..." data-parsley-required>
                  </div>
                  
                  <!-- textarea -->
                  <div class="form-group">
                    <!-- <label>Textarea</label> -->
                    <textarea class="form-control" rows="3" name="desc" placeholder="Write your post ..." data-parsley-required></textarea>
                  </div>

                  <!-- select -->
                  <div class="form-group">
                      <select class="form-control" id="countries" name="countries" data-parsley-required>
                        <option value="Afghanistan">Afghanistan</option>
                        <option value="Åland_Islands">Åland Islands</option>
                        <option value="Albania">Albania</option>
                        <option value="Algeria">Algeria</option>
                        <option value="American_Samoa">American Samoa</option>
                        <option value="Andorra">Andorra</option>
                        <option value="Angola">Angola</option>
                        <option value="Anguilla">Anguilla</option>
                        <option value="Antarctica">Antarctica</option>
                        <option value="Antigua_And_Barbuda">Antigua and Barbuda</option>
                        <option value="Argentina">Argentina</option>
                        <option value="Armenia">Armenia</option>
                        <option value="Aruba">Aruba</option>
                        <option value="Australia">Australia</option>
                        <option value="Austria">Austria</option>
                        <option value="Azerbaijan">Azerbaijan</option>
                        <option value="Bahamas">Bahamas</option>
                        <option value="Bahrain">Bahrain</option>
                        <option value="Bangladesh">Bangladesh</option>
                        <option value="Barbados">Barbados</option>
                        <option value="Belarus">Belarus</option>
                        <option value="Belgium">Belgium</option>
                        <option value="Belize">Belize</option>
                        <option value="Benin">Benin</option>
                        <option value="Bermuda">Bermuda</option>
                        <option value="Bhutan">Bhutan</option>
                        <option value="Bolivia">Bolivia</option>
                        <option value="Bosnia_And_Herzegovina">Bosnia and Herzegovina</option>
                        <option value="Botswana">Botswana</option>
                        <option value="Bouvet_Island">Bouvet Island</option>
                        <option value="Brazil">Brazil</option>
                        <option value="British_Indian_Ocean_Territory">British Indian Ocean Territory</option>
                        <option value="Brunei_Darussalam">Brunei Darussalam</option>
                        <option value="Bulgaria">Bulgaria</option>
                        <option value="Burkina_Faso">Burkina Faso</option>
                        <option value="Burundi">Burundi</option>
                        <option value="Cambodia">Cambodia</option>
                        <option value="Cameroon">Cameroon</option>
                        <option value="Canada">Canada</option>
                        <option value="Cape_Verde">Cape Verde</option>
                        <option value="Cayman_Islands">Cayman Islands</option>
                        <option value="Central_African_Republic">Central African Republic</option>
                        <option value="Chad">Chad</option>
                        <option value="Chile">Chile</option>
                        <option value="China">China</option>
                        <option value="Christmas_Island">Christmas Island</option>
                        <option value="Cocos_(Keeling)_Islands">Cocos (Keeling) Islands</option>
                        <option value="Colombia">Colombia</option>
                        <option value="Comoros">Comoros</option>
                        <option value="Congo">Congo</option>
                        <option value="Congo,_The_Democratic_Republic_Of_The">Congo, The Democratic Republic of The</option>
                        <option value="Cook_Islands">Cook Islands</option>
                        <option value="Costa_Rica">Costa Rica</option>
                        <option value="Cote_D'ivoire">Cote D'ivoire</option>
                        <option value="Croatia">Croatia</option>
                        <option value="Cuba">Cuba</option>
                        <option value="Cyprus">Cyprus</option>
                        <option value="Czechia">Czechia</option>
                        <option value="Denmark">Denmark</option>
                        <option value="Djibouti">Djibouti</option>
                        <option value="Dominica">Dominica</option>
                        <option value="Dominican_Republic">Dominican Republic</option>
                        <option value="Ecuador">Ecuador</option>
                        <option value="Egypt">Egypt</option>
                        <option value="El_Salvador">El Salvador</option>
                        <option value="Equatorial_Guinea">Equatorial Guinea</option>
                        <option value="Eritrea">Eritrea</option>
                        <option value="Estonia">Estonia</option>
                        <option value="Ethiopia">Ethiopia</option>
                        <option value="Falkland_Islands_(Malvinas)">Falkland Islands (Malvinas)</option>
                        <option value="Faroe_Islands">Faroe Islands</option>
                        <option value="Fiji">Fiji</option>
                        <option value="Finland">Finland</option>
                        <option value="France">France</option>
                        <option value="French_Guiana">French Guiana</option>
                        <option value="French_Polynesia">French Polynesia</option>
                        <option value="French_Southern_Territories">French Southern Territories</option>
                        <option value="Gabon">Gabon</option>
                        <option value="Gambia">Gambia</option>
                        <option value="Georgia">Georgia</option>
                        <option value="Germany">Germany</option>
                        <option value="Ghana">Ghana</option>
                        <option value="Gibraltar">Gibraltar</option>
                        <option value="Greece">Greece</option>
                        <option value="Greenland">Greenland</option>
                        <option value="Grenada">Grenada</option>
                        <option value="Guadeloupe">Guadeloupe</option>
                        <option value="Guam">Guam</option>
                        <option value="Guatemala">Guatemala</option>
                        <option value="Guernsey">Guernsey</option>
                        <option value="Guinea">Guinea</option>
                        <option value="Guinea-bissau">Guinea-bissau</option>
                        <option value="Guyana">Guyana</option>
                        <option value="Haiti">Haiti</option>
                        <option value="Heard_Island_And_Mcdonald_Islands">Heard Island and Mcdonald Islands</option>
                        <option value="Holy_See_(Vatican_City_State)">Holy See (Vatican City State)</option>
                        <option value="Honduras">Honduras</option>
                        <option value="Hong_Kong">Hong Kong</option>
                        <option value="Hungary">Hungary</option>
                        <option value="Iceland">Iceland</option>
                        <option value="India">India</option>
                        <option value="Indonesia">Indonesia</option>
                        <option value="Iran,_Islamic_Republic_Of">Iran, Islamic Republic of</option>
                        <option value="Iraq">Iraq</option>
                        <option value="Ireland">Ireland</option>
                        <option value="Isle_Of_Man">Isle of Man</option>
                        <option value="Israel">Israel</option>
                        <option value="Italy">Italy</option>
                        <option value="Jamaica">Jamaica</option>
                        <option value="Japan">Japan</option>
                        <option value="Jersey">Jersey</option>
                        <option value="Jordan">Jordan</option>
                        <option value="Kazakhstan">Kazakhstan</option>
                        <option value="Kenya">Kenya</option>
                        <option value="Kiribati">Kiribati</option>
                        <option value="Korea,_Democratic_People's_Republic_Of">Korea, Democratic People's Republic of</option>
                        <option value="Korea,_Republic_Of">Korea, Republic of</option>
                        <option value="Kuwait">Kuwait</option>
                        <option value="Kyrgyzstan">Kyrgyzstan</option>
                        <option value="Lao_People's_Democratic_Republic">Lao People's Democratic Republic</option>
                        <option value="Latvia">Latvia</option>
                        <option value="Lebanon">Lebanon</option>
                        <option value="Lesotho">Lesotho</option>
                        <option value="Liberia">Liberia</option>
                        <option value="Libyan_Arab_Jamahiriya">Libyan Arab Jamahiriya</option>
                        <option value="Liechtenstein">Liechtenstein</option>
                        <option value="Lithuania">Lithuania</option>
                        <option value="Luxembourg">Luxembourg</option>
                        <option value="Macao">Macao</option>
                        <option value="Macedonia,_The_Former_Yugoslav_Republic_Of">Macedonia, The Former Yugoslav Republic of</option>
                        <option value="Madagascar">Madagascar</option>
                        <option value="Malawi">Malawi</option>
                        <option value="Malaysia">Malaysia</option>
                        <option value="Maldives">Maldives</option>
                        <option value="Mali">Mali</option>
                        <option value="Malta">Malta</option>
                        <option value="Marshall_Islands">Marshall Islands</option>
                        <option value="Martinique">Martinique</option>
                        <option value="Mauritania">Mauritania</option>
                        <option value="Mauritius">Mauritius</option>
                        <option value="Mayotte">Mayotte</option>
                        <option value="Mexico">Mexico</option>
                        <option value="Micronesia,_Federated_States_Of">Micronesia, Federated States of</option>
                        <option value="Moldova,_Republic_Of">Moldova, Republic of</option>
                        <option value="Monaco">Monaco</option>
                        <option value="Mongolia">Mongolia</option>
                        <option value="Montenegro">Montenegro</option>
                        <option value="Montserrat">Montserrat</option>
                        <option value="Morocco">Morocco</option>
                        <option value="Mozambique">Mozambique</option>
                        <option value="Myanmar">Myanmar</option>
                        <option value="Namibia">Namibia</option>
                        <option value="Nauru">Nauru</option>
                        <option value="Nepal">Nepal</option>
                        <option value="Netherlands">Netherlands</option>
                        <option value="Netherlands_Antilles">Netherlands Antilles</option>
                        <option value="New_Caledonia">New Caledonia</option>
                        <option value="New_Zealand">New Zealand</option>
                        <option value="Nicaragua">Nicaragua</option>
                        <option value="Niger">Niger</option>
                        <option value="Nigeria">Nigeria</option>
                        <option value="Niue">Niue</option>
                        <option value="Norfolk_Island">Norfolk Island</option>
                        <option value="Northern_Mariana_Islands">Northern Mariana Islands</option>
                        <option value="Norway">Norway</option>
                        <option value="Oman">Oman</option>
                        <option value="Pakistan">Pakistan</option>
                        <option value="Palau">Palau</option>
                        <option value="Palestinian_Territory,_Occupied">Palestinian Territory, Occupied</option>
                        <option value="Panama">Panama</option>
                        <option value="Papua_New_Guinea">Papua New Guinea</option>
                        <option value="Paraguay">Paraguay</option>
                        <option value="Peru">Peru</option>
                        <option value="Philippines">Philippines</option>
                        <option value="Pitcairn">Pitcairn</option>
                        <option value="Poland">Poland</option>
                        <option value="Portugal">Portugal</option>
                        <option value="Puerto_Rico">Puerto Rico</option>
                        <option value="Qatar">Qatar</option>
                        <option value="Reunion">Reunion</option>
                        <option value="Romania">Romania</option>
                        <option value="Russian_Federation">Russian Federation</option>
                        <option value="Rwanda">Rwanda</option>
                        <option value="Saint_Helena">Saint Helena</option>
                        <option value="Saint_Kitts_And_Nevis">Saint Kitts and Nevis</option>
                        <option value="Saint_Lucia">Saint Lucia</option>
                        <option value="Saint_Pierre_And_Miquelon">Saint Pierre and Miquelon</option>
                        <option value="Saint_Vincent_And_The_Grenadines">Saint Vincent and The Grenadines</option>
                        <option value="Samoa">Samoa</option>
                        <option value="San_Marino">San Marino</option>
                        <option value="Sao_Tome_And_Principe">Sao Tome and Principe</option>
                        <option value="Saudi_Arabia">Saudi Arabia</option>
                        <option value="Senegal">Senegal</option>
                        <option value="Serbia">Serbia</option>
                        <option value="Seychelles">Seychelles</option>
                        <option value="Sierra_Leone">Sierra Leone</option>
                        <option value="Singapore">Singapore</option>
                        <option value="Slovakia">Slovakia</option>
                        <option value="Slovenia">Slovenia</option>
                        <option value="Solomon_Islands">Solomon Islands</option>
                        <option value="Somalia">Somalia</option>
                        <option value="South_Africa">South Africa</option>
                        <option value="South_Georgia_And_The_South_Sandwich_Islands">South Georgia and The South Sandwich Islands</option>
                        <option value="Spain">Spain</option>
                        <option value="Sri_Lanka">Sri Lanka</option>
                        <option value="Sudan">Sudan</option>
                        <option value="Suriname">Suriname</option>
                        <option value="Svalbard_And_Jan_Mayen">Svalbard and Jan Mayen</option>
                        <option value="Swaziland">Swaziland</option>
                        <option value="Sweden">Sweden</option>
                        <option value="Switzerland">Switzerland</option>
                        <option value="Syrian_Arab_Republic">Syrian Arab Republic</option>
                        <option value="Taiwan,_Province_Of_China">Taiwan, Province of China</option>
                        <option value="Tajikistan">Tajikistan</option>
                        <option value="Tanzania,_United_Republic_Of">Tanzania, United Republic of</option>
                        <option value="Thailand">Thailand</option>
                        <option value="Timor-leste">Timor-leste</option>
                        <option value="Togo">Togo</option>
                        <option value="Tokelau">Tokelau</option>
                        <option value="Tonga">Tonga</option>
                        <option value="Trinidad_And_Tobago">Trinidad and Tobago</option>
                        <option value="Tunisia">Tunisia</option>
                        <option value="Turkey">Turkey</option>
                        <option value="Turkmenistan">Turkmenistan</option>
                        <option value="Turks_And_Caicos_Islands">Turks and Caicos Islands</option>
                        <option value="Tuvalu">Tuvalu</option>
                        <option value="Uganda">Uganda</option>
                        <option value="Ukraine">Ukraine</option>
                        <option value="United_Arab_Emirates">United Arab Emirates</option>
                        <option value="United_Kingdom">United Kingdom</option>
                        <option value="United_States">United States</option>
                        <option value="United_States_Minor_Outlying_Islands">United States Minor Outlying Islands</option>
                        <option value="Uruguay">Uruguay</option>
                        <option value="Uzbekistan">Uzbekistan</option>
                        <option value="Vanuatu">Vanuatu</option>
                        <option value="Venezuela">Venezuela</option>
                        <option value="Viet_Nam">Viet Nam</option>
                        <option value="Virgin_Islands,_British">Virgin Islands, British</option>
                        <option value="Virgin_Islands,_U.S.">Virgin Islands, U.S.</option>
                        <option value="Wallis_And_Futuna">Wallis and Futuna</option>
                        <option value="Western_Sahara">Western Sahara</option>
                        <option value="Yemen">Yemen</option>
                        <option value="Zambia">Zambia</option>
                        <option value="Zimbabwe">Zimbabwe</option>
                    </select>
                  </div>

                  <div class="form-group">
                    <!-- <label>Text</label> -->
                    <input type="date" class="form-control" name="datetimes" placeholder="Going Date ..." data-parsley-required>
                  </div>

                  <?php
                    if(mysqli_num_rows($result_user_info) < 1){ 
                  ?>
                      <input class="btn btn-success btn-block"  placeholder="Insert Yout Info First" disabled="disabled">
                  <?php
                    }else{ 
                  ?>
                      <input type="submit" name="post" class="btn btn-success btn-block" onclick="return confirm('Are you sure want to add post?')" placeholder="Post">
                  <?php
                    }
                  ?>
                  
                </form>
              </div>
              <!-- /.box-body -->
            </div>

          <?php
            }else if($_SESSION['level'] =="admin"){
          ?>

            <p>Hi admin</p>
            
          <?php
            }
          ?>
          <!-- About Me Box -->
         
          <!-- /.box -->
        </div>

      </div>
      <!-- /.row (main row) -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
  
  <!-- Footer -->
  <?php 
   include 'Master/footer.php';
  ?>
  <!-- Footer -->

 
  <!-- /.control-sidebar -->
  <!-- Add the sidebar's background. This div must be placed
       immediately after the control sidebar -->
  <div class="control-sidebar-bg"></div>
</div>
<!-- ./wrapper -->



  <!-- datewise select -->
  <script>
    $(function() {
      var nowDate = new Date();
      var today = new Date(nowDate.getFullYear(), nowDate.getMonth(), nowDate.getDate(), 0, 0, 0, 0);
      
      $('input[name="datetimes"]').daterangepicker({
        
        singleDatePicker: true,
        drops: "up",
        minDate: today,
        startDate: moment().startOf('day'),
        // endDate: moment().endOf('day').add(5, 'day'),
        locale: {
        format: 'Y-MM-DD'
        }
      });
    });
  </script>


<?php 
 include 'Master/after_login_footer.php';
?>