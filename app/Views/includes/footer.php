<?php
$uri = service('uri');
$request = service('request');
?>
<footer class="main-footer">
  <!-- To the right -->
  <div class="float-right d-none d-sm-inline">
    Anything you want
  </div>
  <!-- Default to the left -->
  <?php echo $footer ?>
</footer>
</div>
<!-- ./wrapper -->

<!-- REQUIRED SCRIPTS -->

<!-- jQuery -->
<script src="<?php echo site_url('plugins/jquery/jquery.min.js') ?>"></script>
<!-- Bootstrap 4 -->
<script src="<?php echo site_url('plugins/bootstrap/js/bootstrap.bundle.min.js') ?>"></script>

<?php 
// echo $page;
// exit();
echo view('includes/pages/'.$page) 
?>
</body>

</html>