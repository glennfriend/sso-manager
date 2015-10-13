<?php
/**
 * Date
 *
 * @version     1.0.0.0
 * @category    Ydin
 * @package     Ydin\Date
 * @uses
 */
namespace Ydin;

class Date
{

    /**
     * ��J�����, ��{�b���A�����ɶ��ۤ��, �O�_�b��J�� �Ѽ� ����
     *
     * @param int $time
     * @param int $day
     * @return boolean
     */
    public static function inDay( $time, $day )
    {
        $diff = time() - ((int) $time);
        if ( $diff < 0 ) {
            // ��ܥ��Ӫ����
            return true;
        }

        $second = ((int) $day) * 86400;
        if ( $second - $diff > 0 ) {
            return true;
        }
        return false;
    }

}
