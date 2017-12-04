<?php

namespace AppBundle\Form\DataTransformer;

use Symfony\Component\Form\DataTransformerInterface;
use Symfony\Component\Form\Exception\TransformationFailedException;
use Doctrine\Common\Persistence\ObjectManager;
use AppBundle\Entity\CodigosPostales;

class CodigopostalToNumberTransformer implements DataTransformerInterface
{
    /**
     * @var ObjectManager
     */
    private $om;
    
    /**
     * @param ObjectManager $om
     */
    public function __construct(ObjectManager $om)
    {
        $this->om = $om;
    }
    
    /**
     * Transforma un objeto (``CodigoPostal``) a una cadena (``cp``).
     *
     * @param  CodigoPostal|null $codigoPostal
     * @return string
     */
    public function transform($codigoPostal)
    {
        if (null === $codigoPostal) {
            return "";
        }

        return $codigoPostal->getCp();
    }
    
    /**
     * Transforma una cadena (``cp``) a un objeto (``CodigoPostal``).
     *
     * @param  string $cp
     *
     * @return CodgigoPostal|null
     *
     * @throws TransformationFailedException si no encuentra el objeto (CodigoPostal).
     */
    public function reverseTransform($cp)
    {
        if (!$cp) {
            return null;
        }

        $codigoPostal = $this->om
            ->getRepository('AppBundle:CodigosPostales')
            ->findOneBy(array('cp' => $cp))
        ;

        if (null === $codigoPostal) {
            throw new TransformationFailedException(sprintf(
                'El Código Postal número "%s" no existe!',
                $cp
            ));
        }

        return $codigoPostal;
    }

}


