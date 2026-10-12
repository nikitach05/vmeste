const radioFields = document.querySelectorAll('.radio-field');

if (radioFields.length) {
    radioFields.forEach((radio) => {
        const box = radio.querySelector('.radio-field__box');
        const label = radio.querySelector('.radio-field__label');
        box?.addEventListener('click', toggleRadio);
        label?.addEventListener('click', toggleRadio);
    });
}

function toggleRadio(e) {
    const target = e.target.closest('.radio-field');
    const input = target?.querySelector('.radio-field__input');
    if (!input) return;

    document.querySelectorAll(`input[name="${input.name}"]`).forEach((item) => {
        item.checked = false;
        item.closest('.radio-field')?.querySelector('.radio-field__box')?.classList.remove('active');
    });

    input.checked = true;
    target.querySelector('.radio-field__box')?.classList.add('active');
}
