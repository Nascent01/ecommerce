<?php

namespace App\Constants\Product;

class AttributeConstant
{
    const TYPE_ATTRIBUTE_MODEL = 'Model';
    const TYPE_ATTRIBUTE_BRAND = 'Brand';
    const TYPE_ATTRIBUTE_NETWORK = 'Network';
    const TYPE_ATTRIBUTE_TWOG = 'TwoG';
    const TYPE_ATTRIBUTE_THREEG = 'ThreeG';
    const TYPE_ATTRIBUTE_NETWORK_SPEED = 'Network_Speed';
    const TYPE_ATTRIBUTE_GPRS = 'GPRS';
    const TYPE_ATTRIBUTE_EDGE = 'EDGE';
    const TYPE_ATTRIBUTE_STATUS = 'Status';
    const TYPE_ATTRIBUTE_DIMENSIONS = 'Dimensions';
    const TYPE_ATTRIBUTE_SIM = 'SIM';
    const TYPE_ATTRIBUTE_DISPLAY_TYPE = 'Display_type';
    const TYPE_ATTRIBUTE_DISPLAY_RESOLUTION = 'Display_resolution';
    const TYPE_ATTRIBUTE_DISPLAY_SIZE = 'Display_size';
    const TYPE_ATTRIBUTE_OPERATING_SYSTEM = 'Operating_System';
    const TYPE_ATTRIBUTE_CPU = 'CPU';
    const TYPE_ATTRIBUTE_MEMORY_CARD = 'Memory_card';
    const TYPE_ATTRIBUTE_INTERNAL_MEMORY = 'Internal_memory';
    const TYPE_ATTRIBUTE_RAM = 'RAM';
    const TYPE_ATTRIBUTE_PRIMARY_CAMERA = 'Primary_camera';
    const TYPE_ATTRIBUTE_SECONDARY_CAMERA = 'Secondary_camera';
    const TYPE_ATTRIBUTE_LOUD_SPEAKER = 'Loud_speaker';
    const TYPE_ATTRIBUTE_AUDIO_JACK = 'Audio_jack';
    const TYPE_ATTRIBUTE_WLAN = 'WLAN';
    const TYPE_ATTRIBUTE_BLUETOOTH = 'Bluetooth';
    const TYPE_ATTRIBUTE_GPS = 'GPS';
    const TYPE_ATTRIBUTE_RADIO = 'Radio';
    const TYPE_ATTRIBUTE_USB = 'USB';
    const TYPE_ATTRIBUTE_SENSORS = 'Sensors';
    const TYPE_ATTRIBUTE_BATTERY = 'Battery';
    const TYPE_ATTRIBUTE_COLORS = 'Colors';

    const ATTRIBUTES_ARRAY = [
        self::TYPE_ATTRIBUTE_MODEL,
        self::TYPE_ATTRIBUTE_BRAND,
        self::TYPE_ATTRIBUTE_NETWORK,
        self::TYPE_ATTRIBUTE_TWOG,
        self::TYPE_ATTRIBUTE_THREEG,
        self::TYPE_ATTRIBUTE_NETWORK_SPEED,
        self::TYPE_ATTRIBUTE_GPRS,
        self::TYPE_ATTRIBUTE_EDGE,
        self::TYPE_ATTRIBUTE_STATUS,
        self::TYPE_ATTRIBUTE_DIMENSIONS,
        self::TYPE_ATTRIBUTE_SIM,
        self::TYPE_ATTRIBUTE_DISPLAY_TYPE,
        self::TYPE_ATTRIBUTE_DISPLAY_RESOLUTION,
        self::TYPE_ATTRIBUTE_DISPLAY_SIZE,
        self::TYPE_ATTRIBUTE_OPERATING_SYSTEM,
        self::TYPE_ATTRIBUTE_CPU,
        self::TYPE_ATTRIBUTE_MEMORY_CARD,
        self::TYPE_ATTRIBUTE_INTERNAL_MEMORY,
        self::TYPE_ATTRIBUTE_RAM,
        self::TYPE_ATTRIBUTE_PRIMARY_CAMERA,
        self::TYPE_ATTRIBUTE_SECONDARY_CAMERA,
        self::TYPE_ATTRIBUTE_LOUD_SPEAKER,
        self::TYPE_ATTRIBUTE_AUDIO_JACK,
        self::TYPE_ATTRIBUTE_WLAN,
        self::TYPE_ATTRIBUTE_BLUETOOTH,
        self::TYPE_ATTRIBUTE_GPS,
        self::TYPE_ATTRIBUTE_RADIO,
        self::TYPE_ATTRIBUTE_USB,
        self::TYPE_ATTRIBUTE_SENSORS,
        self::TYPE_ATTRIBUTE_BATTERY,
        self::TYPE_ATTRIBUTE_COLORS,
    ];

    const ATTRIBUTE_SEPERATOR_MAPPING = [
        self::TYPE_ATTRIBUTE_COLORS => '|',
        self::TYPE_ATTRIBUTE_INTERNAL_MEMORY => '/',
    ];
}
