<?php
namespace Main\Model;

use Zend\InputFilter\InputFilter;
use Zend\InputFilter\Input;
use Zend\Validator;

class ValidatorRestAlbum
{
    public function validatorAlbum($dato)
    {
        $artist = new Input('artist');
        $artist->getValidatorChain()->addValidator(new Validator\StringLength(array('min' => '5', 'max' => '20')));
        $title = new Input('title');
        $title->getValidatorChain()->addValidator(new Validator\StringLength(array('min' => '5', 'max' => '20')));
        $inputFilter = new InputFilter();
        $inputFilter->add($artist);
        $inputFilter->add($title);
        $inputFilter->setData((array)$dato);
        if ($inputFilter->isValid()) {
            return var_dump($dato);
        } else {
            return null;
        }
    }
}