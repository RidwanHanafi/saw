<!-- ======= Footer ======= -->

<footer style="margin-top: 40px"  id="footer">

  <div class="footer-top">

    <div class="container">

      <div class="row justify-content-center">
        <div class="col-lg-6">
          <a href="<?php echo base_url() ?>assets/beranda/#header" class="scrollto footer-logo"><img src="<?php echo base_url() ?>assets/icon/logo1.png" alt=""></a>
          <h3>Esthree Cake and Bakery</h3>
          <p>Pemilihan tepung </p>
        </div>
      </div>
    </div>
  </div>

  <div class="container footer-bottom clearfix">
    <div class="copyright">
      &copy; Copyright <strong><span>Esthree Cake</span></strong>.
    </div>
  </div>
</footer><!-- End Footer -->

<a href="<?php echo base_url() ?>" class="back-to-top"><i class="icofont-simple-up"></i></a>
<!-- Vendor JS Files -->
<script src="<?php echo base_url() ?>assets/beranda/assets/vendor/jquery/jquery.min.js"></script>
<script src="<?php echo base_url() ?>assets/beranda/assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="<?php echo base_url() ?>assets/beranda/assets/vendor/jquery.easing/jquery.easing.min.js"></script>
<script src="<?php echo base_url() ?>assets/beranda/assets/vendor/php-email-form/validate.js"></script>
<script src="<?php echo base_url() ?>assets/beranda/assets/vendor/jquery-sticky/jquery.sticky.js"></script>
<script src="<?php echo base_url() ?>assets/beranda/assets/vendor/venobox/venobox.min.js"></script>
<script src="<?php echo base_url() ?>assets/beranda/assets/vendor/isotope-layout/isotope.pkgd.min.js"></script>
<script src="<?php echo base_url() ?>assets/beranda/assets/vendor/owl.carousel/owl.carousel.min.js"></script>
<script src="<?php echo base_url() ?>assets/beranda/assets/vendor/aos/aos.js"></script>

<!-- Template Main JS File -->
<script src="<?php echo base_url() ?>assets/beranda/assets/js/main.js"></script>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

<!-- DataTables -->
<script src="<?php echo base_url() ?>assets/beranda/assets/js/datatables/jquery.dataTables.min.js"></script>
<script src="<?php echo base_url() ?>assets/beranda/assets/js/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
<script src="<?php echo base_url() ?>assets/beranda/assets/js/datatables-responsive/js/dataTables.responsive.min.js"></script>
<script src="<?php echo base_url() ?>assets/beranda/assets/js/datatables-responsive/js/responsive.bootstrap4.min.js"></script>

<script>
    $(".js-select2").each(function(){
      $(this).select2({
        minimumResultsForSearch: 20,
        dropdownParent: $(this).next('.dropDownSelect2')
      });
    })
  </script>

<script>
  function getCat(val) {
    $.ajax({
      type: "POST",
      url: encodeURI("../proses/penilaian/lihat.php"),
      data: 'id_kategori=' + val,
      success: function(data) {
        $("#jenis_kriteria").html(data);
        
      }
    });
  }
</script>

<script>
  function kategori_tepung(val) {
    $.ajax({
      type: "POST",
      url: encodeURI("../proses/hasil/lihat.php"),
      data: 'id_kategori=' + val,
      success: function(data) {
        $("#hasil").html(data);
      }
    });
  }
</script>

<!-- DataTables -->
<script>
  $(function () {
    $("#example1").DataTable({
      "responsive": false,
      "autoWidth": false,
      "searching": true,
      "scrollX" : true,
      "language": {
        "sSearch": "Cari",
        "info": "Menampilkan _START_ sampai _END_ dari _TOTAL_ data",
        "infoEmpty": "Menampilkan 0 sampai 0 dari 0 data",
        "lengthMenu": "Menampilkan _MENU_ Data",
        "zeroRecords": "Data tidak ditemukan",
        "paginate": {
          'previous': 'Sebelumnya',
          'next': 'Selanjutnya'
        }
      }
     
    });
   
  });
 
</script>

<!-- Upload Gambar -->
<script>
// Add the following code if you want the name of the file appear on select
$(".custom-file-input").on("change", function() {
  var fileName = $(this).val().split("\\").pop();
  $(this).siblings(".custom-file-label").addClass("selected").html(fileName);
});
</script>

</body>
</html>
