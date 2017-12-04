<?php

namespace AppBundle\Form\DataTransformer;

use Symfony\Component\Form\DataTransformerInterface;
use Symfony\Component\Form\Exception\TransformationFailedException;
use Doctrine\Common\Persistence\ObjectManager;
use AppBundle\Entity\CuentasPersonales;

class CuentapersonalToNumberTransformer implements DataTransformerInterface
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
     * Transforma un objeto (``CuentaPersonal``) a una cadena (``ctapersonal``).
     *
     * @param  CuentaPersonal|null $cuentaPersonal
     * @return string
     */
    public function transform($cuentaPersonal)
    {
        if (null === $cuentaPersonal) {
            return "";
        }

        return $cuentaPersonal->getNcuentaPersonal();
    }
    
    /**
     * Transforma una cadena (``ctapersonal``) a un objeto (``CuentaPersonal``).
     *
     * @param  string $ctapersonal
     *
     * @return CuentaPersonal|null
     *
     * @throws TransformationFailedException si no encuentra el objeto (CuentaPersonal).
     */
    public function reverseTransform($ncuentaPersonal)
    {
        if (!$ncuentaPersonal) {
            return null;
        }

       $cuentaPersonal = $this->om
            ->getRepository('AppBundle:CuentasPersonales')
            ->findOneBy(array('ncuentaPersonal' => $ncuentaPersonal))
        ;

        if (null === $cuentaPersonal) {
            throw new TransformationFailedException(sprintf(
                'La Cuenta Personal número "%s" no existe!',
                $ncuentaPersonal
            ));
        }

        return $cuentaPersonal;
    }

}


