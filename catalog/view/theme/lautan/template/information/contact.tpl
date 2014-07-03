<?php echo $header; ?><?php echo $column_right; ?>
<div id="body">
<!-- 
<div class="breadcrumb">
    <?php foreach ($breadcrumbs as $breadcrumb) { ?>
    <?php echo $breadcrumb['separator']; ?><a href="<?php echo $breadcrumb['href']; ?>"><?php echo $breadcrumb['text']; ?></a>
    <?php } ?>
  </div>
  -->
<?php echo $column_left; ?>
<div id="content"><?php echo $content_top; ?>
  
 
  <!-- 
  
  <h1><?php echo $heading_title; ?></h1>
  -->
  <h2><?php echo $heading_title; ?></h2><br/>
  <iframe src="https://www.google.com/maps/embed?pb=!1m16!1m10!1m3!1d3919.764279773579!2d106.66794010000001!3d10.752632799999999!2m1!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x31752ef97c4d2fbf%3A0x878d5a19667970d9!2zNDE4IFRy4bqnbiBQaMO6LCBQaMaw4budbmcgNywgUXXhuq1uIDU!5e0!3m2!1sen!2s!4v1404139151478" width="600" height="400" frameborder="0" style="border:0"></iframe>
  <form action="<?php echo $action; ?>" method="post" enctype="multipart/form-data">
    <!-- 
    <h2><?php echo $text_contact; ?></h2>
     -->
  
    <div class="content">
    <b><?php echo $entry_name; ?></b><br />
    <input type="text" name="name" value="<?php echo $name; ?>" />
    <br />
    <?php if ($error_name) { ?>
    <span class="error"><?php echo $error_name; ?></span>
    <?php } ?>
    <br />
    <b><?php echo $entry_email; ?></b><br />
    <input type="text" name="email" value="<?php echo $email; ?>" />
    <br />
    <?php if ($error_email) { ?>
    <span class="error"><?php echo $error_email; ?></span>
    <?php } ?>
    <br />
    <b><?php echo $entry_subject; ?></b><br />
    <input type="text" name="subject" value="<?php echo $subject; ?>"/>
    <br />
    <?php if ($error_subject) { ?>
    <span class="error"><?php echo $error_subject; ?></span>
    <?php } ?>
    <br />
    <b><?php echo $entry_enquiry; ?></b><br />
    <textarea name="enquiry" cols="40" rows="10" style="width: 90%;"><?php echo $enquiry; ?></textarea>
    <br />
    <?php if ($error_enquiry) { ?>
    <span class="error"><?php echo $error_enquiry; ?></span>
    <?php } ?>
    <br />
    <!-- 
    <b><?php echo $entry_captcha; ?></b><br />
    <input type="text" name="captcha" value="<?php echo $captcha; ?>" />
    <br />
    <img src="index.php?route=information/contact/captcha" alt="" />
    <?php if ($error_captcha) { ?>
    <span class="error"><?php echo $error_captcha; ?></span>
    <?php } ?>
     -->
    </div>
    <div class="buttons">
      <div class="left">
      <span class="lautan_button">
      <input type="submit" value="<?php echo $button_submit; ?>" class="button" />
      </span>
      <span class="lautan_button">
      <input type="reset" value="<?php echo $button_clear; ?>" class="button" />
      </span>
      </div>
    </div>
  </form>
  
  
  <?php echo $content_bottom; ?></div>
  </div>
<?php echo $footer; ?>