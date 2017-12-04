<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use AppBundle\Entity\CodigosPostales;
use AppBundle\Entity\CuentasPersonales;
use AppBundle\Entity\DatosTelefonicos;
use AppBundle\Entity\REBUTerceros;
use AppBundle\Entity\VehiculosREBUTerceros;
use AppBundle\Entity\ComprasRG;
use AppBundle\Entity\VehiculosComprasRG;
use AppBundle\Entity\REBUAutoFacturas;
use AppBundle\Entity\Usuario;
use AppBundle\Entity\Asientos;
use AppBundle\Entity\Apuntes;
use AppBundle\Entity\Diarios;
use AppBundle\Entity\CuentasContables;
use AppBundle\Entity\TiposIva;
use AppBundle\Entity\Ejercicios;
use AppBundle\Entity\GastosFacturas;


class DefaultController extends Controller
{
    /**
     * @Route("/SoftAutoWeb/", name="Inicio")
     */
    public function inicioAction()
    {
        return $this->render('inicio.html.twig');
    }
    
    
    /**
     * @Route("/usuario/autoFacturaREBUpdf/", name="autoFacturaREBUpdf")
     */
    public function autoFacturaREBUpdfAction(Request $request)
    {
            $nFactura = $request->query->get('factura');
        
            $em = $this->getDoctrine()->getManager();
            
            $factura = $em->getRepository('AppBundle:REBUAutoFacturas')->findOneBy(array(
                'nAutoFactura' => $nFactura
            ));
        
        
            $html = $this->renderView('REBUAutoFacturaPdf.html.twig', array('factura' => $factura));
            $pdf= $this->get('knp_snappy.pdf')->getOutputFromHtml($html, array(
                'lowquality'                   => false,
                'grayscale'                    => false,
                'margin-bottom'                => 0,
                'margin-left'                  => 0,
                'margin-right'                 => 0,
                'margin-top'                   => 0,
                'page-size'                    => "A4",
                'images'                       => true,
                'enable-javascript'            => true,
                'disable-smart-shrinking'      => true,
                'zoom'                         => 1.04,
                'footer-html'                  => "<h1>aqui</h1>",
            ));
        
            return new \Symfony\Component\HttpFoundation\Response(
                $pdf, 200, array(
                    'Content-Type' => 'application/pdf',
                    'Content-Disposition' => 'inline; filename="file.pdf"',
            ));    
        
    }
    
    /**
     * @Route("/usuario/inicio/", name="Inicio_loginOK")
     */
    public function inicioOKAction()
    {
        return $this->render('inicio_loginOK.html.twig');
    }
    
    /**
     * @Route("usuario/compraVenta/", name="compraVenta")
     */
    public function compraVentaAction()
    {
        return $this->render('compraventa.html.twig');
    }
    
    /**
     * @Route("/usuario/taller", name="taller")
     */
    public function tallerAction()
    {
        return $this->render('taller.html.twig');
    }
    
    /**
     * @Route("/usuario/insertarCuentasPersonales/", name="insertarCuentasPersonales")
     */
    public function insertarCuentasPersonalesAction(Request $request)
    {
        
            $cuentaPersonal = new CuentasPersonales();
            $formulario = $this->createForm('AppBundle\Form\CuentasPersonalesType', $cuentaPersonal, array(
                'em' => $this->getDoctrine()->getEntityManager(),                                                                                               
            ));
            
            $formulario->handleRequest($request);
            
            if ($formulario->isValid()) {
                
                $em = $this->getDoctrine()->getManager();
                
                $em->persist($cuentaPersonal);
                $em->flush();
                //Actualizamos el numero de cuenta personal basado en el id
                $var = $cuentaPersonal->getId();
                $nvar = strlen($var);
                switch ($nvar){
                    case 1:
                        $ctaPersonal = "0"."0"."0"."0".$var;
                        $cuentaPersonal->setNcuentaPersonal($ctaPersonal);
                        break;
                    case 2:
                        $ctaPersonal = "0"."0"."0".$var;
                        $cuentaPersonal->setNcuentaPersonal($ctaPersonal);
                        break;
                    case 3:
                        $ctaPersonal = "0"."0".$var;
                        $cuentaPersonal->setNcuentaPersonal($ctaPersonal);
                        break;
                    case 4:
                        $ctaPersonal = "0".$var;
                        $cuentaPersonal->setNcuentaPersonal($ctaPersonal);
                        break;
                    default:
                        $ctaPersonal = $var;
                        $cuentaPersonal->setNcuentaPersonal($ctaPersonal);
                }
                $em->flush();
                $cuenta = $cuentaPersonal->getNcuentaPersonal();
                $nombre = $cuentaPersonal->getNombre();
                $apellido1 = $cuentaPersonal->getPrimerApellido();
                $apellido2 = $cuentaPersonal->getSegundoApellido();
                $nifcif = $cuentaPersonal->getNifCif();
                $denominacionSocial = $cuentaPersonal->getDenominacionSocial();
                if (is_null($denominacionSocial)){
                    $this->addFlash(
                        'notice',
                        'La cuenta '.$cuenta.' se ha añadido correctamente'
                    );
                    $this->addFlash(
                        'notice',
                        $nombre.' '.$apellido1.' '.$apellido2
                    );
                    $this->addFlash(
                        'notice',
                        $nifcif
                    );
                }else{
                    $this->addFlash(
                        'notice',
                        'La cuenta '.$cuenta.' se ha añadido correctamente'
                    );
                    $this->addFlash(
                        'notice',
                        $denominacionSocial
                    );
                    $this->addFlash(
                        'notice',
                        $nifcif
                    );
                }
                
                return $this->redirectToRoute('REBUTerceros');
                 
            }
        
            return $this->render('insertarCuentasPersonales.html.twig', array(
                'formulario' => $formulario->createView()
            ));
        
    }
    
    /**
     * @Route("/usuario/insertarCodigosPostalesAjax/", name="insertarCodigosPostalesAjax")
     */
    public function insertarCodigosPostalesAjaxAction(Request $request)
    {
        if ($request->isXmlHttpRequest())
        {
            $codigoPostal = new CodigosPostales();
        
            $formulario = $this->createForm('AppBundle\Form\CodigosPostalesType', $codigoPostal);
            
            $formulario->handleRequest($request);
        
            if ($formulario->isValid()) {
                $em = $this->getDoctrine()->getManager();
                $ObtenerCp = $codigoPostal->getCp();
                $codigoPostal->setSlug($ObtenerCp);
                $em->persist($codigoPostal);
                $em->flush();
                
                $this->addFlash('info', 'Código Postal añadido');
            
            }
        
            return $this->render('insertarCodigosPostalesAjax.html.twig', array(
                'formulario' => $formulario->createView()                                                        
            ));
        }
        
    }
    
    /**
     * @Route("/usuario/insertarCodigosPostales/", name="insertarCodigosPostales")
     */
    public function insertarCodigosPostalesAction(Request $request)
    {
        $codigoPostal = new CodigosPostales();
        
        $formulario = $this->createForm('AppBundle\Form\CodigosPostalesType', $codigoPostal);
        
        $formulario->handleRequest($request);
        
        if ($formulario->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $ObtenerCp = $codigoPostal->getCp();
            $codigoPostal->setSlug($ObtenerCp);
            $em->persist($codigoPostal);
            $em->flush();
            
            $this->addFlash('info', 'Código Postal añadido');
            
            return $this->redirectToRoute('insertarCodigosPostales');
        }
        
        return $this->render('insertarCodigosPostales.html.twig', array(
            'formulario' => $formulario->createView()                                                        
        ));
    }
    
    /**
     * @Route("/usuario/numeroCPs/", name="numeroCPs")
     */
    public function numeroCpsAction(Request $request)
    {
        if ($request->isXmlHttpRequest())
        {
            $cp = $request->request->get('cpost');
            
            $em = $this->getDoctrine()->getManager();
            $codigosPostales = $em->getRepository('AppBundle:CodigosPostales')->findOneBy(array(
                'cp' => $cp    
            ));
            
            $NcodigosPostales = count($codigosPostales);
            
            return new Response($NcodigosPostales);
        }
    }
    
    /**
     * @Route("/usuario/numeroCPers/", name="numeroCPers")
     */
    public function numeroCpersAction(Request $request)
    {
        if ($request->isXmlHttpRequest())
        {
            $cpers = $request->request->get('cpersonal');
            
            $em = $this->getDoctrine()->getManager();
            $cuentasPersonales = $em->getRepository('AppBundle:CuentasPersonales')->findOneBy(array(
                'ncuentaPersonal' => $cpers,
                'proveedor'=> true
            ));
            
            $NcuentasPersonales = count($cuentasPersonales);
            
            return new Response($NcuentasPersonales);
        }
    }
    
    /**
     * @Route("/usuario/buscarCP/", name="buscarCP")
     */
    public function buscarcpAction(Request $request)
    {
        if ($request->isXmlHttpRequest()) 
        {
            $cp = $request->request->get('cpost');
            
            $em = $this->getDoctrine()->getManager();
            $codigosPostales = $em->getRepository('AppBundle:CodigosPostales')->findOneBy(array(
                'cp' => $cp    
            ));
            
            $NcodigosPostales = count($codigosPostales);
            
            if (empty($codigosPostales)) {
                
                return $this->render('cp.html.twig', array(
                    'codigoPostal' => $NcodigosPostales,
                ));
            
            } else {
                $localidad = $codigosPostales->getLocalidad();
                $provincia = $codigosPostales->getProvincia();
                $pais = $codigosPostales->getPais();
                
                return $this->render('cp.html.twig', array(
                    'codigoPostal' => $NcodigosPostales,
                    'localidad' => $localidad,
                    'provincia' => $provincia,
                    'pais' => $pais
                ));
                
            }
        }   
    }
    
    /**
     *@Route("/usuario/aProveedor/", name="aProveedor")
     */
    public function aProveedorAction(Request $request)
    {
        if ($request->isXmlHttpRequest())
        {
            $cpers = $request->request->get('cpersonal');
            
            $em = $this->getDoctrine()->getManager();
            $cuentaPersonal = $em->getRepository('AppBundle:CuentasPersonales')->findOneBy(array(
                'ncuentaPersonal' => $cpers    
            ));
            
            $cuentaPersonal->setProveedor(true);
            
            $em->flush();
            
            return $this->redirectToRoute('REBUTerceros');
        }
    }
    
    
    /**
     * @Route("/usuario/comprobarEjercicio/", name="comprobarEjercicio")
     */
    public function comprobarEjercicioAction(Request $request)
    {
        if ($request->isXmlHttpRequest())
        {
            $año = $request->query->get('ejerc');
            
            $em = $this->getDoctrine()->getManager();
            $ejercicio = $em->getRepository('AppBundle:Ejercicios')->findOneBy(array(
                'ejercicio' => $año    
            ));
            
            $comprobarEjercicio = count($ejercicio);
            
            if (!empty($ejercicio)) {
                if ($ejercicio->getAbierto() == false){ //ejercicio existe y está cerrado
                    $caso = 1;
                }else{
                    $caso = 2;
                }
            }else{  //ejercicio no existe
               $caso = 3;
            };
            
            return new Response($caso);
        }
    }
    
    /**
     * @Route("/usuario/buscarCtaPers/", name="buscarCtaPers")
     */
    public function buscarCtaPersAction(Request $request)
    {
        if ($request->isXmlHttpRequest())
        {
            $cpers = $request->request->get('cpersonal');
            
            $em = $this->getDoctrine()->getManager();
            $cuentaPersonal = $em->getRepository('AppBundle:CuentasPersonales')->findOneBy(array(
                'ncuentaPersonal' => $cpers    
            ));
            
            if ($cuentaPersonal->getProveedor() == true) {
                $respuesta = 1;
            }else{
                $respuesta = 0;
            };
            
            return new Response($respuesta);
        }
    }
    
    /**
     * @Route("/usuario/buscarCPers/", name="buscarCPers")
     */
    public function buscarcpersAction(Request $request)
    {
        if ($request->isXmlHttpRequest())
        {
            $cpers = $request->request->get('cpersonal');
            
            $em = $this->getDoctrine()->getManager();
            $cuentasPersonales = $em->getRepository('AppBundle:CuentasPersonales')->findOneBy(array(
                'ncuentaPersonal' => $cpers,
                'proveedor' => true
            ));
            
            $NcuentasPersonales = count($cuentasPersonales);
            
            if (empty($cuentasPersonales)) {
                
                return $this->render('cpers.html.twig', array(
                    'cuentasPersonales' => $NcuentasPersonales,
                ));
            
            } else {
            
                $nombre = $cuentasPersonales->getNombre();
                $primerApellido = $cuentasPersonales->getPrimerApellido();
                $segundoApellido = $cuentasPersonales->getSegundoApellido();
                $denominacionSocial = $cuentasPersonales->getDenominacionSocial();
                $nifCif = $cuentasPersonales->getNifCif();
                
                return $this->render('cpers.html.twig', array(
                    'cuentasPersonales' => $NcuentasPersonales,
                    'nombre' => $nombre,
                    'primerApellido' => $primerApellido,
                    'segundoApellido' => $segundoApellido,
                    'denominacionSocial' => $denominacionSocial,
                    'nifCif' => $nifCif
                ));
            }
        }
    }
    
    /**
     * @Route("/usuario/prueba/", name="Prueba")
     */
    public function PruebaAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $db = $em->getConnection();
        
        //Ejecutar codigo nativo SQL para consulta de union de varias tablas
        $query = "(SELECT rebut.id, rebut.cuenta_personal_id, rebut.tipo_iva_id, rebut.fecha_factura as fecha, rebut.numero_factura, rebut.asiento_id,
                          cper.id, cper.nombre, cper.primer_apellido, cper.segundo_apellido, cper.denominacion_social, cper.nif_cif,
                          tiva.id, tiva.porcentaje as porc,
                          asie.id, asie.diario_id, asie.referencia,
                          SUM(vrebut.importe) as base, vrebut.RebuTerceros_id
                    FROM rebuterceros rebut, cuentas_personales cper, tipos_iva tiva, asientos asie, vehiculos_rebuterceros vrebut
                    WHERE rebut.cuenta_personal_id = cper.id
                    AND rebut.tipo_iva_id = tiva.id
                    AND rebut.asiento_id = asie.id
                    AND rebut.id = vrebut.RebuTerceros_id GROUP BY rebut.id)
                  UNION
                  (SELECT rg.id, rg.cuenta_personal_id, rg.tipo_iva_id, rg.fecha_factura as fecha, rg.numero_factura, rg.asiento_id,
                          cpers.id, cpers.nombre, cpers.primer_apellido, cpers.segundo_apellido, cpers.denominacion_social, cpers.nif_cif,
                          tpiva.id, tpiva.porcentaje as porc,
                          asien.id, asien.diario_id, asien.referencia,
                          SUM(vrg.importe) as base, vrg.ComprasRG_id
                    FROM compras_rg rg, cuentas_personales cpers, tipos_iva tpiva, asientos asien, vehiculos_compras_rg vrg
                    WHERE rg.cuenta_personal_id = cpers.id
                    AND rg.tipo_iva_id = tpiva.id
                    AND rg.asiento_id = asien.id
                    AND rg.id = vrg.ComprasRG_id GROUP BY rg.id)
                  UNION
                  (SELECT autof.id, autof.cuenta_personal_id, autof.tipo_iva_id, autof.fecha_factura as fecha, autof.n_auto_factura, autof.asiento_id,
                          cperso.id, cperso.nombre, cperso.primer_apellido, cperso.segundo_apellido, cperso.denominacion_social, cperso.nif_cif,
                          tipiva.id, tipiva.porcentaje as porc,
                          asient.id, asient.diario_id, asient.referencia,
                          autof.importe as base, autof.importe as base
                    FROM rebuauto_facturas autof, cuentas_personales cperso, tipos_iva tipiva, asientos asient
                    WHERE autof.cuenta_personal_id = cperso.id
                    AND autof.tipo_iva_id = tipiva.id
                    AND autof.asiento_id = asient.id)
                  ORDER BY fecha
                ";
                
        $stmt = $db->prepare($query);
        $params = array();
        $stmt->execute($params);
        $facturas=$stmt->fetchAll();
        
        //Totalizar por tipos de iva encontrados
        $tipos=[];
        foreach ($facturas as $factura) {
            $tipoIva = $factura['porc'];
            if (in_array($tipoIva, $tipos) == false) {
                $tipos[] = $tipoIva;
            }
        }
        
        return $this->render('prueba.html.twig', array(
            'facturas' => $facturas,
            'tipos' => $tipos
        )); 
        
    }
    

    private function PersistirAutoFacturaRebu(REBUAutoFacturas $REBUAutoFactura, Asientos $asiento)
    {
        $em = $this->getDoctrine()->getManager();

        $tIva = $em->find('AppBundle:TiposIva', 1);
        $REBUAutoFactura->setTipoIva($tIva);
            
        $em->persist($REBUAutoFactura);
            
        $fecha = $REBUAutoFactura->getFechaFactura();
        $fechaS = $fecha->format('Y-m-d');
        $año2cifras = substr($fechaS, 2, 2);
        $año4cifras = substr($fechaS, 0, 4);
        $fecha1 = $año4cifras."-01-01";
        $fecha2 = $año4cifras."-12-31";
            
        $autoFacturas = $em->getRepository('AppBundle:REBUAutoFacturas')->findAll();
        if(empty($autoFacturas)) {
            $nuevoNAnual = 1;
        }else{
            $consulta = "SELECT fact FROM AppBundle:REBUAutoFacturas fact
                         WHERE fact.fechaFactura >= :fecha1 AND fact.fechaFactura <= :fecha2
                         ORDER BY fact.nAnual DESC";   
            $facturasAnuales = $em->createQuery($consulta)
                ->setParameter('fecha1', $fecha1)
                ->setParameter('fecha2', $fecha2)
                ->setMaxResults(1)
                ->getResult();
            if (empty($facturasAnuales)) {
                $nuevoNAnual = 1;
            }else{
                foreach ($facturasAnuales as $fA) {
                    $ultimoNAnual = $fA->getNAnual();
                }
                $nuevoNAnual = $ultimoNAnual + 1;
            }    
        }
        $REBUAutoFactura->setNAnual($nuevoNAnual);
            
        $REBUAutoFactura->setNAutoFactura("A".$año2cifras."-".$nuevoNAnual);
            
        $asientos = $em->getRepository('AppBundle:Asientos')->findAll();
        if (empty($asientos)) {
            $referencia = 100001;
        }else{
            $ultimoAsiento = $em->getRepository('AppBundle:Asientos')->findBy(
                array(),
                array('id'=>'DESC'),
                1,
                0
            );
            foreach ($ultimoAsiento as $ua) {
                $ref = $ua->getReferencia();
            }
            $referencia = $ref + 1;
        }
            
        $ctaPersonal = $REBUAutoFactura->getCuentaPersonal();
        $importe = $REBUAutoFactura->getImporte();
        $diario = $em->find('AppBundle:Diarios', 2);
        $ctaContable1 = $em->find('AppBundle:CuentasContables', 3);
        $ctaContable2 = $em->find('AppBundle:CuentasContables', 4);
            
        $asiento->setFechaAsiento($fecha);
        $asiento->setReferencia($referencia);
        $asiento->setDiario($diario);
            
        $apunte1= new Apuntes();
        $apunte1->setCuentaContable($ctaContable1);
        $apunte1->setCuentaPersonal($ctaPersonal);
        $apunte1->setConcepto('Factura nº. '.'A'.$año2cifras.'-'.$nuevoNAnual);
        $apunte1->setImporte($importe);
        $apunte1->setDebe(0);
        $asiento->addApunte($apunte1);
            
        $apunte2= new Apuntes();
        $apunte2->setCuentaContable($ctaContable2);
        $apunte2->setConcepto('Factura nº. '.'A'.$año2cifras.'-'.$nuevoNAnual);
        $apunte2->setImporte($importe);
        $apunte2->setDebe(1);
        $asiento->addApunte($apunte2);
            
        $REBUAutoFactura->setAsiento($asiento);
        $em->persist($asiento);
        $em->flush();
            
        $this->addFlash('info', 'REFERENCIA Nº.:'." ".$referencia);
              
    }

    private function PersistirRebuTerceros(REBUTerceros $REBUTercero, Asientos $asiento)
    {
        $em = $this->getDoctrine()->getManager();

        $REBUTercero->getVehiculosREBUTerceros();
        $tIva = $em->find('AppBundle:TiposIva', 1);
        $REBUTercero->setTipoIva($tIva);
        $em->persist($REBUTercero);
            
            
        $fecha = $REBUTercero->getFechaFactura();
            
        $asientos = $em->getRepository('AppBundle:Asientos')->findAll();
        if (empty($asientos)) {
            $referencia = 100001;
        }else{
            $ultimoAsiento = $em->getRepository('AppBundle:Asientos')->findBy(
                array(),
                array('id'=>'DESC'),
                1,
                0
            );
            foreach ($ultimoAsiento as $ua) {
                $ref = $ua->getReferencia();
            }
            $referencia = $ref + 1;
        }
            
        $ctaPersonal = $REBUTercero->getCuentaPersonal();
        $nFactura = $REBUTercero->getNumeroFactura();
        $vehiculos = $REBUTercero->getVehiculosREBUTerceros();
            
        $total = 0;
        foreach ($vehiculos as $vehiculo)
        {
            $importe = $vehiculo->getImporte();
            $total = $total + $importe;
        }
            
        $diario = $em->find('AppBundle:Diarios', 2);
        $ctaContable1 = $em->find('AppBundle:CuentasContables', 3);
        $ctaContable2 = $em->find('AppBundle:CuentasContables', 4);
            
        $asiento->setFechaAsiento($fecha);
        $asiento->setReferencia($referencia);
        $asiento->setDiario($diario);
        $apunte1= new Apuntes();
        $apunte1->setCuentaContable($ctaContable1);
        $apunte1->setCuentaPersonal($ctaPersonal);
        $apunte1->setConcepto('Factura nº. '.$nFactura);
        $apunte1->setImporte($total);
        $apunte1->setDebe(0);
        $asiento->addApunte($apunte1);
            
        $i=1;
        foreach ($vehiculos as $vehiculo)
        {
            $i=$i+1;
            $apunte = 'apunte'.$i;
            $apunte = new Apuntes();
            $apunte->setCuentaContable($ctaContable2);
            $apunte->setConcepto('COMPRA'." ".$vehiculo->getMarca()." ".$vehiculo->getModelo()." ".$vehiculo->getMatricula());
            $apunte->setImporte($vehiculo->getImporte());
            $apunte->setDebe(1);
            $asiento->addApunte($apunte);
        };
           
        $REBUTercero->setAsiento($asiento);
        $em->persist($asiento);
        $em->flush();
            
        $this->addFlash('info', 'REFERENCIA Nº.:'." ".$referencia);
    }

    private function PersistirComprasRG(ComprasRG $compraRG, Asientos $asiento)
    {
        $em = $this->getDoctrine()->getManager();

        $compraRG->getComprasRGVehiculos();
            
        $em->persist($compraRG);
        
        $fecha = $compraRG->getFechaFactura();
            
        $asientos = $em->getRepository('AppBundle:Asientos')->findAll();
        if (empty($asientos)) {
            $referencia = 100001;
        }else{
            $ultimoAsiento = $em->getRepository('AppBundle:Asientos')->findBy(
                array(),
                array('id'=>'DESC'),
                1,
                0
            );
            foreach ($ultimoAsiento as $ua) {
                $ref = $ua->getReferencia();
            }
            $referencia = $ref + 1;
        }
        
        $ctaPersonal = $compraRG->getCuentaPersonal();
        $nFactura = $compraRG->getNumeroFactura();
        $vehiculos = $compraRG->getComprasRGVehiculos();
            
        $total = 0;
        foreach ($vehiculos as $vehiculo)
        {
            $importe = $vehiculo->getImporte();
            $total = $total + $importe;
        }
        $tIva = $compraRG->getTipoIva();
        $porcentaje = $tIva->getPorcentaje();
        $importeTotal = $total + ($total * $porcentaje) / 100;
        $Iva = ($total * $porcentaje) / 100;
            
        $diario = $em->find('AppBundle:Diarios', 2);
        $ctaContable1 = $em->find('AppBundle:CuentasContables', 3);
        $ctaContable2 = $em->find('AppBundle:CuentasContables', 4);
        $ctaContable3 = $em->find('AppBundle:CuentasContables', 5);
            
        $asiento->setFechaAsiento($fecha);
        $asiento->setReferencia($referencia);
        $asiento->setDiario($diario);
        $apunte1 = new Apuntes();
        $apunte1->setCuentaContable($ctaContable1);
        $apunte1->setCuentaPersonal($ctaPersonal);
        $apunte1->setConcepto('Factura nº. '.$nFactura);
        $apunte1->setImporte($importeTotal);
        $apunte1->setDebe(0);
        $asiento->addApunte($apunte1);
            
        $apunte2 = new Apuntes();
        $apunte2->setCuentaContable($ctaContable3);
        $apunte2->setConcepto('IVA SOPORTADO Factura nº. '.$nFactura);
        $apunte2->setImporte($Iva);
        $apunte2->setDebe(1);
        $asiento->addApunte($apunte2);
            
        $i=2;
        foreach ($vehiculos as $vehiculo)
        {
            $i=$i+1;
            $apunte = 'apunte'.$i;
            $apunte = new Apuntes();
            $apunte->setCuentaContable($ctaContable2);
            $apunte->setConcepto('COMPRA'." ".$vehiculo->getMarca()." ".$vehiculo->getModelo()." ".$vehiculo->getMatricula());
            $apunte->setImporte($vehiculo->getImporte());
            $apunte->setDebe(1);
            $asiento->addApunte($apunte);
        };
            
        $compraRG->setAsiento($asiento);

        $em->persist($asiento);
        $em->flush();
            
        $this->addFlash('info', 'REFERENCIA Nº.:'." ".$referencia);
    }

    private function PersistirEjercicio($añoFactura)
    {
        $em = $this->getDoctrine()->getManager();

        $Ejercicio = new Ejercicios;
        $Ejercicio->setEjercicio((int)$añoFactura);
        $Ejercicio->setAbierto(1);

        $em->persist($Ejercicio);    
    }
    
    /**
     * @Route("/usuario/REBUAutoFacturas/", name="REBUAutoFacturas")
     */
    public function REBUAutoFacturasAction(Request $request)
    {
        $REBUAutoFactura = new REBUAutoFacturas();
        $asiento = new Asientos;
        
        $formulario = $this->createForm('AppBundle\Form\REBUAutoFacturasType', $REBUAutoFactura, array(
            'em' => $this->getDoctrine()->getEntityManager(),    
        ));
        
        $formulario->handleRequest($request);
        
        if ($formulario->isValid()) {
            
            $em = $this->getDoctrine()->getManager();

            //Obtener el año de la factura  y obtener el ejercicio correspondiente
                $fecha_Fact = $formulario->get('fechaFactura')->getData();
                $fecha_Factura = $fecha_Fact->format('Y-m-d');
                $año_Factura = substr($fecha_Factura, 0, 4);
                $ejercicio = $em->getRepository('AppBundle:Ejercicios')->findOneBy(array(
                    'ejercicio' => $año_Factura   
                ));

            if (empty($ejercicio)) { //Si el ejercicio no existe

                //persistir elejercicio
                $this->PersistirEjercicio($año_Factura);

                //persistir la factura
                $this->PersistirAutoFacturaRebu($REBUAutoFactura, $asiento);
                return $this->redirectToRoute('REBUAutoFacturas');
                
            }else{ //Si el ejercicio existe

                if ($ejercicio->getAbierto() == 0) { //Si el ejercicio está cerrado
                    
                    $this->addFlash(
                        'notice',
                        '¡El ejercicio '.$año_Factura.' está cerrado!'
                    );
                    return $this->redirectToRoute('REBUAutoFacturas');

                }else{ //Si el ejercicio está abierto

                    //persistir la factura
                    $this->PersistirAutoFacturaRebu($REBUAutoFactura, $asiento);
                    return $this->redirectToRoute('REBUAutoFacturas');   
                }
            }
        }
        
        return $this->render('insertarREBUAutoFacturas.html.twig', array(
            'formulario' => $formulario->createView()                                                        
        ));
    }

    /**
     * @Route("/usuario/GastosFactura/", name="GastosFactura")
     */
    public function GastosFacturaAction(Request $request)
    {
        $gastoFactura = new GastosFacturas();
        $asiento = new Asientos();

        $formulario = $this->createForm('AppBundle\Form\GastosFacturasType', $gastoFactura, array(
            'em' => $this->getDoctrine()->getEntityManager(),                                                                                       
        ));

        $formulario->handleRequest($request);

        if ($formulario->isValid()) {

            $em = $this->getDoctrine()->getManager();
        }

        return $this->render('insertarGastosFacturas.html.twig', array(
            'formulario' => $formulario->createView()                                                        
        )); 
    }

    /**
     * @Route("/usuario/ComprasRG/", name="ComprasRG")
     */
    public function ComprasRGAction(Request $request)
    {
        $compraRG = new ComprasRG();
        $asiento = new Asientos();
        
        $formulario = $this->createForm('AppBundle\Form\ComprasRGType', $compraRG, array(
            'em' => $this->getDoctrine()->getEntityManager(),                                                                                       
        ));
        
        $formulario->handleRequest($request);
        
        if ($formulario->isValid()) {
            
            $em = $this->getDoctrine()->getManager();

            //Obtener el año de la factura  y obtener el ejercicio correspondiente
                $fecha_Fact = $formulario->get('fechaFactura')->getData();
                $fecha_Factura = $fecha_Fact->format('Y-m-d');
                $año_Factura = substr($fecha_Factura, 0, 4);
                $ejercicio = $em->getRepository('AppBundle:Ejercicios')->findOneBy(array(
                    'ejercicio' => $año_Factura   
                ));

            if (empty($ejercicio)) {  //Si el ejercicio no existe

                //persistir elejercicio
                $this->PersistirEjercicio($año_Factura);

                //persistir la factura
                $this->PersistirComprasRG($compraRG, $asiento);
                return $this->redirectToRoute('ComprasRG');   

            }else{ //Si el ejercicio existe

                if ($ejercicio->getAbierto() == 0) { //Si el ejercicio está cerrado

                    $this->addFlash(
                        'notice',
                        '¡El ejercicio '.$año_Factura.' está cerrado!'
                    );
                    return $this->redirectToRoute('ComprasRG');

                }else{ //Si el ejercicio está abierto

                    //persistir la factura
                    $this->PersistirComprasRG($compraRG, $asiento);
                    return $this->redirectToRoute('ComprasRG');  

                }

            }
                
        }
        
        return $this->render('insertarComprasRG.html.twig', array(
            'formulario' => $formulario->createView()                                                        
        )); 
    }
    
    /**
     * @Route("/usuario/REBUTerceros/", name="REBUTerceros")
     */
    public function REBUTercerosAction(Request $request)
    {
        $REBUTercero = new REBUTerceros();
        $asiento = new Asientos();
        
        $formulario = $this->createForm('AppBundle\Form\REBUTercerosType', $REBUTercero, array(
            'em' => $this->getDoctrine()->getEntityManager(),                                                                                       
        ));
        
        $formulario->handleRequest($request);
        
        if ($formulario->isValid()) {

            $em = $this->getDoctrine()->getManager();

            //Obtener el año de la factura  y obtener el ejercicio correspondiente
                $fecha_Fact = $formulario->get('fechaFactura')->getData();
                $fecha_Factura = $fecha_Fact->format('Y-m-d');
                $año_Factura = substr($fecha_Factura, 0, 4);
                $ejercicio = $em->getRepository('AppBundle:Ejercicios')->findOneBy(array(
                    'ejercicio' => $año_Factura   
                ));

            if (empty($ejercicio)) { //Si el ejercicio no existe

                //persistir elejercicio
                $this->PersistirEjercicio($año_Factura);
                
                //persistir la factura
                $this->PersistirRebuTerceros($REBUTercero, $asiento);
                return $this->redirectToRoute('REBUTerceros'); 

            }else{ //Si el ejercicio existe

                if ($ejercicio->getAbierto() == 0) {  //Si el ejercicio está cerrado

                    $this->addFlash(
                        'notice',
                        '¡El ejercicio '.$año_Factura.' está cerrado!'
                    );
                    return $this->redirectToRoute('REBUTerceros');

                }else{  //Si el ejercicio está abierto

                    //persistir la factura
                    $this->PersistirRebuTerceros($REBUTercero, $asiento);
                    return $this->redirectToRoute('REBUTerceros'); 

                }

            }
            
        }
        
        return $this->render('insertarREBUTerceros.html.twig', array(
            'formulario' => $formulario->createView()                                                        
        ));    
    }
    
    /**
     *@Route("/usuario/proveedores/", name="grid_proveedores")
     */
    public function ProveedoresAjaxAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $consulta = $em->createQuery('SELECT cp.ncuentaPersonal, cp.nombre, cp.primerApellido, cp.segundoApellido,
                                     cp.denominacionSocial, cp.nifCif FROM AppBundle:CuentasPersonales cp
                                     WHERE cp.proveedor = true ORDER BY cp.id');
        $proveedores = $consulta->getResult();
        
        return $this->render('proveedoresREBU.html.twig', array(
            'proveedores' => $proveedores                                                        
        ));
    
    }
    
    /**
     *@Route("/usuario/cPersonales/", name="grid_cuentasPersonales")
     */
    public function cPersonalesAjaxAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $consulta = $em->getRepository('AppBundle:CuentasPersonales')->findAll();
        
        return $this->render('ctasPersonales.html.twig', array(
            'cPersonales' => $consulta 
        ));
    }
    
    /**
     *@Route("/usuario/gridCodigosPostales/", name="grid_codigosPostales")
     */
    public function CodigosPostalesAjaxAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $consulta = $em->createQuery('SELECT c.cp, c.localidad, c.provincia, c.pais FROM AppBundle:CodigosPostales c');
        $codigosPostales = $consulta->getResult();
        
        return $this->render('gridCodigosPostales.html.twig', array(
            'codigosPostales' => $codigosPostales                                                            
        ));
    }
    
    /**
     *@Route("/usuario/gridDiario/", name="grid_diario")
     */
    public function DiarioAjaxAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $asientos = $em->getRepository('AppBundle:Asientos')->findBy(
            array(),
            array('referencia' => 'DESC'),
            10,
            0
        );
        
        return $this->render('gridDiario.html.twig', array(
            'asientos' => $asientos   
        ));
    }
    
    /**
     *@Route("/usuario/gridFacturasComprasRG", name="grid_facturasComprasRG")
     */
    public function FacturasComprasRGAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $facturas = $em->getRepository('AppBundle:ComprasRG')->findAll();
        
        return $this->render('gridFacturasComprasRG.html.twig', array(
            'facturas' => $facturas    
        ));    
    }
    
    /**
     *@Route("/usuario/gridFacturasREBUAutoFacturas/", name="grid_facturasREBUAutoFacturas")
     */
    public function FacturasREBUAutoFacturasAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $facturas = $em->getRepository('AppBundle:REBUAutoFacturas')->findAll();
        
        return $this->render('gridFacturasREBUAutoFacturas.html.twig', array(
            'facturas' => $facturas 
        ));
    }
    
    /**
     *@Route("/usuario/gridFacturasREBUTerceros/", name="grid_facturasREBUTerceros")
     */
    public function FacturasREBUTercerosAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $facturas = $em->getRepository('AppBundle:REBUTerceros')->findAll();
        
        return $this->render('gridFacturasREBUTerceros.html.twig', array(
            'facturas' => $facturas    
        ));
    }
    
    /**
     *@Route("/regUsuarios", name="registro_usuarios")
     */
    public function registroUsuariosAction(Request $request)
    {
        $usuario = new Usuario();
        
        $formulario = $this->createForm('AppBundle\Form\UsuarioType', $usuario);
        
        $formulario->handleRequest($request);
        
        if ($formulario->isValid()) {
            $encoder = $this->get('security.encoder_factory')->getEncoder($usuario);
            $passwordCodificado = $encoder->encodePassword($usuario->getPassword(), null);
            $usuario->setPassword($passwordCodificado);
            $em = $this->getDoctrine()->getManager();
            $em->persist($usuario);
            $em->flush();
        }

        return $this->render('registro.html.twig', array(
            'formulario' => $formulario->createView()
        ));    
    }
}
