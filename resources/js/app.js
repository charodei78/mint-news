require('./bootstrap');

require('alpinejs');

// window.onpopstate = () => {
//   Livewire.emit('history-move')
// }

window.log = console.log;

window.changePage = (page, params = {}, pushState = true) =>
{
    if (event.button !== 1 && event.button !== 0)
        return;

    const url = new URL('/' + page, location.href);

    for (let i in params)
    {
        url.searchParams.append(i, params[i]);
    }

    let urlString = url.toString();

    if (event.button === 1) {
        let win = window.open(urlString, '_blank', "width=900");
        return;
    }

    window.Livewire.emitTo('index','changePage', page, params);
    history.replaceState(history.state, page, urlString);

    dispatchEvent(new Event('change-page'));
    scrollTo(0, 0);
}

// window.onpopstate = function(event) {
//     let props = {};
//     for (let i in event.state)
//         if (i !== 'livewire')
//             props[i] = event.state[i];
//     changePage( event.state.page, props, false);
// };

document.addEventListener("DOMContentLoaded", () => {
    Livewire.hook('message.sent', (message, component) => {
        preloader.style.display = 'flex';
    })
    Livewire.hook('message.processed', (message, component) => {
        preloader.style.display = 'none';
        let share = document.querySelector('.ya-share2');
        if (share)
        {
            while (!share.innerHTML.length)
                Ya.share2(share);
        }
    })
});

const camelToKebabCase = str => str.replace(/[A-Z]/g, letter => `-${letter.toLowerCase()}`);

