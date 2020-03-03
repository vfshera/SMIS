
    mybutton = document.getElementById("gotopbtn");
    window.onscroll = () => {

                if (document.body.scrollTop > 40 || document.documentElement.scrollTop > 40) {
                    mybutton.style.display = "block";
                } else {
                    mybutton.style.display = "none";
                }
    };

    mybutton.on('click',() => {
      document.body.scrollTop = 0; // For Safari
      document.documentElement.scrollTop = 0; // For Chrome, Firefox, IE and Opera
    });
