<footer class="footer-extras">
 <div class="container">
  <div class="row">
    <div class="col-sm-6 col-md-4 footer-extras-col">
      <?php get_search_form(); ?>
    </div>
    <div class="col-sm-6 col-md-8 footer-extras-col">
     <?php get_template_part('templates/social', 'buttons'); ?>
  </div>
  </div>
</div>
</footer>

<footer class="content-info">
  <div class="container">
  	<div class="row">
     <?php dynamic_sidebar('sidebar-footer'); ?>
      <a class="btn btn-default btn-round btn-back" href="javascript:window.history.back(-1);" title="Cofnij">
        <i class="fa fa-long-arrow-left" aria-hidden="true"></i>
      </a>
   </div>
 </div>
</footer>

<footer class="footer-bottom" id="bottom">
  <div class="container">
    <div class="row">
      <div class="col-xs-6 copyright">
        Copyright &copy; 2008-<?php echo date("Y"); ?> <a href="http://www.kielki.info/" title="">kielki.info</a>
      </div>
      <div class="col-xs-6 text-right">
        Projekt i wykonanie: <a href="http://horizonweb.pl" target="_blank">horizonweb.pl</a>
    </div>
    <div class="arrows">
      <a class="scroll-top btn btn-default btn-round" href="#" title="Przewiń do góry"><i class="fa fa-long-arrow-up" aria-hidden="true"></i></a>
    </div>

    <div class="col-xs-12">
      <a href="<?php echo home_url('/'); ?>nota-prawna" title="">Nota prawna</a> &nbsp;
      <a href="<?php echo home_url('/'); ?>polityka-prywatnosci" title="">Polityka prywatności</a>
    </div>
  </div>
</div>
</footer>


