<?php
    add_meta_box( 
        'cgs_ext_url',
        __( 'Target Page URL', '' ),
        array($this,'cgs_ext_url_content'),
        'content-slider',
        'side',
        'default'
    );