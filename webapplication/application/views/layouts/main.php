<!--    loads header and footer views inside the main view so that we dont have to call these views for every view page -->
<!--This main.php will be called from the products.php controller-->

    <?php $this->load->view('layouts/includes/header'); ?>

        <!--main content will be defined in the controller-->
<!--        main_content is the products.php-->
        <?php $this->load->view($main_content); ?>

            <?php $this->load->view('layouts/includes/footer'); ?>