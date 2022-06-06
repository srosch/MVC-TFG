<?php

use Symfony\Component\DependencyInjection\Argument\RewindableGenerator;

// This file has been auto-generated by the Symfony Dependency Injection Component for internal use.
// Returns the public 'Mvc\Infrastructure\CQRS\Command\CommandBus' shared autowired service.

return $this->services['Mvc\\Infrastructure\\CQRS\\Command\\CommandBus'] = new \Mvc\Infrastructure\CQRS\Command\SimpleCommandBus(new RewindableGenerator(function () {
    yield 0 => ${($_ = isset($this->services['Mvc\\Application\\Service\\HistoryUserAllergyCreatorService']) ? $this->services['Mvc\\Application\\Service\\HistoryUserAllergyCreatorService'] : $this->load('getHistoryUserAllergyCreatorServiceService.php')) && false ?: '_'};
    yield 1 => ${($_ = isset($this->services['Mvc\\Application\\Service\\HistoryUserDiseaseCreatorService']) ? $this->services['Mvc\\Application\\Service\\HistoryUserDiseaseCreatorService'] : $this->load('getHistoryUserDiseaseCreatorServiceService.php')) && false ?: '_'};
    yield 2 => ${($_ = isset($this->services['Mvc\\Application\\Service\\HistoryUserDonationCreatorService']) ? $this->services['Mvc\\Application\\Service\\HistoryUserDonationCreatorService'] : $this->load('getHistoryUserDonationCreatorServiceService.php')) && false ?: '_'};
    yield 3 => ${($_ = isset($this->services['Mvc\\Application\\Service\\HistoryUserOperationCreatorService']) ? $this->services['Mvc\\Application\\Service\\HistoryUserOperationCreatorService'] : $this->load('getHistoryUserOperationCreatorServiceService.php')) && false ?: '_'};
    yield 4 => ${($_ = isset($this->services['Mvc\\Application\\Service\\HistoryUserOperationsAddNoteService']) ? $this->services['Mvc\\Application\\Service\\HistoryUserOperationsAddNoteService'] : $this->load('getHistoryUserOperationsAddNoteServiceService.php')) && false ?: '_'};
    yield 5 => ${($_ = isset($this->services['Mvc\\Application\\Service\\HistoryUserVaccineCreatorService']) ? $this->services['Mvc\\Application\\Service\\HistoryUserVaccineCreatorService'] : $this->load('getHistoryUserVaccineCreatorServiceService.php')) && false ?: '_'};
    yield 6 => ${($_ = isset($this->services['Mvc\\Application\\Service\\MedicalCenterCreatorService']) ? $this->services['Mvc\\Application\\Service\\MedicalCenterCreatorService'] : $this->load('getMedicalCenterCreatorServiceService.php')) && false ?: '_'};
    yield 7 => ${($_ = isset($this->services['Mvc\\Application\\Service\\MedicalCenterUpdatorService']) ? $this->services['Mvc\\Application\\Service\\MedicalCenterUpdatorService'] : $this->load('getMedicalCenterUpdatorServiceService.php')) && false ?: '_'};
    yield 8 => ${($_ = isset($this->services['Mvc\\Application\\Service\\OnlineConsultationCreatorService']) ? $this->services['Mvc\\Application\\Service\\OnlineConsultationCreatorService'] : $this->load('getOnlineConsultationCreatorServiceService.php')) && false ?: '_'};
    yield 9 => ${($_ = isset($this->services['Mvc\\Application\\Service\\OnlineConsultationResponseService']) ? $this->services['Mvc\\Application\\Service\\OnlineConsultationResponseService'] : $this->load('getOnlineConsultationResponseServiceService.php')) && false ?: '_'};
    yield 10 => ${($_ = isset($this->services['Mvc\\Application\\Service\\ScheduleAddNoteService']) ? $this->services['Mvc\\Application\\Service\\ScheduleAddNoteService'] : $this->load('getScheduleAddNoteServiceService.php')) && false ?: '_'};
    yield 11 => ${($_ = isset($this->services['Mvc\\Application\\Service\\ScheduleCreatorService']) ? $this->services['Mvc\\Application\\Service\\ScheduleCreatorService'] : $this->load('getScheduleCreatorServiceService.php')) && false ?: '_'};
    yield 12 => ${($_ = isset($this->services['Mvc\\Application\\Service\\ScheduleDeleterService']) ? $this->services['Mvc\\Application\\Service\\ScheduleDeleterService'] : $this->load('getScheduleDeleterServiceService.php')) && false ?: '_'};
    yield 13 => ${($_ = isset($this->services['Mvc\\Application\\Service\\ScheduleUpdatorService']) ? $this->services['Mvc\\Application\\Service\\ScheduleUpdatorService'] : $this->load('getScheduleUpdatorServiceService.php')) && false ?: '_'};
    yield 14 => ${($_ = isset($this->services['Mvc\\Application\\Service\\UserAdministrativeCreatorService']) ? $this->services['Mvc\\Application\\Service\\UserAdministrativeCreatorService'] : $this->load('getUserAdministrativeCreatorServiceService.php')) && false ?: '_'};
    yield 15 => ${($_ = isset($this->services['Mvc\\Application\\Service\\UserDiseaseTreatmentCreatorService']) ? $this->services['Mvc\\Application\\Service\\UserDiseaseTreatmentCreatorService'] : $this->load('getUserDiseaseTreatmentCreatorServiceService.php')) && false ?: '_'};
    yield 16 => ${($_ = isset($this->services['Mvc\\Application\\Service\\UserDocumentCreatorService']) ? $this->services['Mvc\\Application\\Service\\UserDocumentCreatorService'] : $this->load('getUserDocumentCreatorServiceService.php')) && false ?: '_'};
    yield 17 => ${($_ = isset($this->services['Mvc\\Application\\Service\\UserHealthPersonnelCreatorService']) ? $this->services['Mvc\\Application\\Service\\UserHealthPersonnelCreatorService'] : $this->load('getUserHealthPersonnelCreatorServiceService.php')) && false ?: '_'};
    yield 18 => ${($_ = isset($this->services['Mvc\\Application\\Service\\UserPatientCreatorService']) ? $this->services['Mvc\\Application\\Service\\UserPatientCreatorService'] : $this->load('getUserPatientCreatorServiceService.php')) && false ?: '_'};
    yield 19 => ${($_ = isset($this->services['Mvc\\Application\\Service\\UserPatientModifyContactDataService']) ? $this->services['Mvc\\Application\\Service\\UserPatientModifyContactDataService'] : $this->load('getUserPatientModifyContactDataServiceService.php')) && false ?: '_'};
    yield 20 => ${($_ = isset($this->services['Mvc\\Application\\Service\\UserPatientModifyPrimaryCenterService']) ? $this->services['Mvc\\Application\\Service\\UserPatientModifyPrimaryCenterService'] : $this->load('getUserPatientModifyPrimaryCenterServiceService.php')) && false ?: '_'};
}, 21));