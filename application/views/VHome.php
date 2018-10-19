<?php
      $this->load->view('includes/VHeader.php');
      $this->load->view('VMenuBar.php');

?>
      <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
          <?php $this->load->view('VDashboard') ?>
        </section>

      <div class="control-sidebar-bg"></div>
      </div><!-- ./wrapper -->
<?php
      $this->load->view('includes/VFooter.php');
?>