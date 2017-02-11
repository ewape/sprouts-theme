<footer class="footer-extras">
 <div class="container">
  <div class="row footer-extras-row">
    <div class="col-sm-6 col-md-4 footer-extras-col">
      <?php get_search_form(); ?>
    </div>
    <div class="col-sm-6 col-md-8 footer-extras-col">
     <?php get_template_part('templates/social', 'buttons'); ?>
  </div>
  </div>
</div>
</footer>

<footer class="footer-mid">
  <div class="container">
  	<div class="row">
     <?php dynamic_sidebar('sidebar-footer'); ?>
      <a class="btn btn-default btn-round btn-back" href="#" title="Cofnij" data-toggle="tooltip" data-placement="auto">
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
        Projekt i wykonanie: <a class="developer-contact" href="http://horizonwebdesign.pl">horizonwebdesign.pl</a>
      </div>

      <div class="col-xs-12 footnotes">
        <a href="<?php echo home_url('/'); ?>nota-prawna" title="">Nota prawna</a> &nbsp;
        <a href="<?php echo home_url('/'); ?>polityka-prywatnosci" title="">Polityka prywatności</a>
      </div>

    </div>
  </div>
</footer>

<div class="arrows">
  <a class="scroll-top btn btn-default btn-round" href="#" title="Przewiń do góry" data-toggle="tooltip" data-placement="auto">
    <i class="fa fa-long-arrow-up" aria-hidden="true"></i>
  </a>
</div>

<?php get_template_part('templates/photoswipe'); ?>
