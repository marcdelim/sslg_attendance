INSERT INTO `maintenance_type`(
    `code`,
    `name`,
    `description`,
    `created_by`,
    `date_created`,
    `archived`
)
VALUES(
    'threshold_computation_data_filter',
    'Threshold Computation Data Filter',
    'Threshold Computation Data Filter',
    '1',
    CURRENT_TIMESTAMP(), NULL),
    (
        'threshold_computation_reference_point',
        'Threshold Computation Reference Point',
        'Threshold Computation Reference Point',
        '1',
        CURRENT_TIMESTAMP(), NULL),
        (
            'threshold_computation_color_code',
            'Threshold Computation Color Code',
            'Threshold Computation Color Code',
            '1',
            CURRENT_TIMESTAMP(), NULL),
            (
                'threshold_computation_bu',
                'Threshold Computation Business Unit',
                'Threshold Computation Business Unit',
                '1',
                CURRENT_TIMESTAMP(), NULL),
                (
                    'threshold_computation_sub_bu',
                    'Threshold Computation Sub-Business Unit',
                    'Threshold Computation Sub-Business Unit',
                    '1',
                    CURRENT_TIMESTAMP(), NULL);