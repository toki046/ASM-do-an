let arrow = document.querySelectorAll(".arrow");
console.log(arrow);
for(var i = 0; i < arrow.length; i++) {
    arrow[i].addEventListener("click", (a)=>{
        let arrowParent = a.target.parentElement.parentElement;
        console.log(arrowParent);
        arrowParent.classList.toggle("showMenu");
    });
}