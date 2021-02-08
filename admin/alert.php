<script>src="js/sweetalert.min.js"</script>

<?php if (isset($_SESSION['status']) && $_SESSION['status'] !='')
{
    ?>

  <script>
swal({
  title: "<?php echo $_SESSION['success']; ?>",
//   text: "You clicked the b utton!",
  icon: "<?php echo $_SESSION['success_code']; ?>",
}); 
</script>
  <?php
  unset($_SESSION['status']);
}
?>
