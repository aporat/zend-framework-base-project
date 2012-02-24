<?php
abstract class Form_Abstract extends Zend_Form
{
	const SELECT_DEFAULT_LABEL = '%s';
	const SELECT_DEFAULT_VALUE = 'NONE';


	/**
	 * @return array elements' errors decorator
	 */
	public function returnErrors()
	{
		$errors = array();
		foreach($this->getElements() as $element) {
			if ($element->hasErrors()) {
				$errors[$element->getId()] = $element->getDecorator('Errors')->setElement($element)->render('');
			}
		}
		return $errors;
	}


	/**
	 * get all errors on the form
	 */
	public function errors()
	{
		$errors = array();

		foreach($this->getMessages() as $elementKey => $message) {
				
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