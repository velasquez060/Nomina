function toggleMenu() {
    const menuLateral = document.querySelector('.menu-lateral');

    menuLateral.style.left = (menuLateral.style.left === '0px') ? '-250px' : '0px';
}
