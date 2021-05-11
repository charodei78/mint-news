require('./bootstrap');

require('alpinejs');

// window.onpopstate = () => {
//   Livewire.emit('history-move')
// }

window.log = console.log;

window.changePage = (page, params = {}, pushState = true) =>
{
    if (pushState) {
        console.log(params)
        let url = new URL('/' + page, location.href);
        if (params['page'])
            delete params['page'];
        for (let i in params)
            url.searchParams.append(i, params[i]);
        url = url.toString();
        if (event.button === 1) {
            let win = window.open(url, '_blank', "width=900");
            return;
        }

        else if (url === location.href)
            return
        else
            history.pushState({ page: page, ...params }, page, url);
    }
    window.Livewire.emitTo('index','changePage', page, params);
    dispatchEvent(new Event('change-page'));
}

window.onpopstate = function(event) {
    let props = {};
    for (let i in event.state)
        if (i !== 'livewire')
            props[i] = event.state[i];
    changePage( event.state.page, props, false);
};

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

