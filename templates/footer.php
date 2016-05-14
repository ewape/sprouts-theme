<footer class="footer-extras">
 <div class="container">
  <div class="row">
    <div class="col-sm-6 col-md-4">
      <?php get_search_form(); ?>
    </div>
    <div class="col-sm-6 col-md-8">
     <?php get_template_part('templates/social', 'buttons'); ?>
  </div>
  </div>
</div>
</footer>

<footer class="content-info">
  <div class="container">
  	<div class="row">
     <?php dynamic_sidebar('sidebar-footer'); ?>
   </div>
 </div>
</footer>

<footer class="footer-bottom" id="bottom">
  <div class="container">
    <div class="row">
      <div class="col-xs-6 copyright">
        Copyright &copy; 2008-<?php echo date("Y"); ?> <a href="http://www.kielki.info/" title="">kielki.info</a>
      </div>
      <div class="col-xs-6 footer-navlinks">
       <a href="javascript:window.history.back(-1);" title="Cofnij">
        <i class="fa fa-long-arrow-left" aria-hidden="true"></i> cofnij
      </a>
      <a class="scroll-top" href="#" title="Przewiń do góry">
        <i class="fa fa-long-arrow-up" aria-hidden="true"></i> do góry
      </a>
    </div>
  </div>
</div>
</footer>

<div class="arrows">
  <a class="scroll-top" href="#" title="Przewiń do góry"><?php get_template_part('templates/arrow'); ?></a>
  <a class="smoothscroll active" href="#bottom" title=""><?php get_template_part('templates/arrow'); ?></a>
</div>

