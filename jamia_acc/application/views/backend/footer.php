<!-- Footer -->

<footer class="main">
    <div class="row">
        <div class="col-sm-5">&copy; <?php echo date("Y ");?><strong>itkoor School System</strong> - +92 315 2288722. </div>
        <?php if ($this->session->userdata('admin_login') == 1):?>
        
        <?php endif;?>
    </div>
	

</footer>

