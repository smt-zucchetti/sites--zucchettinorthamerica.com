(function() {
  
  var RokettoJS = {
      loadEvents: function() {
          window.global.setup();
      }
  };

  document.addEventListener("DOMContentLoaded", RokettoJS.loadEvents);

})();