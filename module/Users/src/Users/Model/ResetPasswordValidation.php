<?php

/**
 * LoginValidation class
*
* @author Display Name <osscube(Kaushal Kishore)>
* Used to add validator on login form
*/
namespace Users\Model;

use Zend\InputFilter\InputFilter;
use Zend\InputFilter\Factory as InputFactory;
use Zend\InputFilter\InputFilterAwareInterface;
use Zend\InputFilter\InputFilterInterface;

/**
 * LoginValidation is used to add validator on login form
 *
 * @category Login
 * @package Model
 *         
 * @author Display Name <osscube(Kaushal Kishore)>
 */
class ResetPasswordValidation implements InputFilterAwareInterface
{

    /**
     *
     * @var object Zend\InputFilter\InputFilterAwareInterface
     */
    protected $_inputFilter;

    /**
     * set interface for input filter
     *
     * @param InputFilterInterface $inputFilter
     *            object of InputFilterInterface
     *            
     * @throws \Exception
     * @return void
     */
    public function setInputFilter(InputFilterInterface $inputFilter)
    {
        throw new \Exception("Not used $inputFilter");
    }

    /**
     * Function to add validation on
     * Add filter form
     *
     * @return object Zend\InputFilter\InputFilterAwareInterface
     */
    public function getInputFilter()
    {
        if (! $this->_inputFilter) {
            $inputFilter = new InputFilter();
            
            $factory = new InputFactory();
            $isEmpty = \Zend\Validator\NotEmpty::IS_EMPTY;
            $minLength = \Zend\Validator\StringLength::TOO_SHORT;
            $maxLength = \Zend\Validator\StringLength::TOO_LONG;
            /* $invalidEmail = \Zend\Validator\EmailAddress::INVALID_FORMAT; */
            $regexNotMatched = \Zend\Validator\Regex::NOT_MATCH;
            $notMatched = \Zend\Validator\Identical::NOT_SAME;
            
            $inputFilter->add($factory->createInput(array(
                'name' => 'new_password',
                'required' => true,
                'validators' => array(
                    array(
                        'name' => 'NotEmpty',
                        'options' => array(
                            'messages' => array(
                                $isEmpty => 'Senha não pode estar vazia.'
                            )
                        ),
                        'break_chain_on_failure' => true
                    ),
                    
                    array(
                        'name' => 'Regex',
                        'options' => array(
                            'pattern' => '/^(?=.*\d)(?=.*[a-z])(?=.*[A-Z])(?=.*[!@#$%^&*()\-_=+{};:,<.>]).{8,45}$/',
                            'messages' => array(
                                $regexNotMatched => 'A senha deve conter pelo menos um caractere especial.'
                            )
                        ),
                        'break_chain_on_failure' => true
                    ),
                    
                    array(
                        'name' => 'StringLength',
                        'options' => array(
                            'min' => 8,
                            'max' => 45,
                            'messages' => array(
                                $minLength => 'A senha deve ter no mínimo 8 caracteres',
                                $maxLength => 'A senha deve ter menos de 45 caracteres'
                            )
                        ),
                        'break_chain_on_failure' => true
                    )
                ),
                'filters' => array(
                    array(
                        'name' => 'StripTags'
                    ),
                    array(
                        'name' => 'StringTrim'
                    )
                )
            )));
            
            $inputFilter->add($factory->createInput(array(
                'name' => 'confirm_password',
                'required' => true,
                'validators' => array(
                    array(
                        'name' => 'NotEmpty',
                        'options' => array(
                            'messages' => array(
                                $isEmpty => 'Confirmação de Senha não pode estar vazia.'
                            )
                        ),
                        'break_chain_on_failure' => true
                    ),
                    
                    array(
                        'name' => 'Identical',
                        'options' => array(
                            'token' => 'new_password',
                            'messages' => array(
                                $notMatched => 'Nova Senha e Confirmação de Senha não correspondem.'
                            )
                        ),
                        'break_chain_on_failure' => true
                    )
                )
                ,
                'filters' => array(
                    array(
                        'name' => 'StripTags'
                    ),
                    array(
                        'name' => 'StringTrim'
                    )
                )
            )));
            
            $this->_inputFilter = $inputFilter;
        }
        
        return $this->_inputFilter;
    }
}
