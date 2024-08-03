document.addEventListener('DOMContentLoaded', function(){
    const joinModalOpen = document.querySelector('.join_modal_open');
    const joinModal = document.querySelector('.join_modal');
    const joinModalClose = document.querySelector('.join_modal_close');

    function modal(a,b,c){
        a.addEventListener('click' , function(){
            b.style.display = c
        })
    }

    modal (joinModalOpen, joinModal , 'block')
    modal (joinModalClose, joinModal , 'none')
})