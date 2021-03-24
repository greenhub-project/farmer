-- homestead.android_permissions definition

CREATE TABLE `android_permissions` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `permission` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;


-- homestead.devices definition

CREATE TABLE `devices` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `uuid` varchar(120) COLLATE utf8mb4_unicode_ci NOT NULL,
  `model` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `manufacturer` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `brand` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `product` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `os_version` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `kernel_version` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `is_root` tinyint(1) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `devices_uuid_index` (`uuid`),
  KEY `devices_model_index` (`model`),
  KEY `devices_brand_index` (`brand`),
  KEY `devices_os_version_index` (`os_version`),
  KEY `devices_created_at_index` (`created_at`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;


-- homestead.migrations definition

CREATE TABLE `migrations` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=20 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;


-- homestead.mobile_messages definition

CREATE TABLE `mobile_messages` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `recipient` int(10) unsigned NOT NULL DEFAULT 0,
  `type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'info',
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `body` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `permanent` tinyint(1) NOT NULL DEFAULT 0,
  `published` tinyint(1) NOT NULL DEFAULT 0,
  `version` int(10) unsigned NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `mobile_messages_recipient_index` (`recipient`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;


-- homestead.password_resets definition

CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  KEY `password_resets_email_index` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;


-- homestead.permissions definition

CREATE TABLE `permissions` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `guard_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;


-- homestead.roles definition

CREATE TABLE `roles` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `guard_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;


-- homestead.uploads definition

CREATE TABLE `uploads` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `data` mediumtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;


-- homestead.users definition

CREATE TABLE `users` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `api_token` varchar(30) COLLATE utf8mb4_unicode_ci NOT NULL,
  `active` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`),
  UNIQUE KEY `users_api_token_unique` (`api_token`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;


-- homestead.datasets definition

CREATE TABLE `datasets` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(10) unsigned NOT NULL,
  `path` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `download_token` varchar(30) COLLATE utf8mb4_unicode_ci NOT NULL,
  `downloaded` tinyint(1) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `datasets_download_token_unique` (`download_token`),
  KEY `datasets_user_id_foreign` (`user_id`),
  CONSTRAINT `datasets_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;


-- homestead.model_has_permissions definition

CREATE TABLE `model_has_permissions` (
  `permission_id` int(10) unsigned NOT NULL,
  `model_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `model_id` bigint(20) unsigned NOT NULL,
  PRIMARY KEY (`permission_id`,`model_id`,`model_type`),
  KEY `model_has_permissions_model_id_model_type_index` (`model_id`,`model_type`),
  CONSTRAINT `model_has_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;


-- homestead.model_has_roles definition

CREATE TABLE `model_has_roles` (
  `role_id` int(10) unsigned NOT NULL,
  `model_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `model_id` bigint(20) unsigned NOT NULL,
  PRIMARY KEY (`role_id`,`model_id`,`model_type`),
  KEY `model_has_roles_model_id_model_type_index` (`model_id`,`model_type`),
  CONSTRAINT `model_has_roles_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;


-- homestead.role_has_permissions definition

CREATE TABLE `role_has_permissions` (
  `permission_id` int(10) unsigned NOT NULL,
  `role_id` int(10) unsigned NOT NULL,
  PRIMARY KEY (`permission_id`,`role_id`),
  KEY `role_has_permissions_role_id_foreign` (`role_id`),
  CONSTRAINT `role_has_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE,
  CONSTRAINT `role_has_permissions_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;


-- homestead.samples definition

CREATE TABLE `samples` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `device_id` int(10) unsigned NOT NULL,
  `timestamp` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `app_version` int(10) unsigned NOT NULL DEFAULT 0,
  `database_version` int(10) unsigned NOT NULL DEFAULT 0,
  `battery_state` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `battery_level` decimal(8,2) NOT NULL,
  `memory_active` int(10) unsigned NOT NULL,
  `memory_inactive` int(10) unsigned NOT NULL,
  `memory_free` int(10) unsigned NOT NULL,
  `memory_user` int(10) unsigned NOT NULL,
  `triggered_by` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `network_status` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `screen_brightness` int(11) NOT NULL,
  `screen_on` tinyint(1) NOT NULL,
  `timezone` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `country_code` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `samples_device_id_foreign` (`device_id`),
  KEY `samples_battery_state_index` (`battery_state`),
  KEY `samples_network_status_index` (`network_status`),
  KEY `samples_screen_on_index` (`screen_on`),
  KEY `samples_created_at_index` (`created_at`),
  CONSTRAINT `samples_device_id_foreign` FOREIGN KEY (`device_id`) REFERENCES `devices` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;


-- homestead.sensor_details definition

CREATE TABLE `sensor_details` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `sample_id` int(10) unsigned NOT NULL,
  `fifo_max_event_count` int(11) NOT NULL,
  `fifo_reserved_event_count` int(11) NOT NULL,
  `highest_direct_report_rate_level` int(11) NOT NULL,
  `is_additional_info_supported` tinyint(1) NOT NULL,
  `is_dynamic_sensor` tinyint(1) NOT NULL,
  `is_wake_up_sensor` tinyint(1) NOT NULL,
  `max_delay` int(11) NOT NULL,
  `maximum_range` decimal(8,2) NOT NULL,
  `min_delay` int(11) NOT NULL,
  `name` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `power` decimal(8,2) NOT NULL,
  `reporting_mode` int(11) NOT NULL,
  `resolution` decimal(8,2) NOT NULL,
  `string_type` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `code_type` int(11) NOT NULL,
  `vendor` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `version` int(11) NOT NULL,
  `frequency_of_use` int(11) NOT NULL,
  `ini_timestamp` bigint(20) NOT NULL,
  `end_timestamp` bigint(20) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `sensor_details_sample_id_foreign` (`sample_id`),
  CONSTRAINT `sensor_details_sample_id_foreign` FOREIGN KEY (`sample_id`) REFERENCES `samples` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;


-- homestead.settings definition

CREATE TABLE `settings` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `sample_id` int(10) unsigned NOT NULL,
  `bluetooth_enabled` tinyint(1) NOT NULL,
  `location_enabled` tinyint(1) NOT NULL,
  `power_saver_enabled` tinyint(1) NOT NULL,
  `flashlight_enabled` tinyint(1) NOT NULL,
  `nfc_enabled` tinyint(1) NOT NULL,
  `unknown_sources` tinyint(1) NOT NULL,
  `developer_mode` tinyint(1) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `settings_sample_id_foreign` (`sample_id`),
  CONSTRAINT `settings_sample_id_foreign` FOREIGN KEY (`sample_id`) REFERENCES `samples` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;


-- homestead.storage_details definition

CREATE TABLE `storage_details` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `sample_id` int(10) unsigned NOT NULL,
  `free` int(10) unsigned NOT NULL,
  `total` int(10) unsigned NOT NULL,
  `free_external` int(10) unsigned NOT NULL,
  `total_external` int(10) unsigned NOT NULL,
  `free_system` int(10) unsigned NOT NULL,
  `total_system` int(10) unsigned NOT NULL,
  `free_secondary` int(10) unsigned NOT NULL,
  `total_secondary` int(10) unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `storage_details_sample_id_foreign` (`sample_id`),
  CONSTRAINT `storage_details_sample_id_foreign` FOREIGN KEY (`sample_id`) REFERENCES `samples` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;


-- homestead.app_processes definition

CREATE TABLE `app_processes` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `sample_id` int(10) unsigned NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `application_label` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `is_system_app` tinyint(1) NOT NULL,
  `importance` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `version_name` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `version_code` int(11) NOT NULL,
  `installation_package` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `app_processes_sample_id_foreign` (`sample_id`),
  KEY `app_processes_name_index` (`name`),
  KEY `app_processes_application_label_index` (`application_label`),
  KEY `app_processes_created_at_index` (`created_at`),
  CONSTRAINT `app_processes_sample_id_foreign` FOREIGN KEY (`sample_id`) REFERENCES `samples` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;


-- homestead.battery_details definition

CREATE TABLE `battery_details` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `sample_id` int(10) unsigned NOT NULL,
  `charger` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `health` varchar(30) COLLATE utf8mb4_unicode_ci NOT NULL,
  `voltage` decimal(8,2) NOT NULL,
  `temperature` decimal(8,2) NOT NULL,
  `capacity` int(11) NOT NULL,
  `charge_counter` int(11) NOT NULL,
  `current_average` int(11) NOT NULL,
  `current_now` int(11) NOT NULL,
  `energy_counter` bigint(20) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `battery_details_sample_id_foreign` (`sample_id`),
  CONSTRAINT `battery_details_sample_id_foreign` FOREIGN KEY (`sample_id`) REFERENCES `samples` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;


-- homestead.cpu_statuses definition

CREATE TABLE `cpu_statuses` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `sample_id` int(10) unsigned NOT NULL,
  `usage` decimal(8,2) NOT NULL,
  `up_time` bigint(20) unsigned NOT NULL DEFAULT 0,
  `sleep_time` bigint(20) unsigned NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `cpu_statuses_sample_id_foreign` (`sample_id`),
  CONSTRAINT `cpu_statuses_sample_id_foreign` FOREIGN KEY (`sample_id`) REFERENCES `samples` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;


-- homestead.features definition

CREATE TABLE `features` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `sample_id` int(10) unsigned NOT NULL,
  `key` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `value` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `features_sample_id_foreign` (`sample_id`),
  CONSTRAINT `features_sample_id_foreign` FOREIGN KEY (`sample_id`) REFERENCES `samples` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;


-- homestead.location_providers definition

CREATE TABLE `location_providers` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `sample_id` int(10) unsigned NOT NULL,
  `provider` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `location_providers_sample_id_foreign` (`sample_id`),
  CONSTRAINT `location_providers_sample_id_foreign` FOREIGN KEY (`sample_id`) REFERENCES `samples` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;


-- homestead.network_details definition

CREATE TABLE `network_details` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `sample_id` int(10) unsigned NOT NULL,
  `network_type` varchar(30) COLLATE utf8mb4_unicode_ci NOT NULL,
  `mobile_network_type` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `mobile_data_status` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `mobile_data_activity` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL,
  `roaming_enabled` tinyint(1) NOT NULL,
  `wifi_status` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `wifi_signal_strength` int(11) NOT NULL,
  `wifi_link_speed` int(11) NOT NULL,
  `wifi_ap_status` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `network_operator` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `sim_operator` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `mcc` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL,
  `mnc` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `network_details_sample_id_foreign` (`sample_id`),
  CONSTRAINT `network_details_sample_id_foreign` FOREIGN KEY (`sample_id`) REFERENCES `samples` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;


-- homestead.app_permissions definition

CREATE TABLE `app_permissions` (
  `android_permission_id` int(10) unsigned NOT NULL,
  `app_process_id` int(10) unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`android_permission_id`,`app_process_id`),
  KEY `app_permissions_app_process_id_foreign` (`app_process_id`),
  CONSTRAINT `app_permissions_android_permission_id_foreign` FOREIGN KEY (`android_permission_id`) REFERENCES `android_permissions` (`id`) ON DELETE CASCADE,
  CONSTRAINT `app_permissions_app_process_id_foreign` FOREIGN KEY (`app_process_id`) REFERENCES `app_processes` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;