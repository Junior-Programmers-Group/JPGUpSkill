let text = document.getElementById('msg');

let btn = document.getElementById('changeMsgBtn');

btn.addEventListener('click', () => {
    text.textContent = 'Hello Developers!';
});

let nPress = 0;
window.onload = () => {
    
    const main = document.getElementById('main');

    // add text
    const container = document.createElement('div');
    container.classList.add('bg-light', 'd-flex', 'align-items-center', 'justify-content-between', 'w-50');

    main.appendChild(container);

    const text = document.createElement('h5');
    text.textContent = `I pressed this button ${nPress} times.`;
    text.classList.add('m-0');
    container.appendChild(text);

    const btnContainer = document.createElement('div');
    btnContainer.classList.add('d-flex', 'flex-row', 'align-items-center', 'gap-2');
    container.appendChild(btnContainer);

    const pressMe = document.createElement('button');
    pressMe.textContent = 'Press me';
    pressMe.classList.add('btn', 'btn-primary', 'mt-2');
    btnContainer.appendChild(pressMe);

    const resetMe = document.createElement('button');
    resetMe.textContent = 'Reset';
    resetMe.classList.add('btn', 'btn-danger', 'mt-2');
    btnContainer.appendChild(resetMe);

    pressMe.addEventListener('click', () => {
        nPress++;
        text.textContent = `I pressed this button ${nPress} times.`;
    });

    resetMe.addEventListener('click', () => {
        nPress = 0;
        text.textContent = `I pressed this button ${nPress} times.`;
    });
}

