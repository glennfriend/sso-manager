<?php
/**
 *  該程式於 model 呼叫使用
 *  代入特定的 white-list array 
 *  將會處理裡面的參數
 *
 *  白名單格式 $whiteList example
  *      array(
 *          'field' => [
 *              'id'            => 'order_item.id',
 *              'orderId'       => 'order_item.order_id',
 *              'status'        => 'order_item.status',
 *              'sku'           => 'order_item.sku',
 *              'orderId'       => 'order.order_number',
 *              'orderNumber'   => 'order.order_number',
 *          ],
 *          'option' => [
 *              '_order',
 *              '_page',
 *              '_itemsPerPage',
 *          ]
 *      );
 *
 */
class ZendModelWhiteListHelper
{

    /**
     *  如果代入的欄位不在白名單, 會 trigger error
     *
     *  @param array $options, 標準欄位格式
     *  @param array $allowFields, 予許的欄位白名單
     */
    public static function validateFields( Array $option, Array $whiteList )
    {
        foreach ( $option as $field => $value) {
            if ( !in_array($field, array_keys($whiteList['fields'])) &&
                 !in_array($field, $whiteList['option'] )
            ) {
                $field = preg_replace("/[^a-zA-Z0-9_]+/", '', $field );
                trigger_error("Custom Model Error: field not found '{$field}'", E_USER_ERROR);
            }
        }
    }

    /**
     *  將陣列資料的 null 轉換為 空字串
     *
     *  @param array $options, 標準欄位格式
     *  @return array
     */
    public static function fieldValueNullToEmpty( Array & $options )
    {
        foreach ( $options as $field => $value) {
            if ( is_null($options[$field]) ) {
                $options[$field] = '';
            }
        }
    }

    /**
     *  filter order-by string
     *  如果欄位名稱沒包含在白名單內
     *  則 unset() 這筆資料
     *
     *  該程式 會 區分大寫小
     *
     *  example:
     *      array(
     *          "_order" => "order_number desc"
     *      )
     *      , array(
     *          "order_id",
     *          "order_number",
     *      )
     *
     *  @return array
     */
    public static function filterOrder( Array & $option, Array $whiteList, $name='_order' )
    {
        // 如果欄位不存在, 則不處理
        if ( !isset($option[$name]) ) {
            return $option;
        }
        $orderBy = explode(',', trim( $option[$name] ) );


        // field
        $field = $orderBy[0];
        if ( !in_array( $field, array_keys($whiteList['fields']) ) ) {
            unset( $option[$name] );
            return $option;
        }

        // order by
        $order = isset($orderBy[1]) ? $orderBy[1] : 'asc';
        if ( 'desc' != strtolower($order) ) {
            $order = 'asc';
        }

        $option[$name] = $whiteList['fields'][$field].' '.$order;
    }


}
