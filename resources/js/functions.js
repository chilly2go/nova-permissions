export function getOptionClass(selectedValues, option) {
    const values = Array.isArray(selectedValues) ? selectedValues : [];
    const isSelected = values.includes(option);

    return {
        'bg-success': isSelected,
        'bg-danger': !isSelected,
    };
}
