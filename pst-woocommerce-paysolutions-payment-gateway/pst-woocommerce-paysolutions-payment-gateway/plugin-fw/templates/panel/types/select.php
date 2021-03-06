<?php
/**
 * This file belongs to the PAYSOLUTIONS Plugin Framework.
 *
 * This source file is subject to the GNU GENERAL PUBLIC LICENSE (GPL 3.0)
 * that is bundled with this package in the file LICENSE.txt.
 * It is also available through the world-wide-web at this URL:
 * http://www.gnu.org/licenses/gpl-3.0.txt
 */

/**
 * Select Plugin Admin View
 *
 * @package    Thaiepay
 * @author     Wilawan Onnom' <wilawan@efrainc.com>
 * @since      1.0.0
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
} // Exit if accessed directly
$id = $this->get_id_field( $option['id'] );
$name = $this->get_name_field( $option['id'] );

$is_multiple = isset( $option['multiple'] ) && $option['multiple'];
$multiple = ( $is_multiple ) ? ' multiple' : '';
?>
<div id="<?php echo $id ?>-container" class="pst_options rm_option rm_input rm_text" <?php if ( isset( $option['deps'] ) ): ?>data-field="<?php echo $id ?>" data-dep="<?php echo $this->get_id_field( $option['deps']['ids'] ) ?>" data-value="<?php echo $option['deps']['values'] ?>" <?php endif ?>>
    <div class="option">
        <div class="select_wrapper">
            <select name="<?php echo $name ?><?php if( $is_multiple ) echo "[]" ?>" id="<?php echo $id ?>" <?php echo $multiple ?> >
                <?php foreach ( $option['options'] as $key => $value ) : ?>
                    <option value="<?php echo esc_attr( $key ) ?>"<?php ($is_multiple) ? selected( true, in_array( $key, $db_value) ) : selected( $key, $db_value ) ?>><?php echo $value ?></option>
                <?php endforeach; ?>
            </select>
        </div>
    </div>
    <span class="description"><?php echo $option['desc'] ?></span>

    <div class="clear"></div>
</div>
