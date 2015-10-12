<?php
    if ( 'cgs_groups' != $_GET['taxonomy'] )
        return;
    $parent = 'parent()';
    if ( isset( $_GET['action'] ) )
        $parent = 'parent()';
    ?>
        <script type="text/javascript">
            jQuery(document).ready(function($){     
                jQuery('label[for=parent]').<?php echo $parent; ?>.remove();
				jQuery('#parent').<?php echo $parent; ?>.remove();       
            });
        </script>
