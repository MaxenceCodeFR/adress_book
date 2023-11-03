<?php

use Symfony\Component\Validator\Constraints\Compound;
use Symfony\Component\Validator\Constraints as Assert;

class PhoneRegex extends Compound
{

    protected function getConstraints(array $options): array
    {
        return [
            //regex -> pour avoir au minium un chiffre ou plus 
            // d = digit
            // i = case insensitive (autorise les majuscules et minuscules)
            // + = peut avoir plusieurs chiffres
            new Assert\Regex([
                'pattern' => '/^0[0-9]*$/',
                'message' => 'Le numéro de téléphone doit commencer par 0 et ne contenir que des chiffres.'
            ]),

        ];
    }
}
