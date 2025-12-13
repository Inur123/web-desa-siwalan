function toggleSettingDropdown() {
    const submenu = document.getElementById('settingSubmenu');
    const arrow = document.getElementById('settingArrow');
    if (submenu.classList.contains('hidden')) {
        submenu.classList.remove('hidden');
        arrow.classList.add('rotate-180');
    } else {
        submenu.classList.add('hidden');
        arrow.classList.remove('rotate-180');
    }
}

function toggleLayananDropdown() {
    const submenu = document.getElementById('layananSubmenu');
    const arrow = document.getElementById('layananArrow');
    if (submenu.classList.contains('hidden')) {
        submenu.classList.remove('hidden');
        arrow.classList.add('rotate-180');
    } else {
        submenu.classList.add('hidden');
        arrow.classList.remove('rotate-180');
    }
}
