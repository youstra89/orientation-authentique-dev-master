<?php

use Symfony\Component\Routing\RequestContext;
use Symfony\Component\Routing\Exception\RouteNotFoundException;
use Psr\Log\LoggerInterface;

/**
 * This class has been auto-generated
 * by the Symfony Routing Component.
 */
class srcProdProjectContainerUrlGenerator extends Symfony\Component\Routing\Generator\UrlGenerator
{
    private static $declaredRoutes;
    private $defaultLocale;

    public function __construct(RequestContext $context, LoggerInterface $logger = null, string $defaultLocale = null)
    {
        $this->context = $context;
        $this->logger = $logger;
        $this->defaultLocale = $defaultLocale;
        if (null === self::$declaredRoutes) {
            self::$declaredRoutes = array(
        'about' => array(array(), array('_controller' => 'App\\Controller\\AboutController::index'), array(), array(array('text', '/a-propos-du-projet-orientation-authentique')), array(), array()),
        'admin' => array(array(), array('_controller' => 'App\\Controller\\Admin\\AdminController::index'), array(), array(array('text', '/admin/')), array(), array()),
        'courses' => array(array(), array('_controller' => 'App\\Controller\\Admin\\AdminCoursController::index'), array(), array(array('text', '/admin/cours/')), array(), array()),
        'cours.add.select.hds' => array(array(), array('_controller' => 'App\\Controller\\Admin\\AdminCoursController::cours_add_select_hds'), array(), array(array('text', '/admin/cours/hds-pour-enregistrement-cours')), array(), array()),
        'cours.add.select.mosquee' => array(array('id'), array('_controller' => 'App\\Controller\\Admin\\AdminCoursController::cours_add_select_mosquee'), array(), array(array('variable', '-', '[^/]++', 'id'), array('text', '/admin/cours/mosquee-pour-enregistrement-cours/hds')), array(), array()),
        'cours.add' => array(array('hdsId', 'id'), array('_controller' => 'App\\Controller\\Admin\\AdminCoursController::cours_add'), array('hdsId' => '\\d+', 'id' => '\\d+'), array(array('variable', '-', '\\d+', 'id'), array('text', '-mosquee'), array('variable', '-', '\\d+', 'hdsId'), array('text', '/admin/cours/add-hds')), array(), array()),
        'cours.edit' => array(array('id'), array('_controller' => 'App\\Controller\\Admin\\AdminCoursController::cours_edit'), array('id' => '\\d+'), array(array('variable', '/', '\\d+', 'id'), array('text', '/admin/cours/edit')), array(), array()),
        'cours.details' => array(array('id'), array('_controller' => 'App\\Controller\\Admin\\AdminCoursController::cours_details'), array('id' => '\\d+'), array(array('variable', '/', '\\d+', 'id'), array('text', '/admin/cours/details')), array(), array()),
        'disciplines' => array(array(), array('_controller' => 'App\\Controller\\Admin\\AdminDisciplineController::disciplines'), array(), array(array('text', '/admin/cours/discipline')), array(), array()),
        'discipline.add' => array(array(), array('_controller' => 'App\\Controller\\Admin\\AdminDisciplineController::discipline_add'), array(), array(array('text', '/admin/cours/discipline/add')), array(), array()),
        'discipline.edit' => array(array('id'), array('_controller' => 'App\\Controller\\Admin\\AdminDisciplineController::discipline_edit'), array('id' => '\\d+'), array(array('variable', '/', '\\d+', 'id'), array('text', '/admin/cours/discipline/edit')), array(), array()),
        'ecoles' => array(array(), array('_controller' => 'App\\Controller\\Admin\\AdminEcoleController::index'), array(), array(array('text', '/admin/ecole/')), array(), array()),
        'ecole.add' => array(array(), array('_controller' => 'App\\Controller\\Admin\\AdminEcoleController::ecole_add'), array(), array(array('text', '/admin/ecole/add')), array(), array()),
        'ecole.edit' => array(array('id'), array('_controller' => 'App\\Controller\\Admin\\AdminEcoleController::ecole_edit'), array('id' => '\\d+'), array(array('variable', '/', '\\d+', 'id'), array('text', '/admin/ecole/edit')), array(), array()),
        'ecole.info' => array(array('id'), array('_controller' => 'App\\Controller\\Admin\\AdminEcoleController::ecole_information'), array('id' => '\\d+'), array(array('variable', '/', '\\d+', 'id'), array('text', '/admin/ecole/information')), array(), array()),
        'hds' => array(array(), array('_controller' => 'App\\Controller\\Admin\\AdminHDSController::index'), array(), array(array('text', '/admin/hommes-de-science/')), array(), array()),
        'hds.add' => array(array(), array('_controller' => 'App\\Controller\\Admin\\AdminHDSController::hds_add'), array(), array(array('text', '/admin/hommes-de-science/add')), array(), array()),
        'hds.edit' => array(array('id'), array('_controller' => 'App\\Controller\\Admin\\AdminHDSController::hds_edit'), array('id' => '\\d+'), array(array('variable', '/', '\\d+', 'id'), array('text', '/admin/hommes-de-science/edit')), array(), array()),
        'hds.biographie' => array(array('id'), array('_controller' => 'App\\Controller\\Admin\\AdminHDSController::hds_biongraphie'), array('id' => '\\d+'), array(array('variable', '/', '\\d+', 'id'), array('text', '/admin/hommes-de-science/biographie')), array(), array()),
        'select.hds' => array(array(), array('_controller' => 'App\\Controller\\Admin\\AdminHDSController::hds_select_request'), array(), array(array('text', '/admin/hommes-de-science/select-request')), array(), array()),
        'livres' => array(array(), array('_controller' => 'App\\Controller\\Admin\\AdminLivreController::livres'), array(), array(array('text', '/admin/cours/livre')), array(), array()),
        'livre.add' => array(array(), array('_controller' => 'App\\Controller\\Admin\\AdminLivreController::livre_add'), array(), array(array('text', '/admin/cours/livre/add')), array(), array()),
        'livre.edit' => array(array('id'), array('_controller' => 'App\\Controller\\Admin\\AdminLivreController::livre_edit'), array('id' => '\\d+'), array(array('variable', '/', '\\d+', 'id'), array('text', '/admin/cours/livre/edit')), array(), array()),
        'localite' => array(array(), array('_controller' => 'App\\Controller\\Admin\\AdminLocaliteController::index'), array(), array(array('text', '/admin/localite/')), array(), array()),
        'regions' => array(array(), array('_controller' => 'App\\Controller\\Admin\\AdminLocaliteController::regions'), array(), array(array('text', '/admin/localite/region')), array(), array()),
        'region.add' => array(array(), array('_controller' => 'App\\Controller\\Admin\\AdminLocaliteController::region_add'), array(), array(array('text', '/admin/localite/region/add')), array(), array()),
        'region.edit' => array(array('id'), array('_controller' => 'App\\Controller\\Admin\\AdminLocaliteController::region_edit'), array('id' => '\\d+'), array(array('variable', '/', '\\d+', 'id'), array('text', '/admin/localite/region/edit')), array(), array()),
        'villes' => array(array(), array('_controller' => 'App\\Controller\\Admin\\AdminLocaliteController::villes'), array(), array(array('text', '/admin/localite/ville')), array(), array()),
        'ville.add' => array(array(), array('_controller' => 'App\\Controller\\Admin\\AdminLocaliteController::ville_add'), array(), array(array('text', '/admin/localite/ville/add')), array(), array()),
        'ville.edit' => array(array('id'), array('_controller' => 'App\\Controller\\Admin\\AdminLocaliteController::ville_edit'), array('id' => '\\d+'), array(array('variable', '/', '\\d+', 'id'), array('text', '/admin/localite/ville/edit')), array(), array()),
        'communes' => array(array(), array('_controller' => 'App\\Controller\\Admin\\AdminLocaliteController::communes'), array(), array(array('text', '/admin/localite/commune')), array(), array()),
        'commune.add' => array(array('villeId'), array('_controller' => 'App\\Controller\\Admin\\AdminLocaliteController::commune_add'), array('villeId' => '\\d+'), array(array('variable', '/', '\\d+', 'villeId'), array('text', '/admin/localite/commune/add')), array(), array()),
        'commune.edit' => array(array('id'), array('_controller' => 'App\\Controller\\Admin\\AdminLocaliteController::commune_edit'), array('id' => '\\d+'), array(array('variable', '/', '\\d+', 'id'), array('text', '/admin/localite/commune/edit')), array(), array()),
        'mosquees' => array(array(), array('_controller' => 'App\\Controller\\Admin\\AdminMosqueeController::index'), array(), array(array('text', '/admin/mosquee/')), array(), array()),
        'mosquee.add' => array(array(), array('_controller' => 'App\\Controller\\Admin\\AdminMosqueeController::mosquee_add'), array(), array(array('text', '/admin/mosquee/add')), array(), array()),
        'mosquee.edit' => array(array('id'), array('_controller' => 'App\\Controller\\Admin\\AdminMosqueeController::mosquee_edit'), array('id' => '\\d+'), array(array('variable', '/', '\\d+', 'id'), array('text', '/admin/mosquee/edit')), array(), array()),
        'mosquee.info' => array(array('id'), array('_controller' => 'App\\Controller\\Admin\\AdminMosqueeController::mosquee_informations'), array('id' => '\\d+'), array(array('variable', '/', '\\d+', 'id'), array('text', '/admin/mosquee/information')), array(), array()),
        'contact' => array(array(), array('_controller' => 'App\\Controller\\ContactController::index'), array(), array(array('text', '/contacter-orientation-authentique')), array(), array()),
        'contribution' => array(array(), array('_controller' => 'App\\Controller\\ContributionController::index'), array(), array(array('text', '/contribuer-a-orientation-authentique')), array(), array()),
        'orientation' => array(array(), array('_controller' => 'App\\Controller\\OrientationController::index'), array(), array(array('text', '/orientations/')), array(), array()),
        'orientation.cours' => array(array(), array('_controller' => 'App\\Controller\\OrientationController::cours'), array(), array(array('text', '/orientations/cours')), array(), array()),
        'orientation.ecoles' => array(array(), array('_controller' => 'App\\Controller\\OrientationController::ecoles'), array(), array(array('text', '/orientations/ecoles')), array(), array()),
        'orientation.hds' => array(array(), array('_controller' => 'App\\Controller\\OrientationController::hds'), array(), array(array('text', '/orientations/hommes-de-science')), array(), array()),
        'orientation.mosquees' => array(array(), array('_controller' => 'App\\Controller\\OrientationController::mosquees'), array(), array(array('text', '/orientations/mosquees')), array(), array()),
        'registration' => array(array(), array('_controller' => 'App\\Controller\\RegistrationController::registerAction'), array(), array(array('text', '/register')), array(), array()),
        'activation_compte' => array(array('token'), array('_controller' => 'App\\Controller\\RegistrationController::activation_compte'), array(), array(array('variable', '/', '[^/]++', 'token'), array('text', '/activation-de-compte-orientation-authetique')), array(), array()),
        'login' => array(array(), array('_controller' => 'App\\Controller\\SecurityController::login'), array(), array(array('text', '/login')), array(), array()),
        'logout' => array(array(), array('_controller' => 'App\\Controller\\SecurityController::logout'), array(), array(array('text', '/logout')), array(), array()),
        'homepage' => array(array(), array('_controller' => 'App\\Controller\\MainController::index'), array(), array(array('text', '/')), array(), array()),
    );
        }
    }

    public function generate($name, $parameters = array(), $referenceType = self::ABSOLUTE_PATH)
    {
        $locale = $parameters['_locale']
            ?? $this->context->getParameter('_locale')
            ?: $this->defaultLocale;

        if (null !== $locale && (self::$declaredRoutes[$name.'.'.$locale][1]['_canonical_route'] ?? null) === $name) {
            unset($parameters['_locale']);
            $name .= '.'.$locale;
        } elseif (!isset(self::$declaredRoutes[$name])) {
            throw new RouteNotFoundException(sprintf('Unable to generate a URL for the named route "%s" as such route does not exist.', $name));
        }

        list($variables, $defaults, $requirements, $tokens, $hostTokens, $requiredSchemes) = self::$declaredRoutes[$name];

        return $this->doGenerate($variables, $defaults, $requirements, $tokens, $parameters, $name, $referenceType, $hostTokens, $requiredSchemes);
    }
}
