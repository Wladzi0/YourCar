$('#btnAdd').click(function(){
    let url = window.location.href;
      $.ajax({method: 'POST',
        url: '/session/add',
         data: {
            'url': url
         }
      })
});