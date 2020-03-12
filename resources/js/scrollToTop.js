
 const mybutton = document.querySelector("#gotopbtn");
  window.onload = ()=>{


    mybutton.addEventListener('click',() => {
     document.body.scrollTop = 0; // For Safari
     document.documentElement.scrollTop = 0; // For Chrome, Firefox, IE and Opera
   });
}


    window.onscroll = ()=>{

                if (document.body.scrollTop > 40 || document.documentElement.scrollTop > 40) {
                    mybutton.style.display = "block";
                } else {
                    mybutton.style.display = "none";
                }
    };


    // document.ready(()=>{
    //     document.querySelector('#dt').DataTable({
    //     "paging": true,
    //     "lengthChange": false,
    //     "searching": true,
    //     "ordering": true,
    //     "info": true,
    //     "autoWidth": false,
    // });
    // }),
