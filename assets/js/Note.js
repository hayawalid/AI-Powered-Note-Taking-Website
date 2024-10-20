document.addEventListener("DOMContentLoaded", function() {
    var elements = document.querySelectorAll(".panel");
    var win = window;
  
    function visible(el, partial) {
      var viewTop = win.scrollY;
      var viewBottom = viewTop + win.innerHeight;
      var top = el.getBoundingClientRect().top + win.scrollY;
      var bottom = top + el.clientHeight;
      var compareTop = partial ? bottom : top;
      var compareBottom = partial ? top : bottom;
  
      return ((compareBottom <= viewBottom) && (compareTop >= viewTop));
    }
  
    elements.forEach(function(el) {
      if (visible(el, true)) {
        el.classList.add("already-visible");
      }
    });
  
    win.addEventListener("scroll", function() {
      elements.forEach(function(el) {
        if (visible(el, true)) {
          el.classList.add("come-in");
        }
      });
    });
  
    document.querySelector('.summarize').addEventListener('click', function() {
      const summarizedElement = document.querySelector('.summaried-class');
      const noteContent = document.querySelector('.note-content');
      
      summarizedElement.style.display = 'block';
      noteContent.classList.remove('centered');
    });
  });
  