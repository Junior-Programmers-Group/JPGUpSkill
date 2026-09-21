let hooks = [];
let hookIndex = 0;

const useState = (initialValue) => {
    const _index = hookIndex;

    if (hooks[_index] === undefined) {
        hooks[_index] = initialValue;
    }

    const setState = (newValue) => {
        const nextValue = typeof newValue === 'function' ? newValue(hooks[_index]) : newValue;
        if (hooks[_index] !== nextValue) {
            hooks[_index] = nextValue;
            refreshUI();
        }
    };

    hookIndex++;
    return [hooks[_index], setState];
};

const init = () => {
    hookIndex = 0;

    const [nPress, setNPress] = useState(0);
    const [title, setTitle] = useState('Hello World');

    const main = document.getElementById('main');
    main.appendChild(CreateContainer(nPress, setNPress, title, setTitle));
};

const removeElements = () => {
    const main = document.getElementById('main');
    while (main.firstChild) {
        main.removeChild(main.firstChild);
    }
};

const refreshUI = () => {
    removeElements();
    init();
};

const CreateContainer = (nPress, setNPress, title, setTitle) => {
    const container = document.createElement('div');
    container.classList.add('bg-light', 'd-flex', 'flex-column', 'align-items-center', 'justify-content-between', 'w-50', 'p-2');
    container.appendChild(CreateHelloWorld(title));
    container.appendChild(CreatePressCounter(nPress));
    container.appendChild(CreateIncrementButton(setNPress));
    container.appendChild(CreateButtonContainer(setTitle));

    // This is how it would look in React JSX:
    // <Container>
    //     <CreateHelloWorld title={title} />
    //     <CreatePressCounter nPress={nPress} />
    //     <CreateIncrementButton setNPress={setNPress} />
    //     <CreateButtonContainer setTitle={setTitle} />
    // </Container>
    return container;
};

const CreateButtonContainer = (setTitle) => {
    const buttonContainer = document.createElement('div');
    buttonContainer.classList.add('d-flex', 'flex-row', 'align-items-center', 'gap-2', "m-3");
    buttonContainer.appendChild(CreateButton("Change Title", () => setTitle('Change Title')));
    buttonContainer.appendChild(CreateButton("Another Title", () => setTitle('Another Title')));
    buttonContainer.appendChild(CreateButton("Hello World", () => setTitle('Hello World')));
    return buttonContainer;
}

const CreateHelloWorld = (title) => {
    const helloWorld = document.createElement('h3');
    helloWorld.textContent = title;
    helloWorld.classList.add('m-0');
    return helloWorld;

    // React JSX equivalent:
    // return {
    //     <>
    //         <h3 className="m-0">{title}</h3>
    //     </>
    // };

};

const CreatePressCounter = (nPress) => {
    const counter = document.createElement('p');
    counter.textContent = `Button pressed ${nPress} times`;
    return counter;

    // return {
    //     <p>Button pressed {nPress} times</p>}
    // }
};

const CreateIncrementButton = (setNPress) => {
    const button = document.createElement('button');
    button.textContent = 'Press me';
    button.classList.add('btn', 'btn-primary', 'mt-2');
    button.addEventListener('click', () => setNPress(prev => prev + 1));
    return button;
};

const CreateButton = (title, onClick) => {
    const button = document.createElement('button');
    button.textContent = title;
    button.classList.add('btn', 'btn-primary');
    button.addEventListener('click', onClick);
    return button;
};

window.onload = init;