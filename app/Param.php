<?php

namespace App;

class Param
{
    public const GROUND_MOVEMENT_EVENT = '1';
    public const GROUND_MOVEMENT_EARLY_WARNING = '2';
    public const GROUND_MOVEMENT_EVENT_RECAP = '3';
    public const GROUND_MOVEMENT_MAP_ZKGT = '4';

    public const GROUND_MOVEMENT_EVENT_SLUG = 'daftar-kejadian';
    public const GROUND_MOVEMENT_EARLY_WARNING_SLUG = 'peringatan-dini';
    public const GROUND_MOVEMENT_EVENT_RECAP_SLUG = 'rekapitulasi-kejadian';

    public const PROFILE_ABOUT = '1';
    public const PROFILE_STRUCTURE = '2';
    public const PROFILE_HISTORY = '3';

    public const ROLE_SLUG_ADMIN = 'admin';
    public const ROLE_SLUG_MANAGER = 'manager';
    public const ROLE_SLUG_EDITOR = 'editor';
    public const ROLE_SLUG_USER = 'user';

    public const PUBLIC_SERVICE_BUREAUCRATIC_REFORM = '1';
    public const PUBLIC_SERVICE_INFORMATION_DISSEMINATION = '2';

    public const PUBLIC_SERVICE_BUREAUCRATIC_REFORM_SLUG = 'reformasi-birokrasi';
    public const PUBLIC_SERVICE_INFORMATION_DISSEMINATION_SLUG = 'diseminasi-informasi';

    public const DEFAULT_ACCESS_POLICY = '*';
    public const MANAGE_USER_POLICY = 'manage-user';
    public const MANAGE_ROLE_POLICY = 'manage-role';
    public const MANAGE_UPLOAD_POLICY = 'manage-upload';
    public const MANAGE_PRESS_RELEASE_POLICY = 'manage-press-release';
    public const MANAGE_PROFILE_ABOUT_POLICY = 'manage-profile-about';
    public const MANAGE_PROFILE_STRUCTURE_POLICY = 'manage-profile-structure';
    public const MANAGE_PROFILE_HISTORY_POLICY = 'manage-profile-history';
    public const MANAGE_VOLCANO_BASIC_DATA_POLICY = 'manage-volcano-basic-data';
    public const MANAGE_VOLCANO_ACTIVITY_LEVEL_POLICY = 'manage-volcano-activity-level';
    public const MANAGE_GROUND_MOVEMENT_EVENT_POLICY = 'manage-ground-movement-event';
    public const MANAGE_GROUND_MOVEMENT_EARLY_WARNING_POLICY = 'manage-ground-movement-early-warning';
    public const MANAGE_GROUND_MOVEMENT_EVENT_RECAP_POLICY = 'manage-ground-movement-event-recap';
    public const MANAGE_GROUND_MOVEMENT_INCIDENT_RESPONSE_POLICY = 'manage-ground-movement-incident-response';
    public const MANAGE_EARTHQUAKES_AND_TSUNAMI_EVENT_POLICY = 'manage-earthquakes-and-tsunami-event';
    public const MANAGE_EARTHQUAKES_AND_TSUNAMI_EVENT_REVIEW_POLICY = 'manage-earthquakes-and-tsunami-event-review';
    public const MANAGE_EARTHQUAKES_AND_TSUNAMI_EVENT_REPORT_POLICY = 'manage-earthquakes-and-tsunami-event-report';
    public const MANAGE_EARTHQUAKES_AND_TSUNAMI_MITIGATION_PUBLICATION_POLICY = 'manage-earthquakes-and-tsunami-mitigation-publication';
    public const MANAGE_PUBLIC_SERVICE_BUREAUCRATIC_REFORM_POLICY = 'manage-public-service-bureaucratic-reform';
    public const MANAGE_PUBLIC_SERVICE_INFORMATION_DISSEMINATION_POLICY = 'manage-public-service-information-dissemination';
    public const MANAGE_PUBLIC_SERVICE_COLLABORATION_INFORMATION_POLICY = 'manage-public-service-collaboration-information';
    public const MANAGE_PUBLIC_SERVICE_CONTACT_POLICY = 'manage-public-service-contact';
    public const MANAGE_PUBLIC_SERVICE_ANNOUNCMENT_POLICY = 'manage-public-service-announcement';
}
