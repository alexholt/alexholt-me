import '../css/style.css';

function registerServiceWorker() {
  if ('serviceWorker' in navigator) {
    navigator.serviceWorker.register('service-worker.js')
      .then(function(reg){
        console.log("Service worker registered");
      }).catch(function(err) {
      console.log("Error with service worker registration: ", err)
    });
  }
}

window.addEventListener('load', () => {
  registerServiceWorker();
});
