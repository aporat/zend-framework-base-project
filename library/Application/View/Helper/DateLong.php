<?php
/**
 *  Show DATE_LONG (February 11, 2011) with/without time (14:53 pm)
 *
 * @param   string $date
 * @param   bool $time
 * @return  string
 */
class Application_View_Helper_DateLong extends Zend_View_Helper_HtmlElement
{
    public function dateLong($date, $format = null, $time = true)
    {
    	if ($date == '0000-00-00 00:00:00') {
    		return 'N/A';
    	}
    	
    	$format = empty($format) ? Zend_Date::ISO_8601 : $format;
    	
		if (Zend_Date::isDate($date, $format)) {
			$dateIso = new Zend_Date($date, $format);
			$dateLong = $dateIso->toString(Zend_Date::DATE_LONG);
			
			if ($time) {
				$dateLong .= ', ' . $dateIso->toString(Zend_Date::TIME_SHORT);
			}
			
			return $dateLong;
	    } else {
			return $date;
		}	
    }
}