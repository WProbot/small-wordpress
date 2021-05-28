<?php
/*
 * Plugin Name: NeverEmailPasswords
 * Plugin URI: http://zippykid.com/plugins/never-email-passwords
 * Version: 0.2
 * Author: ZippyKid
 * Description: Send new users a reset password link when their account is created.
 */

$nep = new NeverEmailPasswords();
$nep->registerHooks();

class NeverEmailPasswords
{
    protected $userData;

    public function registerHooks()
    {
        add_action('user_register', array($this, 'handleActivationRequest'));
        add_action('admin_print_scripts', array($this, 'registerUIHooks'));
    }

    public function registerUIHooks()
    {
        if (defined('IS_PROFILE_PAGE')) {
          if(IS_PROFILE_PAGE === true) {
            return false;
          }
        }

        $password = wp_generate_password(64, false);
        wp_enqueue_script(
            'nep_remove_email_checkbox',
            plugins_url('/js/nep_remove_email_checkbox.js', __FILE__),
            array(),
            false,
            true
        );
        wp_localize_script(
            'nep_remove_email_checkbox',
            'NeverEmailPasswords',
            array('password' => $password)
        );
    }

    public function handleActivationRequest($user_id)
    {
        // only run on the admin pages so you don't disable 3rd party functionality
        if (!is_admin()) {
            return false;
        }
        if (!$this->setUserDataById($user_id)) {
            return false;
        }

        $key = $this->updateUserActivationKey();
        $this->sendEmailInvitation($key);

        return true;
    }

    /**
     * Update the user with a new activation key
     */
    protected function updateUserActivationKey()
    {
        global $wpdb;

        if (!$this->userData) {
            return false;
        }

        $key = wp_generate_password(20, false);

        $wpdb->update(
            $wpdb->users,
            array('user_activation_key' => $key),
            array('user_login' => $this->userData->user_login)
        );

        return $key;
    }

    /**
     * Update the instance state for the specified user ID.
     *
     * Generally this will only happen once, since PHP is request-based,
     * but this would allow for potentially multiple calls.
     *
     * @return bool
     */
    protected function setUserDataById($user_id)
    {
        global $wpdb;

        $this->userData = false;

        $user_data = get_userdata($user_id);

        if (is_wp_error($user_data)) {
            $this->reportError(
                'user_register error grom get_user_data(%s): %s',
                array(
                    $user_id,
                    $user_data->get_error_message()
                )
            );

            return false;
        }

        $this->userData = $user_data;

        return true;
    }

    /**
     * Send to the end user an invitation email to set their password.
     */
    protected function sendEmailInvitation($key)
    {
        $blog_name = get_bloginfo('name');
        $subject = "Please set your $blog_name password";
        $body = $this->getMessageBody($key);

        if (!wp_mail($this->userData->user_email, $subject, $body)) {
            $this->reportError(
                'Failed sending email to <%s>: %s',
                array(
                    $this->userData->user_email,
                    $subject
                )
            );
            return false;
        }

        $this->reportError(
            'Successfully sent password reset link to %s',
            array($userData->user_email)
        );
    }

    /**
     * Report to the error log an error or other message.
     */
    protected function reportError($message, array $arguments)
    {
        error_log(
            'NeverEmailPasswords: '
            . vsprintf($message, $arguments)
        );
    }

    protected function getMessageBody($key)
    {
        $blog_name = get_bloginfo('name');
        $link = network_site_url(
            "wp-login.php?" . http_build_query(
                array(
                    'action' => 'rp',
                    'key' => $key,
                    'login' => $this->userData->user_login
                )
            ),
            'login'
        );

        return <<<EOB
An account has been created for you at $blog_name, you need to set a password
for this account before it can be used.

Click here to set this password, otherwise ignore this message:

$link
EOB;
    }
}
