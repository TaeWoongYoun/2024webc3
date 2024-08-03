document.addEventListener('DOMContentLoaded', function(){
    const joinModalOpen = document.querySelector('.join_modal_open');
    const joinModal = document.querySelector('.join_modal');
    const joinModalClose = document.querySelector('.join_modal_close');
    const loginModalOpen = document.querySelector('.login_modal_open');
    const loginModal = document.querySelector('.login_modal');
    const loginModalClose = document.querySelector('.login_modal_close');


    function modal(a,b,c){
        a.addEventListener('click' , function(){
            b.style.display = c
        })
    }

    // 회원가입을 누르면
    modal (joinModalOpen, joinModal , 'block')
    modal (joinModalOpen, loginModal , 'none')
    modal (joinModalClose, joinModal , 'none')

    // 로그인을 누르면
    modal (loginModalOpen, loginModal , 'block')
    modal (loginModalOpen, joinModal , 'none')
    modal (loginModalClose, loginModal , 'none')
})