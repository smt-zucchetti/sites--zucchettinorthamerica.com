jQuery(document).ready(function ($) {
    const list = $('.cwb-blocks-sortable');
    const template = $('#cwb-block-template').html();

    // Utility: Convert index string (like "0_1_2") to bracket notation for names: [0][1][2]
    function indexToNamePrefix(index) {
        return index.split('_').reduce((acc, part) => `${acc}[${part}]`, 'blocks');
    }

    // Add main row
    list.on('click', '.cwb-add-row', function () {
        const newIndex = list.children('li').length;
        const namePrefix = indexToNamePrefix(String(newIndex));
        let html = template
            .replace(/__DATA_INDEX__/g, newIndex)
            .replace(/__NAME_PREFIX__/g, namePrefix);

        const $newRow = $(html).attr('data-index', newIndex);
        list.append($newRow);

        const $select = $newRow.find('select');
        CWB.toggleFieldOptions($newRow, $select.val());
    });

    // Add subrow (nested repeaters)
    list.on('click', '.cwb-add-subrow', function () {
        const $btn = $(this);
        const parentDataIndex = $btn.data('parentName'); // e.g., "0", "0_1"

        if (!parentDataIndex) {
            console.error('Missing data-parent-name attribute on add subfield button');
            return;
        }

        const $repeaterFields = $btn.siblings('.cwb-repeater-fields');
        const subfieldCount = $repeaterFields.children('li').length;
        const newIndex = parentDataIndex + '_' + subfieldCount;
        const namePrefix = indexToNamePrefix(newIndex);

        let html = template
            .replace(/__DATA_INDEX__/g, newIndex)
            .replace(/__NAME_PREFIX__/g, namePrefix);

        const $newSubRow = $(html).attr('data-index', newIndex);
        $repeaterFields.append($newSubRow);

        const $select = $newSubRow.find('select');
        CWB.toggleFieldOptions($newSubRow, $select.val());
    });

    // Toggle visibility of options based on select field
    list.on('change', 'select[name$="[type]"]', function () {
        const $select = $(this);
        const $row = $select.closest('.cwb-block-row');
        CWB.toggleFieldOptions($row, $select.val());
    });

    window.CWB = {
        toggleFieldOptions($row, type) {
            $row.find('.cwb-options-wrap').hide();
            $row.find('.cwb-repeater-fields, .cwb-add-subrow').hide();

            if (type === 'text' || type === 'textarea') {
                $row.find('.cwb-options-wrap[data-type="' + type + '"]').show();
            } else if (type === 'repeater') {
                $row.find('.cwb-repeater-fields, .cwb-add-subrow').show();
            }
        }
    };
});
