<?php
/*
 * This file belongs to the PAYSOLUTIONS Framework.
 *
 */

$to_active_products  = $this->get_to_active_products();
$activated_products  = $this->get_activated_products();
$no_active_products  = $this->get_no_active_licence_key();
$expired_products    = isset( $no_active_products[ '106' ] ) ? $no_active_products[ '106' ] : array();
$banned_products     = isset( $no_active_products[ '107' ] ) ? $no_active_products[ '107' ] : array();
?>

<div class="pst-container product-licence-activation">
    <h2><?php _e( 'Thaiepay Licence Activation', 'pst' ) ?></h2>

    <div class="licence-check-section">
        <form method="post" id="licence-check-update" action="<?php echo admin_url( 'admin-ajax.php' ) ?>">
            <span class="licence-label" style="display: block;"><?php _e( 'Have you updated your licenses? Have you asked for an extension? Update information concerning your products.', 'pst' ); ?></span>
            <input type="hidden" name="action" value="update_licence_information-<?php echo $this->_product_type ?>" />
            <input type="submit" name="submit" value="<?php _e( 'Update licence information', 'pst' ) ?>" class="button-licence licence-check" />
            <div class="spinner"></div>
        </form>
    </div>

    <!-- To Active Products -->


    <?php if( ! empty( $to_active_products ) ) : ?>
        <h3 class="to-active">
            <?php _e( 'Products to be activated', 'pst' ) ?>
            <span class="spinner"></span>
        </h3>
        <div class="to-active-wrapper">
            <?php foreach( $to_active_products as $init => $info ) : ?>
                <form class="to-active-form" method="post" id="<?php echo $info['product_id'] ?>" action="<?php echo admin_url( 'admin-ajax.php' ) ?>">
                    <table class="to-active-table">
                        <tbody>
                            <tr class="product-row">
                                <td class="product-name">
                                    <?php echo $info['Name'] ?>
                                </td>
                                <td>
                                    <input type="email" name="email" placeholder="Your email on Paysolutions.com" value="" class="user-email" />
                                </td>
                                <td>
                                    <input type="text" name="licence_key" placeholder="Licence Key" value="" class="licence-key" />
                                </td>
                                <td class="activate-button">
                                    <input type="submit" name="submit" value="<?php _e( 'Activate', 'pst' )?>" class="button-licence licence-activation" data-formid="<?php echo $info['product_id'] ?>"/>
                                </td>
                            </tr>
                            <input type="hidden" name="action" value="activate-<?php echo $this->_product_type ?>" />
                            <input type="hidden" name="product_init" value="<?php echo $init ?>" />
                        </tbody>
                    </table>
                    <div class="spinner"></div>
                    <div class="message-wrapper">
                        <span class="message arrow-left"></span>
                    </div>
                </form>
            <?php endforeach; ?>
        </div>
    <?php endif; ?>

    <!-- Activated Products -->

    <?php if( ! empty( $activated_products ) ) : ?>
        <h3><?php _e( 'Activated', 'pst' ) ?></h3>
        <table class="expired-table">
            <thead>
                <tr>
                    <th><?php _e( 'Product Name', 'pst' ) ?></th>
                    <th><?php _e( 'Email', 'pst' ) ?></th>
                    <th><?php _e( 'Licence Key', 'pst' ) ?></th>
                    <th><?php _e( 'Expires', 'pst' ) ?></th>
                    <th><?php _e( 'Remaining', 'pst' ) ?></th>
                    <th><?php _e( 'Renew', 'pst' ) ?></th>
                </tr>
            </thead>
            <tbody>
                <?php foreach( $activated_products as $init => $info ) : ?>
                    <tr>
                        <td class="product-name"><?php echo $info['Name'] ?></td>
                        <td class="product-licence-email"><?php echo $info['licence']['email'] ?></td>
                        <td class="product-licence-key"><?php echo $info['licence']['licence_key'] ?></td>
                        <td class="product-licence-expires"><?php echo date("F j, Y", $info['licence']['licence_expires'] ); ?></td>
                        <td class="product-licence-remaining">
                            <?php printf( __( '%1s out of %2s', 'pst' ), $info['licence']['activation_remaining'], $info['licence']['activation_limit']  ); ?>
                        </td>
                        <td><a class="button-licence licence-renew" href="<?php echo $this->get_renewing_uri( $info['licence']['licence_key'] ) ?>" target="_blank"><?php _e( 'Renew', 'pst' ) ?></a></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    <?php endif;?>

     <!-- Banned Products -->

    <?php if( ! empty( $banned_products ) ) : ?>
        <h3><?php _e( 'Banned', 'pst' ) ?></h3>
        <table class="expired-table">
            <thead>
                <tr>
                    <th><?php _e( 'Product Name', 'pst' ) ?></th>
                    <th><?php _e( 'Email', 'pst' ) ?></th>
                    <th><?php _e( 'Licence Key', 'pst' ) ?></th>
                </tr>
            </thead>
            <tbody>
            <?php foreach( $banned_products as $init => $info ) : ?>
                    <tr>
                        <td class="product-name"><?php echo $info['Name'] ?></td>
                        <td class="product-licence-email"><?php echo $info['licence']['email'] ?></td>
                        <td class="product-licence-key"><?php echo $info['licence']['licence_key'] ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    <?php endif;?>

    <!-- Expired Products -->

    <?php if( ! empty( $expired_products ) ) : ?>
        <h3><?php _e( 'Expired', 'pst' ) ?></h3>
        <table class="expired-table">
            <thead>
                <tr>
                    <th><?php _e( 'Product Name', 'pst' ) ?></th>
                    <th><?php _e( 'Email', 'pst' ) ?></th>
                    <th><?php _e( 'Licence Key', 'pst' ) ?></th>
                    <th><?php _e( 'Expires', 'pst' ) ?></th>
                    <th><?php _e( 'Renew', 'pst' ) ?></th>
                </tr>
            </thead>
            <tbody>
                <?php foreach( $expired_products as $init => $info ) : ?>
                    <tr>
                        <td class="product-name"><?php echo $info['Name'] ?></td>
                        <td class="product-licence-email"><?php echo $info['licence']['email'] ?></td>
                        <td class="product-licence-key"><?php echo $info['licence']['licence_key'] ?></td>
                        <td class="product-licence-expires"><?php echo date("F j, Y", $info['licence']['licence_expires'] ); ?></td>
                        <td><a class="button-licence licence-renew" href="<?php echo $this->get_renewing_uri( $info['licence']['licence_key'] ) ?>" target="_blank"><?php _e( 'Renew', 'pst' ) ?></a></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    <?php endif;?>
</div>