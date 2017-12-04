<?php

namespace AppBundle\Form\DataTransformer;

use Symfony\Component\Form\DataTransformerInterface;
use Symfony\Component\Form\Exception\TransformationFailedException;
use Doctrine\Common\Persistence\ObjectManager;
use AppBundle\Entity\CuentasContables;

class CuentacontableToNumberTransformer implements DataTransformerInterface
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
     * Transforma un objeto (``CuentaContable``) a una cadena (``cc``).
     *
     * @param  CuentaContable|null $ctaContable
     * @return string
     */
    public function transform($ctaContable)
    {
        if (null === $ctaContable) {
            return "";
        }

        return $ctaContable->getCuentaContable();
    }
    
    /**
     * Transforma una cadena (``cc``) a un objeto (``CuentaContable``).
     *
     * @param  string $cc
     *
     * @return CuentaContable|null
     *
     * @throws TransformationFailedException si no encuentra el objeto (CuentaContable).
     */
    public function reverseTransform($cc)
    {
        if (!$cc) {
            return null;
        }

        $ctaContable = $this->om
            ->getRepository('AppBundle:CuentasContables')
            ->findOneBy(array('cuentaContable' => $cc))
        ;

        if (null === $ctaContable) {
            throw new TransformationFailedException(sprintf(
                'La cuenta contable número "%s" no existe!',
                $ctaContable
            ));
        }

        return $ctaContable;
    }

}


