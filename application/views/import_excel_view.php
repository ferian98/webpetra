<?php require 'header.php';
			require 'sidebar.php';?>
<main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-4">

    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
      <h1 class="h2">Data User</h1>
      <div class="btn-toolbar mb-2 mb-md-0">

      </div>
    </div>

    <div>
    		<div class="wrapper">
          <?php
            echo form_open_multipart("Import_excel/proses");

            echo '<div class="form-group">';
            echo '<label>Silahkan upload file Excel ' . '</label>'; // show error judul
            echo '</div>';
            echo '<div class="form-group">';
            echo '<label>' . $error . '</label>'; // show error upload
            echo '<br />';
            echo form_upload('userfile');
            echo '</div>';
            echo form_submit('mysubmit', 'Upload', 'class="btn btn-primary"');
            echo form_close();
          ?>
        </div>
    </div>

</main>



<?php require 'footer.php'; ?>
