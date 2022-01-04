<h1><?php echo __( 'Communication box settings', 'emo_ecb' ) ?></h1>
<form action="options.php" method="post" class="sunset-general-form">
    <?php settings_fields('emo_ecb_settings_group'); ?>
    <?php do_settings_sections('emo_ecb_slug'); ?>
    <?php submit_button( __('Save stettings', 'emo_ecb'), 'primary', 'btnSubmit'); ?>
</form>

