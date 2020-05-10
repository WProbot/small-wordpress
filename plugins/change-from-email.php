
   function fixer9_sender_email( $original_email_address ) {
       return 'info@domain.tld';
   }

   function fixer9_sender_name( $original_email_from ) {
       return 'name';
   }


   add_filter( 'wp_mail_from',      'fixer9_sender_email' );

   add_filter( 'wp_mail_from_name', 'fixer9_sender_name'  );


