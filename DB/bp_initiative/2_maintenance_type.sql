INSERT INTO `maintenance_type`(
    `code`,
    `name`,
    `description`,
    `created_by`,
    `date_created`,
    `archived`
)
VALUES(
    'bp_initiative_category',
    'BP Initiative Category',
    'BP Initiative Category',
    '1',
    CURRENT_TIMESTAMP(), NULL),
    (
        'bp_initiative_sub_category',
        'BP Initiative Sub-Category',
        'BP Initiative Sub-Category',
        '1',
        CURRENT_TIMESTAMP(), NULL);