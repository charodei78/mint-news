require('./bootstrap');

require('alpinejs');

// window.onpopstate = () => {
//   Livewire.emit('history-move')
// }
window.onpopstate = function(event) {
    Livewire.emit('history-move', event.state)
    console.log( "location: " + document.location + ", state: " + JSON.stringify(event.state))
};
