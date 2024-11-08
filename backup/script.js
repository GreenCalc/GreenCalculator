// Example function to limit the number of selections
document.querySelectorAll('input[type="checkbox"]').forEach(item => {
    item.addEventListener('change', () => {
        const checkedItems = document.querySelectorAll('input[type="checkbox"]:checked');
        if (checkedItems.length > 5) {
            item.checked = false;
            alert('Maksimal 5 pilihan');
        }
    });
});

// Update emission calculation logic here
