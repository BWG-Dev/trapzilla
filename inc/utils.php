<?php

function es_template( $file, $args ){
    // ensure the file exists
    if ( !file_exists( $file ) ) {
        return '';
    }

    // Make values in the associative array easier to access by extracting them
    if ( is_array( $args ) ){
        extract( $args );
    }

    // buffer the output (including the file is "output")
    ob_start();
    include $file;
    return ob_get_clean();
}

function trap_send_pdf_copy($email, $data){

    $attachments = [$data['pdf_path']];

    $title   = 'Trapzilla Sizing Tool - '  . $data['project_name'];
    $content = es_template(get_stylesheet_directory() . '/inc/templates/pdf_email.php',$data);
    $headers[] = 'Content-Type: text/html; charset=UTF-8';

    return wp_mail( $email, $title, $content,$headers, $attachments);
}