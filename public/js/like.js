document.querySelectorAll('#js-favourite').forEach(function (link) {
    link.addEventListener('click', onClickBtnLike);
});
function onClickBtnLike(event) {
    event.preventDefault();

    const url = this.href;
    const icon = this.querySelector('i')
    let divNum=$('#js-favourite').data('car');
    let likeCount = $('#like-count').val();
    axios.get(url).then(function (response) {

        if (icon.classList.contains('fas')) {
            icon.classList.replace('fas', 'far');
            likeCount--;
            $('#like-count').val(likeCount);
            if (divNum)
                setTimeout(function (){
                    $('#'+divNum).remove();
                },300);
        } else {
            likeCount++;
            $('#like-count').val(likeCount);
            icon.classList.replace('far', 'fas');
        }
    }).catch(function (error){
        if (error.response.status===403){
            window.alert("To add this car to your favourite you have to login")
        }
    });
}
