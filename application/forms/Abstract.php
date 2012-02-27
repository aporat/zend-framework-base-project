<?php
abstract class Form_Abstract extends Zend_Form
{
	/**
	 * get all errors on the form
	 */
	public function errors()
	{
		$errors = array();

		foreach ($this->getMessages() as $elementKey => $message) {
				
			$element = $this->getElement($elementKey);
			
			if ($element instanceof Zend_Form_Element) {
				$element->removeDecorator('Errors');
				
				if (is_array($message)) {
					foreach ($message as $errorKey => $errorMessage) {
						if (empty($errors[$elementKey])) {
							$errors[$elementKey] = array('message' => $errorMessage);
						}
					}
				}
			}
		}
		
		return $errors;
	}

}