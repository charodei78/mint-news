require('./bootstrap');

require('alpinejs');

// window.onpopstate = () => {
//   Livewire.emit('history-move')
// }
window.onpopstate = function(event) {
    Livewire.emit('history-move', event.state)
    console.log( "location: " + document.location + ", state: " + JSON.stringify(event.state))
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