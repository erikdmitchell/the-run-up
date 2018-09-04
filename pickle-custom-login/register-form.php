<?php
/**
 * The template for displaying the registration form
 *
 * This template can be overridden by copying it to yourtheme/pickle-custom-login/register-form.php.
 *
 * NOTICE: These fields are required: username, email, password. Please make sure you use the default functions for those fields.
 */
?>

<div class="pcl-registration row">
    <div class="col-8 offset-2">
    <form id="pcl-registration-form" class="pcl-custom-form" action="" method="POST">       
        
        <fieldset>
            <p>
                <?php pickle_custom_login()->registration->form_username_field(); ?>
            </p>
            
            <p>
                <?php pickle_custom_login()->registration->form_email_field(); ?>
            </p>
            
            <p>
                <?php pickle_custom_login()->registration->form_name_field(); ?>
            </p>
                
            <p>
                <?php pickle_custom_login()->registration->form_password_field(); ?>
            </p>

            <p>
                <?php pickle_custom_login()->registration->form_recaptcha_field(); ?>
            </p>
            
            <p>
                <?php pickle_custom_login()->registration->form_register_button(); ?>
            </p>

        </fieldset>
    </form>
    
    <?php
    pcl_login_extras(
        array(
            'loginout' => true,
            'register' => false,
            'password' => false,
        )
    );
    ?>
    </div>
    
</div>
