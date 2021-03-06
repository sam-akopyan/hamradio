<?php
/**
 * @package Sj Vm Listing Tabs
 * @version 1.0.0
 * @license http://www.gnu.org/licenses/gpl-2.0.html GNU/GPL
 * @copyright (c) 2014 YouTech Company. All Rights Reserved.
 * @author YouTech Company http://www.smartaddons.com
 *
 */
    defined('_JEXEC') or die;
    $currency = CurrencyDisplay::getInstance();
    $time_now = $date = date('Y-m-d H:i:s');
    $small_image_config = array(
    'type' => $params->get('imgcfg_type'),
    'width' => $params->get('imgcfg_width'),
    'height' => $params->get('imgcfg_height'),
    'quality' => 90,
    'function' => ($params->get('imgcfg_function') == 'none') ? null : 'resize',
    'function_mode' => ($params->get('imgcfg_function') == 'none') ? null : substr($params->get('imgcfg_function'), 7),
    'transparency' => $params->get('imgcfg_transparency', 1) ? true : false,
    'background' => $params->get('imgcfg_background'));

    if($params->get('item_first_product_display',1) == 1){
        $first_image_config = array(
        'type' => $params->get('imgcfgfd_type'),
        'width' => $params->get('imgcfgfd_width'),
        'height' => $params->get('imgcfgfd_height'),
        'quality' => 90,
        'function' => ($params->get('imgcfgfd_function') == 'none') ? null : 'resize',
        'function_mode' => ($params->get('imgcfgfd_function') == 'none') ? null : substr($params->get('imgcfgfd_function'), 7),
        'transparency' => $params->get('imgcfgfd_transparency', 1) ? true : false,
        'background' => $params->get('imgcfgfd_background'));

        echo '<div class="sj_vm_deals_slide_product">';
    } ?>
<div class="control-slide-product">
                                <div class="bt-prev"><i class="fa fa-angle-left"></i></div>
                                <div class="bt-next"><i class="fa fa-angle-right"></i></div>
                            </div>
   <?php echo '<div class="owl-carousel owl-theme">';
        foreach($list as $index => $item){
            if($params->get('item_first_product_display',1) == 1){
                if($index == 0)continue;
            }
            echo '<div class="item">';
                echo '<div class="sj_relative">';
                echo '<div class="item-inner">';
                    $item_img = VMDealsHelper::getVmImage($item, $params, 'imgcfg');
                    if ($item_img) {
                        echo '<div class="item-image">
                                    <a href="'.$item->link.'"
                                        title="'.$item->title.'" '.VMDealsHelper::parseTarget($params->get('link_target')).' >'.VMDealsHelper::imageTag($item_img, $small_image_config).'
                                        <span class="image-border"></span>
                                    </a>
                                </div>';
                    }
                    if($params->get('item_countdown_display') != 'POP'){
                        if($item->prices['product_price_publish_down'] && $item->prices['product_price_publish_down'] != null){
                            echo '<div class="item-deals" data-deals="'.$item->prices['product_price_publish_down'].'">';

                            echo '</div>';
                        }
                    }
                    require JModuleHelper::getLayoutPath($module->module, $layout . '_rating');
                    if ($params->get('item_title_display', 1) == 1) {
                        echo '<div class="item-title">';
                            echo '<a href="'.$item->link.'" title="'.$item->title.'" '.VMDealsHelper::parseTarget($params->get('link_target')).' >';
                                echo VMDealsHelper::truncate($item->title, (int)$params->get('item_title_max_characters', 25));
                            echo '</a>';
                        echo '</div>';
                    }

                    echo '<div class="item-price">';
                    if (!empty($item->prices['salesPrice'])) {
                        echo $currency->createPriceDiv('salesPrice', '', $item->prices, FALSE, FALSE, 1.0, TRUE);
                    }
                    if (!empty($item->prices['discountAmount'])) {
                        echo $currency->createPriceDiv('discountAmount', '', $item->prices, FALSE, FALSE, 1.0, TRUE);
                                                     ?>
                                                    <?php } ?>
                                             <?php echo '</div>';
                echo '</div>';
                if($params->get('item_popup_display') == 1){
                    echo '<div class="sj_vm_deals_popup sj_absolute">';
                        if ($params->get('item_addtocart_display', 1) == 1) {
                            $_item['product'] = $item;
                            echo '<div class="item-addtocart">';
                                echo shopFunctionsF::renderVmSubLayout('addtocart', $_item);
                            echo '</div>';
                        }
                        if ($params->get('item_quickview_display', 1) == 1) {
                            echo '<div class="item-quick-view">';
                                echo '<a href="'.$item->link.'" title="'.$item->title.'" '.VMDealsHelper::parseTarget($params->get('link_target')).' style="display:none;"></a>';
                            echo '</div>';
                        }
                    echo '</div>';
                }
            echo '</div>';
            echo '</div>';
        }

    echo '</div>';
    if($params->get('item_first_product_display',1) == 1){
        echo '</div>';
    }

?>

