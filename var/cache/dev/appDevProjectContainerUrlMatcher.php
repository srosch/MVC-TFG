<?php

use Symfony\Component\Routing\Exception\MethodNotAllowedException;
use Symfony\Component\Routing\Exception\ResourceNotFoundException;
use Symfony\Component\Routing\RequestContext;

/**
 * This class has been auto-generated
 * by the Symfony Routing Component.
 */
class appDevProjectContainerUrlMatcher extends Symfony\Bundle\FrameworkBundle\Routing\RedirectableUrlMatcher
{
    public function __construct(RequestContext $context)
    {
        $this->context = $context;
    }

    public function match($rawPathinfo)
    {
        $allow = [];
        $pathinfo = rawurldecode($rawPathinfo);
        $trimmedPathinfo = rtrim($pathinfo, '/');
        $context = $this->context;
        $request = $this->request ?: $this->createRequest($pathinfo);
        $requestMethod = $canonicalMethod = $context->getMethod();

        if ('HEAD' === $requestMethod) {
            $canonicalMethod = 'GET';
        }

        // _twig_error_test
        if (0 === strpos($pathinfo, '/_error') && preg_match('#^/_error/(?P<code>\\d+)(?:\\.(?P<_format>[^/]++))?$#sD', $pathinfo, $matches)) {
            return $this->mergeDefaults(array_replace($matches, ['_route' => '_twig_error_test']), array (  '_controller' => 'twig.controller.preview_error:previewErrorPageAction',  '_format' => 'html',));
        }

        if (0 === strpos($pathinfo, '/mvc')) {
            if (0 === strpos($pathinfo, '/mvc/a')) {
                // mvc_userinterface_http_allergyfindersget__invoke
                if ('/mvc/allergies' === $pathinfo) {
                    $ret = array (  '_controller' => 'Mvc\\UserInterface\\Http\\Controller\\AllergyFindersGetController::__invoke',  '_route' => 'mvc_userinterface_http_allergyfindersget__invoke',);
                    if (!in_array($canonicalMethod, ['GET'])) {
                        $allow = array_merge($allow, ['GET']);
                        goto not_mvc_userinterface_http_allergyfindersget__invoke;
                    }

                    return $ret;
                }
                not_mvc_userinterface_http_allergyfindersget__invoke:

                // mvc_userinterface_http_useradministrativecreatorpost__invoke
                if ('/mvc/administrative' === $pathinfo) {
                    $ret = array (  '_controller' => 'Mvc\\UserInterface\\Http\\Controller\\UserAdministrativeCreatorPostController::__invoke',  '_route' => 'mvc_userinterface_http_useradministrativecreatorpost__invoke',);
                    if (!in_array($requestMethod, ['POST'])) {
                        $allow = array_merge($allow, ['POST']);
                        goto not_mvc_userinterface_http_useradministrativecreatorpost__invoke;
                    }

                    return $ret;
                }
                not_mvc_userinterface_http_useradministrativecreatorpost__invoke:

                // mvc_userinterface_http_userdocumentcreatorpost__invoke
                if ('/mvc/add-document' === $pathinfo) {
                    $ret = array (  '_controller' => 'Mvc\\UserInterface\\Http\\Controller\\UserDocumentCreatorPostController::__invoke',  '_route' => 'mvc_userinterface_http_userdocumentcreatorpost__invoke',);
                    if (!in_array($requestMethod, ['POST'])) {
                        $allow = array_merge($allow, ['POST']);
                        goto not_mvc_userinterface_http_userdocumentcreatorpost__invoke;
                    }

                    return $ret;
                }
                not_mvc_userinterface_http_userdocumentcreatorpost__invoke:

                // mvc_userinterface_http_userautenticatedfinderget__invoke
                if ('/mvc/auth/user' === $pathinfo) {
                    $ret = array (  '_controller' => 'Mvc\\UserInterface\\Http\\Controller\\UserAutenticatedFinderGetController::__invoke',  '_route' => 'mvc_userinterface_http_userautenticatedfinderget__invoke',);
                    if (!in_array($canonicalMethod, ['GET'])) {
                        $allow = array_merge($allow, ['GET']);
                        goto not_mvc_userinterface_http_userautenticatedfinderget__invoke;
                    }

                    return $ret;
                }
                not_mvc_userinterface_http_userautenticatedfinderget__invoke:

            }

            // mvc_userinterface_http_diseasefindersget__invoke
            if ('/mvc/diseases' === $pathinfo) {
                $ret = array (  '_controller' => 'Mvc\\UserInterface\\Http\\Controller\\DiseaseFindersGetController::__invoke',  '_route' => 'mvc_userinterface_http_diseasefindersget__invoke',);
                if (!in_array($canonicalMethod, ['GET'])) {
                    $allow = array_merge($allow, ['GET']);
                    goto not_mvc_userinterface_http_diseasefindersget__invoke;
                }

                return $ret;
            }
            not_mvc_userinterface_http_diseasefindersget__invoke:

            if (0 === strpos($pathinfo, '/mvc/document')) {
                // mvc_userinterface_http_userdocumentfinderget__invoke
                if (preg_match('#^/mvc/document/(?P<documentId>[^/]++)/download$#sD', $pathinfo, $matches)) {
                    $ret = $this->mergeDefaults(array_replace($matches, ['_route' => 'mvc_userinterface_http_userdocumentfinderget__invoke']), array (  '_controller' => 'Mvc\\UserInterface\\Http\\Controller\\UserDocumentFinderGetController::__invoke',));
                    if (!in_array($canonicalMethod, ['GET'])) {
                        $allow = array_merge($allow, ['GET']);
                        goto not_mvc_userinterface_http_userdocumentfinderget__invoke;
                    }

                    return $ret;
                }
                not_mvc_userinterface_http_userdocumentfinderget__invoke:

                // mvc_userinterface_http_userdocumentfindersget__invoke
                if ('/mvc/documents' === $pathinfo) {
                    $ret = array (  '_controller' => 'Mvc\\UserInterface\\Http\\Controller\\UserDocumentFindersGetController::__invoke',  '_route' => 'mvc_userinterface_http_userdocumentfindersget__invoke',);
                    if (!in_array($canonicalMethod, ['GET'])) {
                        $allow = array_merge($allow, ['GET']);
                        goto not_mvc_userinterface_http_userdocumentfindersget__invoke;
                    }

                    return $ret;
                }
                not_mvc_userinterface_http_userdocumentfindersget__invoke:

            }

            elseif (0 === strpos($pathinfo, '/mvc/history-')) {
                if (0 === strpos($pathinfo, '/mvc/history-allergy')) {
                    // mvc_userinterface_http_historyuserallergycreatorpost__invoke
                    if ('/mvc/history-allergy' === $pathinfo) {
                        $ret = array (  '_controller' => 'Mvc\\UserInterface\\Http\\Controller\\HistoryUserAllergyCreatorPostController::__invoke',  '_route' => 'mvc_userinterface_http_historyuserallergycreatorpost__invoke',);
                        if (!in_array($requestMethod, ['POST'])) {
                            $allow = array_merge($allow, ['POST']);
                            goto not_mvc_userinterface_http_historyuserallergycreatorpost__invoke;
                        }

                        return $ret;
                    }
                    not_mvc_userinterface_http_historyuserallergycreatorpost__invoke:

                    // mvc_userinterface_http_historyuserallergyfindersget__invoke
                    if ('/mvc/history-allergy' === $pathinfo) {
                        $ret = array (  '_controller' => 'Mvc\\UserInterface\\Http\\Controller\\HistoryUserAllergyFindersGetController::__invoke',  '_route' => 'mvc_userinterface_http_historyuserallergyfindersget__invoke',);
                        if (!in_array($canonicalMethod, ['GET'])) {
                            $allow = array_merge($allow, ['GET']);
                            goto not_mvc_userinterface_http_historyuserallergyfindersget__invoke;
                        }

                        return $ret;
                    }
                    not_mvc_userinterface_http_historyuserallergyfindersget__invoke:

                    // mvc_userinterface_http_historyuserallergypatientfinderget__invoke
                    if (preg_match('#^/mvc/history\\-allergy/(?P<patient>[^/]++)$#sD', $pathinfo, $matches)) {
                        $ret = $this->mergeDefaults(array_replace($matches, ['_route' => 'mvc_userinterface_http_historyuserallergypatientfinderget__invoke']), array (  '_controller' => 'Mvc\\UserInterface\\Http\\Controller\\HistoryUserAllergyPatientFinderGetController::__invoke',));
                        if (!in_array($canonicalMethod, ['GET'])) {
                            $allow = array_merge($allow, ['GET']);
                            goto not_mvc_userinterface_http_historyuserallergypatientfinderget__invoke;
                        }

                        return $ret;
                    }
                    not_mvc_userinterface_http_historyuserallergypatientfinderget__invoke:

                }

                elseif (0 === strpos($pathinfo, '/mvc/history-disease')) {
                    // mvc_userinterface_http_historyuserdiseasecreatorpost__invoke
                    if ('/mvc/history-disease' === $pathinfo) {
                        $ret = array (  '_controller' => 'Mvc\\UserInterface\\Http\\Controller\\HistoryUserDiseaseCreatorPostController::__invoke',  '_route' => 'mvc_userinterface_http_historyuserdiseasecreatorpost__invoke',);
                        if (!in_array($requestMethod, ['POST'])) {
                            $allow = array_merge($allow, ['POST']);
                            goto not_mvc_userinterface_http_historyuserdiseasecreatorpost__invoke;
                        }

                        return $ret;
                    }
                    not_mvc_userinterface_http_historyuserdiseasecreatorpost__invoke:

                    // mvc_userinterface_http_historyuserdiseasefindersget__invoke
                    if ('/mvc/history-disease' === $pathinfo) {
                        $ret = array (  '_controller' => 'Mvc\\UserInterface\\Http\\Controller\\HistoryUserDiseaseFindersGetController::__invoke',  '_route' => 'mvc_userinterface_http_historyuserdiseasefindersget__invoke',);
                        if (!in_array($canonicalMethod, ['GET'])) {
                            $allow = array_merge($allow, ['GET']);
                            goto not_mvc_userinterface_http_historyuserdiseasefindersget__invoke;
                        }

                        return $ret;
                    }
                    not_mvc_userinterface_http_historyuserdiseasefindersget__invoke:

                    // mvc_userinterface_http_historyuserdiseasepatientfinderget__invoke
                    if (preg_match('#^/mvc/history\\-disease/(?P<patient>[^/]++)$#sD', $pathinfo, $matches)) {
                        $ret = $this->mergeDefaults(array_replace($matches, ['_route' => 'mvc_userinterface_http_historyuserdiseasepatientfinderget__invoke']), array (  '_controller' => 'Mvc\\UserInterface\\Http\\Controller\\HistoryUserDiseasePatientFinderGetController::__invoke',));
                        if (!in_array($canonicalMethod, ['GET'])) {
                            $allow = array_merge($allow, ['GET']);
                            goto not_mvc_userinterface_http_historyuserdiseasepatientfinderget__invoke;
                        }

                        return $ret;
                    }
                    not_mvc_userinterface_http_historyuserdiseasepatientfinderget__invoke:

                    // mvc_userinterface_http_userdiseasetreatmentfindersget__invoke
                    if (0 === strpos($pathinfo, '/mvc/history-disease/treatment') && preg_match('#^/mvc/history\\-disease/treatment/(?P<historyUserDiseaseId>[^/]++)$#sD', $pathinfo, $matches)) {
                        $ret = $this->mergeDefaults(array_replace($matches, ['_route' => 'mvc_userinterface_http_userdiseasetreatmentfindersget__invoke']), array (  '_controller' => 'Mvc\\UserInterface\\Http\\Controller\\UserDiseaseTreatmentFindersGetController::__invoke',));
                        if (!in_array($canonicalMethod, ['GET'])) {
                            $allow = array_merge($allow, ['GET']);
                            goto not_mvc_userinterface_http_userdiseasetreatmentfindersget__invoke;
                        }

                        return $ret;
                    }
                    not_mvc_userinterface_http_userdiseasetreatmentfindersget__invoke:

                }

                elseif (0 === strpos($pathinfo, '/mvc/history-donations')) {
                    // mvc_userinterface_http_historyuserdonationscreatorpost__invoke
                    if ('/mvc/history-donations' === $pathinfo) {
                        $ret = array (  '_controller' => 'Mvc\\UserInterface\\Http\\Controller\\HistoryUserDonationsCreatorPostController::__invoke',  '_route' => 'mvc_userinterface_http_historyuserdonationscreatorpost__invoke',);
                        if (!in_array($requestMethod, ['POST'])) {
                            $allow = array_merge($allow, ['POST']);
                            goto not_mvc_userinterface_http_historyuserdonationscreatorpost__invoke;
                        }

                        return $ret;
                    }
                    not_mvc_userinterface_http_historyuserdonationscreatorpost__invoke:

                    // mvc_userinterface_http_historyuserdonationsfindersget__invoke
                    if ('/mvc/history-donations' === $pathinfo) {
                        $ret = array (  '_controller' => 'Mvc\\UserInterface\\Http\\Controller\\HistoryUserDonationsFindersGetController::__invoke',  '_route' => 'mvc_userinterface_http_historyuserdonationsfindersget__invoke',);
                        if (!in_array($canonicalMethod, ['GET'])) {
                            $allow = array_merge($allow, ['GET']);
                            goto not_mvc_userinterface_http_historyuserdonationsfindersget__invoke;
                        }

                        return $ret;
                    }
                    not_mvc_userinterface_http_historyuserdonationsfindersget__invoke:

                    // mvc_userinterface_http_historyuserdonationspatientfinderget__invoke
                    if (preg_match('#^/mvc/history\\-donations/(?P<patient>[^/]++)$#sD', $pathinfo, $matches)) {
                        $ret = $this->mergeDefaults(array_replace($matches, ['_route' => 'mvc_userinterface_http_historyuserdonationspatientfinderget__invoke']), array (  '_controller' => 'Mvc\\UserInterface\\Http\\Controller\\HistoryUserDonationsPatientFinderGetController::__invoke',));
                        if (!in_array($canonicalMethod, ['GET'])) {
                            $allow = array_merge($allow, ['GET']);
                            goto not_mvc_userinterface_http_historyuserdonationspatientfinderget__invoke;
                        }

                        return $ret;
                    }
                    not_mvc_userinterface_http_historyuserdonationspatientfinderget__invoke:

                }

                elseif (0 === strpos($pathinfo, '/mvc/history-operations')) {
                    // mvc_userinterface_http_historyuseroperationcreatorpost__invoke
                    if ('/mvc/history-operations' === $pathinfo) {
                        $ret = array (  '_controller' => 'Mvc\\UserInterface\\Http\\Controller\\HistoryUserOperationCreatorPostController::__invoke',  '_route' => 'mvc_userinterface_http_historyuseroperationcreatorpost__invoke',);
                        if (!in_array($requestMethod, ['POST'])) {
                            $allow = array_merge($allow, ['POST']);
                            goto not_mvc_userinterface_http_historyuseroperationcreatorpost__invoke;
                        }

                        return $ret;
                    }
                    not_mvc_userinterface_http_historyuseroperationcreatorpost__invoke:

                    // mvc_userinterface_http_historyuseroperationsaddnoteput__invoke
                    if (0 === strpos($pathinfo, '/mvc/history-operations/add-note') && preg_match('#^/mvc/history\\-operations/add\\-note/(?P<historyOperationId>[^/]++)$#sD', $pathinfo, $matches)) {
                        $ret = $this->mergeDefaults(array_replace($matches, ['_route' => 'mvc_userinterface_http_historyuseroperationsaddnoteput__invoke']), array (  '_controller' => 'Mvc\\UserInterface\\Http\\Controller\\HistoryUserOperationsAddNotePutController::__invoke',));
                        if (!in_array($requestMethod, ['PUT'])) {
                            $allow = array_merge($allow, ['PUT']);
                            goto not_mvc_userinterface_http_historyuseroperationsaddnoteput__invoke;
                        }

                        return $ret;
                    }
                    not_mvc_userinterface_http_historyuseroperationsaddnoteput__invoke:

                    // mvc_userinterface_http_historyuseroperationsfindersget__invoke
                    if ('/mvc/history-operations' === $pathinfo) {
                        $ret = array (  '_controller' => 'Mvc\\UserInterface\\Http\\Controller\\HistoryUserOperationsFindersGetController::__invoke',  '_route' => 'mvc_userinterface_http_historyuseroperationsfindersget__invoke',);
                        if (!in_array($canonicalMethod, ['GET'])) {
                            $allow = array_merge($allow, ['GET']);
                            goto not_mvc_userinterface_http_historyuseroperationsfindersget__invoke;
                        }

                        return $ret;
                    }
                    not_mvc_userinterface_http_historyuseroperationsfindersget__invoke:

                    // mvc_userinterface_http_historyuseroperationspatientfinderget__invoke
                    if (preg_match('#^/mvc/history\\-operations/(?P<patient>[^/]++)$#sD', $pathinfo, $matches)) {
                        $ret = $this->mergeDefaults(array_replace($matches, ['_route' => 'mvc_userinterface_http_historyuseroperationspatientfinderget__invoke']), array (  '_controller' => 'Mvc\\UserInterface\\Http\\Controller\\HistoryUserOperationsPatientFinderGetController::__invoke',));
                        if (!in_array($canonicalMethod, ['GET'])) {
                            $allow = array_merge($allow, ['GET']);
                            goto not_mvc_userinterface_http_historyuseroperationspatientfinderget__invoke;
                        }

                        return $ret;
                    }
                    not_mvc_userinterface_http_historyuseroperationspatientfinderget__invoke:

                }

                elseif (0 === strpos($pathinfo, '/mvc/history-vaccine')) {
                    // mvc_userinterface_http_historyuservaccinecreatorpost__invoke
                    if ('/mvc/history-vaccine' === $pathinfo) {
                        $ret = array (  '_controller' => 'Mvc\\UserInterface\\Http\\Controller\\HistoryUserVaccineCreatorPostController::__invoke',  '_route' => 'mvc_userinterface_http_historyuservaccinecreatorpost__invoke',);
                        if (!in_array($requestMethod, ['POST'])) {
                            $allow = array_merge($allow, ['POST']);
                            goto not_mvc_userinterface_http_historyuservaccinecreatorpost__invoke;
                        }

                        return $ret;
                    }
                    not_mvc_userinterface_http_historyuservaccinecreatorpost__invoke:

                    // mvc_userinterface_http_historyuservaccinefindersget__invoke
                    if ('/mvc/history-vaccine' === $pathinfo) {
                        $ret = array (  '_controller' => 'Mvc\\UserInterface\\Http\\Controller\\HistoryUserVaccineFindersGetController::__invoke',  '_route' => 'mvc_userinterface_http_historyuservaccinefindersget__invoke',);
                        if (!in_array($canonicalMethod, ['GET'])) {
                            $allow = array_merge($allow, ['GET']);
                            goto not_mvc_userinterface_http_historyuservaccinefindersget__invoke;
                        }

                        return $ret;
                    }
                    not_mvc_userinterface_http_historyuservaccinefindersget__invoke:

                    // mvc_userinterface_http_historyuservaccinepatientfinderget__invoke
                    if (preg_match('#^/mvc/history\\-vaccine/(?P<patient>[^/]++)$#sD', $pathinfo, $matches)) {
                        $ret = $this->mergeDefaults(array_replace($matches, ['_route' => 'mvc_userinterface_http_historyuservaccinepatientfinderget__invoke']), array (  '_controller' => 'Mvc\\UserInterface\\Http\\Controller\\HistoryUserVaccinePatientFinderGetController::__invoke',));
                        if (!in_array($canonicalMethod, ['GET'])) {
                            $allow = array_merge($allow, ['GET']);
                            goto not_mvc_userinterface_http_historyuservaccinepatientfinderget__invoke;
                        }

                        return $ret;
                    }
                    not_mvc_userinterface_http_historyuservaccinepatientfinderget__invoke:

                }

            }

            // mvc_userinterface_http_userhealthpersonnelcreatorpost__invoke
            if ('/mvc/health-personnel' === $pathinfo) {
                $ret = array (  '_controller' => 'Mvc\\UserInterface\\Http\\Controller\\UserHealthPersonnelCreatorPostController::__invoke',  '_route' => 'mvc_userinterface_http_userhealthpersonnelcreatorpost__invoke',);
                if (!in_array($requestMethod, ['POST'])) {
                    $allow = array_merge($allow, ['POST']);
                    goto not_mvc_userinterface_http_userhealthpersonnelcreatorpost__invoke;
                }

                return $ret;
            }
            not_mvc_userinterface_http_userhealthpersonnelcreatorpost__invoke:

            if (0 === strpos($pathinfo, '/mvc/medical-center')) {
                // mvc_userinterface_http_medicalcentercreatorpost__invoke
                if ('/mvc/medical-center' === $pathinfo) {
                    $ret = array (  '_controller' => 'Mvc\\UserInterface\\Http\\Controller\\MedicalCenterCreatorPostController::__invoke',  '_route' => 'mvc_userinterface_http_medicalcentercreatorpost__invoke',);
                    if (!in_array($requestMethod, ['POST'])) {
                        $allow = array_merge($allow, ['POST']);
                        goto not_mvc_userinterface_http_medicalcentercreatorpost__invoke;
                    }

                    return $ret;
                }
                not_mvc_userinterface_http_medicalcentercreatorpost__invoke:

                // mvc_userinterface_http_medicalcenterfinderget__invoke
                if (preg_match('#^/mvc/medical\\-center/(?P<medicalCenterId>[^/]++)$#sD', $pathinfo, $matches)) {
                    $ret = $this->mergeDefaults(array_replace($matches, ['_route' => 'mvc_userinterface_http_medicalcenterfinderget__invoke']), array (  '_controller' => 'Mvc\\UserInterface\\Http\\Controller\\MedicalCenterFinderGetController::__invoke',));
                    if (!in_array($canonicalMethod, ['GET'])) {
                        $allow = array_merge($allow, ['GET']);
                        goto not_mvc_userinterface_http_medicalcenterfinderget__invoke;
                    }

                    return $ret;
                }
                not_mvc_userinterface_http_medicalcenterfinderget__invoke:

                // mvc_userinterface_http_medicalcenterfindersget__invoke
                if ('/mvc/medical-centers' === $pathinfo) {
                    $ret = array (  '_controller' => 'Mvc\\UserInterface\\Http\\Controller\\MedicalCenterFindersGetController::__invoke',  '_route' => 'mvc_userinterface_http_medicalcenterfindersget__invoke',);
                    if (!in_array($canonicalMethod, ['GET'])) {
                        $allow = array_merge($allow, ['GET']);
                        goto not_mvc_userinterface_http_medicalcenterfindersget__invoke;
                    }

                    return $ret;
                }
                not_mvc_userinterface_http_medicalcenterfindersget__invoke:

                // mvc_userinterface_http_medicalcenterupdatorput__invoke
                if (preg_match('#^/mvc/medical\\-center/(?P<medicalCenterId>[^/]++)$#sD', $pathinfo, $matches)) {
                    $ret = $this->mergeDefaults(array_replace($matches, ['_route' => 'mvc_userinterface_http_medicalcenterupdatorput__invoke']), array (  '_controller' => 'Mvc\\UserInterface\\Http\\Controller\\MedicalCenterUpdatorPutController::__invoke',));
                    if (!in_array($requestMethod, ['PUT'])) {
                        $allow = array_merge($allow, ['PUT']);
                        goto not_mvc_userinterface_http_medicalcenterupdatorput__invoke;
                    }

                    return $ret;
                }
                not_mvc_userinterface_http_medicalcenterupdatorput__invoke:

            }

            elseif (0 === strpos($pathinfo, '/mvc/online-consultation')) {
                // mvc_userinterface_http_onlineconsultationcreatorpost__invoke
                if ('/mvc/online-consultation' === $pathinfo) {
                    $ret = array (  '_controller' => 'Mvc\\UserInterface\\Http\\Controller\\OnlineConsultationCreatorPostController::__invoke',  '_route' => 'mvc_userinterface_http_onlineconsultationcreatorpost__invoke',);
                    if (!in_array($requestMethod, ['POST'])) {
                        $allow = array_merge($allow, ['POST']);
                        goto not_mvc_userinterface_http_onlineconsultationcreatorpost__invoke;
                    }

                    return $ret;
                }
                not_mvc_userinterface_http_onlineconsultationcreatorpost__invoke:

                // mvc_userinterface_http_onlineconsultationpatientfindersget__invoke
                if (preg_match('#^/mvc/online\\-consultation/(?P<patient>[^/]++)$#sD', $pathinfo, $matches)) {
                    $ret = $this->mergeDefaults(array_replace($matches, ['_route' => 'mvc_userinterface_http_onlineconsultationpatientfindersget__invoke']), array (  '_controller' => 'Mvc\\UserInterface\\Http\\Controller\\OnlineConsultationPatientFindersGetController::__invoke',));
                    if (!in_array($canonicalMethod, ['GET'])) {
                        $allow = array_merge($allow, ['GET']);
                        goto not_mvc_userinterface_http_onlineconsultationpatientfindersget__invoke;
                    }

                    return $ret;
                }
                not_mvc_userinterface_http_onlineconsultationpatientfindersget__invoke:

                // mvc_userinterface_http_onlineconsultationpendingfindersget__invoke
                if ('/mvc/online-consultation/pending' === $pathinfo) {
                    $ret = array (  '_controller' => 'Mvc\\UserInterface\\Http\\Controller\\OnlineConsultationPendingFindersGetController::__invoke',  '_route' => 'mvc_userinterface_http_onlineconsultationpendingfindersget__invoke',);
                    if (!in_array($canonicalMethod, ['GET'])) {
                        $allow = array_merge($allow, ['GET']);
                        goto not_mvc_userinterface_http_onlineconsultationpendingfindersget__invoke;
                    }

                    return $ret;
                }
                not_mvc_userinterface_http_onlineconsultationpendingfindersget__invoke:

                // mvc_userinterface_http_onlineconsultationresponseput__invoke
                if (preg_match('#^/mvc/online\\-consultation/(?P<onlineConsultationId>[^/]++)/response$#sD', $pathinfo, $matches)) {
                    $ret = $this->mergeDefaults(array_replace($matches, ['_route' => 'mvc_userinterface_http_onlineconsultationresponseput__invoke']), array (  '_controller' => 'Mvc\\UserInterface\\Http\\Controller\\OnlineConsultationResponsePutController::__invoke',));
                    if (!in_array($requestMethod, ['PUT'])) {
                        $allow = array_merge($allow, ['PUT']);
                        goto not_mvc_userinterface_http_onlineconsultationresponseput__invoke;
                    }

                    return $ret;
                }
                not_mvc_userinterface_http_onlineconsultationresponseput__invoke:

            }

            elseif (0 === strpos($pathinfo, '/mvc/schedule')) {
                // mvc_userinterface_http_scheduleaddnoteput__invoke
                if (0 === strpos($pathinfo, '/mvc/schedule/add-note') && preg_match('#^/mvc/schedule/add\\-note/(?P<scheduleId>[^/]++)$#sD', $pathinfo, $matches)) {
                    $ret = $this->mergeDefaults(array_replace($matches, ['_route' => 'mvc_userinterface_http_scheduleaddnoteput__invoke']), array (  '_controller' => 'Mvc\\UserInterface\\Http\\Controller\\ScheduleAddNotePutController::__invoke',));
                    if (!in_array($requestMethod, ['PUT'])) {
                        $allow = array_merge($allow, ['PUT']);
                        goto not_mvc_userinterface_http_scheduleaddnoteput__invoke;
                    }

                    return $ret;
                }
                not_mvc_userinterface_http_scheduleaddnoteput__invoke:

                // mvc_userinterface_http_schedulecreatorpost__invoke
                if ('/mvc/schedule' === $pathinfo) {
                    $ret = array (  '_controller' => 'Mvc\\UserInterface\\Http\\Controller\\ScheduleCreatorPostController::__invoke',  '_route' => 'mvc_userinterface_http_schedulecreatorpost__invoke',);
                    if (!in_array($requestMethod, ['POST'])) {
                        $allow = array_merge($allow, ['POST']);
                        goto not_mvc_userinterface_http_schedulecreatorpost__invoke;
                    }

                    return $ret;
                }
                not_mvc_userinterface_http_schedulecreatorpost__invoke:

                // mvc_userinterface_http_scheduledeleterdelete__invoke
                if (preg_match('#^/mvc/schedule/(?P<scheduleId>[^/]++)$#sD', $pathinfo, $matches)) {
                    $ret = $this->mergeDefaults(array_replace($matches, ['_route' => 'mvc_userinterface_http_scheduledeleterdelete__invoke']), array (  '_controller' => 'Mvc\\UserInterface\\Http\\Controller\\ScheduleDeleterDeleteController::__invoke',));
                    if (!in_array($requestMethod, ['DELETE'])) {
                        $allow = array_merge($allow, ['DELETE']);
                        goto not_mvc_userinterface_http_scheduledeleterdelete__invoke;
                    }

                    return $ret;
                }
                not_mvc_userinterface_http_scheduledeleterdelete__invoke:

                if (0 === strpos($pathinfo, '/mvc/schedules')) {
                    // mvc_userinterface_http_schedulefindersget__invoke
                    if ('/mvc/schedules' === $pathinfo) {
                        $ret = array (  '_controller' => 'Mvc\\UserInterface\\Http\\Controller\\ScheduleFindersGetController::__invoke',  '_route' => 'mvc_userinterface_http_schedulefindersget__invoke',);
                        if (!in_array($canonicalMethod, ['GET'])) {
                            $allow = array_merge($allow, ['GET']);
                            goto not_mvc_userinterface_http_schedulefindersget__invoke;
                        }

                        return $ret;
                    }
                    not_mvc_userinterface_http_schedulefindersget__invoke:

                    // mvc_userinterface_http_schedulepatientfindersget__invoke
                    if (preg_match('#^/mvc/schedules/(?P<patient>[^/]++)$#sD', $pathinfo, $matches)) {
                        $ret = $this->mergeDefaults(array_replace($matches, ['_route' => 'mvc_userinterface_http_schedulepatientfindersget__invoke']), array (  '_controller' => 'Mvc\\UserInterface\\Http\\Controller\\SchedulePatientFindersGetController::__invoke',));
                        if (!in_array($canonicalMethod, ['GET'])) {
                            $allow = array_merge($allow, ['GET']);
                            goto not_mvc_userinterface_http_schedulepatientfindersget__invoke;
                        }

                        return $ret;
                    }
                    not_mvc_userinterface_http_schedulepatientfindersget__invoke:

                }

                // mvc_userinterface_http_scheduleupdatorput__invoke
                if (preg_match('#^/mvc/schedule/(?P<scheduleId>[^/]++)$#sD', $pathinfo, $matches)) {
                    $ret = $this->mergeDefaults(array_replace($matches, ['_route' => 'mvc_userinterface_http_scheduleupdatorput__invoke']), array (  '_controller' => 'Mvc\\UserInterface\\Http\\Controller\\ScheduleUpdatorPutController::__invoke',));
                    if (!in_array($requestMethod, ['PUT'])) {
                        $allow = array_merge($allow, ['PUT']);
                        goto not_mvc_userinterface_http_scheduleupdatorput__invoke;
                    }

                    return $ret;
                }
                not_mvc_userinterface_http_scheduleupdatorput__invoke:

            }

            elseif (0 === strpos($pathinfo, '/mvc/user')) {
                // mvc_userinterface_http_userdiseasetreatmentcreatorpost__invoke
                if ('/mvc/user-disease/treatment' === $pathinfo) {
                    $ret = array (  '_controller' => 'Mvc\\UserInterface\\Http\\Controller\\UserDiseaseTreatmentCreatorPostController::__invoke',  '_route' => 'mvc_userinterface_http_userdiseasetreatmentcreatorpost__invoke',);
                    if (!in_array($requestMethod, ['POST'])) {
                        $allow = array_merge($allow, ['POST']);
                        goto not_mvc_userinterface_http_userdiseasetreatmentcreatorpost__invoke;
                    }

                    return $ret;
                }
                not_mvc_userinterface_http_userdiseasetreatmentcreatorpost__invoke:

                // mvc_userinterface_http_userfinbyniforcipfinderget__invoke
                if (0 === strpos($pathinfo, '/mvc/user/search') && preg_match('#^/mvc/user/search/(?P<nifOrCip>[^/]++)$#sD', $pathinfo, $matches)) {
                    $ret = $this->mergeDefaults(array_replace($matches, ['_route' => 'mvc_userinterface_http_userfinbyniforcipfinderget__invoke']), array (  '_controller' => 'Mvc\\UserInterface\\Http\\Controller\\UserFindByNifOrCipFinderGetController::__invoke',));
                    if (!in_array($canonicalMethod, ['GET'])) {
                        $allow = array_merge($allow, ['GET']);
                        goto not_mvc_userinterface_http_userfinbyniforcipfinderget__invoke;
                    }

                    return $ret;
                }
                not_mvc_userinterface_http_userfinbyniforcipfinderget__invoke:

                // mvc_userinterface_http_userfinderget__invoke
                if (preg_match('#^/mvc/user/(?P<userId>[^/]++)$#sD', $pathinfo, $matches)) {
                    $ret = $this->mergeDefaults(array_replace($matches, ['_route' => 'mvc_userinterface_http_userfinderget__invoke']), array (  '_controller' => 'Mvc\\UserInterface\\Http\\Controller\\UserFinderGetController::__invoke',));
                    if (!in_array($canonicalMethod, ['GET'])) {
                        $allow = array_merge($allow, ['GET']);
                        goto not_mvc_userinterface_http_userfinderget__invoke;
                    }

                    return $ret;
                }
                not_mvc_userinterface_http_userfinderget__invoke:

                // mvc_userinterface_http_userfindersget__invoke
                if ('/mvc/users' === $pathinfo) {
                    $ret = array (  '_controller' => 'Mvc\\UserInterface\\Http\\Controller\\UserFindersGetController::__invoke',  '_route' => 'mvc_userinterface_http_userfindersget__invoke',);
                    if (!in_array($canonicalMethod, ['GET'])) {
                        $allow = array_merge($allow, ['GET']);
                        goto not_mvc_userinterface_http_userfindersget__invoke;
                    }

                    return $ret;
                }
                not_mvc_userinterface_http_userfindersget__invoke:

            }

            elseif (0 === strpos($pathinfo, '/mvc/patient')) {
                // mvc_userinterface_http_userpatientcreatorpost__invoke
                if ('/mvc/patient' === $pathinfo) {
                    $ret = array (  '_controller' => 'Mvc\\UserInterface\\Http\\Controller\\UserPatientCreatorPostController::__invoke',  '_route' => 'mvc_userinterface_http_userpatientcreatorpost__invoke',);
                    if (!in_array($requestMethod, ['POST'])) {
                        $allow = array_merge($allow, ['POST']);
                        goto not_mvc_userinterface_http_userpatientcreatorpost__invoke;
                    }

                    return $ret;
                }
                not_mvc_userinterface_http_userpatientcreatorpost__invoke:

                // mvc_userinterface_http_userpatientmodifycontactdataput__invoke
                if (preg_match('#^/mvc/patient/(?P<patientId>[^/]++)/modify\\-contact\\-data$#sD', $pathinfo, $matches)) {
                    $ret = $this->mergeDefaults(array_replace($matches, ['_route' => 'mvc_userinterface_http_userpatientmodifycontactdataput__invoke']), array (  '_controller' => 'Mvc\\UserInterface\\Http\\Controller\\UserPatientModifyContactDataPutController::__invoke',));
                    if (!in_array($requestMethod, ['PUT'])) {
                        $allow = array_merge($allow, ['PUT']);
                        goto not_mvc_userinterface_http_userpatientmodifycontactdataput__invoke;
                    }

                    return $ret;
                }
                not_mvc_userinterface_http_userpatientmodifycontactdataput__invoke:

                // mvc_userinterface_http_userpatientmodifyprimarycenterput__invoke
                if (preg_match('#^/mvc/patient/(?P<patientId>[^/]++)/modify\\-primary\\-center$#sD', $pathinfo, $matches)) {
                    $ret = $this->mergeDefaults(array_replace($matches, ['_route' => 'mvc_userinterface_http_userpatientmodifyprimarycenterput__invoke']), array (  '_controller' => 'Mvc\\UserInterface\\Http\\Controller\\UserPatientModifyPrimaryCenterPutController::__invoke',));
                    if (!in_array($requestMethod, ['PUT'])) {
                        $allow = array_merge($allow, ['PUT']);
                        goto not_mvc_userinterface_http_userpatientmodifyprimarycenterput__invoke;
                    }

                    return $ret;
                }
                not_mvc_userinterface_http_userpatientmodifyprimarycenterput__invoke:

            }

            // mvc_userinterface_http_vaccinefindersget__invoke
            if ('/mvc/vaccines' === $pathinfo) {
                $ret = array (  '_controller' => 'Mvc\\UserInterface\\Http\\Controller\\VaccineFindersGetController::__invoke',  '_route' => 'mvc_userinterface_http_vaccinefindersget__invoke',);
                if (!in_array($canonicalMethod, ['GET'])) {
                    $allow = array_merge($allow, ['GET']);
                    goto not_mvc_userinterface_http_vaccinefindersget__invoke;
                }

                return $ret;
            }
            not_mvc_userinterface_http_vaccinefindersget__invoke:

        }

        // mvc_userinterface_http_helloworld__invoke
        if ('/api/hello' === $pathinfo) {
            $ret = array (  '_controller' => 'Mvc\\UserInterface\\Http\\Controller\\HelloWorldController::__invoke',  '_route' => 'mvc_userinterface_http_helloworld__invoke',);
            if (!in_array($canonicalMethod, ['GET'])) {
                $allow = array_merge($allow, ['GET']);
                goto not_mvc_userinterface_http_helloworld__invoke;
            }

            return $ret;
        }
        not_mvc_userinterface_http_helloworld__invoke:

        // mvc_userinterface_http_loginpost__invoke
        if ('/login' === $pathinfo) {
            $ret = array (  '_controller' => 'Mvc\\UserInterface\\Http\\Controller\\LoginPostController::__invoke',  '_route' => 'mvc_userinterface_http_loginpost__invoke',);
            if (!in_array($requestMethod, ['POST'])) {
                $allow = array_merge($allow, ['POST']);
                goto not_mvc_userinterface_http_loginpost__invoke;
            }

            return $ret;
        }
        not_mvc_userinterface_http_loginpost__invoke:

        if ('/' === $pathinfo && !$allow) {
            throw new Symfony\Component\Routing\Exception\NoConfigurationException();
        }

        throw 0 < count($allow) ? new MethodNotAllowedException(array_unique($allow)) : new ResourceNotFoundException();
    }
}
